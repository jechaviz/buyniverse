<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Live_contest;
use App\Live_contest_participant;
use App\Proposal;
use App\User;
use App\Job;
use App\Chatroom;
use App\Chat;
use Auth;
use File;
use App\Contest_bid;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\Contestend;

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
    public static function publicPath()
    {
        $path = public_path();
        //dd($path);
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] != '127.0.0.1') {
            $path = getcwd();
        }
        return $path;
    }
    public static function getProfileImage($user_id, $size = '')
    {
        $profile_image = !empty(User::find($user_id)->profile->avater) ? User::find($user_id)->profile->avater : '';
        if (!empty($size)) {
            if (file_exists(self::publicPath() . 'public/uploads/users/' . $user_id . '/' . $size . $profile_image)) {
                return !empty($profile_image) ? 'public/uploads/users/' . $user_id . '/' . $size . $profile_image : '/public/images/user.jpg';
            } else if (file_exists(self::publicPath() . 'public/uploads/users/' . $user_id . '/' . $profile_image)) {
                return !empty($profile_image) ? 'public/uploads/users/' . $user_id . '/' . $profile_image : '/public/images/user.jpg';
            } else {
                return '/public/images/user.jpg';
            }

        } else if (file_exists(self::publicPath() . 'uploads/users/' . $user_id . '/' . $profile_image)) {
            return !empty($profile_image) ? 'uploads/users/' . $user_id . '/' . $profile_image : '/public/images/user.jpg';
        } else {
            return '/public/images/user.jpg';
        }
    }

    public function getmessages($id)
    {
        //dd($id);
        $user_id = Auth::user()->id;
        $chats = Chat::where('chatroom_id', $id)->get();
        foreach($chats as $value)
        {
            $user = User::find($value->user_id);
            if($user->nickname)
                $username = $user->nickname;
            else
                $username = $user->first_name.' '.$user->last_name;
            $value->username = $username;
            $value->image = $this->getProfileImage($user->id);
            //dd($this->getProfileImage($user->id));
        }
        return $chats ;
    }

    public function sendmessage(Request $request)
    {
        //dd($request->all());
        $user_id = Auth::user()->id;
        return Chat::create([
            'chatroom_id' => $request->chatroom_id,
            'message' => $request->message,
            'user_id' => $user_id
        ]);
    }

    public function check($id)
    {
        if(Live_contest::where('job_id', $id)->exists())
        {
            $live = Live_contest::where('job_id', $id)->first();
            if(Chatroom::where('contest_id', $live->id)->exists())
            {
               $room =  Chatroom::where('contest_id', $live->id)->first();
               return $room->id;            
            }
            else
            {
                $room = Chatroom::create([
                    'contest_id' => $live->id,
                    'status' => 1
                ]);
                return $room->id;
            }                
        }
        else
        {
            return;
        }
    }
    public function over($id)
    {
        //return $id;
        $live = Live_contest::find($id);
        $job = Job::find($live->job_id);
        //dd($job);
        //to be added acceped proposal.


        //mail for contest over 
        $participant = Live_contest_participant::where('live_id', $live->id)->get();
        foreach($participant as $value)
        {
            $user = User::find($value->user_id);
            Mail::to($user->email)->send(new Contestend($job));
            Mail::to('sadiqueali786@gmail.com')->send(new Contestend($job));
        }

        $live->status = "close";
        $live->save();
        //Contest is over
    }
    public function bid($id)
    {
        if(Live_contest::where('id', $id)->where('flag', '1')->exists())
        {
            $live = Live_contest::find($id);
            $live->flag = 0;
            $live->save();
            return 'true';
        }
        else
            return 'false';
    }
    public function provider_bid($id)
    {
        $user_id = Auth::user()->id;
        if(Live_contest_participant::where('live_id', $id)->where('user_id', $user_id)->where('status', 'yes')->exists())
        {
            $live = Live_contest_participant::where('live_id', $id)->where('user_id', $user_id)->where('status', 'yes')->first();
            $live->status = 'no';
            $live->save();
            return 'true';
        }
        else
            return 'false';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd('this is the test');
        $contest = Live_contest::find($id);
        $participant = Live_contest_participant::where('live_id', $contest->id)->get();
        foreach($participant as $value)
        {
            $user = User::find($value->user_id);
            $profile =  $user->profile;

            $value->name = $user->first_name.' '.$user->last_name;
            $value->tagline = $profile->tagline;
            $proposal = Proposal::where('job_id', $contest->job_id)->where('freelancer_id', $value->user_id)->first();
            $value->proposal = $proposal;
        }
        $now =  Carbon::today();
        $start = Carbon::parse($contest->start_date);
        
        $result = $now->lt($start);
        $contest->result = $result;
        $contest->participants = $participant;
        
        return response()->json($contest);
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
