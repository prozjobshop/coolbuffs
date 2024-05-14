<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-6.css') }}">

    <style>
      .test-borde{
        margin: 2px 0;
      }
    </style>
</head>

<body>

  <div class="header">
    <div class="pad-1 " style="padding-top: 20px"> 
        @isset($user->name)
        <h1 class="f-50 mb0 mt0">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h1>
        @endisset
        <p class="f-18 mt0 txt-clr f-b">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</p>
    </div>    

    <div>
      <div class="pad-1 mt-3 " style="margin-top: -9px">
          @isset($user->email)
          <div class="wid-40 pt-5">
          <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf0e0;</i>
            <span class="f-14 mb0 mt0">{{ $user->email }}</span>
          </div>
          @endisset

          @isset($user->mobile_num)
          <div class="wid-30-1">
            <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf095;</i>
            <span class="f-14 mb0 mt0">{{ $user->mobile_num }}</span>
          </div>
          @endisset

          @if(isset($user->country) || isset($user->state) || isset($user->city))
          <div class="wid-30-1">
            <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf041;</i>
            <span class="f-14 mb0 mt0">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</span>
          </div>
          @endif

      </div>
    </div>
  </div>


  <div class="main">
    <div class="wid-70">

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
        <div class="experiences personal_details pad-1">
            <h1 class="mb0 f-20">PERSONAL DETAILS</h1>
            <hr class="mt0">


            @isset($user->father_name)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">Father Name :</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->father_name }}</span>
                </div>
              </div>
            @endisset
            @isset($user->date_of_birth)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">Date of Birth :</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</span>
                </div>
              </div>
            @endisset
            @isset($user->gender_id)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">Gender</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->gender }}</span>
                </div>
              </div>
            @endisset
            @isset($user->marital_status)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Marital Status : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->marital_status }}</span>
                </div>
              </div>
            @endisset
            @isset($user->nationality)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Nationality : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->nationality }}</span>
                </div>
              </div>
            @endisset
            {{-- @isset($user->national_id_card_number)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'National ID : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->national_id_card_number }}</span>
                </div>
              </div>
            @endisset
            @isset($user->phone)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Phone : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->phone }}</span>
                </div>
              </div>
            @endisset --}}
            @isset($user->job_experience)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Job Experience : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->job_experience }}</span>
                </div>
              </div>
            @endisset
            @isset($user->industry)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Industry : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->industry }}</span>
                </div>
              </div>
            @endisset
            @isset($user->functional_area)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Functional Area : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->functional_area }}</span>
                </div>
              </div>
            @endisset
            {{-- @isset($user->current_salary)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Current Salary : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->current_salary }}</span>
                </div>
              </div>
            @endisset
            @isset($user->expected_salary)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Expected Salary : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->expected_salary }}</span>
                </div>
              </div>
            @endisset
            @isset($user->salary_currency)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Salary Currency : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->salary_currency }}</span>
                </div>
              </div>
            @endisset
            @isset($user->street_address)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Street Address : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->street_address }}</span>
                </div>
              </div>
            @endisset --}}
            @isset($user->video_link)
              <div class="experience">
                <div class="wid-50 f-left  test-borde">
                  <span class="f-14 mb0 mt0">{{ 'Video Profile : ' }}</span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <span class="f-14 mb0 mt0">{{ $user->video_link }}</span>
                </div>
              </div>
            @endisset
        </div>
        @endif


        @if(count($user_experience) > 0)
        <div class="experiences pad-1">
            <h1 class="mb0 f-20">WORK EXPERIENCE</h1>
            <hr class="mt0">

            @foreach($user_experience as $user_exp)
              <div class="experience">
                <p class="f-18 m-5">{{ $user_exp->title }}</p>
                <p class="txt-clr fw-t f-b mb0 mt0 ">{{ $user_exp->company }}</p>

                <div class="wid-50 f-left  test-borde">
                  {{-- <i class="fa fa-2x fa-calendar" style="color: #CCCCCC;"></i> --}}
                  <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf073;</i>
                  <span class="f-14 mb0 mt0">
                    {{-- {{ date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }} --}}
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
                {{-- <div class=""> --}}
                  {{-- <p class="font-sm mb-5"> --}}
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
                  {{-- </span> --}}
                {{-- </div> --}}
                @endif
                  </span>
                </div>

                <div class="wid-50 f-left tc test-borde">
                  <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf041;</i>
                  <span class="f-14 mb0 mt0">{{ $user_exp->city_name }}</span>
                </div>


                
                
                <p class="f-14">{{$user_exp->description}}</p>
                {{-- <ul>
                    <li>Developed and optimized a Microsoft Oﬃce Suite feature with JavaScript to increase user eﬃciency by 15%.
                    </li>
                    <li>Implemented a microservice architecture for a cloud-based product, increasing system reliability and
                        <b><i>reducing deployment time by 16%.</i></b> </li>
                    <li>Spearheaded the redesigning of a key Windows OS component to see improved boot time by 29%.</li>
                    <li>Led the migration of a critical application from on-premise to Azure cloud infrastructure, reducing
                        operational costs by 32%. </li>
                    <li>Implemented a CI/CD pipeline for a key product, reducing release cycle times by 26%.</li>
                </ul> --}}
              </div>
            @endforeach
        </div>
        @endif


        @if(count($user_projects) > 0)
        <div class="experiences pad-1">
            <h1 class="mb0 f-20">PROJECTS</h1>
            <hr class="mt0">


            @foreach($user_projects as $project)
              <div class="experience">
                <div class="p-wid-70">
                  <p class="f-18 m-5">{{ $project->name }}</p>
                  <p class="f-14 mb mt0 txt-clr">
                    <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf0ac;</i>
                    {{ $project->url }}
                  </p>
                </div>
                
                <div class="p-wid-30 pt-10">
                  <span class="f-14 mb0 mt0">{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</span>
                </div>

                <div class="clear"></div>
                
                <p class="mt0 f-14">{{$project->description}}</p>
              </div>
            @endforeach           

        </div>
        @endif

    </div>

    
    <div class="wid-30">
        <div class="pad-2">

          @if(count($user_educations) > 0)
          <div class="educations">
            <h1 class="mb0 f-20">EDUCATION</h1>
            <hr class="mt0">

            @foreach($user_educations as $user_edu)
              <div class="education">
                <p class="mt0 mb0 f-14">{{ $user_edu->institution }}</p>
                {{-- <p class="mb0 mt0 f-14">Computer Science & Engineering</p> --}}
                <p class="fw-t txt-clr mt0 mb0 f-b">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</p>
                <div>
                  <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC;" class="fa tc">&#xf073;</i>
                  <span class="f-14 mb0 mt0">{{ $user_edu->date_completion }}</span>
                </div>
                <div>
                  <i style="font-family: fontawesome; font-style: normal;color: #CCCCCC; font-size: 20px;" class="fa tc">&#xf041;</i>
                  <span class="f-14 mb0 mt0">{{ $user_edu->city }}</span>
                </div>
              </div>
            @endforeach

          </div>
          @endif


          @if(count($user_skills) > 0)
          <div class="skills">
            <h1 class="mb0 f-20">SKILLS</h1>
            <hr class="mt0">

            <ul>
              @foreach($user_skills as $user_skill)
                <li>{{ $user_skill->job_skill}} - <span class="f-14 f-b txt-clr">{{ $user_skill->job_experience}}</span></li>
              @endforeach
            </ul>

          </div>
          @endif


          @if(count($user_languages) > 0)
          <div class="languages">
            <h1 class="mb0 f-20">LANGUAGES</h1>
            <hr class="mt0">
            <ul>
              @foreach($user_languages as $user_language)
                <li>{{ $user_language->lang }} - <span class="f-14 f-b txt-clr">{{ $user_language->lang }}</span></li>
              @endforeach
            </ul>
          </div>
          @endif


        </div>
    </div>
    </div>
</body>
</html>