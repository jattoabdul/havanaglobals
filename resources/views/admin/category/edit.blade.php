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
                            <form class="form-horizontal" method="post" action="{{ route('update_categories', $category->id) }}" enctype="multipart/form-data">
                                <div class="form-group">
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{ ($category->img)? $category->img:asset('dash/global/img/placeholder.png') }}" alt="" /> </div>
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
                                <input class="form-control" name="name" id="category-name" value="{{ $category->name }}">
                                <br />
                                <button class="btn btn-primary">Save Category</button>
                            </div>
                        </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
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