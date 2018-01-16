<?php

namespace App\Http\Controllers\Backend;

use App\ModuleCategory;
use App\ModuleVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;
use Illuminate\Support\Facades\Auth;
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
        $userId = Auth::id();
        $data['created_by'] = $userId;
        $module = Module::create($data);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        Session::flash('success', 'Create Module Successfully!');
        return redirect(route('module.detail', $module->id));
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
            $module->update(['module_version_id' => $moduleVersion->id]);
        }
        Session::flash('success', 'Create module version successfully!');
        return back();
        // return redirect(route('module.index'));
    }

    public function storeNewVersion(Request $request){
        $data = $request->all();
        $moduleVersion = ModuleVersion::find($data['newModuleVersionId']);
        if(!$moduleVersion){
            return response()->view('admin.errors.404', [], 404);
        }
        $moduleVersion->update($data);
        Session::flash('success', 'Update module version successfully!');
        return redirect(route('module.index'));
    }

    public function editVersion($id){
        $userId = Auth::id();
        $module = Module::find($id);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        if($module->module_version_id){
            $moduleVersion = ModuleVersion::find($module->module_version_id);
            $moduleVersion->version = $moduleVersion->version + 1 ;
            if($moduleVersion){
                $newModuleVersion = [];
                $newModuleVersion['name'] = $moduleVersion->name;
                $newModuleVersion['description'] = $moduleVersion->description;
                $newModuleVersion['status'] = 2;
                $newModuleVersion['version'] = $moduleVersion->version +1;
                $newModuleVersion['attribute'] = $moduleVersion->attribute;
                $newModuleVersion['api'] = $moduleVersion->api;
                $newModuleVersion['updated_by'] = $userId;
                $apis = json_decode($newModuleVersion['api'], false);
                $attributes = json_decode($newModuleVersion['attribute'], false);
            }
            $newModuleVer = ModuleVersion::create($newModuleVersion) ;
            if($newModuleVer){
                $newModuleVersionId = $newModuleVer->id;
            }
        }
        $moduleCates = ModuleCategory::all();
        return view ('admin.module_versions.detail', compact(['module', 'moduleCates', 'moduleVersion', 'apis', 'attributes','newModuleVersionId']));
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
