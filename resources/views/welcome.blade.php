@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Search start -->
@include('includes.searchV1')
<!-- Search End --> 
<!-- Top Employers start -->
@include('includes.top_employers')
<!-- Top Employers ends --> 
<!-- Popular Searches start -->
@include('includes.popular_searches')
<!-- Popular Searches ends --> 
<!-- Featured Jobs start -->
@include('includes.featured_jobsV1')
<!-- Featured Jobs ends -->

@include('includes.job_categories')

<!-- Login box start -->
@include('includes.login_textV1')
<!-- Login box ends --> 
<!-- How it Works start -->
@include('includes.how_it_worksV1')
<!-- How it Works Ends -->

@include('includes.home_blogs')

<!-- Latest Jobs start -->

@include('includes.latest_jobs')
<!-- Latest Jobs ends --> 

<!-- Testimonials start -->
@include('includes.testimonials')
<!-- Testimonials End -->
<!-- Video start -->

<!-- Video end --> 
<!-- Login box start -->

<!-- Login box ends --> 

<!-- Subscribe start -->
<!-- Subscribe End -->
@include('includes.footer')
@endsection
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
    });
</script>
@include('includes.country_state_city_js')
@endpush
