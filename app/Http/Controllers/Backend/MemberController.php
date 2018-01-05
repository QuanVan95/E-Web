<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Session;
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->paginate(10);
        foreach ($members as $value){
            $birthDate = date_create($value->birth_date);
            $value->birth_date = date_format($birthDate, 'd/m/Y');
        }
        return view('metronic.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metronic.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function random(){
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random = "";
        for ($i = 0; $i < 6; $i++) {
            $random .= $str[rand() % strlen($str)];
        }
        return $random;
    }
    public function checkRandom($data){
        $validator = Validator::make($data, [
            'code' => 'unique:member',
        ]);
        if ($validator->fails()) {
            $data['code'] = $this->random();
            $this->checkRandom($data);
        }
        return $data;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['code'] = $this->random();
        $data = $this->checkRandom($data);
        $birthDate = str_replace('/', '-', $data['birth_date']);
        $data['birth_date'] = date('Y-m-d', strtotime($birthDate));
        Member::create($data);
        Session::flash('success', 'Cập nhật thành công!');
        return redirect(route('member.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        if(!$member){
            return response()->view('metronic.errors.404', [], 404);
        }
        $birthDate = date_create($member->birth_date);
        $member->birth_date = date_format($birthDate, 'd/m/Y');
        return view('metronic.member.detail', compact('member'));
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
        $member = Member::find($id);
        if(!$member){
            return response()->view('metronic.errors.404', [], 404);
        }
        $data = $request->all();
        $birthDate = str_replace('/', '-', $data['birth_date']);
        $data['birth_date'] = date('Y-m-d', strtotime($birthDate));
        $member->update($data);
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
        $member = Member::find($id);
        if(!$member){
            return response()->view('metronic.errors.404', [], 404);
        }
        $member->delete();
        Session::flash('success', 'Cập nhật thành công!');
        return back();
    }
}
