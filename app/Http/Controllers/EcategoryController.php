<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use Illuminate\Support\Facades\Redirect;
use Session;
use View;
use App\Helper;

class EcategoryController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access public
     * @var    array $category
     */
    protected $category;

    /**
     * Create a new controller instance.
     *
     * @param mixed $category get category model
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd('employer categories');
        if ($request->filled('keyword')) {
            $keyword = $request->query('keyword');
            if (Auth::user()->getRoleNames()[0] == 'admin')
                $cats = $this->category::where('title', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
            else
                $cats = $this->category::where('title', 'like', '%' . $keyword . '%')->where('status', 'appear_globally')->paginate(7)->setPath('');
            $pagination = $cats->appends([
                'keyword' => $keyword,
            ]);
        } else {
            //$cats = $this->category->paginate(10);
            if (Auth::user()->getRoleNames()[0] == 'admin')
                $cats = $this->category->paginate(10);
            else
                $cats = $this->category->where('status', 'appear_globally')->orWhere('user_id', Auth::user()->id)->paginate(10);
        }
        if (file_exists(resource_path('views/extend/back-end/admin/categories/index.blade.php'))) {
            return View::make('extend.back-end.admin.categories.index', compact('cats'));
        } else {
            return View::make(
                'back-end.admin.categories.index', compact('cats')
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
        if (!empty($id)) {
            $cats = $this->category::find($id);
            if (Auth::user()->getRoleNames()[0] == 'admin')
                $cats1 = $this->category->paginate(10);
            else
                $cats1 = $this->category->where('status', 'appear_globally')->paginate(10);
            if (!empty($cats)) {
                if (file_exists(resource_path('views/extend/back-end/admin/categories/edit.blade.php'))) {
                    return View::make('extend.back-end.admin.categories.edit', compact('cats', 'cats1'));
                } else {
                    return View::make(
                        'back-end.admin.categories.edit', compact('id', 'cats', 'cats1')
                    );
                }
                return Redirect::to('employer/categories');
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
