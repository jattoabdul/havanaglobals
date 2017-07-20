@extends('admin.base')
@section('title', 'Edit Product')
@section('active_product', 'active')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-row-seperated" method="post" action="{{ route('update_products') }}" enctype="multipart/form-data">
                <input type="hidden" value="{{ $product->id }}" name="id">
                {!! csrf_field() !!}
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-shopping-cart"></i>Edit Product </div>
                        <div class="actions btn-set">
                            <a href="{{ route('manage_products') }}" class="btn btn-primary">
                                <i class="fa fa-angle-left"></i> Back</a>
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
                                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Description:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea rows="5" class="form-control" name="description">{{ $product->description }}</textarea>
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
                                                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ (in_array($category->id, $category_ids))?'checked':'' }}> {{ $category->name }}</label>
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
                                                <input type="text" class="form-control" name="quantity" value="{{ $product->qty }}" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Price:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="price" value="{{ $product->price }}" required> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Old Price (optional):
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="old_price" value="{{ $product->old_price }}"> </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Status:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <select class="table-group-action-input form-control input-medium" name="status" required>
                                                    <option value="">Select...</option>
                                                    <option value="1" {{ ($product->status == 1)?'selected':'' }}>Enabled</option>
                                                    <option value="0" {{ ($product->status === 0)? 'selected':'' }}>Disabled</option>
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
                                                <input type="text" class="form-control maxlength-handler" name="meta_title" maxlength="100" value="{{ $product->meta_title }}">
                                                <span class="help-block"> max 100 chars </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Meta Keywords:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control maxlength-handler" rows="8" name="meta_keywords" value="{{ $product->meta_keywords }}" maxlength="1000"></textarea>
                                                <span class="help-block"> max 1000 chars </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Meta Description:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control maxlength-handler" rows="8" name="meta_description" value="{{ $product->meta_desc }}" maxlength="255"></textarea>
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
                                        <?php $sn=1; ?>
                                        @foreach($product->images as $image)
                                        <tr id="product-image-{{ $image->id }}">
                                            <td>
                                                <a href="{{ $image->url }}" class="fancybox-button" data-rel="fancybox-button">
                                                    <img class="img-responsive" src="{{ $image->url }}" alt=""> </a>
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="images[{{ $sn }}][label]" value="{{ $image->label }}">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="images[{{ $sn }}][sort_order]" value="{{ $image->order }}">
                                                <input type="hidden" name="images[{{ $sn }}][id]" value="{{ $image->id }}">
                                            </td>

                                            <td>
                                                <button class="btn btn-danger delete-product-image" data-id="{{ $image->id }}"><i class="fa fa-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                            <?php $sn++; ?>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <button type="button" class="btn btn-primary add-new-image" data-count="{{ $sn }}">Add more</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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