<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fteam;
use App\User;
use App\Profile;
use App\Mail\FTeamInvite;
use App\Mail\FuserInvite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Hash;
use App\EmailHelper;

class FteamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $teams = Fteam::where('user_id', $user_id)->get();
        return view('back-end.freelancer.fteams.index', compact('teams'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $user_id = Auth::user()->id;
        Fteam::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'user_id' => $user_id,
        ]);
        if(User::where('email', $request->email)->exists())
        {
            Mail::to($request->email)->send(new FteamInvite());
            Mail::to('sadiqueali786@gmail.com')->send(new FteamInvite());
        }
        else{
            $user = new User;
            $user->first_name = $request->name;
            $user->last_name = $request->name;
            $user->user_verified = 1;
            $user->password = Hash::make('password');
            $user->email = $request->email;
            $user->save();
            $user->assignRole('freelancer');
            $profile = new Profile();
            $profile->user()->associate($user->id);
            $profile->save();
            Mail::to($request->email)->send(new FuserInvite($user));
            Mail::to('sadiqueali786@gmail.com')->send(new FuserInvite($user));
        }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Fteam::find($id);
        return view('back-end.freelancer.fteams.edit', compact('team'));
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
        $team = Fteam::find($id);
        $team->name = $request->name;
        $team->email = $request->email;
        $team->role = $request->role;
        $team->save();
        return redirect()->route('fteam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Fteam::find($id);
        
        $team->delete();
        return redirect()->route('fteam.index');
    }
}
