<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job_ticket;
use App\Reply_ticket;
use App\User;
use App\Fteam;
use Storage;

class TicketController extends Controller
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
        $file = $request->file('files');
        //dd($file);
        $ticket = new Job_ticket;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->sent_to = $request->sent_to;
        $ticket->from = $request->user_id;
        $ticket->priority = $request->priority;
        $ticket->status = 'open';
        $ticket->job_id = $request->job_id;
        if($file)
            $ticket->file_id = time().'.'.$file->getClientOriginalExtension(); 
        $ticket->save(); 

        if($file)
        {
            $input['file'] = $ticket->file_id;

            $destinationPath = public_path('/job_tickets/'); 

            $file->move($destinationPath, $input['file']);
        }
        
        /*return Job_ticket::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'sent_to' => $request->sent_to,
            'from' => $request->user_id,
            'priority' => $request->priority,
            'status' => 'open',
            'job_id' => $request->job_id
        ]);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tickets = Job_ticket::where('job_id', $id)->get();
        foreach($tickets as $key => $ticket)
        {
            $reply = Reply_ticket::where('ticket_id', $ticket->id)->get();
            //dd($reply);
            foreach($reply as $key1 => $value)
            {
                $user = User::find($value->user_id);
                $value->user = $user->first_name.' '.$user->last_name;
            }
            $ticket->reply = $reply;
            $sent = User::find($ticket->sent_to);
            $from = User::find($ticket->from);
            $ticket->sent_to = $sent->first_name.' '.$sent->last_name;
            $ticket->from = $from->first_name.' '.$from->last_name;
        }
        return response()->json($tickets);
    }
    public function status($id)
    {
        $ids = explode('-', $id);
        
        $ticket = Job_ticket::find($ids[0]);
        $ticket->status = $ids[1];
        $ticket->save(); 
    }
    public function download($id)
    {
        //dd('this is the test');
        
        $ticket = Job_ticket::find($id);
        //dd($ticket, $id);
        $fullpath="/job_tickets/{$ticket->file_id}";
        //dd($fullpath);
        return response()->download(public_path($fullpath), null, [], null);
        //return response()->download(storage_path($fullpath));
        //return Storage::disk('public')->download($fullpath);
    }
    public function team($id) {
        $teams = Fteam::where('user_id', $id)->get();
        return response()->json($teams);
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
