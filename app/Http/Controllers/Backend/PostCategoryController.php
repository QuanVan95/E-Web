<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use Session;
use File;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCates = PostCategory::orderBy('id', 'desc')->paginate(10);
        foreach ($postCates as $value){
            if($value->parent_id > 0){
                $postCate = PostCategory::find($value->parent_id);
                if($postCate){
                    $value->parent_name = $postCate->name;
                }
            }
        }
        return view('metronic.post_categories.index', compact('postCates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCates = PostCategory::all();
        return view('metronic.post_categories.create', compact('postCates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($data['description']){
            $a = str_replace('<p>', '', $data['description']);
            $b = str_replace('</p>', '', $a);
            $data['description'] = $b;
        }
        $file = $request->file('image');
        if($file){
            $file_name = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file_name;
            $file->move(base_path().'/public/images/post_cates', $file_name);
        }
        if(isset($data['active'])){
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }
        PostCategory::create($data);
        Session::flash('success', 'Cập nhật thành công!');
        return redirect(route('postCate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postCate = PostCategory::find($id);
        if(!$postCate){
            return response()->view('metronic.errors.404', [], 404);
        }
        $postCates = PostCategory::all();
        foreach ($postCates as $key => $value){
            if($postCate->id == $value->id){
                unset($postCates[$key]);
            }
        }
        return view('metronic.post_categories.detail', compact(['postCate','postCates']));
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
        $postCate = PostCategory::find($id);
        if(!$postCate){
            return response()->view('metronic.errors.404', [], 404);
        }
        $data = $request->all();
        if($data['description']){
            $a = str_replace('<p>', '', $data['description']);
            $b = str_replace('</p>', '', $a);
            $data['description'] = $b;
        }
        $file = $request->file('image');
        if($file){
            $file_name = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file_name;
            $file->move(base_path().'/public/images/post_cates', $file_name);
        }
        if(isset($data['active'])){
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }
        $postCate->update($data);
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCate = PostCategory::find($id);
        if(!$postCate){
            return response()->view('metronic.errors.404', [], 404);
        }
        $postCate->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
