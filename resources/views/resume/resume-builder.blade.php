<!-- @extends('layouts.app') -->
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Create Resume')])
<!-- Inner Page Title end -->
<script src="{{asset('/js/popper.js')}}"></script>
<style>
  .download-btn a {
    width: 220px !important;
    color: #ffffff !important;
    background: #0096FF !important;
    border: 1px solid #0096FF !important;
    line-height: 1;
    font-size: 14px;
  }
</style>
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
                @if($user->is_resume == '1')
                  @if($user->resume_temp!=null)
                      <div class="my-resume">
                        <h3>My Resume</h3>
                        <ul class="searchList">
                          <li>
                              <div class="row">
                                  <div class="col-md-8 col-sm-8">
                                      <div class="jobimg">
                                          @if($user->resume_temp == 'temp_1')
                                              <img src="{{ asset('resumes/template-1.png') }}" alt="" title="">
                                          {{-- @elseif($user->resume_temp == 'temp_2')
                                              <img src="{{ asset('resumes/template-2.png') }}" alt="" title=""> --}}
                                          @elseif($user->resume_temp == 'temp_3')
                                              <img src="{{ asset('resumes/template-3.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_4')
                                              <img src="{{ asset('resumes/template-4.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_5')
                                              <img src="{{ asset('resumes/template-5.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_6')
                                              <img src="{{ asset('resumes/template-6.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_7')
                                              <img src="{{ asset('resumes/template-7.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_8')
                                              <img src="{{ asset('resumes/template-8.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_9')
                                              <img src="{{ asset('resumes/template-10.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_11')
                                              <img src="{{ asset('resumes/template-11.png') }}" alt="" title="">
                                          @elseif($user->resume_temp == 'temp_12')
                                              <img src="{{ asset('resumes/template-12.png') }}" alt="" title="">
                                          @else
                                              {{-- <img src="{{ asset('resumes/template-1.png') }}" alt="" title=""> --}}
                                          @endif
                                      </div>

                                      <div class="jobinfo">
                                          <h3><a href="{{ url('download-resume') }}" title="Download Resume" data-turbolinks="false">
                                              @if($user->resume_temp == 'temp_1')
                                                  Template 1
                                              @elseif($user->resume_temp == 'temp_2')
                                                  Template 2
                                              @elseif($user->resume_temp == 'temp_3')
                                                  Template 2
                                              @elseif($user->resume_temp == 'temp_4')
                                                Template 3
                                              @elseif($user->resume_temp == 'temp_5')
                                                Template 4
                                              @elseif($user->resume_temp == 'temp_6')
                                                Template 5
                                              @elseif($user->resume_temp == 'temp_7')
                                                Template 6
                                              @elseif($user->resume_temp == 'temp_8')
                                                Template 7
                                              @elseif($user->resume_temp == 'temp_9')
                                                Template 8
                                              @elseif($user->resume_temp == 'temp_11')
                                                Template 9
                                              @elseif($user->resume_temp == 'temp_12')
                                                Template 10
                                              @else
                                                  {{-- Template --}}
                                              @endif
                                          </a></h3>
                                          <div class="location">
                                              <label class="fulltime">My Resume</label>
                                          </div>
                                      </div>
                                      <div class="clearfix"></div>
                                  </div>
                                  <div class="col-md-4 col-sm-4">
                                      <div class="listbtn mt-0 download-btn">
                                        
                                        <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Download Resume')}}</a>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item my-1" href="{{ url('download-resume') . '?format=pdf' }}" data-turbolinks="false">PDF</a>
                                          <a class="dropdown-item my-1" href="{{ url('download-resume') . '?format=docx'}}" data-turbolinks="false">Word</a>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                              <p>Click Download Resume to download in PDF format, or choose another template from below to download in selected resume template.</p>
                          </li>
                        </ul>
                      </div>
                    @endif
                  @endif

                <div class="resume-templates">
                    <h3>Resume Templates</h3>
                    <p>Select Resume Template</p>

                    <div class="container mt-4">
                    <div class="row cv-templates">
                      @php
                          $checks = [];
                          $inc=1;
                      @endphp
                    @for($i=1; $i<=12; $i++)
                      @if($i==2 || $i==10)
                       @continue;
                      @endif
                      @php
                        $checks[$i]=DB::table('manage_resumes')->where(['resume_id'=>$i,'status'=>'free'])->get()->count();
                      @endphp
                      @if($checks[$i]>0)
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_$i' ? 'selected_border' : '' }}">
                                {{-- <a href="{{ url('download-resume-template/temp-1') }}" target="_blank"> --}}
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_{{$i}}">
                                    <figure class="text-center">
                                        <figcaption class="text-center mb-3"> 

                                          <span class="temp_name">

                                            Template {{$inc}}
                                            <label class="check-label fulltime selected_check {{ $user->resume_temp == 'temp_$i' ? 'd-inline-block' : 'd-none' }}">
                                              <i class="fa fa-check"></i>
                                            </label> 

                                          </span>
                                          
                                          <div class="clear"></div>
                                          
                                        </figcaption>
                                        
                                        <img src="{{ asset('resumes/template-'.$i.'.png') }}" alt="" class="w-100">
                                    </figure>
                                </a>

                                <div class="download-btn">
                                  <div class="btn-group">
                                      <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Download Resume
                                      </a>
                                      <div class="dropdown-menu">
                                          <a class="dropdown-item my-1" href="{{ url('download-resume') . '?format=pdf&temp_id='.base64_encode("$i") }}" data-turbolinks="false">PDF</a>
                                          <a class="dropdown-item my-1" href="{{ url('download-resume') . '?format=docx&temp_id='.base64_encode("$i") }}" data-turbolinks="false">Word</a>
                                      </div>
                                  </div>
                              </div>
                              
                            </div>
                        </div>
                      @else
                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_$i' ? 'selected_border' : '' }}">
                                {{-- <a href="{{ url('download-resume-template/temp-1') }}" target="_blank"> --}}
                                  @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                    <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_{{$i}}">
                                  @endif
                                    <figure class="text-center">
                                        <figcaption class="text-center mb-3"> 

                                          <span class="temp_name">

                                            Template {{$inc}}
                                            <label class="fulltime selected_check">
                                              {{-- <i class="fa fa-check"></i> --}}
                                              @if(auth()->user()->package_id != '0' && 
                                              auth()->user()->package_id != '7' && 
                                              auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            @endif
                                            
                                            </label> 

                                          </span>
                                          
                                          <div class="clear"></div>
                                          
                                        </figcaption>
                                        
                                        <img src="{{ asset('resumes/template-'.$i.'.png') }}" alt="" class="w-100">
                                    </figure>
                                    @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                    {{-- @if( 1==1 ) --}}
      
                                      </a>
                                    @endif
                                <div class="download-btn">
                                  @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                    <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Download Resume
                                  </a>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item my-1" href="{{ url('download-resume') . '?format=pdf&temp_id='.base64_encode("$i") }}" data-turbolinks="false">PDF</a>
                                      <a class="dropdown-item my-1" href="{{ url('download-resume') . '?format=docx&temp_id='.base64_encode("$i") }}" data-turbolinks="false">Word</a>
                                  </div>
                                  
                                  @else
                                    <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                  @endif
                                </div>
                            </div>
                        </div>
                      @endif
                      @php
                        $inc++;
                      @endphp
                    @endfor
                        {{-- <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_2' ? 'selected_border' : '' }}">
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_2">
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 
                                        <span class="temp_name">
                                          Template 2
                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_2' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>

                                        <div class="clear"></div>

                                      </figcaption>
                                        <img src="{{ asset('resumes/template-2.png') }}" alt="" class="w-100">
                                    </figure>
                                </a>

                                <div class="download-btn">
                                  @if(auth()->user()->is_resume == '1' )
                                    <a href="{{ url('download-resume') . '?temp_id='.base64_encode("2") }}" data-turbolinks="false">Download Resume</a>
                                  @else
                                    <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                  @endif
                                </div>
                            </div>
                        </div> --}}
                 <!--       <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_3' ? 'selected_border' : '' }}">
                                {{-- <a href="{{ url('download-resume-template/temp-3') }}" target="_blank"> --}}
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_3">
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 
                                        <span class="temp_name">
                                          Template 2
                                          
                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_3' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>

                                        <div class="clear"></div>
                                        
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-3.png') }}" alt="" class="w-100">
                                    </figure>
                                </a>

                                <div class="download-btn">
                                  @if(auth()->user()->is_resume == '1' )
                                    <a href="{{ url('download-resume') . '?temp_id='.base64_encode("3") }}" data-turbolinks="false">Download Resume</a>
                                  @else
                                    <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                  @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_4' ? 'selected_border' : '' }}">
                                

                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}
                              
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_4">
                              @endif
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 

                                        <span class="temp_name">
                                          Template 3
                                          


                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_4' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>

                                        <span class="premium_badge">
                                          <span class="fulltime">
                                            @if(auth()->user()->package_id != '0' && 
                                              auth()->user()->package_id != '7' && 
                                              auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            @endif

                                          </span>
                                        </span>

                                        <div class="clear"></div>
                                        
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-4.png') }}" alt="" class="w-100">
                                    </figure>
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}

                                </a>
                              @endif

                              <div class="download-btn">
                                @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                  <a href="{{ url('download-resume') . '?temp_id='.base64_encode("4") }}" data-turbolinks="false">Download Resume</a>
                                @else
                                  <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                @endif
                              </div>

                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_5' ? 'selected_border' : '' }}">
                                

                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}
                              
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_5">
                              @endif
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 

                                        <span class="temp_name">
                                          Template 4
                                          


                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_5' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>

                                        <span class="premium_badge">
                                          <span class="fulltime">
                                            @if(auth()->user()->package_id != '0' && 
                                            auth()->user()->package_id != '7' && 
                                            auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                          <i class="fa fa-unlock" aria-hidden="true"></i>
                                          @else
                                          <i class="fa fa-lock" aria-hidden="true"></i>
                                          @endif
                                          </span>
                                        </span>

                                        <div class="clear"></div>
                                        
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-5.png') }}" alt="" class="w-100">
                                    </figure>
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}

                                </a>
                              @endif

                              <div class="download-btn">
                                @if(auth()->user()->package_id != '0' && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                  <a href="{{ url('download-resume') . '?temp_id='.base64_encode("5") }}" data-turbolinks="false">Download Resume</a>
                                @else
                                  <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                @endif
                              </div>

                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_6' ? 'selected_border' : '' }}">
                                

                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}
                              
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_6">
                              @endif
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 

                                        <span class="temp_name">
                                          Template 5
                                          


                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_6' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>

                                        <span class="premium_badge">
                                          <span class="fulltime">
                                            @if(auth()->user()->package_id != '0' && 
                                            auth()->user()->package_id != '7' && 
                                            auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                          <i class="fa fa-unlock" aria-hidden="true"></i>
                                          @else
                                          <i class="fa fa-lock" aria-hidden="true"></i>
                                          @endif
                                          </span>
                                        </span>

                                        <div class="clear"></div>
                                        
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-6.png') }}" alt="" class="w-100">
                                    </figure>
                              @if(auth()->user()->package_id != '0' && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}

                                </a>
                              @endif

                              <div class="download-btn">
                                @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                  <a href="{{ url('download-resume') . '?temp_id='.base64_encode("6") }}" data-turbolinks="false">Download Resume</a>
                                @else
                                  <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                @endif
                              </div>

                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_7' ? 'selected_border' : '' }}">
                                

                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}
                              
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_7">
                              @endif
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 

                                        <span class="temp_name">
                                          Template 6
                                          


                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_7' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>

                                        <span class="premium_badge">
                                          <span class="fulltime">
                                            @if(auth()->user()->package_id != '0' && 
                                            auth()->user()->package_id != '7' && 
                                            auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                          <i class="fa fa-unlock" aria-hidden="true"></i>
                                          @else
                                          <i class="fa fa-lock" aria-hidden="true"></i>
                                          @endif
                                          </span>
                                        </span>

                                        <div class="clear"></div>
                                        
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-7.png') }}" alt="" class="w-100">
                                    </figure>
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}

                                </a>
                              @endif

                              <div class="download-btn">
                                @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                  <a href="{{ url('download-resume') . '?temp_id='.base64_encode("7") }}" data-turbolinks="false">Download Resume</a>
                                @else
                                  <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                @endif
                              </div>

                            </div>
                        </div>


                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_8' ? 'selected_border' : '' }}">
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}  
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_8">
                              @endif
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 
                                       <span class="temp_name">
                                          Template 7
                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_8' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>
                                      <span class="premium_badge">
                                          <span class="fulltime">
                                            @if(auth()->user()->package_id != '0' && 
                                              auth()->user()->package_id != '7' && 
                                              auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            @endif
                                          </span>
                                        </span>
                                        <div class="clear"></div>                              
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-8.png') }}" alt="" class="w-100">
                                    </figure>
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}
                                </a>
                              @endif
                              <div class="download-btn">
                                @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                  <a href="{{ url('download-resume') . '?temp_id='.base64_encode("8") }}" data-turbolinks="false">Download Resume</a>
                                @else
                                  <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                @endif
                              </div>

                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 mb-4">
                          <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_9' ? 'selected_border' : '' }}">
                            @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                            {{-- @if( 1==1 ) --}}  
                              <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_9">
                             @endif
                                  <figure class="text-center">
                                    <figcaption class="text-center mb-3"> 
                                     <span class="temp_name">
                                        Template 8
                                        <label class="fulltime selected_check {{ $user->resume_temp == 'temp_9' ? 'd-inline-block' : 'd-none' }}">
                                          <i class="fa fa-check"></i>
                                        </label> 
                                      </span>
                                    <span class="premium_badge">
                                        <span class="fulltime">
                                          @if(auth()->user()->package_id != '0' && 
                                            auth()->user()->package_id != '7' && 
                                            auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                          <i class="fa fa-unlock" aria-hidden="true"></i>
                                          @else
                                          <i class="fa fa-lock" aria-hidden="true"></i>
                                          @endif
                                        </span>
                                      </span>
                                      <div class="clear"></div>                              
                                    </figcaption>
                                      <img src="{{ asset('resumes/template-10.png') }}" alt="" class="w-100">
                                  </figure>
                            @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                            {{-- @if( 1==1 ) --}}
                              </a>
                            @endif
                            <div class="download-btn">
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                <a href="{{ url('download-resume') . '?temp_id='.base64_encode("9") }}" data-turbolinks="false">Download Resume</a>
                              @else
                                <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                              @endif
                            </div>

                          </div>
                      </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-4">

                          <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_11' ? 'selected_border' : '' }}">
                            @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                            {{-- @if( 1==1 ) --}}  
                              <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_11">
                            @endif
                                  <figure class="text-center">
                                    <figcaption class="text-center mb-3"> 
                                    <span class="temp_name">
                                        Template 9
                                        <label class="fulltime selected_check {{ $user->resume_temp == 'temp_11' ? 'd-inline-block' : 'd-none' }}">
                                          <i class="fa fa-check"></i>
                                        </label> 
                                      </span>
                                    <span class="premium_badge">
                                        <span class="fulltime">
                                          @if(auth()->user()->package_id != '0' && 
                                            auth()->user()->package_id != '7' && 
                                            auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                          <i class="fa fa-unlock" aria-hidden="true"></i>
                                          @else
                                          <i class="fa fa-lock" aria-hidden="true"></i>
                                          @endif
                                        </span>
                                      </span>
                                      <div class="clear"></div>                              
                                    </figcaption>
                                      <img src="{{ asset('resumes/template-11.png') }}" alt="" class="w-100">
                                  </figure>
                            @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                            {{-- @if( 1==1 ) --}}
                              </a>
                            @endif
                            <div class="download-btn">
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                <a href="{{ url('download-resume') . '?temp_id='.base64_encode("11") }}" data-turbolinks="false">Download Resume</a>
                              @else
                                <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                              @endif
                            </div>

                          </div>
                        </div>
                          <div class="col-12 col-sm-6 col-md-4 mb-4">
                            <div class="cv-template p-3 border {{ $user->resume_temp == 'temp_12' ? 'selected_border' : '' }}">
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}  
                                <a href="javascript:;" class="set-resume-template get-temp" data-get-temp="temp_12">
                              @endif
                                    <figure class="text-center">
                                      <figcaption class="text-center mb-3"> 
                                      <span class="temp_name">
                                          Template 10
                                          <label class="fulltime selected_check {{ $user->resume_temp == 'temp_12' ? 'd-inline-block' : 'd-none' }}">
                                            <i class="fa fa-check"></i>
                                          </label> 
                                        </span>
                                      <span class="premium_badge">
                                          <span class="fulltime">
                                            @if(auth()->user()->package_id != '0' && 
                                              auth()->user()->package_id != '7' && 
                                              auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())))
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                            @endif
                                          </span>
                                        </span>
                                        <div class="clear"></div>                              
                                      </figcaption>
                                        <img src="{{ asset('resumes/template-12.png') }}" alt="" class="w-100">
                                    </figure>
                              @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                              {{-- @if( 1==1 ) --}}
                                </a>
                              @endif
                              <div class="download-btn">
                                @if(auth()->user()->package_id != '0'  && auth()->user()->package_id != '7' && auth()->user()->package_end_date >= date('Y-m-d h:i:s', strtotime(now())) )
                                  <a href="{{ url('download-resume') . '?temp_id='.base64_encode("12") }}" data-turbolinks="false">Download Resume</a>
                                @else
                                  <a href="javascript:;" class="disabled-link" disabled>Download Resume</a>
                                @endif
                              </div>

                            </div>
                        </div>
                      -->

                    </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
    <style type="text/css">

        .clear{
          clear: both;
        }
        .disabled-link{
          pointer-events: none;
          color: gray;
          text-decoration: none;
        }
        /* existing resume */
        .searchList li .jobimg {
            width: 100px;
        }

        .searchList li .jobimg img{
            /* max-width: 100%; */
        }


        /* resumes templates */
        /* .cv-template figure{
            height: 320px;
        }
        .cv-template figure img{
            object-fit: cover;
            height: 300px
        } */
        .cv-template figcaption{
            color: #000;
            font-size: 18px;
        }

        .selected_border{
          border: 3px solid green!important;
        }

        /* .fulltime{
          
        } */

        .temp_name{
          float: left;
        }
        .premium_badge{
          float: right;
        }

        .download-btn a{
          background: #0096FF;
          display: block;
          border-radius: 10px;
          width: 100%;
          color: #ffffff;
          text-transform: capitalize;
          padding: 10px 15px;
          text-align: center;
          border: 1px solid #0096FF;
          font-weight: bold;
          letter-spacing: 1px;
        }


    </style>
@endpush
@push('scripts')
@include('includes.immediate_available_btn')
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}

<script>
  $(document).ready(function(){
    
    $('.get-temp').click(function(){
      
      // title = $(this).find('figcaption').text();
      // img = $(this).find('img').attr('src');

      // $('.jobimg').find('img').attr('src', img);
      // $('.jobinfo').find('h3 a').text(title);

      _this = $(this);
      temp_id = _this.attr('data-get-temp');

      $.ajax({
        url: "{{url('set-resume-template')}}",
        method: "post",
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}',
            temp_id: temp_id,
        },
        beforeSend: function(){
          // $('.order_history').css('min-height', '180px');
          $('.cv-template').removeClass('selected_border');
          $('.cv-template').find('.check-label').removeClass('d-inline-block');
          $('.cv-template').find('.check-label').addClass('d-none');
        },
        success: function (response) {
          // console.log(response);

          // reload page only once if resume is first time generated
          if(response == '0'){
            location.reload();
          }else{
            title = _this.find('figcaption').text();
            img = _this.find('img').attr('src');

            $('.jobimg').find('img').attr('src', img);
            $('.jobinfo').find('h3 a').text(title);

            _this.parent('div').addClass('selected_border');
            _this.find('.check-label').addClass('d-inline-block');
          }

        },
        error: function () {
          console.log('fail consol.e')
        }
      });
    })
  });
</script>
@endpush