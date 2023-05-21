@extends('admin.layouts.app')
@section('content')
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <!-- Main-body start -->
      <div class="main-body">
         <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
               <div class="page-header-title">
                  <h4>{{$module->term}}</h4>
               </div>
               <div class="page-header-breadcrumb">
                  <ul class="breadcrumb-title">
                     <li class="breadcrumb-item">
                        <a href="{{url('/admin')}}">
                        <i class="icofont icofont-home"></i>
                        </a>
                     </li>
                    
                     <li class="breadcrumb-item">{{$module->term}} 
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
                           <h5>{{$module->term}}</h5>                          
                           <div class="card-header-right">
                              <i class="icofont icofont-rounded-down"></i>
                              <i class="icofont icofont-refresh"></i>
                              <i class="icofont icofont-close-circled"></i>
                           </div>
                        </div>
                        <div class="card-block">
                           <h4 class="sub-title">{{$module->term}} {{__('Inputs')}}</h4>
                           {!! Form::model($module_data, array('method' => 'post', 'route' => array('admin.modules.data.update',$module->slug), 'class' => 'form', 'files'=>true)) !!}
                          {!! Form::hidden('id', $module_data->id) !!}
                           @include('admin.modules_data.inc.form')
                           <div class="row">
                              <div class="col-md-5"></div>
                              <div class="col-md-4"><button type="submit" class="btn btn-primary">Update</button></div>
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
@push('js')
<script src="{{asset('admin/assets/pages/filer/jquery.fileuploadsedit.init.js')}}" type="text/javascript"></script>

@endpush