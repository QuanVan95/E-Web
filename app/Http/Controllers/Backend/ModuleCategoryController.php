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

        foreach($moduleCates as $module){ //Remove tags <p> <u>... in summernote
            if($module->description){
              $listRemove = ['<p>','</p>','<u>','</u>','<b>','</b>'];
              $description = str_replace($listRemove, " ", $module->description);
              $module->description = $description;
            }
        }

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
        ModuleCategory::create($data);
        Session::flash('success', 'Create Module Category Successfully!');
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

    public function update(Request $request, $id)
    {
        $moduleCate = ModuleCategory::find($id);
        if(!$moduleCate){
            return response()->view('admin.errors.404', [], 404);
        }
        $data = $request->all();
        $moduleCate->update($data);
        Session::flash('success', 'Update Successfully!');
        return back();
    }

    public function destroy($id)
    {
        $moduleCate = ModuleCategory::find($id);
        if(!$moduleCate){
            return response()->view('admin.errors.404', [], 404);
        }
        $moduleCate->delete();
        Session::flash('success', 'Delete Successfully!');
        return back();
    }
}
