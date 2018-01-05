<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use Session;
use File;

class PostCategoryController extends Controller
{
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
        return view('admin.post_categories.index', compact('postCates'));
    }

    public function create()
    {
        $postCates = PostCategory::all();
        return view('admin.post_categories.create', compact('postCates'));
    }

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

    public function show($id)
    {
        $postCate = PostCategory::find($id);
        if(!$postCate){
            return response()->view('admin.errors.404', [], 404);
        }
        $postCates = PostCategory::all();
        foreach ($postCates as $key => $value){
            if($postCate->id == $value->id){
                unset($postCates[$key]);
            }
        }
        return view('admin.post_categories.detail', compact(['postCate','postCates']));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $postCate = PostCategory::find($id);
        if(!$postCate){
            return response()->view('admin.errors.404', [], 404);
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

    public function destroy($id)
    {
        $postCate = PostCategory::find($id);
        if(!$postCate){
            return response()->view('admin.errors.404', [], 404);
        }
        $postCate->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
