<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elections = Election::all();
        if (auth()->user()->user_type == User::USER_TYPE_ADMIN) {
            return view('elections.index', ['elections' => $elections]);
        } elseif (auth()->user()->user_type == User::USER_TYPE_VOTER) {
            return view('elections.index_user', ['elections' => $elections]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elections.create');
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
            'title' => 'required|string|max:256|unique:elections',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        try {
            DB::beginTransaction();
            $election = Election::create([
                'title' => $request->title,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            foreach (Candidate::candidates as $candidate) {
                Candidate::create([
                    'election_id' => $election->id,
                    'type' => $candidate['type'],
                    'hall' => $candidate['hall'],
                    'department' => $candidate['department'],
                    'fullname' => $candidate['fullname'],
                    'home_district' => $candidate['home_district'],
                    'thumb' => $candidate['thumb'],
                    'votes' => 0,
                ]);
            }

            DB::commit();

            return redirect()->to('/elections')->with('message', 'Election created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $election = Election::find($id);
        $candidates = $election->candidates;

        if (auth()->user()->user_type == User::USER_TYPE_ADMIN) {
            return view('elections.show', ['election' => $election, 'candidates' => $candidates]);
        } elseif (auth()->user()->user_type == User::USER_TYPE_VOTER) {
            return view('elections.show_user', ['election' => $election, 'candidates' => $candidates]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Election $election)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy(Election $election)
    {
        //
    }
}
