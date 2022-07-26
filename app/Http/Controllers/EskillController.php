<?php

namespace App\Http\Controllers;

use View;
use Auth;
use Session;
use App\Skill;
use App\User;
use App\Job;
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
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $skills = $this->skill::where('title', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            $pagination = $skills->appends(
                array(
                    'keyword' => $request->get('keyword')
                )
            );
        } else {
            $skills = $this->skill->paginate(7);
        }
        if (file_exists(resource_path('views/extend/back-end/admin/skills/index.blade.php'))) {
            return View::make(
                'extend.back-end.admin.skills.index',
                compact('skills')
            );
        } else {
            return View::make(
                'back-end.admin.skills.index',
                compact('skills')
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
        if (!empty($id)) {
            $skills = $this->skill::find($id);
            if (!empty($skills)) {
                if (file_exists(resource_path('views/extend/back-end/admin/skills/edit.blade.php'))) {
                    return View::make(
                        'extend.back-end.admin.skills.edit',
                        compact('id', 'skills')
                    );
                } else {
                    return View::make(
                        'back-end.admin.skills.edit',
                        compact('id', 'skills')
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
