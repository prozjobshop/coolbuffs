@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
      <!-- Main-body start -->
      <div class="main-body">
         <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
               @if(session()->has('message.added'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{__('ask Done')}}T!</strong> {!! session('message.content') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
               <div class="page-header-title">
                  <h4>{{__('Widgets List')}}</h4>
               </div>
               <div class="page-header-breadcrumb">
                  <ul class="breadcrumb-title">
                     <li class="breadcrumb-item">
                        <a href="{{url('/admin')}}">
                        <i class="icofont icofont-home"></i>
                        </a>
                     </li>
                     
                     <li class="breadcrumb-item">{{__('Widgets List')}}
                     </li> 
                  </ul>
               </div>
            </div>
            <!-- Page header end -->
            <!-- Page body start -->
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">
                     <!-- Basic Form Inputs card start -->
                     <div class="card">
                        <div class="card-header">
                           <h5>{{__('Widgets List')}}</h5>
                           
                           <div class="card-header-right">
                              <i class="icofont icofont-rounded-down"></i>
                              <i class="icofont icofont-refresh"></i>
                              <i class="icofont icofont-close-circled"></i>
                           </div>
                        </div>
                        <div class="card-block table-border-style">
                           <div class="table-responsive">
                              <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th>{{__('Widget Name')}}</th>
                                    <th>{{__('Action')}}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($widgets)
                                 @foreach($widgets as $widget)
                                 <tr>
                                    <td>{{$widget->title}}</td>
                                   
                                    <td>
                                      <a href="{{route('admin.widgets.edit',$widget->id)}}" class="tabledit-edit-button btn btn-primary waves-effect waves-light"><span class="icofont icofont-ui-edit"></span>&nbsp {{__('Edit')}}</a>
                                      
                                       <a href="{{route('admin.widgets.delete',$widget->id)}}" class="tabledit-delete-button btn btn-danger waves-effect waves-light"><span class="icofont icofont-ui-delete"></span>&nbsp {{__('Delete')}}</a>
                                    </td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Page body end -->
         </div>
      </div>
   </div>
</div>
@endsection
