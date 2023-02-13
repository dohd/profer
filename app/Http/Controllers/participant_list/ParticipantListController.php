<?php

namespace App\Http\Controllers\participant_list;

use App\Http\Controllers\Controller;
use App\Models\disability\Disability;
use App\Models\participant_list\ParticipantList;
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
        $age_groups = DB::table('age_groups')->get();
        $disabilities = Disability::get();

        return view('participant_lists.create', compact('age_groups', 'disabilities'));
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
        $data = $request->only(['name', 'gender', 'age_group_id', 'disability_id', 'organisation', 'designation', 'phone', 'email']);

        DB::beginTransaction();

        try {            
            $participant_list = ParticipantList::create($data);
            if ($participant_list) {
                DB::commit();
                return redirect(route('participant_lists.index'))->with(['success' => 'ParticipantList created successfully']);
            }
        } catch (\Throwable $th) {
            throw GeneralException('Error creating participant_list!');
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
        return view('participant_lists.edit', compact('participant_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
