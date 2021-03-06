@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Module
                    <small></small>
                </h1>
            </div>

            <form action="{{ route('module.add') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="btn-add">
                    <button type="submit" class="btn btn-primary">Add </button>
                </div>
                <div class="col-md-2 btn-add" >
                    <select name="module_cate_id" class="form-control">
                        <option value="0">- Choose Category-</option>
                        @foreach($moduleCates as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

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
                                    <th>Module </th>
                                    <th>Category </th>
                                    <th>Version </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modules as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a href = "{{ route('module.detail',$value->id )}}" >{{ $value->moduleName}}</a></td>
                                        <td>{{ $value->categoryName}}</td>
                                        <td>{{ $value->version}}</td>
                                        {{--<td>{{ $value->module->version}}</td>--}}
                                        <td>
                                            <a class ="btn btn-primary btn-sm btn-detail" href="{{ route('module.modifyVersion',$value->id )}}"><i class ="fa fa-pencil"></i></a>
                                            <a class ="btn btn-danger btn-sm btn-delete" onclick="return onDelete('{{ route('module.delete', $value->id)}}')"><i class ="fa fa-close"></i></a>
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
                {{ $modules->links() }}
            </div>
        </div>
    </div>
@endsection
