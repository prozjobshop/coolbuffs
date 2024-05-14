<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-3.css') }}">
</head>
<body>
    <div class="body_name">
        <div class="wid-30 ">
            <div class="p-2">
                <div class="img-container m-50">
                  <?php
                    if(Auth::user()->image){
                      $user_imgg = 'user_images/'.Auth::user()->image;
                    }else{
                      $user_imgg = 'resumes/user-sqq.png';
                    }
                  ?>
                  <img class="img-tag" src="{{ public_path($user_imgg) }}" alt="Profile Image">
                </div>

                <div class="meta-info-div">
                  @isset($user->mobile_num)
                  <div class="m-10">
                    <span class="f-20 meta-info">
                      <i style="font-family: fontawesome;" class="fa tc">&#xf095;</i>
                      &nbsp; {{ $user->mobile_num }}</span>
                  </div>
                  @endisset
                  @isset($user->email)
                  <div class="m-10">
                      <span class="f-20 meta-info">
                        <i style="font-family: fontawesome;" class="fa tc">&#xf003;</i>
                        &nbsp; {{ $user->email }}</span>
                  </div>
                  @endisset
                  @if(isset($user->country) || isset($user->state) || isset($user->city))
                  <div class="m-10">
                      <span class="f-20 meta-info">
                        <i style="font-family: fontawesome;" class="fa tc">&#xf0ac;</i>
                        &nbsp; {{ $user->city . ', ' . $user->state . ', ' . $user->country }}</span>
                  </div>
                  @endif
                </div>
                
                @if(count($user_skills) > 0)
                <!-- Skills -->
                <div class="skills m-30">
                  <h2 class="m-10 tc text-underline">SKILLS & COMPETENCES</h2>

                  @foreach($user_skills as $user_skill)
                    <div class="skill p-1">
                      <p class="mt0 mb0">{{ $user_skill->job_skill}}</p>
                      <hr class="mt0 mb0">
                      <p class="mt0 mb0 tc">{{ $user_skill->job_experience}}</p>
                    </div>
                  @endforeach
                </div>
                @endif


                

                @if(count($user_languages) > 0)
                <!-- Languages -->
                <div class="certificates m-30">
                  <h1 class="m-10 tc text-underline">Languages</h1>

                  @foreach($user_languages as $user_language)
                    <div class="certificate p-1">
                      <p class="mt0 mb0">{{ $user_language->lang}}</p>
                      <p class="tc mt0"><i>{{ $user_language->language_level}}</i></p>
                    </div>
                  @endforeach

                </div>
                @endif

                <!-- Certification -->
                {{-- <div class="certificates m-30">
                  <h1 class="m-10 tc text-underline">CERTIFICATION</h1>

                  <div class="certificate p-1">
                    <p class="mt0 mb0">Frontend Development</p>
                    <p class="tc mt0"><i>Native / Bilingual</i></p>
                  </div>

                  <div class="certificate p-1">
                    <p class="mt0 mb0">MYSQL</p>
                    <p class="tc mt0"><i>Intermediate</i></p>
                  </div>
                </div> --}}




            </div>
        </div>
        <div class="wid-70">
            <div class="bg-1 pad-l">
            <h1 class="mt0 mb0 pt-1 tw f-26">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h1>
            <h3 class=" tw mt0 mb0 f-20">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</h3>
            @if($user->getProfileSummary('summary'))
            <hr style="width: 100%; float: left;"><br>
            <p class="tw mt0 padb" style="padding-right: 15px;"><i>{{$user->getProfileSummary('summary')}}</i></p>
            @endif
            </div>
            <div class="pad">


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
              <h2 class="mb0 tc">Personal Details</h2>
              <hr class="mt0 mb0">


              <div class="m-10">

                @isset($user->father_name)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                      <span class="f-14 exp_meta">Father Name : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->father_name }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->date_of_birth)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Date of Birth : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->gender_id)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Gender : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->gender }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->marital_status)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Marital Status : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->marital_status }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->nationality)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Nationality : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->nationality }}</span>
                    </div>
                </div>
                @endisset
                {{-- @isset($user->national_id_card_number)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Notional ID : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->national_id_card_number }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->phone)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Phone : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->phone }}</span>
                    </div>
                </div>
                @endisset --}}
                @isset($user->job_experience)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Job Experience : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->job_experience }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->industry)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Industry : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->industry }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->functional_area)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Functional Area : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->functional_area }}</span>
                    </div>
                </div>
                @endisset
                {{-- @isset($user->current_salary)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Current Salary : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->current_salary }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->expected_salary)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Expected Salary : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->expected_salary }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->salary_currency)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Salary Currency : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->salary_currency }}</span>
                    </div>
                </div>
                @endisset
                @isset($user->street_address)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Street Address : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->street_address }}</span>
                    </div>
                </div>
                @endisset --}}
                @isset($user->video_link)
                <div class="personal_detail">
                    <div class="wid-50 f-left">
                        <span class="f-14 exp_meta">Video Profile : </span>
                    </div>
                    <div class="wid-50 f-right pd_val">
                      <span class="f-14 exp_meta">{{ $user->video_link }}</span>
                    </div>
                </div>
                @endisset
              </div>
              
            </div>
            @endif

            
            @if(count($user_experience) > 0)
            <!-- WORK EXPERIENCE -->
            <div class="experiences">
              <h2 class="mb0 tc">WORK EXPERIENCE</h2>
              <hr class="mt0 mb0">

              @foreach($user_experience as $user_exp)
              <div class="experience m-10">
                <h6 class="mb0 mt0 tc">{{ $user_exp->title}}</h6>
                <p class="mt0 mb0 f-14">{{ $user_exp->company }}</p>
                <div class="">
                    <div class="wid-50 f-left tc" style="width: 70%">
                        <span class="f-14 exp_meta">
                          {{-- {{ date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }} --}}
                          {{ 'From ' . date('d M, Y', strtotime($user_exp->date_start)) . ' - ' }}
                            {{-- . date('d M, Y', strtotime($user_exp->date_end) --}}
                          @if($user_exp->date_end)
                          {{ date('d M, Y', strtotime($user_exp->date_end)) }}
                          @else
                          Currently Working
                          @endif
                        </span>

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
                        <span class="f-14 exp_meta">
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
                        </span>
                      {{-- </div> --}}
                      @endif
                    </div>
                    <div class="wid-50 f-right tc" style="width: 30%">
                      <span class="f-14 exp_meta">{{ $user_exp->city_name }}</span>
                    </div>

                    
                </div>
                <p class="m-10 mt0 tc1"><i>{{$user_exp->description}}</i></p>
              </div>
              @endforeach
            </div>
            @endif


            @if(count($user_educations) > 0)
            <!-- Education -->
            <div class="educations">
              <h2 class="mb0 tc">EDUCATION</h2>
              <hr class="mt0 mb0">

              @foreach($user_educations as $user_edu)
              <div class="education m-10">
                <h3 class="mb0 mt0 tc">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</h3>
                <p class="mt0 mb0 m-30 f-14">{{ $user_edu->institution }}</p>

                <div class="">
                  <div class="wid-50 f-left tc">
                    <span class="f-14 exp_meta">{{ $user_edu->date_completion }}</span>
                  </div>
                  <div class="wid-50 f-right tc">
                    <span class="f-14 exp_meta">{{ $user_edu->city }}</span>
                  </div>
                </div>

                {{-- <p class="tc mt-10 mb0">CGPI : 7.91</p>
                <p class="mt0">percentage = 80%</p> --}}
              </div>
              @endforeach
            </div>
            @endif

            
            @if(count($user_projects) > 0)
            <!--    Projects -->
            <div class="projects">
              <h2 class="mt0 mb0 tc">PROJECTS</h2>
              <hr class="mt0 mb0">

              @foreach ($user_projects as $project)
              <div class="project">
                <h3 class="mb0 mt0 tc">{{ $project->name }}</h3>
                <p class="mt0 mb0 m-30 f-14">{{ $project->url }}</p>

                <div class="">
                  <div class="wid-50 f-left tc">
                    <span class="f-14 exp_meta">{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</span>
                  </div>
                </div>

                <p class="m-10 mb0 tc1"><i>{{$project->description}}</i></p>

              </div>
              @endforeach
            </div>
            @endif

            <!-- Achivements -->
            {{-- <div class="achivements">
              <h2 class="mt0 mb0 tc">ACHIEVEMENTS</h2>
              <hr class="mt0 mb0">

              <div class="achivement">
                <p class="mt0 mb0">Frontend Development (2015-16)</p>
              </div>
            </div> --}}

            
        </div>
        </div>
    </div>
</body>
</html>