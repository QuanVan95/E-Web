@extends('admin.layouts.app')
@section('main-content')
<div class="page-bar x_panel">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Quản lý bài viết</span>
        </li>
    </ul>
</div>
<div class="portlet light x_panel">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-dark bold uppercase">Danh sách bài viết </span>
        </div>
        <div class="actions">
            <a class="btn btn-primary" href="{{ route('post.create') }}">Thêm </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Tên </th>
                    <th>Nhóm </th>
                    <th>Thứ tự </th>
                    <th>Active </th>
                    <th>Lượt xem </th>
                    <th>Action </th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->category_name }}</td>
                        <td>{{ $value->position }}</td>
                        <td>
                            @if( $value->active == 1)
                                <input type="checkbox" checked disabled>
                            @else
                                <input type="checkbox" disabled>
                            @endif
                        </td>
                        <td>{{ $value->view }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('post.detail', $value->id) }}"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger btn-sm" onclick="return onDelete('{{ route('post.delete', $value->id) }}')"><i class="fa fa-close"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="fixed-table-pagination" style="display: block;">
        <div class="pull-right pagination">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection