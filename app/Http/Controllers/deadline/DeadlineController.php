<?php

namespace App\Http\Controllers\deadline;

use App\Http\Controllers\Controller;
use App\Models\deadline\Deadline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeadlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deadlines = Deadline::latest()->get();

        return view('deadlines.index', compact('deadlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deadlines.create');
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
            'subject' => 'required',
            'date' => 'required',
            'module' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data = inputClean($request->except(['_token']));                     
            $deadline = Deadline::create($data);
            if ($deadline->active) {
                Deadline::where('id', '!=', $deadline->id)
                ->where(['active' => 1, 'module' => $deadline->module])
                ->update(['active' => 0]);
            }

            DB::commit();
            return redirect(route('deadlines.index'))->with(['success' => 'Deadline created successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error creating deadline!', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Deadline $deadline)
    {
        return view('deadlines.view', compact('deadline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Deadline $deadline)
    {
        return view('deadlines.edit', compact('deadline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deadline $deadline)
    {
        $request->validate([
            'subject' => 'required',
            'date' => 'required',
            'module' => 'required',
        ]);
        
        try {            
            $data = inputClean($request->except(['_token']));
            $deadline->update($data);
            return redirect(route('deadlines.index'))->with(['success' => 'Deadline updated successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error updating deadline!', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deadline $deadline)
    {
        try {            
            $deadline->delete();
            return redirect(route('deadlines.index'))->with(['success' => 'Deadline deleted successfully']);
        } catch (\Throwable $th) {
            return errorHandler('Error deleting deadline!', $th);
        }
    }
}
