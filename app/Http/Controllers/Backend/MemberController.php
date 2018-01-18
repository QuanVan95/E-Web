<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::orderBy('id', 'desc')->paginate(10)->toArray();
        foreach ($members['data'] as $key => $value) {
            if ($value['birth_date']) {
                $birthDate = date_create($value['birth_date']);
                $value['birth_date'] = date_format($birthDate, 'd/m/Y');
            }
        }
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if($data['birth_date']){
            $birthDate = str_replace('/', '-', $data['birth_date']);
            $data['birth_date'] = date('Y-m-d', strtotime($birthDate));
        }
       $data['password'] = bcrypt($data['password']);
        User::create($data);
        Session::flash('success', 'Create Successfully!');
        return redirect(route('member.index'));
    }

    public function show($id)
    {
        $member = User::find($id);
        if(!$member){
            return response()->view('admin.errors.404', [], 404);
        }
        if($member->birth_date){
            $birthDate = date_create($member->birth_date);
            $member->birth_date = date_format($birthDate, 'd/m/Y');
        }
        return view('admin.members.detail', compact('member'));
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        $member = User::find($id);
        if(!$member){
            return response()->view('admin.errors.404', [], 404);
        }
        $data = $request->all();
        if($data['birth_date']){
            $birthDate = str_replace('/', '-', $data['birth_date']);
            $data['birth_date'] = date('Y-m-d', strtotime($birthDate));
        }
        $member->update($data);
        Session::flash('success', 'Update Successfully!');
        return back();
    }


    public function destroy($id)
    {
        $member = User::find($id);
        if(!$member){
            return response()->view('admin.errors.404', [], 404);
        }
        $member->delete();
        Session::flash('success', 'Delete Successfully!');
        return back();
    }
}
