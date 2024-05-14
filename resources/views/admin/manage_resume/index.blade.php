@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Manage Resume</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->        
        <!-- END PAGE HEADER-->
        <br />
        @include('flash::message')
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Resume Templates</span> </div>
                    </div>
                    <div class="portlet-body form">  
                            <form action="{{ route('manage.resume.update') }}" method="POST">
                                @csrf
                    
                                <div class="row mb-3">
                                    @foreach($templates as $template)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $template->name }}</h5>
                                                    <select name="template_types[{{ $template->id }}]" class="form-control">
                                                        <option value="free" @if($template->status=="free") selected @endif>free</option>
                                                        <option value="premium" @if($template->status=="premium") selected @endif>Premium</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                <button type="submit" class="btn btn-primary mt-2" style="margin-top: 10px">Update Types</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>
@endsection