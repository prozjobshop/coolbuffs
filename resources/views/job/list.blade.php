@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header')
{{-- {{dd($data['functionalAreas'])}} --}}
<!-- Header end --> 
<!-- Inner Page Title start --> 
<div class="pageTitle">
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-3 col-sm-3">
                <h1 class="page-heading">JOB LISTING</h1>
                <p class="header_description_under_head">Build Your Dream Job</p>
            </div>
            <div class="col-md-9 col-sm-9">
                <form action="{{route('job.list')}}" method="get">
                    <div class="searchform row custom_top_margin_second_header">
                        <div class="col-lg-9 pl-lg-0">
                            <input type="text" name="search" value="{{Request::get('search', '')}}" class="form-control find_job typeahead typeahead_job" placeholder="{{__('Enter Skills, job title or Location')}}" id="job_page_typehead" />
                        </div>
                        {{-- <div class="col-lg-1 pl-lg-0">
                            <button type="button" class="btn" onclick="job_advance_filter()">
                                <i class="fa fa-filter" aria-hidden="true"></i>
                            </button>
                        </div> --}}
                        <div class="col-lg-3 pl-lg-0">
                            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i> {{__('Search Jobs')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('flash::message')
@include('includes.inner_top_search')
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        
        <form action="{{route('job.list')}}" method="get" id="search-job-form">
            <!-- Search Result and sidebar start -->
            <div class="row"> 
                @include('includes.job_list_side_bar')
                
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
                    <!-- Search List -->
                    <ul class="searchList">
                        <!-- job start --> 
                        @if(isset($jobs) && count($jobs)) <?php $count_1 = 1; ?> @foreach($jobs as $job) @php $company =
                            $job->getCompany();  @endphp
                             <?php if(isset($company))
                            {
                            ?>
                            <?php if($count_1 == 7) {?>
                                <li class="inpostad">{!! $siteSetting->listing_page_horizontal_ad !!}</li>
                            <?php }else{ ?>
						
						
						
                        <li>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="jobimg">{{$company->printCompanyImage()}}</div>
                                    <div class="jobinfo">
                                        <h3><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}">{{$job->title}}</a></h3>
                                        <div class="companyName"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></div>
                                        <div class="location">
                                            <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{$job->getCity('city')}}</span></div>
                                            <!-- <label class="fulltime" title="{{$job->getJobType('job_type')}}">{{$job->getJobType('job_type')}}</label> -->
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8 pr-0">
                                    <p>{{\Illuminate\Support\Str::limit(strip_tags($job->description), 150, '...')}}</p>
                                </div>
                                <div class="col-md-4">
                                    <div class="listbtn">
                                        <a href="{{route('job.detail', [$job->slug])}}">{{__('View Details')}}</a>
                                    </div>
                                </div>
                        </li>
						
						 <?php } ?>
                            <?php $count_1++; ?>
						
						 <?php } ?>
                        <!-- job end --> 
                        @endforeach @endif
						
						
						
                           
                       
                            <!-- job end -->
                            
						
						
						
                    </ul>
                    <!-- Pagination Start -->
                    <div class="pagiWrap">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="showreslt">
                                    {{__('Showing Results')}} : {{__('Total')}} {{ $jobs->total() }}
                                    
                                </div>
                            </div>
                            <div class="col-md-7 text-right">
                                @if(isset($jobs) && count($jobs))
                                {{ $jobs->appends(request()->query())->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Pagination end --> 
                   
                </div>
				
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-right">
                    <!-- Sponsord By -->
                    <div class="sidebar">
                        <h4 class="widget-title">{{__('Sponsord By')}}</h4>
                        <div class="gad">{!! $siteSetting->listing_page_vertical_ad !!}</div>
                    </div>
                </div>
				
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="show_alert" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="submit_alert">
                @csrf
                <input type="hidden" name="search" value="{{ Request::get('search') }}">
                <input type="hidden" name="country_id" value="@if(isset(Request::get('country_id')[0])) {{ Request::get('country_id')[0] }} @endif">
                <input type="hidden" name="state_id" value="@if(isset(Request::get('state_id')[0])){{ Request::get('state_id')[0] }} @endif">
                <input type="hidden" name="city_id" value="@if(isset(Request::get('city_id')[0])){{ Request::get('city_id')[0] }} @endif">
                <input type="hidden" name="functional_area_id" value="@if(isset(Request::get('functional_area_id')[0])){{ Request::get('functional_area_id')[0] }} @endif">
                <div class="modal-header">
                    <h4 class="modal-title">Job Alert</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
					
					<h3>Get the latest <strong>{{ ucfirst(Request::get('search')) }}</strong> jobs  @if(Request::get('location')!='') in <strong>{{ ucfirst(Request::get('location')) }}</strong>@endif sent straight to your inbox</h3>
					
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email"
                            value="@if( Auth::check() ) {{Auth::user()->email}} @endif">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="job_advance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title modal_title_main" id="exampleModalLabel">Advance Search</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="get" action="{{ route('job.list')}}">
            <div class="modal-body modal_body_main">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputCompany" class="mb-1">Job Title</label>
                        <input type="text" name="job_title[]" class="form-control typeahead typeahead_job" id="exampleInputCompany"  placeholder="Job Title" value="{{ @Request::get('job_title')[0] }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputCompany" class="mb-1">Company</label>
                        <select name="company_id[]" class="form-control">
                            <option value="">Select Company</option>
                            @foreach ($data['companies'] as $company)
                            @php
                                $selected = (in_array($company->id, Request::get('company_id', array())))? 'selected':'';
                            @endphp
                                <option value="{{ $company->id }}" {{ $selected }}>{{ $company->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Job Skill</label>
                        <select name="job_skill_id[]" class="form-control">
                            <option value="">Select Skill</option>
                            @foreach ($data['job_skill'] as $job_skill)
                            @php
                                $selected = (in_array($job_skill->job_skill_id, Request::get('job_skill_id', array())))? 'selected':'';
                            @endphp
                                <option value="{{ $job_skill->job_skill_id }}" {{ $selected }}>{{ $job_skill->job_skill }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Country</label>
                        <select name="country_id[]" class="form-control" id="country_id">
                            <option value="">Select Country</option>
                            @foreach ($data['countries'] as $country)
                                @php
                                    $selected = (in_array($country->country_id, Request::get('country_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $country->country_id }}" {{ $selected }}>{{ $country->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 state_id_div" id="state_id_div">
                        <label for="exampleInputCompany" class="mb-1">State</label>
                        <span id="default_state_dd" class="default_state_dd">
                            <select name="state_id[]" class="form-control" id="state_id">
                                <option value="">All States</option>
                            </select>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">City</label>
                        <span id="default_city_dd">
                            <select name="city_id[]" class="form-control">
                                <option value="">All Cities</option>
                            </select>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Gender</label>
                        <select name="gender_id[]" class="form-control">
                            <option value="">Select Gender</option>
                            @foreach ($data['gender'] as $gender)
                                @php
                                    $selected = (in_array($gender->gender_id, Request::get('gender_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $gender->gender_id }}" {{ $selected }}>{{ $gender->gender }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Job Type</label>
                        <select name="job_type_id[]" class="form-control">
                            <option value="">Select Job Type</option>
                            @foreach ($data['job_types'] as $job_type)
                                @php
                                    $selected = (in_array($job_type->job_type_id, Request::get('job_type_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $job_type->job_type_id }}" {{ $selected }}>{{ $job_type->job_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Job Shift</label>
                        <select name="job_shift_id[]" class="form-control">
                            <option value="">Select Job Shift</option>
                            @foreach ($data['job_shifts'] as $shift)
                                @php
                                    $selected = (in_array($shift->job_shift_id, Request::get('job_shift_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $shift->job_shift_id }}" {{ $selected }}>{{ $shift->job_shift }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Jobs Degree Level</label>
                        <select name="degree_level_id[]" class="form-control">
                            <option value="">Select Job Shift</option>
                            @foreach ($data['job_degree_levels'] as $degree)
                                @php
                                    $selected = (in_array($degree->degree_level_id, Request::get('degree_level_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $degree->degree_level_id }}" {{ $selected }}>{{ $degree->degree_level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Experience</label>
                        <select name="job_experience_id[]" class="form-control">
                            <option value="">Select Experience</option>
                            @foreach ($data['job_experience'] as $experience)
                            @php
                                $selected = (in_array($experience->job_experience_id, Request::get('job_experience_id', array())))? 'selected="selected"':'';
                            @endphp
                                <option value="{{ $experience->job_experience_id }}" {{$selected}}>{{ $experience->job_experience }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Jobs Career Level</label>
                        <select name="career_level_id[]" class="form-control">
                            <option value="">Select Job Shift</option>
                            @foreach ($data['job_careers'] as $level)
                                @php
                                    $selected = (in_array($level->career_level_id, Request::get('career_level_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $level->career_level_id }}" {{ $selected }}>{{ $level->career_level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Jobs Industry</label>
                        <select name="industry_id[]" class="form-control">
                            <option value="">Select Job Shift</option>
                            @foreach ($data['industries'] as $industry)
                            @php
                                $selected = (in_array($industry->id, Request::get('industry_id', array())))? 'selected="selected"':'';
                            @endphp
                                <option value="{{ $industry->id }}" {{ $selected }}>{{ $industry->industry }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputCompany" class="mb-1">Jobs Functional Areas</label>
                        <select name="functional_area_id[]" class="form-control">
                            <option value="">Select Job Shift</option>
                            @foreach ($data['functional_areas'] as  $f_area)
                                @php
                                    $selected = (in_array($f_area->functional_area_id, Request::get('functional_area_id', array())))? 'selected="selected"':'';
                                @endphp
                                <option value="{{ $f_area->functional_area_id }}" {{$selected}}>{{ $f_area->functional_area }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputCompany" class="mb-1">Salary Range From</label>
                        <input type="text" name="salary_from" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control" id="exampleInputCompany" placeholder="Salary From" value="{{ Request::get('salary_from') }}">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="exampleInputCompany" class="mb-1">Salary Range To</label>
                        <input type="text" name="salary_to" onkeyup="this.value=this.value.replace(/[^\d]/,'')" class="form-control" id="exampleInputCompany" placeholder="Salary To" value="{{ Request::get('salary_to') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exampleInputCompany" class="mb-1">Currency</label>
                        <select name="salary_currency" class="form-control">
                            <option value="">Select Job Shift</option>
                            @foreach ($data['currencies'] as $currency)
                                @php
                                    $selected = (Request::get('salary_currency') == $currency )?'Selected':'';
                                @endphp
                                <option value="{{ $currency }}" {{ $selected }}>{{ $currency }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
            <button type="submit" onclick="advanceSearchSubmit()" class="btn btn-primary">Search</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .searchList li .jobimg {
        min-height: 80px;
    }
    .hide_vm_ul{
        height:100px;
        overflow:hidden;
    }
    .hide_vm{
        display:none !important;
    }
    .view_more{
        cursor:pointer;
    }
</style>
@endpush
@push('scripts') 
<script>
$('.btn-job-alert').on('click', function() {
    @if(Auth::user())
    $('#show_alert').modal('show');
    @else
    swal({
        title: "Save Job Alerts",
        text: "To save Job Alerts you must be Registered and Logged in",
        icon: "error",
        buttons: {
        Login: "Login",
        register: "Register",
        hello: "OK",
      },
});
    @endif
})
     $(document).ready(function ($) {
        $("#search-job-list").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("#search-job-list").find(":input").prop("disabled", false);
        $(".view_more_ul").each(function () {
            if ($(this).height() > 100)
            {
                $(this).addClass('hide_vm_ul');
                $(this).next().removeClass('hide_vm');
            }
        });
        $('.view_more').on('click', function (e) {
            e.preventDefault();
            $(this).prev().removeClass('hide_vm_ul');
            $(this).addClass('hide_vm');
        });
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(0);
    });
    if ($("#submit_alert").length > 0) {
    $("#submit_alert").validate({
        rules: {
            email: {
                required: true,
                maxlength: 5000,
                email: true
            }
        },
        messages: {
            email: {
                required: "Email is required",
            }
        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('subscribe.alert')}}",
                type: "GET",
                data: $('#submit_alert').serialize(),
                success: function(response) {
                    $("#submit_alert").trigger("reset");
                    $('#show_alert').modal('hide');
                    swal({
                        title: "Success",
                        text: response["msg"],
                        icon: "success",
                        button: "OK",
                    });
                }
            });
        }
    })
}
 $(document).on('click','.swal-button--Login',function(){
        window.location.href = "{{route('login')}}";
     })
     $(document).on('click','.swal-button--register',function(){
        window.location.href = "{{route('register')}}";
     })

     function searchJob(){
        var salary_from = parseInt($('#salary_from').val());
        var salary_to = parseInt($('#salary_to').val());
        var is_true = true;
        if(salary_from >= salary_to){
            $('#salary_to_greater').text('(SalaryTo) must be greater than (Salary From)');
            is_true = false;
        }else{
            $('#salary_to_greater').text('');
            is_true = true;
        }
        if(is_true){
            $('#search-job-form').submit();
        }
     }
     function submit_form() {
        // $(".click_on_button_when_click_filter").click();
        $('#search-job-form').submit();
     }


     function job_advance_filter(){
        $("#job_advance_modal").modal("show");
     }
     function advanceSearchSubmit(){

     }

     function filterLangStates(state_id)
    {
        var country_id = $('#country_id').val();
        console.log(country_id);
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown.job.ad') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterLangCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
                    });
        }
    }
    function filterLangCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown.job.ad') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }
</script>
@include('includes.country_state_city_js')
@endpush