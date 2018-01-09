<?php

namespace App\Http\Controllers\Backend;

use App\ModuleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;
use Session;
use File;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('id', 'desc')->paginate(10);
        foreach ($modules as $value){
            if($value->parent_id > 0){
                $module = Module::find($value->parent_id);
                if($module){
                    $value->parent_name = $module->name;
                }
            }
        }
        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        $moduleCates = ModuleCategory::all();
        return view('admin.modules.create', compact('moduleCates'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        dd($data);
        Module::create($data);
        Session::flash('success', 'Create Module Successfully!');
        return redirect(route('module.index'));
    }

    public function show($id)
    {
        $module = Module::find($id);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        $modules = Module::all();
        foreach ($modules as $key => $value){
            if($module->id == $value->id){
                unset($modules[$key]);
            }
        }
        return view('admin.modules.detail', compact(['module','modules']));
    }

    public function update(Request $request, $id)
    {
        $module = Module::find($id);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        $data = $request->all();
        $module->update($data);
        Session::flash('success', 'Update Successfully!');
        return back();
    }

    public function destroy($id)
    {
        $module = Module::find($id);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        $module->delete();
        Session::flash('success', 'Delete Successfully!');
        return back();
    }
}
