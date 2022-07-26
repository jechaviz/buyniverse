<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;
use App\Sub_skill;

class Sub_skillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('This is the test');
        
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
        $sub = new Sub_skill;
        $sub->sub_skill = $request->skill_title;
        $sub->skill_id = $request->skill_id;
        $sub->save();
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
        
        $sub_skills = Sub_skill::where('skill_id', $id)->get();
        return view('back-end.admin.sub_skills.index', compact('sub_skills', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd('edit');
        
        $sub_skills = Sub_skill::find($id);
        return view('back-end.admin.sub_skills.edit', compact('sub_skills'));
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
        $sub = Sub_skill::find($id);
        $sub->sub_skill = $request->skill_title;
        $sub->save();
        return redirect()->route('sub-skills.show', $sub->skill_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('delete has been hitted');
        $sub = Sub_skill::find($id);
        $ids = $sub->skill_id;
        $sub->delete();
        return redirect()->route('sub-skills.show', $ids);
    }
}
