@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Create Member
                    <small></small>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="{{ route('member.add') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Name </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="name" placeholder="Name" onkeyup="return getSlug()" autocomplete="off" id="name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Email </label>
                                    <div class="col-md-4">
                                        <input type="email" class="form-control" name="email" placeholder="Email" onkeyup="return getSlug()" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Password </label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password" placeholder="Password" onkeyup="return getSlug()" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Phone </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="phone" placeholder="Phone" onkeyup="return getSlug()" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Address </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="address" placeholder="Input your address" onkeyup="return getSlug()" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Birthdate </label>
                                    <div class="col-md-4">
                                        <input class="form-control form-control-inline date-picker" type="text" name="birth_date" placeholder="Birthdate">
                                    </div>
                                </div>


                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green">Save</button>
                                        <a href="{{ route('member.index') }}" class="btn default">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection