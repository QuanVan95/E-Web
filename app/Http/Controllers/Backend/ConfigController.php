<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Config;
use Session;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Config::orderBy('id', 'desc')->paginate(10);
        return view('metronic.config.index', compact('configs'));
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
        $config = Config::find($id);
        if(!$config){
            return response()->view('metronic.errors.404', [], 404);
        }
        return view('metronic.config.detail', compact('config'));
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
        $config = Config::find($id);
        if(!$config){
            return response()->view('metronic.errors.404', [], 404);
        }
        $data = $request->all();
        $file1 = $request->file('value1');
        $file2 = $request->file('value2');
        if($file1){
            $file_name = time() . '_' . $file1->getClientOriginalName();
            $data['value1'] = $file_name;
            $file1->move(base_path().'/public/images/config', $file_name);
        }
        if($file2){
            $file_name = time() . '_' . $file2->getClientOriginalName();
            $data['value2'] = $file_name;
            $file2->move(base_path().'/public/images/config', $file_name);
        }
        if(isset($data['active'])){
            if($data['active'] == 'on'){
                $data['active'] = 1;
            }
        }
        $config->update($data);
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
        //
    }
}
