<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-11.css') }}">
</head>

<body>
<div class="wid-100">
    <div class="wid-70">
        <div class="pad-1">
            <h1 class="f-50 mb0 heading" style="font-family: sans-serif">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h1>
            <p class="f-20 mt0 txt-clr">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</p>
            <div class="">
                <div class=" ">
                    
                    @isset($user->mobile_num)
                    <div class="wid-30-1">
                        <i style="font-family: fontawesome; color:#CCCCCC" class="fa tc f-18">&#xf095;</i>
                        <span class="f-10 mb0 mt0">{{ $user->mobile_num }} </span>
                    </div>
                    @endisset
                    
                    @isset($user->email)
                    <div class="wid-40">
                        <i style="font-family: fontawesome; color:#CCCCCC" class="fa tc f-18">&#xf003;</i>
                        <span class="f-10 mb0 mt0"> {{ $user->email }}</span>
                    </div>
                    @endisset
                    @if(isset($user->country) || isset($user->state) || isset($user->city))
                    <div class="wid-30-1">
                        <i style="font-family: fontawesome; color:#CCCCCC" class="fa tc f-18">&#xf124;</i>
                        <span class="f-10 mb0 mt0">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</span>
                    </div>
                    @endif
                </div>
            </div>
            <div class="pad-y">
                
                @if($user->getProfileSummary('summary'))
                    <h1 class="mb0 heading">SUMMARY</h1>
                    <hr class="bk">
                    <p class="f-12" style="margin: 0; padding:0; text-align:justify">{{$user->getProfileSummary('summary')}}</p>
                @endif
                @if(count($user_experience)>0)
                    <h1 class="mb0 heading" style="margin-top:50px">WORK EXPERIENCE</h1>
                    <hr>
                    
                    @foreach($user_experience as $user_exp)
                    <div class="f-14">
                        <div class="wid-50 f-left tc" style"width: 50%;">
                            <p class="f-12">{{$user_exp->title}}</p>
                        </div>
                        <div class="wid-50 f-right-1 tc" style"width: 60%;">
                            <p class="f-12">
                              {{-- {{date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end))}} --}}
                              {{ 'From ' . date('d M, Y', strtotime($user_exp->date_start)) . ' - ' }}
                              {{-- . date('d M, Y', strtotime($user_exp->date_end) --}}
                              @if($user_exp->date_end)
                              {{ date('d M, Y', strtotime($user_exp->date_end)) }}
                              @else
                              Currently Working
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
                              @endif
                            </p>
                        </div>
                    </div>

                  

                    <div class="f-14">
                        <div class="wid-50 f-left tc">
                            <p class="txt-clr f-12">{{$user_exp->company}} </p>
                        </div>
                        <div class="wid-50 f-right-1 tc">
                            <p class="f-12">{{$user_exp->city_name}}</p>
                        </div>
                    </div>
                    <p class="f-12" style="text-align: justify">
                        {{$user_exp->description}}
                    </p>
                    @endforeach
                @endif
                @if (count($user_educations)>0)
                    
                <h1 class="mb0 heading education-heading">EDUCATION </h1>
                <hr>
                
                    @foreach($user_educations as $user_edu)
                    <p class=" mb-0 f-12">{{ $user_edu->degree_level . ' | ' . $user_edu->degree_type }}</p>
                    <div class="m-30 f-12">
                        <div class="wid-50 f-left tc">
                            <p class="txt-clr f-12 "> {{ $user_edu->institution }}</p>
                        </div>
                        <div class="wid-50 f-right-1 tc">
                            <p class="f-12">{{ $user_edu->date_completion }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                
                @endif
            </div>
        </div>
    </div>
    <div class="wid-30" style="margin:0;padding:0;height:100%;">
        <div class="bg " style="height:120%;">
            <div class="" style="padding: 20px">
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
            {{-- Personal Details --}}
            <div class="personal_details">
              <h2 class="mb0 tc tw">Personal Details</h2>
              <hr class="mt0 mb0">


              <div class="m-10 tw">

                @isset($user->father_name)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                      <span class="f-12 exp_meta">Father Name : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->father_name }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->date_of_birth)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Date of Birth : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->gender_id)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Gender : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->gender }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->marital_status)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Marital Status : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->marital_status }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->nationality)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Nationality : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->nationality }}</span>
                    </div>
                </div>
                @endisset
                {{-- @isset($user->national_id_card_number)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Notional ID : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->national_id_card_number }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->phone)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Phone : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->phone }}</span>
                    </div>
                </div>
                @endisset --}}
                @isset($user->job_experience)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Job Experience : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->job_experience }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->industry)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Industry : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->industry }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->functional_area)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Functional Area : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->functional_area }}</span>
                    </div>
                </div>
                @endisset
                {{-- @isset($user->current_salary)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Current Salary : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->current_salary }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->expected_salary)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Expected Salary : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->expected_salary }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->salary_currency)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Salary Currency : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->salary_currency }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->street_address)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Street Address : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->street_address }}</span>
                    </div>
                </div>
                @endisset --}}
                @isset($user->video_link)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-12 exp_meta">Video Profile : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-12 exp_meta">{{ $user->video_link }}</span>
                    </div>
                </div>
                @endisset
              </div>
              
            </div>
            @endif
            @if(count($user_skills) > 0)
                <h1 class="mb0 tw">SKILLS</h1>
                <hr class="wt">
                
                <div class="mb0 tw"> 
                    @foreach($user_skills as $user_skill)
                        {{ $user_skill->job_skill}} | <b> {{ $user_skill->job_experience}}</b><br>
                    @endforeach
                </div>
            @endif

                {{-- <h1 class="mb0 tw">CERTIFICATION</h1>
                <hr class="wt">
                <p class="tw">Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <i class="tw">Systems </i> --}}
                
                @if(count($user_languages) > 0)
                    <h1 class="mb0 tw">LANGUAGES</h1>
                    <hr>
                    <ul>
                        @foreach($user_languages as $user_language)
                            <li class="tw">{{ $user_language->lang }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
    
</body>

</html>
