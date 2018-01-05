@extends('admin.layouts.app')
@section('main-content')
    <div class="page-bar x_panel">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Quản lý bài viết </span>
            </li>
        </ul>
    </div>
    <div class="portlet light x_panel">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-dark bold uppercase">Tạo nhóm bài viết </span>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="{{ route('postCate.add') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nhóm </label>
                        <div class="col-md-4">
                            <select name="parent_id" class="form-control">
                                <option value="0">- Chọn nhóm -</option>
                                @foreach($postCates as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên nhóm </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" placeholder="Tên nhóm " onkeyup="return getSlug()" autocomplete="off" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tên phụ </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="sub_name" placeholder="Tên phụ ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nội dung </label>
                        <div class="col-md-4">
                            <textarea type="text" id="summernote" name="description" placeholder="Nội dung "></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Đường dẫn </label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="url" placeholder="Đường dẫn " id="url" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Title </label>
                        <div class="col-md-4">
                            <input type="text" name="meta_title" class="form-control" placeholder="Meta Title  ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Keyword </label>
                        <div class="col-md-4">
                            <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword  ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Meta Description </label>
                        <div class="col-md-4">
                            <input type="text" name="meta_description" class="form-control" placeholder="Meta Description  ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Active </label>
                        <div class="col-md-4">
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" name="active" checked>
                                <span style="margin-top: 5px"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hình ảnh </label>
                        <div class="col-md-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"
                                     style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="hidden" value="" name="...">
                                        <input type="file" name="image">
                                    </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-4">
                            <button type="submit" class="btn green">Tạo </button>
                            <a href="{{ route('postCate.index') }}" class="btn default">Trở về </a>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
@endsection