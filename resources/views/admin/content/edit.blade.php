@extends('admin.base')
@section('title', 'Edit Content')
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

            @if(count($errors)>0)
                <div class="note note-danger">
                    @foreach($errors->all() as $error)
                    <p> {{ $error }} </p>
                    @endforeach
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
                            <span class="caption-subject bold uppercase">Edit: {{ $content->title }}</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-horizontal" method="post" action="{{ route('update_content') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $content->id }}">
                            <div class="form-group">
                                <label class="control-label col-md-2"> Title
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control" name="title" value="{{ $content->title }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2"> Slug
                                    <span class="required">  </span>
                                </label>
                                <div class="col-md-9">
                                    <input class="form-control" value="{{ $content->slug }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2"> Category
                                    <span class="required">  </span>
                                </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="parent">
                                        <option value="">--None</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->slug }}"{{ ($parent->slug == $content->slug)?' selected':'' }}>{{ $parent->slug }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2"> status
                                    <span class="required">  </span>
                                </label>
                                <div class="col-md-5">
                                    <select class="form-control" name="status">
                                        <option value="1"{{ ($content->status)?' selected':'' }}>Enabled</option>
                                        <option value="0"{{ (!$content->status)?' selected':'' }}>Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2"> Body
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-9">
                                    <textarea class="wysihtml5 form-control" rows="6" name="body" data-error-container="#editor1_error">
                                        {!! html_entity_decode($content->body) !!}
                                    </textarea>
                                    <div id="editor1_error"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-9">
                                    <button class="btn btn-primary" type="submit"> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->
@endsection

@section('css')
    <link href="{{ asset('dash/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('plugins')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('dash/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dash/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script>
        $('.wysihtml5').wysihtml5();
    </script>
@endsection