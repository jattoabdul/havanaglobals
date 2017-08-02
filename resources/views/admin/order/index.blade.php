@extends('admin.base')
@section('title', 'Orders')
@section('active_orders', 'active')

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

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">All Customers</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                            <thead>
                            <tr>
                                <th class="all">Order #</th>
                                <th class="all">User</th>
                                <th class="all">Date Created</th>
                                <th class="all">Status</th>
                                <th class="all">Total</th>
                                <th class="all">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->user->first_name.' '.$order->user->last_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->toFormattedDateString() }}</td>
                                    <td>{{ \App\Core::orderStatusToString($order->status) }}</td>
                                    <td>N{{ number_format($order->total) }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <a class="btn btn-default" href="{{ route('view_order', $order->id) }}">
                                                View
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                        @if($order->status != 2)
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                Edit Status
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu pull-right">
                                                <li><a href="{{ route('order_status_update', [$order->id,1]) }}"> Success</a></li>
                                                <li><a href="{{ route('order_status_update', [$order->id,3]) }}"> Shipped</a></li>
                                                <li><a href="{{ route('order_status_update', [$order->id,4]) }}"> Complete</a></li>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>

        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
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