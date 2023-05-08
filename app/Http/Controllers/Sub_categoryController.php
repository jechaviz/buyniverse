<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sub_catetory;
use App\Category; 
use Auth;

class Sub_categoryController extends Controller
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

    public function approve($id)
    {
        $cat = Category::find($id);
        $cat->status = 'appear_globally';
        $cat->approved_by = Auth::user()->id;
        $cat->save();
        return redirect()->back();
    }

    public function reject($id)
    {
        $cat = Category::find($id);
        $cat->status = 'rejected';
        $cat->approved_by = Auth::user()->id;
        $cat->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub = new Sub_catetory;
        $sub->sub_category = $request->cat_title;
        $sub->category_id = $request->category_id;
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
        $cats = Sub_catetory::where('category_id', $id)->get();
        return view('back-end.admin.sub_category.index', compact('cats', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub = Sub_catetory::find($id);
        return view('back-end.admin.sub_category.edit', compact('sub'));
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
        $sub = Sub_catetory::find($id);
        $sub->sub_category = $request->cat_title;
        $sub->save();

        return redirect()->route('sub-category.show', $sub->category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Sub_catetory::find($id);
        $ids = $sub->category_id;
        $sub->delete();
        return redirect()->route('sub-category.show', $ids);
    }
}
