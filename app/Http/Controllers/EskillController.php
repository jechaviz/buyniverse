<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Session;
use App\Skill;
use App\User;
use App\Job;
use App\Category;
use App\CatSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Helper;

class EskillController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $skill
     */
    protected $skill;

    /**
     * Create a new controller instance.
     *
     * @param instance $skill instance
     *
     * @return void
     */
    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cats = Category::all();
        if ($request->filled('keyword')) {
            $keyword = $request->query('keyword');
            //$skills = $this->skill::where('title', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            if (Auth::user()->getRoleNames()[0] == 'admin')
                $skills = $this->skill::where('title', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            else
                $skills = $this->skill::where('title', 'like', '%' . $keyword . '%')->where('status', 'appear_globally')->paginate(7)->setPath('');
            $pagination = $skills->appends([
                'keyword' => $keyword,
            ]);
        } else {
            //$skills = $this->skill->paginate(7);
            if (Auth::user()->getRoleNames()[0] == 'admin')
                $skills = $this->skill->paginate(10);
            else
                $skills = $this->skill->where('status', 'appear_globally')->paginate(10);
        }
        if (file_exists(resource_path('views/extend/back-end/admin/skills/index.blade.php'))) {
            return View::make(
                'extend.back-end.admin.skills.index',
                compact('skills', 'cats')
            );
        } else {
            return View::make(
                'back-end.admin.skills.index',
                compact('skills', 'cats')
            );
        }
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
        //dd('edit');
        $cats = Category::all();
        if (!empty($id)) {
            $skills = $this->skill::find($id);
            if (!empty($skills)) {
                if (file_exists(resource_path('views/extend/back-end/admin/skills/edit.blade.php'))) {
                    return View::make(
                        'extend.back-end.admin.skills.edit',
                        compact('id', 'skills', 'cats')
                    );
                } else {
                    return View::make(
                        'back-end.admin.skills.edit',
                        compact('id', 'skills', 'cats')
                    );
                }
                return Redirect::to('employer/skills');
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
