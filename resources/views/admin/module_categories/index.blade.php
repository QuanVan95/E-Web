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
            <div class="btn-add">
                <a class="btn btn-primary" href="{{ route('moduleCate.create') }}">Add </a>
            </div>
        </div>
        <!-- END PAGE HEAD-->
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($moduleCates as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->parent_name }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>
                                            <a class ="btn btn-primary btn-sm btn-detail" href="{{ route('moduleCate.detail',$value->id )}}"><i class ="fa fa-pencil"></i></a>
                                            <a class ="btn btn-danger btn-sm btn-delete" onclick="return onDelete('{{ route('moduleCate.delete', $value->id)}}')"><i class ="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE BASE CONTENT -->
        <div class="fixed-table-pagination" style="display: block;">
            <div class="pull-right pagination">
                {{ $moduleCates->links() }}
            </div>
        </div>
    </div>
@endsection
