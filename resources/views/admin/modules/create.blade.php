@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Create Module Category
                    <small>statistics, charts, recent events and reports</small>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{ route('module.add') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Module Category </label>
                                    <div class="col-md-4">
                                        <select name="parent_id" class="form-control">
                                            <option value="0">- Choose Category-</option>
                                            @foreach($moduleCates as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="name" placeholder="Category name " onkeyup="return getSlug()" autocomplete="off" id="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description </label>
                                    <div class="col-md-4">
                                        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                                    </div>
                                </div>
                        <!-- END FORM-->
                            <br />
                            <h2 align="center">Object Models/Resources</h2>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="crud_table">
                                    <thead>
                                        <tr>
                                            <th >Property</th>
                                            <th >Type</th>
                                            <th >Description</th>
                                            <th >Example Value(s)</th>
                                            <th >Required/Defaults</th>
                                            <th>F</th>
                                            <th >C</th>
                                            <th >I</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td contenteditable="true" class="property"></td>
                                            <td contenteditable="true" class="type"></td>
                                            <td contenteditable="true" class="attribute_description"></td>
                                            <td contenteditable="true" class="example_value"></td>
                                            <td contenteditable="true" class="required_default"></td>
                                            <td contenteditable="true" class="f"></td>
                                            <td contenteditable="true" class="c"></td>
                                            <td contenteditable="true" class="r"></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <div align="right">
                                    <button type="button" name="add" id='add' class="btn btn-success btn-xs">+</button>
                                    <button type="button" name="ajax-add" id='add' class="ajax-add btn btn-success btn-xs">Add</button>
                                </div>
                                <div id="inserted_item_data"></div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-4">
                                        <button type="submit" class="btn green check">Create </button>
                                        <a href="{{ route('module.index') }}" class="btn default">Back </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
    <script>
    </script>
@endsection