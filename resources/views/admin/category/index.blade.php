@extends('admin.base')
@section('title', 'Categories')
@section('active_category', 'active')

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
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">Add Category</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <form class="form-horizontal" method="post" action="{{ route('save_categories') }}" enctype="multipart/form-data">
                                <div class="form-group">
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{ asset('dash/global/img/placeholder.png') }}" alt="" /> </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" id="category-img" name="img"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="category-name">Category Name</label>
                                <input class="form-control" name="name" id="category-name" value="{{ old('name') }}">
                                <br />
                                <button class="btn btn-primary">Save Category</button>
                            </div>
                        </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">All Categories</span>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                                <thead>
                                <tr>
                                    <th class="all">ID</th>
                                    <th class="all">Name</th>
                                    <th class="all">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                    Action
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <div class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="{{ route('edit_categories', $category->id) }}" class=""> edit </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('delete_categories') }}" method="post" id="delete-category-{{ $category->id }}">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                                        </form>

                                                        <a onclick="document.getElementById('delete-category-{{ $category->id }}').submit();"> Delete </a>
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