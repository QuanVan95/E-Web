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

    public function storeVersion(Request $request){ // Create a new one version
        $data = $request->all();
        $data['module_id'] = $data['moduleId'];
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
        return redirect(route('module.index'));
        // return redirect(route('module.index'));
    }

    public function editVersion($id){  //Clone a new version when edit button is clicked.
        $userId = Auth::id();
        $module = Module::find($id);
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        $moduleCates = ModuleCategory::all();
        if($module->module_version_id) {
            $moduleVersion = ModuleVersion::find($module->module_version_id);
            if ($moduleVersion) {
                $newModuleVersion = [];
                $newModuleVersion['name'] = $moduleVersion->name;
                $newModuleVersion['description'] = $moduleVersion->description;
                $newModuleVersion['status'] = 2;
                $newModuleVersion['version'] = $moduleVersion->version + 1;
                $newModuleVersion['attribute'] = $moduleVersion->attribute;
                $newModuleVersion['module_id'] = $moduleVersion->module_id;
                $newModuleVersion['api'] = $moduleVersion->api;
                $newModuleVersion['created_by'] = $userId;
                $newModuleVersion['updated_by'] = $userId;
                if ($newModuleVersion['api']) {
                    $apis = json_decode($newModuleVersion['api'], false);
                }
                if ($newModuleVersion['attribute']) {
                    $attributes = json_decode($newModuleVersion['attribute'], false);
                }
            }
            $newModuleVer = ModuleVersion::create($newModuleVersion);
            if ($newModuleVer) {
                $newModuleVersionId = $newModuleVer->id;
            }
            return view('admin.module_versions.detail', compact(['module', 'moduleCates', 'newModuleVer', 'apis', 'attributes', 'newModuleVersionId'])         );
        }
            return redirect(route('module.detail', $module->id));
        }

    public function updateNewVersion(Request $request){ //Update new version
        $data = $request->all();
        $userId = Auth::id();
        if(isset($data['newModuleVersionId'])){
            $moduleVersion = ModuleVersion::find($data['newModuleVersionId']);
            if(!$moduleVersion){
                return response()->view('admin.errors.404', [], 404);
            }
        }
        $moduleVersion->update($data);

        if($data['status'] == 1){      //In case the new version has status == 1(public) => change status of current version into 3(ready)
            $moduleVersions = DB::table('module_versions')
                ->select('*')
                ->where('module_id',$moduleVersion->module_id)
                ->get();

          foreach($moduleVersions as $version){
              if($version->status == 1 && $version->id != $moduleVersion->id){
                  $versionPublic = ModuleVersion::find($version->id);
                  $publicToReady = ['status' => 3];
                  $versionPublic->update($publicToReady);
              }
          }
            $module = Module::find($moduleVersion->module_id); //Update version for module
            $moduleData = [
                'module_version_id' => $moduleVersion->id,
                'updated_by'        => $userId,
            ];
            $module->update($moduleData);
        }

        Session::flash('success', 'Update module version successfully!');
        return redirect(route('module.index'));
    }

    public function show($id)
    {
        $module = Module::find($id);
        $moduleCates = ModuleCategory::all();
        if(!$module){
            return response()->view('admin.errors.404', [], 404);
        }
        if($module->module_version_id){
            $moduleVersion = ModuleVersion::find($module->module_version_id);
            if($moduleVersion->attribute){
                $attributes = json_decode($moduleVersion->attribute);
            }
            if($moduleVersion->api){
                $apis = json_decode($moduleVersion->api);
            }
        }
        return view('admin.module_versions.index', compact(['module', 'moduleCates', 'apis', 'attributes', 'moduleVersion']));
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
