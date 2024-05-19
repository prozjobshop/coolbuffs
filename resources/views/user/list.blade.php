@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Job Seekers')]) 
<!-- Inner Page Title end -->

@include('flash::message')


<div class="listpgWraper">
    <div class="container">
        
        <form action="{{route('job.seeker.list')}}" method="get" id="search-applicant-form">
            <!-- Search Result and sidebar start -->
            <div class="row"> @include('includes.job_seeker_list_side_bar')                
                <div class="col-lg-6"> 
                    <!-- Search List -->
                    <ul class="searchList">
                        <!-- job start --> 
                        @if(isset($jobSeekers) && count($jobSeekers))
                        @foreach($jobSeekers as $jobSeeker)
                        <li>
                            <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <div class="jobimg">{{$jobSeeker->printUserImage(100, 100)}}</div>
                                    <div class="jobinfo">
                                        <h3><a href="{{route('user.profile', $jobSeeker->id)}}">{{$jobSeeker->getName()}}</a></h3>
                                        <div class="location"> {{$jobSeeker->getLocation()}}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                @if($jobSeeker!=NULL && $jobSeeker->package_end_date >= date('d-m-Y', strtotime(now())) )
                                    <img src="{{ asset('images/gold-icon.png') }}" alt="" style="margin-top: 3px">
                                @endif
                                          <div class="listbtn">
                                        <a href="{{route('user.profile', $jobSeeker->id)}}">{{__('View Profile')}}</a></div>
                                </div>
                            </div>
                            <p>{{\Illuminate\Support\Str::limit($jobSeeker->getProfileSummary('summary'),150,'...')}}</p>
                        </li>
                        <!-- job end --> 
                        @endforeach
                        @endif
                    </ul>

                    <!-- Pagination Start -->
                    <div class="pagiWrap">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="showreslt">
                                    {{__('Showing Pages')}} : {{ $jobSeekers->firstItem() }} - {{ $jobSeekers->lastItem() }} {{__('Total')}} {{ $jobSeekers->total() }}
                                </div>
                            </div>
                            <div class="col-md-7 text-right">
                                @if(isset($jobSeekers) && count($jobSeekers))
                                {{ $jobSeekers->appends(request()->query())->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Pagination end --> 
                    <div class=""><br />{!! $siteSetting->listing_page_horizontal_ad !!}</div>

                </div>
				<div class="col-lg-3">
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
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);

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

    });
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
            $('#search-applicant-form').submit();
        }
     }
    function submit_form() {
    // $(".click_on_button_when_click_filter").click();
        $('#search-applicant-form').submit();
    }
</script>
@include('includes.country_state_city_js')
@endpush