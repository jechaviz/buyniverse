<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Live_contest;
use App\Proposal;
use App\Live_contest_participant;
use App\Job;
use App\Contest_bid;
use App\User;
use Session;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Mail\Conteststart;
use Illuminate\Support\Facades\Mail;


class ContestController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function start($id)
    {
        //dd('Contest is started');
        $contest = Live_contest::find($id);
        $job = Job::find($contest->job_id);
        $contest->title = $job->title;
        $now =  Carbon::today();
        $start = Carbon::parse($contest->start_date)->format('Y-m-d\TH:i');
        $end = Carbon::parse($contest->end_date)->format('Y-m-d\TH:i');
        $result = $now->gt($start);
        if($result)
        {
            $result = $now->gt($end); 
        }
        
        //Mail on start
        $participant = Live_contest_participant::where('live_id', $contest->id)->get();
        foreach($participant as $value)
        {
            $proposal = Proposal::where('job_id', $contest->job_id)->where('freelancer_id', $value->user_id)->first();
            $saved = ($proposal->original - $proposal->amount) * 100 / $proposal->original;

            $saved = round($saved, 2);
            $proposal->saved = $saved;
            $value->proposal = $proposal;
            $user = User::find($value->user_id);
            Mail::to($user->email)->send(new Conteststart($job));
            Mail::to('sadiqueali786@gmail.com')->send(new Conteststart($job));
        }

        $contest->participants = $participant;
        //dd($contest);
        
        return view('back-end.employer.contests.start', compact('contest', 'result'));
        
    }

    public function sendinvite($id)
    {
        //dd('Contest invite is sent');
        $ids = explode('-', $id);
        if(Live_contest_participant::where('live_id', $ids[0])->where('user_id', $ids[1])->exists())
        {
            //already invited
        }
        else
        {
            $contest = Live_contest::find($id);
            $proposal = Proposal::where('job_id', $contest->job_id)->where('freelancer_id', $ids[1])->first();

            $contest_bid = new Contest_bid;
            $contest_bid->bid = $proposal->amount;
            $contest_bid->contest_id = $ids[0];
            $contest_bid->user_id = $ids[1];
            $contest_bid->status = 1;

            $participant = new Live_contest_participant;
            $participant->live_id = $ids[0];
            $participant->user_id = $ids[1];

            $participant->save();
            $contest_bid->save();
            //session()->put(['type' => 'success', 'message' => trans('lang.job_contest_invite')]);
            //return redirect()->back(); 
            /*$json['type'] = 'success';
            $json['message'] = trans('lang.job_contest_invite');
            return $json;*/
            $route = URL::previous();
            Session::flash('success', 'User Invited');
            return Redirect::to($route.'#menu3');
        }
        
    }

    public function contest($id)
    {
        if(Live_contest::where('job_id', $id)->exists())
        {
            //dd('send to show');
            $contest = Live_contest::where('job_id', $id)->first();
            return redirect()->route('contests.show', $contest->id);
        }
        else
        {
            return view('back-end.employer.contests.create', compact('id'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->show_participant == null);
        $contest = new Live_contest;
        $contest->job_id = $request->job_id;
        $contest->start_date = $request->start_date;
        $contest->end_date = $request->end_date;
        if($request->show_participant == null)
            $contest->show_participant = 'no';
        else
            $contest->show_participant = 'yes';

        if($request->show_participant_to_freelancer == null)
            $contest->show_participant_to_freelancer = 'no';
        else
            $contest->show_participant_to_freelancer = 'yes';

        if($request->show_participant_offer_to_freelancer == null)
            $contest->show_participant_offer_to_freelancer = 'no';
        else
            $contest->show_participant_offer_to_freelancer = 'yes';

        $contest->time_limit = $request->time_limit;
        if($request->automatic_offer == null)
        {
            $contest->automatic_offer = 'no';            
        }
        else
        {
            $contest->automatic_offer = 'yes';
            $contest->automatic_offer_choice = $request->automatic_offer_choice;
            $contest->automatic_offer_value = $request->automatic_offer_value;   
        }
            

        
        
        $contest->awarded_allowed = $request->awarded_allowed;
        
        $contest->save();

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd('Show is accepted', $id);
        $contest = Live_contest::find($id);
        $job = Job::find($contest->job_id);
        $contest->title = $job->title;
        return view('back-end.employer.contests.show', compact('contest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contest = Live_contest::find($id);    
        $contest->startdate = Carbon::parse($contest->start_date)->format('Y-m-d\TH:i');
        $contest->enddate = Carbon::parse($contest->end_date)->format('Y-m-d\TH:i');
        return view('back-end.employer.contests.edit', compact('contest'));
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
        //dd($request->all());
        $contest = Live_contest::find($id);
        //$contest->job_id = $request->job_id;
        $contest->start_date = $request->start_date;
        $contest->end_date = $request->end_date;
        if($request->show_participant == null)
            $contest->show_participant = 'no';
        else
            $contest->show_participant = 'yes';

        if($request->show_participant_to_freelancer == null)
            $contest->show_participant_to_freelancer = 'no';
        else
            $contest->show_participant_to_freelancer = 'yes';

        if($request->show_participant_offer_to_freelancer == null)
            $contest->show_participant_offer_to_freelancer = 'no';
        else
            $contest->show_participant_offer_to_freelancer = 'yes';

        $contest->time_limit = $request->time_limit;
        if($request->automatic_offer == null)
        {
            $contest->automatic_offer = 'no';   
            $contest->automatic_offer_choice = null;
            $contest->automatic_offer_value = null;         
        }
        else
        {
            $contest->automatic_offer = 'yes';
            $contest->automatic_offer_choice = $request->automatic_offer_choice;
            $contest->automatic_offer_value = $request->automatic_offer_value;   
        }
            

        
        
        $contest->awarded_allowed = $request->awarded_allowed;
        
        $contest->save();

        return redirect()->route('contests.show', $contest->id);
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
