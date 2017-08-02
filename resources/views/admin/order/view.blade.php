@extends('admin.base')
@section('title', 'View Order')
@section('active_orders', 'active')

@section('content')
    <!-- BEGIN CONTENT -->
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
        </div>
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light portlet-fit portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase"> Order #{{ $order->order_id }}
                                                <span class="hidden-xs">| {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }} </span>
                                            </span>
                    </div>
                    <div class="actions">
                        @if($order->status != 0 && $order->status != 2)
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <span class="hidden-xs"> Change Order Status </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('order_status_update', [$order->id,1]) }}"> Success</a></li>
                                <li><a href="{{ route('order_status_update', [$order->id,3]) }}"> Shipped</a></li>
                                <li><a href="{{ route('order_status_update', [$order->id,4]) }}"> Complete</a></li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs nav-tabs-lg">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab"> Details </a>
                            </li>
                            {{--
                            <li>
                                <a href="#tab_2" data-toggle="tab"> Invoices
                                    <span class="badge badge-success">4</span>
                                </a>
                            </li>
                            --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet yellow-crusta box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Order Details
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Order #: </div>
                                                    <div class="col-md-7 value"> {{ $order->order_id }}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Order Date & Time: </div>
                                                    <div class="col-md-7 value"> {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }}</div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Order Status: </div>
                                                    <div class="col-md-7 value">
                                                        {!! html_entity_decode(\App\Core::orderStatusToString($order->status, true)) !!}
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Grand Total: </div>
                                                    <div class="col-md-7 value"> N{{ number_format($order->total) }} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet blue-hoki box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Customer Information
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Customer Name: </div>
                                                    <div class="col-md-7 value"> {{ $order->user->first_name.' '.$order->user->last_name }} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Email: </div>
                                                    <div class="col-md-7 value"> {{ $order->user->email }} </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-5 name"> Phone Number: </div>
                                                    <div class="col-md-7 value"> {{ $order->user->tel }} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet green-meadow box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Billing Address
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-12 value">
                                                        <br> {{ $order->billing_info->street_address }}
                                                        <br> {{ $order->billing_info->area }}
                                                        <br> {{ $order->billing_info->lga }}
                                                        <br> {{ $order->billing_info->state }}
                                                        <br> T: {{ $order->billing_info->tel }}
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="portlet red-sunglo box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Shipping Address
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-12 value">
                                                        <br> {{ $order->shipping_info->street_address }}
                                                        <br> {{ $order->shipping_info->area }}
                                                        <br> {{ $order->shipping_info->lga }}
                                                        <br> {{ $order->shipping_info->state }}
                                                        <br> T: {{ $order->shipping_info->tel }}
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet grey-cascade box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>Shopping Cart </div>
                                                <div class="actions">
                                                    <a href="javascript:;" class="btn btn-default btn-sm">
                                                        <i class="fa fa-pencil"></i> Edit </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th> Product </th>
                                                            <th> Item Status </th>
                                                            <th> Price </th>
                                                            <th> Quantity </th>
                                                            <th> Total </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(json_decode($order->products) as $item)
                                                        <tr>
                                                            <?php $avail = \App\Product::CheckProductAvailability($item->id, $item->qty); ?>
                                                            <td>
                                                                <a href="{{ route('product_detail', [$item->id, \App\Core::slugger($item->name)]) }}" target="_blank"> {{ $item->name }} </a>
                                                            </td>
                                                            <td>@if($avail == 'Available') <span class="label label-sm label-success"> {{ $avail }} </span> @else <span class="label label-sm label-warning"> {{ $avail }} </span> @endif</td>
                                                            <td> N{{ number_format($item->price) }} </td>
                                                            <td> {{ $item->qty }} </td>
                                                            <td> N{{ number_format($item->qty * $item->price) }} </td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"> </div>
                                    <div class="col-md-6">
                                        <div class="well">
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Shipping: </div>
                                                <div class="col-md-3 value"> N1,000 </div>
                                            </div>
                                            <div class="row static-info align-reverse">
                                                <div class="col-md-8 name"> Grand Total: </div>
                                                <div class="col-md-3 value"> N{{ number_format($order->total) }} </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div class="tab-pane" id="tab_2">
                                <div class="table-container">
                                    <div class="table-actions-wrapper">
                                        <span> </span>
                                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                                            <option value="">Select...</option>
                                            <option value="pending">Pending</option>
                                            <option value="paid">Paid</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                        <button class="btn btn-sm yellow table-group-action-submit">
                                            <i class="fa fa-check"></i> Submit</button>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="datatable_invoices">
                                        <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%">
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                    <span></span>
                                                </label>
                                            </th>
                                            <th width="5%"> Invoice&nbsp;# </th>
                                            <th width="15%"> Bill To </th>
                                            <th width="15%"> Invoice&nbsp;Date </th>
                                            <th width="10%"> Amount </th>
                                            <th width="10%"> Status </th>
                                            <th width="10%"> Actions </th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_no"> </td>
                                            <td>
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_bill_to"> </td>
                                            <td>
                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_invoice_date_from" placeholder="From">
                                                    <span class="input-group-btn">
                                                                                <button class="btn btn-sm default" type="button">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </button>
                                                                            </span>
                                                </div>
                                                <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_invoice_date_to" placeholder="To">
                                                    <span class="input-group-btn">
                                                                                <button class="btn btn-sm default" type="button">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </button>
                                                                            </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <input type="text" class="form-control form-filter input-sm" name="order_invoice_amount_from" placeholder="From" /> </div>
                                                <input type="text" class="form-control form-filter input-sm" name="order_invoice_amount_to" placeholder="To" /> </td>
                                            <td>
                                                <select name="order_invoice_status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="paid">Paid</option>
                                                    <option value="canceled">Canceled</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="margin-bottom-5">
                                                    <button class="btn btn-sm yellow filter-submit margin-bottom">
                                                        <i class="fa fa-search"></i> Search</button>
                                                </div>
                                                <button class="btn btn-sm red filter-cancel">
                                                    <i class="fa fa-times"></i> Reset</button>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
    <!-- END CONTENT -->
@endsection

@section('css')
    <link href="{{ asset('dash/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dash/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dash/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dash/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('plugins')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('dash/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('dash/pages/scripts/table-datatables-responsive.js') }}" type="text/javascript"></script>
@endsection