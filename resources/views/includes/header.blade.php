<div class="header">
    <div class="container-fluid">
        <div class="row pt-2">
            <div class="col-lg-2 col-md-12 col-12 mb-1 header_logo_padding_left"> <a href="{{url('/')}}" class="logo mb-0 ml-2"><img src="{{ asset('/') }}sitesetting_images/thumb/{{ $siteSetting->site_logo }}" alt="{{ $siteSetting->site_name }}" class="desktop_logo" /></a>
                <div class="navbar-header navbar-light">
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-xl-9 col-lg-10 col-md-12 col-12 pt-2 pr-0"> 

                <!-- Nav start -->
                <nav class="navbar navbar-expand-lg navbar-light pt-1">
					
                    <div class="navbar-collapse collapse" id="nav-main">
                        <ul class="navbar-nav ml-auto">
                            @if(!Auth::guard('company')->check())
                                <li class="nav-item {{ Request::url() == route('index') ? 'active' : '' }}"><a href="{{url('/')}}" class="nav-link">{{__('Home')}}</a> </li>
                                <?php //echo $routeName = Route::currentRouteName();?>
                                @if(Auth::guard('company')->check())
                                    <li class="nav-item"><a href="{{url('/job-seekers')}}" class="nav-link">{{__('Seekers')}}</a> </li>
                                    <li class="nav-item {{ Request::url() == route('job.list') ? 'active' : '' }}"><a href="{{url('/jobs')}}" class="nav-link">{{__('Jobs')}}</a> </li>
                                @else
                                    <li class="nav-item {{ Request::url() == route('job.list') ? 'active' : '' }}"><a href="{{url('/jobs')}}" class="nav-link">{{__('Jobs')}}</a> </li>
                                @endif
                                
                                <li class="nav-item {{ Request::url() == route('company.listing') ? 'active' : '' }}"><a href="{{url('/companies')}}" class="nav-link">{{__('Companies')}}</a> </li>
                                @foreach($show_in_top_menu as $top_menu) @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp
                                
                                    <?php
                                    if( isset($cmsContent->page_title) && $cmsContent->page_title != '' ) {?>
                                        <li class="nav-item {{ Request::url() == route('cms', $top_menu->page_slug) ? 'active' : '' }}"><a href="{{ route('cms', $top_menu->page_slug) }}" class="nav-link">
                                            {{ $cmsContent->page_title }}
                                        </a> </li>
                                    <?php
                                    }?>
                                    
                                @endforeach
                                <li class="nav-item {{ Request::url() == route('blogs') ? 'active' : '' }}"><a href="{{ route('blogs') }}" class="nav-link">{{__('Blog')}}</a> </li>
                                <li class="nav-item {{ Request::url() == route('contact.us') ? 'active' : '' }}"><a href="{{ route('contact.us') }}" class="nav-link">{{__('Contact us')}}</a> </li>
                            @endif

                            @if(Auth::check())
                            <li class="nav-item dropdown userbtn"><a href="">{{Auth::user()->printUserImage()}}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{route('home')}}" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a> </li>
                                    <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> {{__('Edit Profile')}}</a> </li>
                                    <li class="nav-item"><a href="{{ route('view.public.profile', Auth::user()->id) }}" class="nav-link"><i class="fa fa-eye" aria-hidden="true"></i> {{__('Public Profile')}}</a> </li>
                                    <li><a href="{{ route('my.job.applications') }}" class="nav-link"><i class="fa fa-desktop" aria-hidden="true"></i> {{__('Applied Jobs')}}</a> </li>
                                    <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a> </li>
                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </li>
                            @endif @if(Auth::guard('company')->check())
                            <li class="nav-item postjob"><a href="{{route('post.job')}}" class="nav-link register">{{__('Post New Job')}}</a> </li>
                            <li class="nav-item dropdown userbtn"><a href="">{{Auth::guard('company')->user()->printCompanyImage()}}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{route('company.home')}}" class="nav-link"><i class="fa fa-tachometer" aria-hidden="true"></i> {{__('Dashboard')}}</a> </li>
                                    <li class="nav-item"><a href="{{ route('company.profile') }}" class="nav-link"><i class="fa fa-user" aria-hidden="true"></i> {{__('Edit Profile')}}</a></li>
                                    <li class="nav-item"><a href="{{route('company.messages')}}" class="nav-link"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{__('Messages')}}</a></li>
                                    <li class="nav-item"><a href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}</a> </li>
                                    <form id="logout-form-header1" action="{{ route('company.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </li>
                            @endif @if(!Auth::user() && !Auth::guard('company')->user())
                            <li class="nav-item {{ Request::url() == route('login') ? 'active' : '' }} {{ Request::url() == route('register') ? 'active' : '' }}"><a href="{{route('login')}}" class="nav-link">{{__('Sign in')}}</a> </li>
							<li class="nav-item"><a href="{{route('register',['type' => 'employer'])}}" class="nav-link register">Corporate Login</a> </li>
                            @endif
                            <!-- <li class="dropdown userbtn"><a href="{{url('/')}}"><img src="{{asset('/')}}images/lang.png" alt="" class="userimg" /></a>
                                <ul class="dropdown-menu">
                                    @foreach($siteLanguages as $siteLang)
                                    <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('locale-form-{{$siteLang->iso_code}}').submit();" class="nav-link">{{$siteLang->native}}</a>
                                        <form id="locale-form-{{$siteLang->iso_code}}" action="{{ route('set.locale') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="locale" value="{{$siteLang->iso_code}}"/>
                                            <input type="hidden" name="return_url" value="{{url()->full()}}"/>
                                            <input type="hidden" name="is_rtl" value="{{$siteLang->is_rtl}}"/>
                                        </form>
                                    </li>
                                    @endforeach
                                </ul>
                            </li> -->
                        </ul>

                        <!-- Nav collapes end --> 

                    </div>
                    <div class="clearfix"></div>
                </nav>

                <!-- Nav end --> 

            </div>
        </div>

        <!-- row end --> 

    </div>

    <!-- Header container end --> 

</div>






<?php /*?>@if(!Auth::user() && !Auth::guard('company')->user())
	<div class="">my dive 2</div>
@endif<?php */?>