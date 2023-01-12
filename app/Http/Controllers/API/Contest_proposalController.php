<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Live_contest;
use App\Job;
use App\User;
use App\Proposal;
use App\Contest_bid;
use Carbon\Carbon;
use App\Live_contest_participant;

class Contest_proposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'this is the test';
    }

    public function hascontest($id)
    {
        $name = array();
        $chart1 = array();
        $chart2 = array();
        
        if(Live_contest::where('job_id', $id)->exists())
        {
            $contest = Live_contest::where('job_id', $id)->first();
            $job = Job::find($contest->job_id);
            $contest->title = $job->title;
            $now =  Carbon::today();
            $start = Carbon::parse($contest->start_date)->format('Y-m-d\TH:i');
            $end = Carbon::parse($contest->end_date)->format('Y-m-d\TH:i');
            $contest->result = $now->gt($start);
            if($contest->result)
            {
                $contest->result = $now->gt($end);
            }
            $participant = Live_contest_participant::where('live_id', $contest->id)->get();
            
            foreach($participant as $value)
            {
                $chart = array();
                $user = User::find($value->user_id);
                $profile =  $user->profile;

                $value->name = $user->first_name.' '.$user->last_name;
                $value->tagline = $profile->tagline;
                array_push($name, $value->name);
                
                $proposal = Proposal::where('job_id', $contest->job_id)->where('freelancer_id', $value->user_id)->first();
                $saved = ($proposal->original - $proposal->amount) * 100 / $proposal->original;
                
                
                
                //dd($bids);
                $saved = round($saved, 2);
                $proposal->saved = $saved;
                $value->proposal = $proposal;
                $bids = Contest_bid::where('contest_id', $contest->id)->where('user_id', $user->id)->select('bid', 'created_at')->get();
                array_push($chart, $bids);
                array_push($chart1, $proposal->original);
                array_push($chart2, $proposal->amount);
                $value->chart1 = $chart;
                $value->bids = $bids;
            }
            $contest->participants = $participant;
            $contest->name = $name;
            $contest->chart1 = $chart1;
            $contest->chart2 = $chart2;
            /*$contest->chart1 = $chart1;
            $contest->chart2 = $chart2;*/
            //dd($chart1, $chart2, $name);
            $best = 0;
            $best_after = 0;
            $min = null;
            $max = null;

            if(Contest_bid::where('contest_id', $contest->id)->exists())
            {
                $bid = Contest_bid::where('contest_id', $contest->id)->select('created_at')->first();
                $min = $bid->created_at;
                
                $bid1 = Contest_bid::where('contest_id', $contest->id)->select('created_at')->orderBy('id', 'desc')->first();
                //dd($bid1);
                $max = $bid1->created_at;

                $best_bid = Contest_bid::where('contest_id', $contest->id)->where('status', 1)->get();
                foreach($best_bid as $value)
                {
                    if($best == 0)
                    {
                        $best = $value->bid;
                    }
                    if($value->bid < $best)
                        $best = $value->bid;
                }
                foreach($bids as $value)
                {
                    //dd($value);
                    if($best_after == 0)
                    {
                        $best_after = $value->bid;
                    }
                    if($value->bid < $best_after)
                        $best_after = $value->bid;

                    
                }
                $financial = ($job->price - $best) * 100 / $job->price;
                $job->best = $best; 
                $job->financial = round($financial, 2); 

                $job->best_after = $best_after; 
                $additional = ($best - $best_after) * 100 / $best;
                $job->additional = round($additional, 2); 
                $total = ($job->price - $best_after) * 100 / $job->price;
                $job->total = round($total, 2);
            }

            
            
            
            

            

            $contest->job = $job;
            $contest->min = $min;
            $contest->max = $max;
            
        
            //dd($best_after);
            return $contest;
        }
        return;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return $contest;
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
