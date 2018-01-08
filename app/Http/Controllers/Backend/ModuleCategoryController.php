<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModuleCategory;
use Session;
use File;

class ModuleCategoryController extends Controller
{
    public function index()
    {
        $moduleCates = ModuleCategory::orderBy('id', 'desc')->paginate(10);
        foreach ($moduleCates as $value){
            if($value->parent_id > 0){
                $moduleCate = ModuleCategory::find($value->parent_id);
                if($moduleCate){
                    $value->parent_name = $moduleCate->name;
                }
            }
        }
        return view('admin.module_categories.index', compact('moduleCates'));
    }

    public function create()
    {
        $moduleCates = ModuleCategory::all();
        return view('admin.module_categories.create', compact('moduleCates'));
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
            $file->move(base_path().'/public/images/module_cates', $file_name);
        }
        if(isset($data['active'])){
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }
        ModuleCategory::create($data);
        Session::flash('success', 'Cập nhật thành công!');
        return redirect(route('moduleCate.index'));
    }

    public function show($id)
    {
        $moduleCate = ModuleCategory::find($id);
        if(!$moduleCate){
            return response()->view('admin.errors.404', [], 404);
        }
        $moduleCates = ModuleCategory::all();
        foreach ($moduleCates as $key => $value){
            if($moduleCate->id == $value->id){
                unset($moduleCates[$key]);
            }
        }
        return view('admin.module_categories.detail', compact(['moduleCate','moduleCates']));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $moduleCate = ModuleCategory::find($id);
        if(!$moduleCate){
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
            $file->move(base_path().'/public/images/module_cates', $file_name);
        }
        if(isset($data['active'])){
            $data['active'] = 1;
        }
        else{
            $data['active'] = 0;
        }
        $moduleCate->update($data);
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }

    public function destroy($id)
    {
        $moduleCate = ModuleCategory::find($id);
        if(!$moduleCate){
            return response()->view('admin.errors.404', [], 404);
        }
        $moduleCate->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
