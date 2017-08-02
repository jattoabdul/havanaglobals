@extends('admin.base')
@section('title', 'Customers')
@section('active_customers', 'active')

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
                                <th class="all">ID</th>
                                <th class="all">Name</th>
                                <th class="all">Email</th>
                                <th class="all">Mobile</th>
                                <th class="all">User Type</th>
                                <th class="all">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tel }}</td>
                                    <td>{{ ($user->type == 1)?'Customer':'Admin' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-primary dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                Action
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu pull-right">
                                                @if($user->type == 1)
                                                    <li>
                                                        <form method="post" action="{{ route('make_admin') }}" id="make_admin_{{ $user->id }}">
                                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                                            {{ csrf_field() }}
                                                        </form>
                                                        <a href="#" onclick="document.getElementById('make_admin_{{ $user->id }}').submit();" class="">Make Admin</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <form method="post" action="{{ route('make_customer') }}" id="make_customer_{{ $user->id }}">
                                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                                            {{ csrf_field() }}
                                                        </form>
                                                        <a href="#" onclick="document.getElementById('make_customer_{{ $user->id }}').submit();" class="">Make Customer</a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <form method="post" action="{{ route('login_as') }}" id="login_as_{{ $user->id }}">
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        {{ csrf_field() }}
                                                    </form>
                                                    <a href="#" onclick="document.getElementById('login_as_{{ $user->id }}').submit();" class=""> Login as user</a>
                                                </li>
                                            </div>
                                        </div>
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