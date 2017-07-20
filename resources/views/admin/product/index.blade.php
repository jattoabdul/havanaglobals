@extends('admin.base')
@section('title', 'Products')
@section('active_product', 'active')

@section('content')

<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        @if(session('error'))
        <div class="note note-danger">
            <p> {{ session('error') }} </p>
        </div>
        @endif
        @if(session('success'))
        <div class="note note-success">
            <p> {{ session('success') }} </p>
        </div>
        @endif

        <!-- Begin: life time stats -->
        <div class="portlet ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart"></i>Product Listing </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                            Bulk Action
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu pull-right">
                            <li>
                                <form id="check_ids" method="post" action="{{ route('delete_multi_image') }}">
                                    {{ csrf_field() }}
                                </form>
                                <a onclick="document.getElementById('check_ids').submit();"> Delete </a>
                            </li>
                        </div>
                    </div>
                    <a href="{{ route('create_products') }}" class="btn btn-primary btn-lg">Add Product</a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="publish">Publish</option>
                            <option value="unpublished">Un-publish</option>
                        </select>
                        <button class="btn btn-sm btn-success table-group-action-submit">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                        <form>
                            <thead>
                            <tr role="row" class="heading">
                                <th width="1%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" id="check-all"/>
                                        <span></span>
                                    </label>
                                </th>
                                <th width="10%"> ID </th>
                                <th width="10%"> Image </th>
                                <th width="15%"> Product&nbsp;Name </th>
                                <th width="20%"> Price </th>
                                <th width="5%"> Quantity </th>
                                <th width="15%"> Date&nbsp;Created </th>
                                <th width="10%"> Status </th>
                                <th width="10%"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="id" value="{{ app('request')->id }}"> </td>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="name" value="{{ app('request')->name }}"> </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm" name="price_from" value="{{ app('request')->price_from }}" placeholder="From" /> </div>
                                    <input type="text" class="form-control form-filter input-sm" name="price_to" value="{{ app('request')->price_to }}" placeholder="To" /> </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm" name="quantity_from" value="{{ app('request')->quantity_from }}" placeholder="From" /> </div>
                                    <input type="text" class="form-control form-filter input-sm" name="quantity_to" value="{{ app('request')->quantity_to }}" placeholder="To" /> </td>
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="created_from" value="{{ app('request')->created_from }}" placeholder="From">
                                        <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                    </div>
                                    <div class="input-group date date-picker">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="created_to" value="{{ app('request')->created_to }}" placeholder="To">
                                        <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                    </div>
                                </td>
                                <td>
                                    <select name="status" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="1" {{ (app('request')->status == 1)?'selected':'' }}>Enabled</option>
                                        <option value="0" {{ (app('request')->status === "0")?'selected':'' }}>Disabled</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <a href="{{ route('manage_products') }}" class="btn btn-sm btn-default filter-cancel" type="reset">
                                        <i class="fa fa-times"></i> Reset</a>
                                </td>
                            </tr>
                            </thead>

                        </form>

                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                           <input type="checkbox" name="multi_check[]" value="{{ $product->id }}" class="checkboxes check-products" id="sample_2"/>
                                           <span></span>
                                        </label>
                                    </td>
                                    <td>{{ $product->id }}</td>
                                    <td></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{!!  ($product->old_price)? '<del class="text-danger">₦'.number_format($product->old_price).'</del>  ₦'.number_format($product->price):'₦'.number_format($product->price)  !!}</td>
                                    <td><strong class="badge {{ ($product->qty >= 25)?'badge-success':'badge-warning' }}">{{ $product->qty }}</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->toFormattedDateString() }}</td>
                                    <td>{{ ($product->status == 1)?'Enabled':'Disabled' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                Action
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ route('edit_products', $product->id) }}" class=""> edit </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('delete_products') }}" method="post" id="delete-product-{{ $product->id }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                    </form>

                                                    <a onclick="document.getElementById('delete-product-{{ $product->id }}').submit();"> Delete </a>
                                                </li>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                               <td colspan="9">{{ $products->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
<!-- END PAGE BASE CONTENT -->
@endsection

@section('css')
    <link href="{{ asset('dash/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dash/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dash/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.cs') }}s" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dash/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('plugins')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('dash/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
    <script>
        $('.date-picker').datepicker({ format: 'mm/dd/yyyy' })
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@endsection