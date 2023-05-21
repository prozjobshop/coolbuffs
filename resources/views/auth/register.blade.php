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
                <h1 class="page-heading">REGISTER</h1>
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
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link {{($c_or_e == 'candidate')? 'active':''}}" data-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a></li>
                                <li class="nav-item" style="margin-left: 25px;"><a class="nav-link {{($c_or_e == 'employer')? 'active':''}}" data-toggle="tab" href="#employer" aria-expanded="false">{{__('Employer')}}</a></li>
                            </ul>
                        @endif
                    </div>
                    <div class="tab-content">
                        <div id="candidate" class="formpanel tab-pane {{($c_or_e == 'candidate')? 'active':''}}">
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}" name="auth_form" id="auth_form">
                                    {{ csrf_field() }}
                                <div class="container p-0">
                                    <input type="hidden" name="candidate_or_employer" value="candidate" />

                                    <!-- <div class="formrow{{ $errors->has('middle_name') ? ' has-error' : '' }}" style="display: none;">
                                        <input type="text" name="middle_name" class="form-control" placeholder="{{__('Middle Name')}}" value="{{old('middle_name')}}">
                                        @if ($errors->has('middle_name')) <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span> @endif
                                    </div> -->


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                <input type="text" name="first_name" class="form-control" required="required" placeholder="{{__('First Name')}}" value="{{old('first_name')}}">
                                                @if ($errors->has('first_name')) <span class="help-block text-danger"> <strong>{{ $errors->first('first_name') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                <input type="text" name="last_name" class="form-control" required="required" placeholder="{{__('Last Name')}}" value="{{old('last_name')}}">
                                                @if ($errors->has('last_name')) <span class="help-block text-danger"> <strong>{{ $errors->first('last_name') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }} mb-0">
                                                <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">
                                                @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                            </div>
                                            <p class="text-danger text-left" style="display: none;" id="email_error_validation">Email address is not valid.</p>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input type="password" name="password" class="form-control" required="required" placeholder="{{__('Password')}}" value="">
                                                @if ($errors->has('password')) <span class="help-block text-danger"> <strong>{{ $errors->first('password') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="{{__('Password Confirmation')}}" value="">
                                                @if ($errors->has('password_confirmation')) <span class="help-block text-danger"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span> @endif 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                                                <input type="checkbox" value="1" name="terms_of_use" />
                                                <a href="javascript:void();" onclick="term_conditions()">{{__('I accept Terms of Use')}}</a>
                                                @if ($errors->has('terms_of_use')) <p class="help-block text-danger text-left"> <strong>{{ $errors->first('terms_of_use') }}</strong> </p> @endif 
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">
                                                <?php
                                                $is_checked = '';
                                                if (old('is_subscribed', 1)) {
                                                    $is_checked = 'checked="checked"';
                                                }
                                                ?>
                                                
                                                <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />
                                                {{__('Subscribe to Newsletter')}}
                                                @if ($errors->has('is_subscribed')) <p class="help-block text-danger text-left"> <strong>{{ $errors->first('is_subscribed') }}</strong> </p> @endif 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group col-12 col-sm-12 col-md-10 text-left p-0 m-0 mobile-padding-no {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response')) <p class="help-block text-danger text-left">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong> </p> @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="button" class="btn" value="{{__('Register')}}" onclick="ValidateEmail(document.auth_form.email)">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="employer" class="formpanel tab-pane fade {{($c_or_e == 'employer')? 'active':''}}">
                            <form class="form-horizontal" method="POST" action="{{ route('company.register') }}" name="auth_form_company" id="auth_form_company">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="employer" />
                                
                                <div class="container p-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="formrow{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <input type="text" name="name" class="form-control" required="required" placeholder="{{__('Name')}}" value="{{old('name')}}">
                                                @if ($errors->has('name')) <span class="help-block text-danger"> <strong>{{ $errors->first('name') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }} mb-0">
                                                <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">
                                                @if ($errors->has('email')) <span class="help-block text-danger"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                            </div>
                                            <p class="text-danger text-left" style="display: none;" id="email_error_validation_company">Email address is not valid.</p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <input type="password" name="password" class="form-control" required="required" placeholder="{{__('Password')}}" value="">
                                                @if ($errors->has('password')) <span class="help-block text-danger"> <strong>{{ $errors->first('password') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="{{__('Password Confirmation')}}" value="">
                                                @if ($errors->has('password_confirmation')) <span class="help-block text-danger"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                                                <input type="checkbox" value="1" name="terms_of_use" />
                                                <!-- {{url('terms-of-use')}} -->
                                                <a href="javascript:void();" onclick="term_conditions()">{{__('I accept Terms of Use')}}</a>
                                                @if ($errors->has('terms_of_use'))<p class="help-block text-danger text-left"> <span class="help-block"> <strong>{{ $errors->first('terms_of_use') }}</strong> </span></p> @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">
                                                <?php
                                            	$is_checked = '';
                                            	if (old('is_subscribed', 1)) {
                                            		$is_checked = 'checked="checked"';
                                            	}
                                            	?>    
                                                <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />
                                                {{__('Subscribe to Newsletter')}}
                                                @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group col-12 col-sm-12 col-md-10 text-left p-0 m-0 mobile-padding-no {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response')) <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong> </span> @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <input type="button" class="btn" value="{{__('Register')}}" onclick="ValidateEmailCompany(document.auth_form_company.email)">
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- sign up form -->
                    @if(request()->get('type') == 'employer')
                        <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('Have Account')}}? <a href="{{route('login',['type' => 'employer'])}}">{{__('Sign in')}}</a></div>
                    @else
                        <div class="newuser"><i class="fa fa-user" aria-hidden="true"></i> {{__('Have Account')}}? <a href="{{route('login')}}">{{__('Sign in')}}</a></div>
                    @endif
                    <!-- sign up form end--> 
                </div>
            </div>
        
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="term_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title modal_title_main" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal_body_main">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@include('includes.footer')
@endsection
<script>
    function term_conditions() {
        $.ajax({
          url: "{{ url('/get_term_conditions_data') }}",
          method: 'get',
          success: function(result){
             $("#term_conditions_modal").modal("show");
             $(".modal_title_main").html(result.page_title);
             $(".modal_body_main").html(result.page_content);
          }});
    }
</script>


<script type="text/javascript">
function ValidateEmail(inputText)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.value.match(mailformat)) {
        document.auth_form.email.focus();
        $("#email_error_validation").hide();
        document.getElementById("auth_form").submit();
        return true;
    } else {
        document.auth_form.email.focus();
        $("#email_error_validation").show();
        return false;
    }
}

function ValidateEmailCompany(inputText)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.value.match(mailformat)) {
        document.auth_form_company.email.focus();
        $("#email_error_validation_company").hide();
        document.getElementById("auth_form_company").submit();
        return true;
    } else {
        document.auth_form_company.email.focus();
        $("#email_error_validation_company").show();
        return false;
    }
}
</script>