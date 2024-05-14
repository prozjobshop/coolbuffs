<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-12.css') }}">
</head>
<body>
    <div class=""  style="height: 260px;">
        <div class="pad-1">
            <div class="wid-40  f-lft">
                <div class="pad-l">
                    <h2 class="f-50 mt0 tcl-2 heading">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h2>
                    <p class="f-16 tcl">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</p>
</div>
</div>
               
                <div class="wid-30  f-left">
                    <div>
                        <?php
        if(Auth::user()->image){
          $user_imgg = 'user_images/'.Auth::user()->image;
        }else{
          $user_imgg = 'resumes/user-2.png';
        }
      ?>
      <img src="{{ public_path($user_imgg) }}" alt="profile_pic" width="200" height="200" style="">
  
                    </div>
                </div>
            <div class="wid-30 f-rgt" style="text-align: right">
                
                @isset($user->email)
                <div class="f-right" style="text-align: right">
                    <span style="color: #4459A2;" class="f-12"><u>{{ $user->email }}</u></span>
                    <i style="font-family: fontawesome; color:#4459A2" class="fa tc f-18">&#xf003;</i>
                </div>
                @endisset
                
                @isset($user->mobile_num)
                <div class="f-right" style="text-align: right">
                    <span class="f-12">{{ $user->mobile_num }}</span> 
                    <i style="font-family: fontawesome; color:#4459A2" class="fa tc f-18">&#xf095;</i>
                </div>
                @endisset
                @if(isset($user->country) || isset($user->state) || isset($user->city))
                <div class="f-right" style="text-align: right">
                    <span class="f-12">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</span>
                    <i style="font-family: fontawesome; color:#4459A2" class="fa tc f-18">&#xf124;</i>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="pad-3">
        <div style="border-top:2px solid #4459A2; margin:20px 0 30px 0"></div>
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
                @if(count($user_experience)>0)
                <h2 class="mb0" style="margin-top:25px"><b>WORK EXPERIENCE</b></h2>
                    @foreach($user_experience as $user_exp)
                        <p class="mt0 mb0 ft-1">{{$user_exp->title}}</p>
                        <p class=" mt0 mb0">{{$user_exp->company}}</p>
                        <p class=" mt0 mb0"> <i>
                          {{-- {{date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end))}}  --}}
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
                        </i></p>

                        

                        <p class="mt0"> <i>Achievements/Tasks </i></p>
                        <p>{{$user_exp->description}}</p>
                    @endforeach
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
        </div>
    </div>
        <div class="wid-50 f-rgt">
            <div class="pad-2 pad-t" >
                <!-- Skills -->
            @if(count($user_skills) > 0)
                <h2 class="mb0 tc">TECHNICAL SKILLS </h2>

                @foreach($user_skills as $user_skill)
                    <p class="mb0 f-20 tc"> {{ $user_skill->job_skill}}</p>
                    <hr>
                    <p class="mt0 f-20 tc">{{ $user_skill->job_experience}}</p>
                @endforeach
            @endif  
            @if(count($user_projects) > 0)
                <h2 class="mb0 tc">PERSONAL PROJECTS</h2>

                @foreach($user_projects as $project)
                <p class="">{{ $project->name }}</p>
                <p class=" m-50"></p>
                @endforeach  
               
                @endif
                {{-- <h2 class="mb0 tc">CERTIFICATES</h2>
                <p class="">Aanaia Application (Aptech) Flutter </p>
                <p class="">Development XXXX Brewery</p>
                <p class="">JAVA amalaka </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>