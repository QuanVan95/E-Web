<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MenuPost;
use App\Menu;
use Session;

class MenuPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuPosts = MenuPost::orderBy('id', 'desc')->paginate(10);
        foreach ($menuPosts as $value){
            $menu = Menu::find($value->menu_id);
            if($menu){
                $value->menu = $menu->name;
            }
        }
        return view('metronic.menu_posts.index', compact('menuPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuCates = Menu::all();
        return view('metronic.menu_posts.create', compact('menuCates'));
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
            $file->move(base_path().'/public/images/menu_posts', $file_name);
        }
        MenuPost::create($data);
        Session::flash('success', 'Cập nhật thành công!');
        return redirect(route('menuPost.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuPost = MenuPost::find($id);
        if(!$menuPost){
            return response()->view('metronic.errors.404', [], 404);
        }
        $menus = Menu::all();
        return view('metronic.menu_posts.detail', compact(['menus','menuPost']));
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
        $menuPost = MenuPost::find($id);
        if(!$menuPost){
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
            $file->move(base_path().'/public/images/menu_posts', $file_name);
        }
        $menuPost->update($data);
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
        $menu = MenuPost::find($id);
        if(!$menu){
            return response()->view('metronic.errors.404', [], 404);
        }
        $menu->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
