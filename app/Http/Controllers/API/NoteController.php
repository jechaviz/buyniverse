<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        return Job_note::create([
            'title' => $request->title,
            'description' => $request->description,
            'star' => 0,
            'color' => 'note-bg-green',
            'user_id' => $request->user_id,
            'job_id' => $request->job_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes = Job_note::where('job_id', $id)->get();
        return response()->json($notes);
    }

    public function star($id)
    {
        $notes = Job_note::find($id);
        if($notes->star == 0)
            $notes->star = 1;
        else
            $notes->star = 0;
        $notes->save();
        //return response()->json($notes);
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
        $notes = Job_note::find($id);
        
        $notes->delete();
    }
}
