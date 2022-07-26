<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\QuestionController;
use App\Question;
use App\Answer;
use App\Quiz;
use App\Marks;
use App\User;
use Auth;
use App\Job_quiz;
use App\Team;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $QuestionController;
    public function __construct(QuestionController $QuestionController)
    {
        $this->QuestionController = $QuestionController;
    }

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
        return Quiz::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'price' => $request->price
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function results($id)
    {
        $marks = Marks::where('quiz_id', $id)->get();
        foreach ($marks as $key => $value) 
        {
            $user = User::find($value->user_id);
            $username = $user->first_name.' '.$user->last_name;
            $value->username = $username;
        }
        return response()->json($marks);   
    }
    public function show($id)
    {
        $idu = Auth::user()->id;
        $admin =  User::role('admin')->select('id')->get()->toArray();
        $team = Team::where('job_id', $id)->get();
        $teamid = array();
        foreach($team as $value)
        {
            $user = User::where('email', $value->email)->first();
            array_push($teamid, $user->id);
        }
        
        //dd($teamid);
        
        if($teamid)
        {
            $quiz = Quiz::where('user_id', $idu)->orWhere('user_id', $admin)->orWhere('user_id', $teamid)->get();
            //dd('Has team');
        }
        else
        {
            $quiz = Quiz::where('user_id', $idu)->orWhere('user_id', $admin)->get();
            //dd('no team');
        }
        foreach($quiz as $value)
        {
            $questions = Question::where('quiz_id', $value->id)->get();
            $value->questions = $questions;
            foreach($questions as $value1)
            {
                $answers = Answer::where('question_id', $value1->id)->get();
                $value1->answers = $answers;
            }
            $user = User::find($value->user_id);
            if($user->getRoleNames()->first() === 'admin')
                $value->admin = 1;
            else
                $value->admin = 0;
            $value->username = $user->first_name.' '.$user->last_name;
            if(Job_quiz::where('job_id', $id)->where('quiz_id', $value->id)->exists())
                $value->job_quiz = 1;
            else
                $value->job_quiz = 0;
        }
        return response()->json($quiz);
    }

    public function selectrecord($id)
    {
        //dd($id);
        $ids = explode('-', $id);
        if($ids[1] == 'true')
        {
            if(Job_quiz::where('job_id', $ids[0])->where('quiz_id', $ids[2])->exists())
            {}
            else
            {
                $job_quiz = new Job_quiz;
                $job_quiz->quiz_id = $ids[2];
                $job_quiz->job_id = $ids[0];
                $job_quiz->save();
            }
        }
        else
        {
            if(Job_quiz::where('job_id', $ids[0])->where('quiz_id', $ids[2])->exists())
            {
                $job_quiz = Job_quiz::where('job_id', $ids[0])->where('quiz_id', $ids[2])->first();
                $job_quiz->delete();
            }
        }

    }

    public function selectall($id)
    {
        //dd($id);
        $ids = explode('-', $id);
        //dd($ids);
        $idu = Auth::user()->id;
        $quiz = Quiz::where('user_id', $idu)->get();
        foreach($quiz as $value)
        {
            if($ids[1] == 'true')
            {
                if(Job_quiz::where('job_id', $ids[0])->where('quiz_id', $value->id)->exists())
                {}
                else
                {
                    $job_quiz = new Job_quiz;
                    $job_quiz->quiz_id = $value->id;
                    $job_quiz->job_id = $id;
                    $job_quiz->save();
                }
            }
            else
            {
                //dd('else');
                if(Job_quiz::where('job_id', $ids[0])->where('quiz_id', $value->id)->exists())
                {
                    $job_quiz = Job_quiz::where('job_id', $ids[0])->where('quiz_id', $value->id)->first();
                    
                    $job_quiz->delete();
                }
            }
        }
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
        $quiz = Quiz::find($id);
        $quiz->title = $request->title;
        $quiz->price = $request->price;
        $quiz->save(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $questions = Question::where('quiz_id', $id)->get();
        foreach($questions as $question)
        {
            $this->QuestionController->destroy($question->id);
        }
        $quiz->delete();
    }
}
