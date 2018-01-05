<?php

namespace App\Http\Controllers\Frontend;

use App\Menu;
use App\MenuPost;
use App\Section;
use App\SectionCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Gallery;
use App\Post;
use App\PostCategory;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('position', 'asc')->get();
        $categories = SectionCategory::orderBy('position', 'asc')->get();
        foreach ($categories as $value){
            $sections = Section::where('category_id', $value->id)->orderBy('position', 'asc')->get();
            if($sections){
                $value->sections = $sections;
                foreach ($value->sections as $item){
                    $gallery = Gallery::find($item->gallery_id);
                    if($gallery){
                        $galleryToArray = json_decode($gallery->gallery);
                        $item->gallery = $galleryToArray;
                    }
                }
            }
        }
        $category = PostCategory::first();
        $blogs = Post::where('category_id', $category->id)->get();
        $category->blogs = $blogs;
        //dd($categories);
        return view('theme.index', compact('banners', 'categories', 'category'));
    }

    public function detail($slug){
        $detail = MenuPost::where('url', $slug)->first();
        if(!$detail){
            return response()->view('metronic.errors.404', [], 404);
        }
        $menu = Menu::find($detail->menu_id);
        return view('theme.detail', compact('detail', 'menu'));
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
