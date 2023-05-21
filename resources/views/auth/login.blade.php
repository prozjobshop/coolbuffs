@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->

<div class="pageTitle">
    
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-sm-12">
                <h1 class="page-heading">LOGIN</h1>
                <!-- <p class="page_header_paragraph">Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ut Enim Ad Minim Veniam.</p> -->
            </div>
        </div>
    </div>
    
</div>

<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        @include('flash::message')
       
            <div class="useraccountwrap">
                <div class="userccount">
                    <div class="userbtns">
                        <?php
                            if(request()->get('type') == 'employer'){
                                $c_or_e = 'employer';
                            }else{
                                $c_or_e = old('candidate_or_employer', 'candidate');
                            }
                        ?>
                        @if(request()->get('type') == 'employer')
                        
                        @else
                            <ul class="nav nav-tabs" style="display: flex;align-items: center;justify-content: space-between;">
                                <li class="nav-item"><a class="nav-link {{($c_or_e == 'candidate')? 'active':''}}" data-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a></li>
                                <li class="nav-item" style="margin-left: 25px;"><a class="nav-link {{($c_or_e == 'employer')? 'active':''}}" data-toggle="tab" href="#employer" aria-expanded="false">{{__('Employer')}}</a></li>
                            </ul>
                        @endif
                    </div>
					
					
                    <div class="tab-content">
                        <div id="candidate" class="formpanel tab-pane {{($c_or_e == 'candidate')? 'active':''}}">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="candidate" />
                                <div class="formpanel">
                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>            
                                    <input type="submit" class="btn" value="{{__('Login')}}">
                                </div>
                                <!-- login form  end--> 
                            </form>

                    <div class="newuser">
                        
                        <i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"></i> New User?
                        <a href="{{route('register')}}"> Register Here</a>

                        <i class="fa fa-user" aria-hidden="true" style="font-size: 20px; margin-left: 25px;"></i> Forgot Your Password?
                        <a href="{{ route('password.request') }}"> Click here</a>

                    </div>
                    <!-- sign up form end-->
                        </div>
                        <div id="employer" class="formpanel tab-pane fade {{($c_or_e == 'employer')? 'active':''}}">
                            <form class="form-horizontal" method="POST" action="{{ route('company.login') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="employer" />
                                <div class="formpanel">
                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>            
                                    <input type="submit" class="btn" value="{{__('Login')}}">
                                </div>
                                <!-- login form  end--> 
                            </form>
                            <!-- sign up form -->

                            
                    <div class="newuser">
                        
                        @if(request()->get('type') == 'employer')
                            <i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"></i> New User?
                            <a href="{{route('register',['type' => 'employer'])}}"> Register Here</a>
                        @else
                            <i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"></i> New User?
                            <a href="{{route('register')}}"> Register Here</a>
                        @endif

                        <i class="fa fa-user" aria-hidden="true" style="font-size: 20px; margin-left: 25px;"></i> Forgot Your Password?
                        <a href="{{ route('company.password.request') }}"> Click here</a>

                    </div>
                    <!-- sign up form end-->
                        </div>
                    </div>
                    <!-- login form -->

                     

                </div>
            </div>
        
    </div>
</div>
@include('includes.footer')
@endsection
