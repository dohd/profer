<?php

namespace App\Http\Controllers\participant_list;

use App\Http\Controllers\Controller;
use App\Models\age_group\AgeGroup;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\item\ParticipantListItem;
use App\Models\participant_list\ParticipantList;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participant_lists = ParticipantList::all();

        return view('participant_lists.index', compact('participant_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $age_groups = AgeGroup::get(['id', 'bracket']);
        $disabilities = Disability::get(['id', 'name', 'code']);
        $proposals = Proposal::get(['id', 'title']);
        $regions = Region::get(['id', 'name']);
        $programmes = Programme::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);

        return view('participant_lists.create', 
            compact('age_groups', 'disabilities', 'proposals', 'regions', 'programmes', 'cohorts')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'proposal_id' => 'required', 
            'proposal_item_id' => 'required', 
            'date' => 'required', 
            'region_id' => 'required', 
            'programme_id' => 'required', 
            'cohort_id' => 'required'            
        ]);
        $data = $request->only([
            'proposal_id', 'proposal_item_id', 'date', 'region_id', 'programme_id', 'cohort_id', 'prepared_by', 
            'male_count', 'female_count', 'total_count'
        ]);
        $data_items = $request->only([
            'name', 'gender', 'age_group_id', 'disability_id', 'phone', 'email', 'designation', 
            'organisation'
        ]);

        DB::beginTransaction();

        try {     
            $data = inputClean($data);            
            $participant_list = ParticipantList::create($data);

            $data_items = databaseArray($data_items);
            $data_items = fillArrayRecurse($data_items, ['participant_list_id' => $participant_list->id]);
            ParticipantListItem::insert($data_items);

            if ($participant_list) {
                DB::commit();
                return redirect(route('participant_lists.index'))->with(['success' => 'Participant List created successfully']);
            }
        } catch (\Throwable $th) {
            errorHandler('Error creating participant_list!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipantList $participant_list)
    {
        return view('participant_lists.view', compact('participant_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipantList $participant_list)
    {
        $age_groups = AgeGroup::get(['id', 'bracket']);
        $disabilities = Disability::get(['id', 'name', 'code']);
        $proposals = Proposal::get(['id', 'title']);
        $regions = Region::get(['id', 'name']);
        $programmes = Programme::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);

        return view('participant_lists.edit', 
            compact('participant_list', 'age_groups', 'disabilities', 'proposals', 'regions', 'programmes', 'cohorts')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParticipantList $participant_list)
    {
        // dd($request->all());
        $request->validate([
            'proposal_id' => 'required', 
            'proposal_item_id' => 'required', 
            'date' => 'required', 
            'region_id' => 'required', 
            'programme_id' => 'required', 
            'cohort_id' => 'required'            
        ]);
        $data = $request->only([
            'proposal_id', 'proposal_item_id', 'date', 'region_id', 'programme_id', 'cohort_id', 'prepared_by', 
            'male_count', 'female_count', 'total_count'
        ]);
        $data_items = $request->only([
            'item_id', 'name', 'gender', 'age_group_id', 'disability_id', 'phone', 'email', 'designation', 
            'organisation'
        ]);

        DB::beginTransaction();

        try {     
            $data = inputClean($data);      
            if ($participant_list->update($data)) {
                $data_items = databaseArray($data_items);
                $data_items = fillArrayRecurse($data_items, ['participant_list_id' => $participant_list->id]);

                // delete omitted item
                $participant_list->items()->whereNotIn('id', array_map(fn($v) => $v['item_id'], $data_items))->delete();
                // update or new item
                foreach ($data_items as $value) {
                    $participant_list_item = ParticipantListItem::firstOrNew(['id' => $value['item_id']]);
                    $participant_list_item->fill($value);
                    unset($participant_list_item->item_id);
                    $participant_list_item->save();
                }

                DB::commit();
                return redirect(route('participant_lists.index'))->with(['success' => 'Participant List updated successfully']);
            }      
        } catch (\Throwable $th) {
            errorHandler('Error updating Participant List!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipantList $participant_list)
    {
        if ($participant_list->delete()) 
            return redirect(route('participant_lists.index'))->with(['success' => 'Participant List deleted successfully']);
        else errorHandler('Error deleting Partcipant List!');
    }
}
