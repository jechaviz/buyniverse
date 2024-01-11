<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Question;
use App\Quiz;
use App\Answer;
use App\Marks;

class MarksController extends Controller
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
        $quiz = Quiz::find($id);
        $quiz->questions = Question::where('quiz_id', $id)->get();
        foreach ($quiz->questions as $key => $value) 
        {
            $value->answers = Answer::where('question_id', $value->id)->get();
        }
        
        return view('back-end.freelancer.jobs.quiz', compact('quiz'));
        //dd($quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //dd($request->all(), $id);
        $marks = new Marks;
        $marks->user_id = $request->user_id;
        $marks->quiz_id = $id;
        $mark = 0;
        $total = 0;
        $report = '';
        $questions = Question::where('quiz_id', $id)->get();
        foreach ($questions as $key => $value) 
        {
            $quest = 'question'.$value->id;
            $ids = $request->$quest;
            $idx = explode('-', $ids);
            $ans = Answer::find($idx[1]);
            //dd($ans);
            $mark += $ans->value;
            $total += $value->value;
            $report = $report.''.$value->question.' - '.$value->value.'<br>'.$ans->answer.' - '.$ans->value.'<br><br><br>';

        }
        $marks->marks = $mark;
        $marks->total = $total;
        $marks->report = $report;

        //dd($marks);
        $marks->save();
        
        return Redirect::to('provider/dashboard');
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
