@extends('admin.layouts.app')
@section('main-content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <div class="page-title">
                <h1>Create Module Version
                    <small></small>
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('module.addVersion')}}" id="submit-version" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" class="form-control" id="attribute" name="attribute" ></input>
                            <input type="hidden" class="form-control" id="api" name="api" ></input>
                            <input type="hidden" class="form-control" name="moduleId" value="{{$module->id}}"></input>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category </label>
                                    <div class="col-md-4">
                                        <select name="parent_id" class="form-control" disabled="disabled">
                                            <option value="0">- Choose Category-</option>
                                            @foreach($moduleCates as $value)
                                                @if($module->module_cate_id == $value->id)
                                                    <option value="{{ $value->id }}" selected>{{$value->name}}</option>
                                                @else
                                                    <option value="{{ $value->id }}">{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="name" placeholder="Name of module"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description </label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" id="summernote" name="description" style="height: 300px;"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Version </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="1" name="version" disabled="disabled"></input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Status </label>
                                    <div class="col-md-4">
                                        <select class ="form-control" name="status">
                                            <option value="1">Public</option>
                                            <option value="2">Draft</option>
                                            <option value="3">??</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- END FORM-->
                                <br />
                                <h2 align="center">Attribute - Object Models/Resources</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="attribute-table">
                                        <thead>
                                        <tr>
                                            <th >Property</th>
                                            <th >Type</th>
                                            <th >Description</th>
                                            <th >Example Value(s)</th>
                                            <th >Required/Defaults</th>
                                            <th id="width-attribute">F</th>
                                            <th id="width-attribute">C</th>
                                            <th id="width-attribute">I</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type = "text" class="property" ></td>
                                            <td><input type="text" class="type"  ></td>
                                            <td><input type="text" class="attribute_description" ></td>
                                            <td><input type="text" class="example_value"></td>
                                            <td><input type="text" class="required_default"></td>
                                            <td><input type="text" class="f" ></td>
                                            <td><input type="text" class="c" ></td>
                                            <td><input type="text" class="r" ></td>
                                            <td></td>
                                        </tr>
                                        </tbody>

                                    </table>
                                    <div align="right">
                                        <button type="button" name="add-attribute" id='add-attribute' class="btn btn-success btn-xs add-attribute">+</button>
                                    </div>
                                    <div id="inserted_item_data"></div>
                                </div>

                                <h2 align="center">Related API Endpoints</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="api-table">
                                        <thead>
                                        <tr>
                                            <th >Method</th>
                                            <th >URL</th>
                                            <th >Description</th>
                                            <th >Doc Updated</th>
                                            <th >Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type = "text" class="api-method" id="width-api" ></td>
                                            <td><input type="text" class="api-url" id="width-api" ></td>
                                            <td><input type="text" class="api-description" id="width-api" ></td>
                                            <td><input type="text" class="api-doc-updated" id="width-api"></td>
                                            <td><input type="text" class="api-status" id="width-api"></td>
                                            <td></td>
                                        </tr>
                                        </tbody>

                                    </table>
                                    <div align="right">
                                        <button type="button" name="add-api" id="add-api" class="btn btn-success btn-xs add-api">+</button>
                                    </div>
                                    <div id="inserted_item_data"></div>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-4">
                                            <button type="button" id="addVersion" class="btn green ajax-add">Create </button>
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