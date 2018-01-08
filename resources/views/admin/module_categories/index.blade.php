@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Module Category
                    <small>statistics, charts, recent events and reports</small>
                </h1>
            </div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Dashboard</span>
            </li>
        </ul>

        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Danh sách nhóm </span>
            </div>
            <div class="actions">
                <a class="btn btn-primary" href="{{ route('postCate.create') }}">Add </a>
            </div>
        </div>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên </th>
                                    <th>Cha </th>
                                    <th>Mô tả </th>

                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- END PAGE BASE CONTENT -->
    </div>






@endsection