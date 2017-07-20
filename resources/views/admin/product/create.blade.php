@extends('admin.base')
@section('title', 'Create Product')
@section('active_product', 'active')

@section('content')
    <div class="row">
        @if(count($errors) > 0)
        <div class="col-md-12">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    {{ $error }}
                </div>
            @endforeach
        </div>
        @endif
        <div class="col-md-12">
            <form class="form-horizontal form-row-seperated" method="post" action="{{ route('save_products') }}" enctype="multipart/form-data">
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i>New Product </div>
                        <div class="actions btn-set">
                            <a href="{{ route('manage_products') }}" class="btn btn-primary">
                                <i class="fa fa-angle-left"></i> Back</a>
                            <button class="btn btn-secondary-outline" type="reset">
                                <i class="fa fa-reply"></i> Reset</button>
                            <button class="btn btn-success" name="stay" value="0">
                                <i class="fa fa-check"></i> Save</button>
                            <button class="btn btn-success" name="stay" value="1">
                                <i class="fa fa-check-circle"></i> Save & Continue Edit</button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-bordered">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_general" data-toggle="tab"> General </a>
                                </li>

                                <li>
                                    <a href="#tab_meta" data-toggle="tab"> Meta </a>
                                </li>

                                <li>
                                    <a href="#tab_images" data-toggle="tab"> Images </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_general">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Name:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') }}" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Description:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea rows="5" class="form-control" name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Categories:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-control height-auto">
                                                    <div class="scroller" style="height:275px;" data-always-visible="1">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                @foreach($categories as $category)
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <label>
                                                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ (!is_null(old('categories')))?(in_array($category->id, old('categories')))?'checked':'':'' }}> {{ $category->name }}</label>
                                                                        </li>
                                                                    </ul>

                                                                @endforeach
                                                                {{--
                                                                <ul class="list-unstyled">
                                                                    <li>
                                                                        <label>
                                                                            <input type="checkbox" name="categories[]" value="1">Footwear</label>
                                                                    </li>
                                                                </ul>
                                                                --}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="help-block"> select one or more categories </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Quantity:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" placeholder="" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Price:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="price" placeholder="" value="{{ old('price') }}" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Old Price (optional):
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="old_price" value="{{ old('old_price') }}" placeholder=""> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Status:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <select class="table-group-action-input form-control input-medium" name="status" required>
                                                    <option value="">Select...</option>
                                                    <option value="1" {{ (old('status') == 1)?'selected':'' }}>Enabled</option>
                                                    <option value="0" {{ (old('status') === 0)?'selected':'' }}>Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab_meta">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Meta Title:</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control maxlength-handler" name="meta_title" value="{{ old('meta_title') }}" maxlength="100" placeholder="">
                                                <span class="help-block"> max 100 chars </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Meta Keywords:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control maxlength-handler" rows="8" name="meta_keywords" value="{{ old('meta_keywords') }}" maxlength="1000"></textarea>
                                                <span class="help-block"> max 1000 chars </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Meta Description:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control maxlength-handler" rows="8" name="meta_description" value="{{ old('meta_description') }}" maxlength="255"></textarea>
                                                <span class="help-block"> max 255 chars </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab_images">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr role="row" class="heading">
                                            <th width="15%"> Image </th>
                                            <th width="35%"> Label </th>
                                            <th width="10%"> Sort Order </th>
                                            <th width="10%"> </th>
                                        </tr>
                                        </thead>
                                        <tbody id="images-wrapper">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="{{ asset('dash/global/img/placeholder.png') }}" alt="" /> </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="images[1][file]"> </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="images[1][label]" value="">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="images[1][sort_order]" value="1">
                                            </td>

                                            <td>

                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <button type="button" class="btn btn-primary add-new-image" data-count="2">Add more</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
@endsection
@section('css')
<link href="{{ asset('dash/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dash/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')
    <script src="{{ asset('dash/pages/scripts/ecommerce-products-edit.min.js') }}" type="text/javascript"></script>
@endsection
@section('plugins')
    <script src="{{ asset('dash/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/plupload/js/plupload.full.min.js') }}" type="text/javascript"></script>
@endsection