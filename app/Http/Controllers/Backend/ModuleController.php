<?php

namespace App\Http\Controllers\Backend;

use App\ModuleCategory;
use App\ModuleVersion;
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
        $moduleCates = ModuleCategory::all();
        foreach ($modules as $value){
            if($value->parent_id > 0){
                $module = Module::find($value->parent_id);
                if($module){
                    $value->parent_name = $module->name;
                }
            }
        }
        return view('admin.modules.index', compact(['modules', 'moduleCates']));
    }

    public function create()
    {
        $moduleCates = ModuleCategory::all();
        return view('admin.modules.detail', compact('moduleCates'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $moduleCates = ModuleCategory::all();
        $module = Module::create($data);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        Session::flash('success', 'Create Module Successfully!');
        return redirect(route('module.detail', $module->id));
//        if ($request->ajax()) {
////            echo '<pre style="color:green;font-weight:bold;">';
//         // $data = $request->all();
//            $data['attribute'] = json_encode($data['list']);
//            //return response($data['attribute']);
//        }
    }

    public function storeVersion(Request $request){
        $data = $request->all();
        return redirect(route('module.index'));
    }

    public function show($id)
    {
        $module = Module::find($id);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        $moduleCates = ModuleCategory::all();
        return view('admin.modules.detail', compact(['module','moduleCates']));
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
