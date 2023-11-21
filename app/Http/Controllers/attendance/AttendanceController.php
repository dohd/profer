<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use App\Models\action_plan\ActionPlan;
use App\Models\age_group\AgeGroup;
use App\Models\attendance\Attendance;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\item\AttendanceItem;
use App\Models\item\ProposalItem;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::latest()->get();

        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proposals = Proposal::whereHas('action_plans')->get(['id', 'title']);
        $age_groups = AgeGroup::get(['id', 'bracket']);
        $disabilities = Disability::get(['id', 'name']);
        
        return view('attendances.create', compact('age_groups', 'disabilities', 'proposals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required', 
            'action_plan_id' => 'required',
            'proposal_item_id' => 'required', 
            'date' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            'doc_file' => $request->doc_file? 'required|mimes:csv,pdf,xls,xlsx,doc,docx' : 'nullable',
        ]);
        if ($validator->fails()) {
            return redirect(route('attendances.index'))->with(['error' => 'Unsupported file format!']);
        }
        $file = $request->file('doc_file');
        if ($file) $this->uploadFile($file);
       
        DB::beginTransaction();

        try {
            $input = inputClean($request->except('_token'));
            $attendance = Attendance::create($input);

            $input_items = $input['attendance_items'];
            foreach ($input_items as $key => $value) {
                $input_items[$key] = array_replace($value, [
                    'attendance_id' => $attendance->id,
                    'male' =>  numberClean($value['male']),
                    'female' =>  numberClean($value['female']),
                    'total' =>  numberClean($value['total']),
                ]);
            }
            AttendanceItem::insert($input_items);

            DB::commit();
            return redirect(route('attendances.index'))->with(['success' => 'Attendance created successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error creating Attendance!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('attendances.view', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $proposals = Proposal::whereHas('action_plans')->get(['id', 'title']);
        $age_groups = AgeGroup::get(['id', 'bracket']);
        $disabilities = Disability::get(['id', 'name']);

        $attendance['action_plans'] = ActionPlan::where('proposal_id', $attendance->proposal_id)
        ->get(['id', 'tid', 'date'])
        ->map(function($v) {
            $v->code = tidCode('action_plan', $v->tid) . '/' . dateFormat($v->date, 'Y');
            return $v;
        });
        $attendance['proposal_items'] = ProposalItem::whereHas('plan_activities', function ($q) use($attendance) {
            $q->whereHas('action_plan', fn($q) => $q->where('id', $attendance->action_plan_id));
        })->get(['name', 'id']);
        $attendance['regions'] = Region::whereHas('plan_regions', function ($q) use($attendance) {
            $q->whereHas('plan_activity', fn($q)  => $q->where('activity_id', $attendance->proposal_item_id));
        })->get(['name', 'id']);
        $attendance['cohorts'] = Cohort::whereHas('plan_cohorts', function ($q) use($attendance) {
            $q->whereHas('plan_activity', fn($q) => $q->where('activity_id', $attendance->proposal_item_id));
        })->get(['name', 'id']); 

        return view('attendances.edit', compact('attendance', 'age_groups', 'disabilities', 'proposals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'proposal_id' => 'required', 
            'action_plan_id' => 'required',
            'proposal_item_id' => 'required', 
            'date' => 'required',
        ]);

        DB::beginTransaction();

        try {     
            $input = inputClean($request->except('_token'));
            $attendance->update($input);

            $input_items = $input['attendance_items'];
            foreach ($input_items as $key => $value) {
                $input_items[$key] = array_replace($value, [
                    'attendance_id' => $attendance->id,
                    'male' =>  numberClean($value['male']),
                    'female' =>  numberClean($value['female']),
                    'total' =>  numberClean($value['total']),
                ]);
            }
            $attendance->items()->delete();
            AttendanceItem::insert($input_items);

            DB::commit();
            return redirect(route('attendances.index'))->with(['success' => 'Attendance updated successfully']);              
        } catch (\Throwable $th) {
            errorHandler('Error updating Attendance!', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        try {
            $attendance->items()->delete();
            $attendance->delete();
            return redirect(route('attendances.index'))->with(['success' => 'Attendance deleted successfully']);
        } catch (\Throwable $th) {
            errorHandler('Error deleting Attendance!', $th);
        }
    }

    /**
     * Remove the file from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_file(Request $request)
    { 
        try {
            $attendance = Attendance::find($request->attendance_id);
            $this->deleteFile($attendance[$request->field]);
            $attendance->update([$request->field => null]);

            return response()->json(['success' => true, 'message' => 'File deleted successfully', 'redirectTo' => route('attendances.show', $attendance)]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Upload file to storage
     */
    public function uploadFile($file)
    {
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file_path = 'attendance' . DIRECTORY_SEPARATOR;
        Storage::disk('public')->put($file_path . $file_name, file_get_contents($file->getRealPath()));
        return $file_name;
    }

    /**
     * Delete file from storage
     */
    public function deleteFile($file_name)
    {
        $file_path = 'attendance' . DIRECTORY_SEPARATOR;
        $file_exists = Storage::disk('public')->exists($file_path . $file_name);
        if ($file_exists) Storage::disk('public')->delete($file_path . $file_name);
        return $file_exists;
    }
}
