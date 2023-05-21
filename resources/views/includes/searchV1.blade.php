@if((bool)$siteSetting->is_slider_active)
<!-- Revolution slider start -->
<div class="tp-banner-container">
    <div class="tp-banner" >
        <ul>
        @if(isset($sliders) && count($sliders))
            @foreach($sliders as $slide)
            <!--Slide-->
            <li data-slotamount="7" data-transition="slotzoom-horizontal" data-masterspeed="1000" data-saveperformance="on"> <img alt="{{$slide->slider_heading}}" src="{{asset('/')}}images/slider/dummy.png" data-lazyload="{{ ImgUploader::print_image_src('/slider_images/'.$slide->slider_image) }}">
                <div class="caption lft large-title tp-resizeme slidertext1" data-x="left" data-y="90" data-speed="600" data-start="1600">{{$slide->slider_heading}}</div>
                <div class="caption lfb large-title tp-resizeme sliderpara" data-x="left" data-y="200" data-speed="600" data-start="2800">{!!$slide->slider_description!!}</div>
                <div class="caption lfb large-title tp-resizeme slidertext5" data-x="left" data-y="300" data-speed="600" data-start="3500"><a href="{{$slide->slider_link}}">{{$slide->slider_link_text}}</a></div>
            </li>
            <!--Slide end--> 
            @endforeach
            @endif
        </ul>
    </div>
</div>
<!-- Revolution slider end --> 
<!--Search Bar start-->

    <div class="container">
		<div class="searchblack">
        @include('includes.search_formV1')
    </div>
		<div class="clearfix"></div>
</div>
<!-- Search End --> 
@else
<div class="searchwrap header_search_custom_margin">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-lg-6 pl-xs-0 pl-sm-0 pl-md-5 find_job_background_image_left">
                @include('includes.search_formV1')
            </div>
            <div class="col-lg-6 find_job_background_image_right">
                
            </div>
        </div>  
    </div>
</div>

<div class="searchwrap right_talent_categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-6 pl-md-5 pl-xs-0 pl-sm-0">
                <div class="searchbar looking_right_talent margin_left_custom_explore">
                    <div class="row">
                        <div class="col-lg-8">
                            <p class="right_talent">
                                Looking For The Right Talents
                            </p>
                        </div>
                        <div class="col-lg-4">
                            @if(Auth::guard('company')->check())
                            <a href="{{url('/job-seekers')}}">
                                <input type="button" class="btn w-100 float-right right_talent_explore" value="Explore" />
                            </a>
                            @else
                            <a href="{{url('/jobs')}}">
                                <input type="button" class="btn w-100 float-right right_talent_explore" value="Explore" />
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="searchbar margin_left_custom_jobs_company looking_right_talent">
            
                        <style type="text/css">
                            /* medium - display 2  */
                            @media (min-width: 768px) {

                                .carousel-inner .carousel-item-right.active,
                                .carousel-inner .carousel-item-next {
                                    transform: translateX(50%);
                                }

                                .carousel-inner .carousel-item-left.active,
                                .carousel-inner .carousel-item-prev {
                                    transform: translateX(-50%);
                                }
                            }

                            /* large - display 3 */
                            @media (min-width: 992px) {

                                .carousel-inner .carousel-item-right.active,
                                .carousel-inner .carousel-item-next {
                                    transform: translateX(33%);
                                }

                                .carousel-inner .carousel-item-left.active,
                                .carousel-inner .carousel-item-prev {
                                    transform: translateX(-33%);
                                }
                            }

                            @media (max-width: 768px) {
                                .carousel-inner .carousel-item>div {
                                    display: none;
                                }

                                .carousel-inner .carousel-item>div:first-child {
                                    display: block;
                                }
                            }

                            .carousel-inner .carousel-item.active,
                            .carousel-inner .carousel-item-next,
                            .carousel-inner .carousel-item-prev {
                                display: flex;
                            }

                            .carousel-inner .carousel-item-right,
                            .carousel-inner .carousel-item-left {
                                transform: translateX(0);
                            }
                        </style>
                     
                        <div id="myCarouse" class="carousel slide jobs_Category_custom_width" data-ride="carousel">
                            <div class="carousel-inner ml-4 w-100" role="listbox">
                                @if(isset($specific_cpmpany_jobs) && count($specific_cpmpany_jobs))
                                    @foreach ($specific_cpmpany_jobs as $key => $company_id_num_jobs)
                                        <?php
                                        $company = App\Company::where('id', '=', $company_id_num_jobs->company_id)->active()->first();
                                        if (null !== $company) {?>
                                                <div class="carousel-item <?php if($key==0){echo 'active';} ?>">
                                                    <div class="col-lg-6 col-xl-4 col-md-6 p-0">
                                                        <a href="{{route('job.detail', [$company_id_num_jobs->slug])}}" title="{{$company_id_num_jobs->title}}">
                                                            <div class="jobs_Category_container">
                                                                <span class="jobs_Category_image">
                                                                    {{$company->printCompanyImage()}}
                                                                    <!-- <img class="img-fluid jobs_Category_name_image_main " src="<?php //echo url('/public/images/microsoft.png');?>"> -->
                                                                </span>
                                                                <span class="jobs_Category_name">
                                                                    <?php
                                                                        echo substr($company_id_num_jobs->title, 0 ,15);
                                                                        if( strlen($company_id_num_jobs->title) > 15 ) {
                                                                            echo "..";
                                                                        }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                        ?>
                                    @endforeach
                                @endif
                                
                            </div>
                            <a class="carousel-control-prev bg-dark" href="#myCarouse" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next bg-dark" href="#myCarouse" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>







                </div>
            </div>
        </div>  
    </div>
</div>

@endif