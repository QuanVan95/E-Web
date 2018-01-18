@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Member
                    <small></small>
                </h1>
            </div>
            <div class="btn-add">
                <a class="btn btn-primary" href="{{ route('member.create') }}">Add </a>
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
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Phone</th>
                                    <th>Address </th>
                                    <th>Birthdate</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members['data'] as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value['name']}}</td>
                                        <td>{{ $value['email']}}</td>
                                        <td>{{ $value['phone']}}</td>
                                        <td>{{ $value['address']}}</td>
                                        <td>{{ $value['birth_date']}}</td>
                                        <td>
                                            <a class ="btn btn-primary btn-sm btn-detail" href="{{ route('member.detail',$value['id'] )}}"><i class ="fa fa-pencil"></i></a>
                                            <a class ="btn btn-danger btn-sm btn-delete" onclick="return onDelete('{{ route('member.delete', $value['id'])}}')"><i class ="fa fa-close"></i></a>
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
                {{--{{ $members->links() }}--}}
            </div>
        </div>
    </div>
@endsection
