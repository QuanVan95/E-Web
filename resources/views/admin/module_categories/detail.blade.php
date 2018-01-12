@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Module Category Detail
                    <small>statistics, charts, recent events and reports</small>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="{{ route('moduleCate.update', $moduleCate->id) }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Parent</label>
                                    <div class="col-md-4">
                                        <select name="parent_id" class="form-control">
                                            <option value="0">- Choose Parent -</option>
                                            @foreach($moduleCates as $value)
                                                @if($moduleCate->parent_id == $value->id)
                                                    <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="name" placeholder="Category Name " value="{{ $moduleCate->name }}" onkeyup="return getSlug()" autocomplete="off" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description </label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" id="summernote" name="description" style="height: 300px;">{{ $moduleCate->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green">Update</button>
                                        <a href="{{ route('moduleCate.index') }}" class="btn default">Back</a>
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

