<?php

namespace App\Http\Controllers\participant;

use App\Http\Controllers\Controller;
use App\Models\disability\Disability;
use App\Models\participant\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::all();

        return view('participants.index', compact('participants'));
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

        return view('participants.create', compact('age_groups', 'disabilities'));
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
            $participant = Participant::create($data);
            if ($participant) {
                DB::commit();
                return redirect(route('participants.index'))->with(['success' => 'Participant created successfully']);
            }
        } catch (\Throwable $th) {
            throw GeneralException('Error creating participant!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        return view('participants.view', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
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
