<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Checklist;

class ChecklistController extends Controller
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
        return Checklist::create([
            'title' => $request->title,
            'task_id' => $request->task_id,
            'status' => 0
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        //$ids = explode('-', $id);
        
        $checklist = Checklist::find($id);
        $checklist->status = 1;
        $checklist->save(); 
    }

    public function show($id)
    {
        $checklists = Checklist::where('task_id', $id)->latest()->get();
        foreach ($checklists as $key => $value) {
            if($value->status == 1)
                $value->checked = 'checked';
            else
            $value->checked = '';
        }
        return response()->json($checklists);
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
        $checklist = Checklist::find($id);
        $checklist->delete();
    }
}
