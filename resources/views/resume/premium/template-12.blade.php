
text/x-generic template-6.blade.php ( HTML document, ASCII text )
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-5.css') }}">
</head>
<body>
    <div class=""  style="height: 200px;">
        <div class="pad-1">
            <div class="wid-60  f-lft">
                <div class="">
                    <h2 class="f-26 mt0">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h2>
                    <p class="f-20">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</p>
                    @if($user->getProfileSummary('summary'))
                      <p class="ft">{{$user->getProfileSummary('summary')}}</p>
                    @endif
                </div>
            </div>
            <div class="wid-40 f-rgt">
                @isset($user->email)
                <div class="f-right">
                    <span class="ft" style="color: blue;"><u>{{ $user->email }}</u></span>
                    <i style="font-family: fontawesome; font-style: normal" class="fa tc">&#xf003;</i>
                </div>
                @endisset
                @isset($user->mobile_num)
                <div class="f-right">
                    <span class="ft">{{ $user->mobile_num }}</span>
                    <i style="font-family: fontawesome;" class="fa tc">&#xf095;</i>
                </div>
                @endisset
                @if(isset($user->country) || isset($user->state) || isset($user->city))
                <div class="f-right">
                    <span class="ft">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</span>
                    <i style="font-family: fontawesome; font-style: normal" class="fa tc">&#xf0ac;</i>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="pad-3">
       <hr style="height: 2px; ">
        <div class="wid-50 f-lft">
                <div class=" ">

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
                    <h2 class="mb0 mt0"><b>PERSONAL DETAILS</b></h2>

                    <div class="experience">


                      @isset($user->father_name)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Father Name : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->father_name }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->date_of_birth)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Date of Birth : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ date('d F, Y', strtotime($user->date_of_birth)) }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->gender_id)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Gender : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->gender }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->marital_status)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Marital Status : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->marital_status }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->nationality)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Nationality : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->nationality }}</i>
                          </div>
                      </div>
                      @endisset
                      {{-- @isset($user->national_id_card_number)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>National ID : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->national_id_card_number }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->phone)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Phone : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->phone }}</i>
                          </div>
                      </div>
                      @endisset --}}
                      @isset($user->job_experience)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Job Experience : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->job_experience }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->industry)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Industry : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->industry }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->functional_area)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Functional Area : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->functional_area }}</i>
                          </div>
                      </div>
                      @endisset
                      {{-- @isset($user->current_salary)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Current Salary : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->current_salary }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->expected_salary)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Expected Salary : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->expected_salary }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->salary_currency)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Salary Currency : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->salary_currency }}</i>
                          </div>
                      </div>
                      @endisset
                      @isset($user->street_address)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Street Address : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->street_address }}</i>
                          </div>
                      </div>
                      @endisset --}}
                      @isset($user->video_link)
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>Video Profile : </i>
                          </div>
                          <div class="wid-50 f-right-1 tc">
                              <i>{{ $user->video_link }}</i>
                          </div>
                      </div>
                      @endisset
                      
                    </div>

                  </div>
                  @endif


                  


                  @if(count($user_educations) > 0)
                  <div class="educations">
                    <h2 class="mt0 mb0"><b>EDUCATION</b></h2>

                    @foreach($user_educations as $user_edu)
                      <div class="education">
                        <p class="ft mtb5"><b>{{ $user_edu->institution }}</b></p>
                        <p class="ft mt0 mb0">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</p>
                        <p class="mt0"> <i>{{ $user_edu->date_completion . ' | ' . $user_edu->city }}</i></p>
                      </div>
                    @endforeach
                  </div>
                  @endif

                  @if(count($user_experience) > 0)
                  <div class="experiences">
                    <h2 class="mb0 mt0"><b>WORK EXPERIENCE</b></h2>

                    @foreach($user_experience as $user_exp)
                    <div class="experience">
                      <p class="ft mtb5"><b>{{ $user_exp->title }}</b></p>
                      <p class="ft mt0 mb0">{{ $user_exp->company }}</p>
                      <div class="mt0">
                          <div class="widd-50 f-left tc">
                              <i>
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
                                {{-- <div class="wid-50 f-right-1 tc"> --}}
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
                              </i>
                          </div>

                          

                      </div>

                      <div class="">
                        <i>{{ $user_exp->city_name }}</i>
                      </div>

                      <p class="ft mtb10">{{$user_exp->description}}</p>
                    </div>
                    @endforeach


                  </div>
                  @endif


                  @if(count($user_languages) > 0)
                  <div class="languages">
                    <h2 class="mt0">LANGUAGES</h2>
                    <div>

                      @foreach($user_languages as $user_language)
                      <div class="language">
                            <p class="ft mb0 mt0">{{ $user_language->lang }}</p>
                      </div>
                      @endforeach

                    </div>
                  </div>
                  @endif
                  

                </div>
        </div>
        <div class="wid-50 f-rgt">
            <div class="pad-2" >
                <!-- Skills -->

                @if(count($user_educations) > 0)
                <div class="skills">
                  <h2 class="mb0 mt0 tc">TECHNICAL SKILLS </h2>

                  @foreach($user_skills as $user_skill)
                    <div class="skill">
                      <p class="mb0 mt0 f-20 tc">{{ $user_skill->job_skill}}</p>
                      <hr class="mt0 mb0">
                      <p class="mb0 mt0 f-20 tc">{{ $user_skill->job_experience}}</p>
                    </div>
                  @endforeach

                </div>
                @endif




                @if(count($user_projects) > 0)
                <div class="projects">
                    
                  <h2 class="">PROJECTS</h2>

                  @foreach($user_projects as $project)
                  <div class="project">
                      <p class="ft mtb5"><b>{{ $project->name }}</b></p>
                      {{-- <p class="ft mt0 mb0">https://www.google.com/</p> --}}
                      <div class="mt0">
                          <div class="wid-50 f-left tc">
                              <i>{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</i>
                          </div>
                          {{-- <div class="wid-50 f-right-1 tc">
                              <i>Karachi/Pakistan</i>
                          </div> --}}
                      </div>

                      <p class="ft mtb10">{{$project->description}}</p>
                  </div>
                  @endforeach  
                </div>
                @endif


               
                
            </div>
        </div>
    </div>
</body>
</html>