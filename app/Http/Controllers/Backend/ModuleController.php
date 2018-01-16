<?php

namespace App\Http\Controllers\Backend;

use App\ModuleCategory;
use App\ModuleVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;
use Illuminate\Support\Facades\DB;
use Session;
use File;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('id', 'desc')->paginate(10);
        $moduleCates = ModuleCategory::all();
        foreach ($modules as $value){
            if($value->module_cate_id > 0){
                $category = ModuleCategory::find($value->module_cate_id);
                if($category){
                    $value->categoryName = $category->name;
                }
            }
            if($value->module_version_id){
                $moduleVersion = ModuleVersion::find($value->module_version_id);
                if($moduleVersion){
                    $value->moduleName = $moduleVersion->name;
                    $value->version = $moduleVersion->version;
                }
            }
        }

        return view('admin.modules.index', compact(['modules', 'moduleCates']));
    }

    public function getModuleVersion($moduleId)
    {
        $module         = Module::find($moduleId);
        if($module){
            if($module->module_version_id){
                $moduleVersion = ModuleVersion::where([['status',1],['id',$module->module_version_id]])->get();
                return $moduleVersion;
            }
        }

    }

    public function create()
    {
        $moduleCates = ModuleCategory::all();
        return view('admin.modules.detail', compact('moduleCates'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
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
        $moduleVersion = ModuleVersion::create($data);
        if(!$moduleVersion){
            Session::flash('error', 'Cannot create module version!');
            return back();
        }
        $module = Module::find($data['moduleId']);
        if($module){
            $module->update(['module_version_id',$moduleVersion->id]);
        }
        $dataModule = [
            '_token' => $data['_token'],
            'module_version_id' => $moduleVersion->id,
        ];
        $module->update($dataModule);
        Session::flash('success', 'Create module version successfully!');
        return back();
        // return redirect(route('module.index'));
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
