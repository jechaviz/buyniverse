<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Job;
use App\Fteam;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function __construct()
    {
        $this->middleware('auth');        
    }*/

    public function index()
    {
        return Tasks::paginate(10);

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
        //$user_id = Auth::user()->id;
        //dd(Auth::user());
        return Tasks::create([
            'title' => $request->title,
            'description' => filter_var($request->description, FILTER_SANITIZE_STRING),
            'due_date' => $request->task_date_due,
            //'tags' => $request->tags,
            'priority' => $request->priority,
            'client_visibility' => $request->client_visibility,
            //'billable' => $request->billable,
            'status' => "0",
            'milestone' => "0",
            'created_by' => $request->user_id,
            'job_id' => $request->job_id,
            'assign' => $request->assign        
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
        $ids = explode('-', $id);
        
        $task = Tasks::find($ids[0]);
        $task->status = $ids[1];
        $task->save(); 
    }
    public function priority($id)
    {
        $ids = explode('-', $id);
        
        $task = Tasks::find($ids[0]);
        $task->priority = $ids[1];
        $task->save(); 
    }
    public function startdate($id)
    {
        $ids = explode('_', $id);
        
        $task = Tasks::find($ids[0]);
        $task->start_date = $ids[1];
        $task->save(); 
    }
    public function duedate($id)
    {
        $ids = explode('_', $id);
        
        $task = Tasks::find($ids[0]);
        $task->due_date = $ids[1];
        $task->save(); 
    }
    public function milestone($id)
    {
        $ids = explode('-', $id);
        
        $task = Tasks::find($ids[0]);
        $task->milestone = $ids[1];
        $task->save(); 
    }
    public function visibility($id)
    {
        $ids = explode('-', $id);
        
        $task = Tasks::find($ids[0]);
        $task->client_visibility = $ids[1];
        $task->save(); 
    }
    public function show($id)
    {  
        $job = Job::find($id);
        $hired = 0;
        foreach($job->proposals as $proposal)
        {
            if($proposal->status == "hired")
            $hired = $proposal->provider_id;
        }
        if($hired != 0)
        {
            $teams = Fteam::where('user_id', $hired)->get();
        }
        else
            $teams = null;
        //dd($job->proposals, $hired); 
        
        //return Tasks::where('job_id', $id)->orderBy('created_at', 'desc')->get();
        $tasks[0] = Tasks::where('job_id', $id)->where('status', 0)->latest()->get();
        $tasks[1] = Tasks::where('job_id', $id)->where('status', 1)->latest()->get();
        $tasks[2] = Tasks::where('job_id', $id)->where('status', 2)->latest()->get();
        $tasks[3] = Tasks::where('job_id', $id)->where('status', 3)->latest()->get();
        $tasks[4] = Tasks::where('job_id', $id)->where('status', 4)->latest()->get();
        $tasks[5] = $teams;
        return response()->json($tasks);
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
        $task = Tasks::find($id);
        $task->title = $request->title;
        $task->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $task = Tasks::find($id);
        $task->delete();
    }
}
