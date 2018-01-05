<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostCategory;
use Session;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        foreach ($posts as $value){
            $postCate = PostCategory::find($value->category_id);
            if($postCate){
                $value->category_name = $postCate->name;
            }
        }
        return view('metronic.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCates = PostCategory::all();
        return view('metronic.posts.create', compact('postCates'));
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
        if(isset($data['description'])){
            $a = str_replace('<p>', '', $data['description']);
            $b = str_replace('</p>', '', $a);
            $data['description'] = $b;
        }
        $file = $request->file('image');
        if($file){
            $file_name = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file_name;
            $file->move(base_path().'/public/images/posts', $file_name);
        }
        if(isset($data['active'])){
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }
        if(isset($data['show'])){
            $data['show'] = 1;
        }
        else{
            $data['show'] = 0;
        }
        Post::create($data);
        Session::flash('success', 'Cập nhật thành công!');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post){
            return response()->view('metronic.errors.404', [], 404);
        }
        $postCates = PostCategory::all();
        return view('metronic.posts.detail', compact(['post','postCates']));
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
        $post = Post::find($id);
        if(!$post){
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
            $file->move(base_path().'/public/images/posts', $file_name);
        }
        if(isset($data['active'])){
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }
        if(isset($data['show'])){
            $data['show'] = 1;
        }
        else{
            $data['show'] = 0;
        }
        $post->update($data);
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
        $post = Post::find($id);
        if(!$post){
            return response()->view('metronic.errors.404', [], 404);
        }
        $post->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
