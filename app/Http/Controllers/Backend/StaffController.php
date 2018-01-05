<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Validator;
use App\Group;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin', 0)->orderBy('id', 'desc')->paginate(10);
        foreach ($users as $value){
            $group = Group::find($value->group_id);
            if($group){
                $value->groupName = $group->name;
            }
            $birthDate = date_create($value->birth_date);
            $value->birth_date = date_format($birthDate, 'd/m/Y');
        }
        return view('metronic.staff.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('metronic.staff.create', compact('groups'));
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
        $birthDate = str_replace('/', '-', $data['birth_date']);
        $data['birth_date'] = date('Y-m-d', strtotime($birthDate));
        User::create($data);
        Session::flash('success', 'Cập nhật thành công!');
        return redirect(route('staff.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = Group::all();
        $user = User::find($id);
        if(!$user){
            return response()->view('metronic.errors.404', [], 404);
        }
        $birthDate = date_create($user->birth_date);
        $user->birth_date = date_format($birthDate, 'd/m/Y');
        return view('metronic.staff.detail', compact('user', 'groups'));
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
        $user = User::find($id);
        if(!$user){
            return response()->view('metronic.errors.404', [], 404);
        }
        $data = $request->all();
        $birthDate = str_replace('/', '-', $data['birth_date']);
        $data['birth_date'] = date('Y-m-d', strtotime($birthDate));
        $user->update($data);
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
        $user = User::find($id);
        if(!$user){
            return response()->view('metronic.errors.404', [], 404);
        }
        $user->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
