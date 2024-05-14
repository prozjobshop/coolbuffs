<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-4.css') }}">
</head>
<body>
    <div>
        <div class="bg-1 header">
            <div class="wid-80">
                <div class="pad-1">
                    <div class="m-30">
                        <h1 class="f-30 tw">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h1>
                        <p class="f-20 tw">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</p>
                    </div>

                    <div class="meta-info">
                      <div class="pad-i">
                          @if(isset($user->country) || isset($user->state) || isset($user->city))
                          <div class="wid-50 f-lft pad-i">
                              <i class="fa fa-location-arrow" style="color: #ffffff;"></i>
                              <span class="f-18 tw">
                                <i style="font-family: fontawesome; font-style: normal" class="fa tc">&#xf0ac;</i>
                                {{ $user->city . ', ' . $user->state . ', ' . $user->country }}
                              </span>
                          </div>
                          @endif

                          @isset($user->email)
                          <div class="wid-50 f-rgt pad-i">
                              <i class="fa fa-envelope-o" style="color: #ffffff;"></i>
                              <span class="f-18 tw">
                                <i style="font-family: fontawesome; font-style: normal" class="fa tc">&#xf003;</i>
                                {{ $user->email }}
                              </span>
                          </div>
                          @endisset
                      </div>

                      @isset($user->mobile_num)
                      <div class="" style="margin-top: 10px;">
                          <div class="wid-50 f-lft pad-i">
                              <i class="fa fa-phone" style="color: #ffffff;"></i>
                              <span class="f-18 tw">
                                <i style="font-family: fontawesome;" class="fa tc">&#xf095;</i>
                                {{ $user->mobile_num }}
                              </span>
                          </div>
                      </div>
                      @endisset
                    </div>
                </div>
            </div>
            <div class="wid-20 profile_img">
              <?php
                if(Auth::user()->image){
                  $user_imgg = 'user_images/'.Auth::user()->image;
                }else{
                  $user_imgg = 'resumes/user-sqq.png';
                }
              ?>
              <img class="img-tag" src="{{ public_path($user_imgg) }}" alt="Profile Image">
            </div>
        </div>
    </div>
    <div>
        <div class="wid-50 f-lft">
            <div class="pad-1 pad-t">

                @if($user->getProfileSummary('summary'))
                <div class="summary">
                  <hr>
                  <p class="txt-c"><b>PROFILE SUMMARY</b></p>
                  <hr>
                  {{-- <p class="font-sm description">Passionate Network Engineer The Animal Rescue League of Iowa cares for thousands of pets each year. Our
                      programs include pet adoption, humane education, pet behavior training, and much more. Volunteers
                      Welcome. Promote Animal Welfare. Community Outreach. Pet Helpline & Resources. 
                  </p> --}}
                  <p class="font-sm description">{{$user->getProfileSummary('summary')}}</p>
                </div>
                @endif



                @if(count($user_experience) > 0)
                <div class="experiences">
                  <hr>
                  <p class="txt-c"><b>WORK EXPERIENCE</b></p>
                  <hr>

                  @foreach($user_experience as $user_exp)
                  <div class="experience">
                    <p class="font-sm mb-5"><b>{{ $user_exp->company . ' - ' . $user_exp->city_name }}</b></p>
                    <p class="font-sm mb-5"><b>
                      {{ $user_exp->title }}
                      {{-- {{ $user_exp->title . ' - ' . date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }} --}}
                      {{ date('d M, Y', strtotime($user_exp->date_start)) }}
                            {{-- . date('d M, Y', strtotime($user_exp->date_end) --}}
                      @if($user_exp->date_end)
                      - {{ date('d M, Y', strtotime($user_exp->date_end)) }}
                      @else
                      - Currently Working
                      @endif

                      @php                      
                      
                      $total_years = 0;
                      $total_months = 0;

                      $start_date = $user_exp->date_start;
                      $end_date = $user_exp->date_end != null ? $user_exp->date_end : \Carbon\Carbon::now();

                      $start = \Carbon\Carbon::parse($start_date);
                      $end = \Carbon\Carbon::parse($end_date);
                      
                      $years = $end->diffInYears($start);
                      $months = $end->diffInMonths($start) % 12;

                      $total_years += $years;
                      $total_months += $months;

                      // comment below if only to calculate without next month - 1 day based logic
                      if ($end->day >= $start->day) {
                        $total_months += 1;
                      }
                    
                      $total_years += intdiv($total_months, 12);
                      $total_months %= 12;

                    @endphp
                    @if($total_years || $total_months)
                    {{-- <div class="m-10"> --}}
                     
                        - 
                    @if($total_years == 1)
                    {{ $total_years }}
                    @if($total_months)
                      {{ '.' . $total_months . ' Year' }}
                    @endif
                  @elseif($total_years > 1)
                    {{ $total_years }}
                    @if($total_months)
                      {{ '.' . $total_months . ' Years' }}
                    @endif                            


                  @else
                    @if($total_months == 1)
                      {{ $total_months . ' Month'  }}
                    @else
                      {{ $total_months . ' Months'  }}
                    @endif
                  @endif
                      
                    {{-- </div> --}}
                    @endif
                    </b></p>

                    

                    {{-- <ul>
                        <li class="font-sm"> Learn how you can support us. Get involved, help sanctuaries!.</li>
                        <li class="font-sm">Learn how you can support us. Get involved, help Learn </li>
                        <li class="font-sm">how you can support us. Get involved, help sanctuaries!</li>
                    </ul> --}}

                    <p class="font-sm">{{$user_exp->description}}</p>
                  </div>
                  @endforeach

                  {{-- <div class="experience">
                    <p class="font-sm"><b>COMPUTERS, Dubai-UAE,</b></p>
                    <p class="font-sm"><b>Network Engineer (Mar 2019 - Feb 2021)</b></p>
                    <ul>
                        <li class="font-sm"> Learn how you can support us. Get involved, help sanctuaries!.</li>
                        <li class="font-sm">Learn how you can support us. Get involved, help Learn </li>
                        <li class="font-sm">how you can support us. Get involved, help sanctuaries!</li>
                        <li class="font-sm">Learn how you can support us. Get involved, help Learn </li>
                        <li class="font-sm">how you can support us. Get involved, help sanctuaries!</li>
                    </ul>
                  </div> --}}
{{-- 
                  <div class="experience">
                    <p><b>NETWORK BULLS, Gurgaon- India,</b></p>
                    <p><b>Network Engineer Trainee (April 2018 - Oct 2019) </b></p>
                    <ul class="m-150">
                        <li>Configuration & Troublehooting of Cisco Routers and Switches.</li>
                        <li>Configuration & Troubleshooting of Paloalto & Cisco ASA Firewalls.</li>
                        <li>Troubleshooting of Cisco ISE & WSA </li>
                    </ul>
                  </div> --}}
                </div>
                @endif


                @if(count($user_projects) > 0)
                <div class="experiences">
                  <hr>
                  <p class="txt-c"><b>PROJECTS</b></p>
                  <hr>

                  @foreach($user_projects as $project)
                  <div class="experience">
                    <p class="font-sm mb-5"><b>{{ $project->name }}</b></p>
                    <p class="font-sm mb-5"><b>{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</b></p>
                    <p class="font-sm">{{$project->description}}</p>
                  </div>
                  @endforeach
                </div>
                @endif

                {{-- <span class="test-border badge-float">ok</span>
                <span class="test-border badge-float">ok karo</span> --}}

                {{-- <div class="certificates">
                  <hr>
                  <p class="txt-c"><b>CERTIFICATIONS</b></p>
                  <hr>
                  <div>
                      <p class="txt bg-2 tw">CCIE Security #63423</p>
                      <p class="txt bg-2 tw">CCNA</p>
                      <p class="txt bg-2 tw">Paloalto ACE</p>
                  </div>
                </div> --}}


            </div>
        </div>
        <div class="wid-50 f-rgt">
            <div class="pad-2 pad-t">

                {{-- personal details --}}
                @if(
                  isset($user->father_name) || 
                  isset($user->date_of_birth) || 
                  isset($user->gender_id) ||
                  isset($user->marital_status_id) ||
                  isset($user->nationality_id) ||
                  isset($user->national_id_card_number) ||
                  isset($user->phone) ||
                  isset($user->job_experience) ||
                  isset($user->industry) ||
                  isset($user->functional_area) ||
                  isset($user->current_salary) ||
                  isset($user->expected_salary) ||
                  isset($user->salary_currency) ||
                  isset($user->street_address) ||
                  isset($user->video_link)
                  )
                <div class="personal_details">
                  <hr>
                  <p class="txt-c"><b>PERSONAL DETAILS</b></p>
                  <hr>

                  @isset($user->father_name)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Father Name</b></p>
                    <p class="font-sm font-left pd_head">{{ $user->father_name }}</p>
                  </div>
                  @endisset
                  @isset($user->date_of_birth)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Date of Birth</b></p>
                    <p class="font-sm font-left pd_head">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p>
                  </div>
                  @endisset
                  @isset($user->gender_id)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Gender</p>
                    <p class="font-sm font-left pd_head">{{ $user->gender }}</p>
                  </div>
                  @endisset
                  @isset($user->marital_status)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Marital Status</p>
                    <p class="font-sm font-left pd_head">{{ $user->marital_status }}</p>
                  </div>
                  @endisset
                  @isset($user->nationality)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Nationality</p>
                    <p class="font-sm font-left pd_head">{{ $user->nationality }}</p>
                  </div>
                  @endisset
                  {{-- @isset($user->national_id_card_number)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>National ID</p>
                    <p class="font-sm font-left pd_head">{{ $user->national_id_card_number }}</p>
                  </div>
                  @endisset
                  @isset($user->phone)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Phone</p>
                    <p class="font-sm font-left pd_head">{{ $user->phone }}</p>
                  </div>
                  @endisset --}}
                  @isset($user->job_experience)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Job Experience</p>
                    <p class="font-sm font-left pd_head">{{ $user->job_experience }}</p>
                  </div>
                  @endisset
                  @isset($user->industry)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Industry</p>
                    <p class="font-sm font-left pd_head">{{ $user->industry }}</p>
                  </div>
                  @endisset
                  @isset($user->functional_area)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Functional Area</p>
                    <p class="font-sm font-left pd_head">{{ $user->functional_area }}</p>
                  </div>
                  @endisset
                  {{-- @isset($user->current_salary)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Current Salary</p>
                    <p class="font-sm font-left pd_head">{{ $user->current_salary }}</p>
                  </div>
                  @endisset
                  @isset($user->expected_salary)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Expected Salary</p>
                    <p class="font-sm font-left pd_head">{{ $user->expected_salary }}</p>
                  </div>
                  @endisset
                  @isset($user->salary_currency)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Salary Currency</p>
                    <p class="font-sm font-left pd_head">{{ $user->salary_currency }}</p>
                  </div>
                  @endisset
                  @isset($user->street_address)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Street Address</p>
                    <p class="font-sm font-left pd_head">{{ $user->street_address }}</p>
                  </div>
                  @endisset --}}
                  @isset($user->video_link)
                  <div class="personal_detail">
                    <p class="font-sm pd_head"><b>Video Profile</p>
                    <p class="font-sm font-left pd_head">{{ $user->video_link }}</p>
                  </div>
                  @endisset
                  
                  

                  <div class="clear"></div>

                </div>
                @endif
                



                @if(count($user_educations) > 0)
                <div class="educations">
                  <hr>
                  <p class="txt-c"><b>EDUCATION</b></p>
                  <hr>

                  @foreach($user_educations as $user_edu)
                  <div class="education">
                    <p class="font-sm"><b>{{ $user_edu->institution }}</b></p>
                    <p class="font-sm"><b>{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</b></p>
                    <p class="font-sm">{{ $user_edu->date_completion . ' | ' . $user_edu->city }}</p>
                  </div>
                  @endforeach

                  {{-- <div class="education">
                    <p class="font-sm"><b>D.D.D.D.D, CBSE</b></p>
                    <p class="font-sm">2011 – 2018 | Nagar, India</p>
                  </div> --}}


                </div>
                @endif


                @if(count($user_skills) > 0)
                <div class="skills">
                  <hr>
                  <p class="txt-c"><b>TECHNICAL SKILLS</b></p>
                  <hr>

                  @foreach($user_skills as $user_skill)
                  <div class="skill">
                    <p class="font-sm"><b>{{ $user_skill->job_skill}}</b></p>
                    <hr>
                    <p class="font-sm"><b>{{ $user_skill->job_experience}}</b></p>
                  </div>
                  @endforeach


                  {{-- <div class="skill">
                    <p class="font-sm"><b>F5-LTM</b></p>
                    <ul>
                        <li class="font-sm">Blocking Preventing Threats & Viruses using</li>
                        <li class="font-sm">CONTENT- Vulnerability Protection</li>
                        <li class="font-sm">Configuring High Availability. Configuring</li>
                        <li class="font-sm">Remote</li>
                        <li class="font-sm">Authenticating</li>
                        <li class="font-sm">Configuring Availability</li>
                        <li class="font-sm">Backup, Restore & Firmware Upgrades</li>
                        <li class="font-sm">Configuring Availability</li>
                    </ul>
                  </div> --}}

{{-- 
                  <div class="skill">
                    <p class="font-sm"><b>Cisco ISE</b></p>
                    <ul>
                        <li class="font-sm">Dot1x and MAB Authentication & Authorization. </li>
                        <li class="font-sm">Configuring Guest Portals.</li>
                        <li class="font-sm">ISE Profiling</li>
                        <li class="font-sm">Configuring RIP</li>
                        <li class="font-sm">Implementing</li>
                        <li class="font-sm">L2 flooding using Port Security Feature</li>
                    </ul>
                  </div> --}}
                  
                </div>
                @endif


                {{-- <p class=""><b>Cisco</b></p>
                <ul>
                    <li>Configuring</li>
                    <li>Configuring</li>
                    <li>Configuring</li>
                    <li>Configuring</li>
                </ul>
                <p class=""><b>F5-LTM</b></p>
                <ul>
                    <li>Bloc.king Preventing Threats & Viruses using </li>
                    <li>CONTENT- Vulnerability Protection.</li>
                    <li>Configuring High Availability. Configuring </li>
                    <li>Remote</li>
                    <li>Authenticating</li>
                    <li>Configuring Availability.</li>
                </ul>
                <p class=""><b>Cisco ISE</b></p>
                <ul>
                    <li>Dot1x and MAB Authentication & Authorization.</li>
                    <li>Configuring Guest Portals.</li>
                    <li>ISE Profiling.</li>
                </ul>
                <p class=""><b>Routing & Switching</b></p>
                <ul>
                    <li>Configuring RIP</li>
                    <li>Implementing.</li>
                    <li>Configuring </li>
                    <li>Configuring Inter-</li>
                    <li>Configuring </li>
                    <li>L2 flooding using Port Security Feature.</li>
                </ul>
                <p class=""><b>Other Skills/Knowledge</b></p>
                <ul class="m-50">
                    <li>Basic Knowledge Abc</li>
                    <li>Understanding Abc.</li>
                    <li>General overview of application</li>
                    <li>Fundamentals of cloud.</li>
                </ul> --}}

                @if(count($user_languages) > 0)
                  <hr>
                  <p class="txt-c"><b>LANGUAGES</b></p>
                  <hr style="margin-bottom: 10px;">

                  @foreach($user_languages as $user_language)
                    <span>{{ $user_language->lang }} | </span>  
                  @endforeach
                
                @endif


            </div>
        </div>
    </div>
</body>
</html>