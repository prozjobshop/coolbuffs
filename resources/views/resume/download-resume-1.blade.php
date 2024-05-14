<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resume</title>
    <link rel="stylesheet" href="{{ public_path('css/templates/premium/template-10.css') }}">
</head>
<body>

    <div class="pad-1" style="padding-top: 12px">
        @isset($user->name)
        <h1 class="f-50 mb0" style="font-size: 24px; font-family:serif; text-align:left">{{ $user->name }}</h1>

      
    </div>    

<div class="pad-1" style="padding-top: -12px">
    @endisset
        @if(isset($user->country) || isset($user->state) || isset($user->city))
                
        <h1 class="f-50 mb0" style="font-size: 15px; text-align:left; color:#007FFF">{{ $user->city . ', ' . $user->country }}</h1>
        @endisset
        @isset($user->email)
        <p style="text-align:right; margin-top:-35px; font-size: 12px"><img src="./resumes/email.png">  {{ $user->email }}</span></p>
        @endisset
        @isset($user->mobile_num)
                        <p style="text-align:right; padding-top:-11px; font-size: 12px"><img src="./resumes/phone.png">  {{ $user->mobile_num }}</span></p>    
                
            @endisset 
           
</div>
   
                            
          

        {{-- <div> --}}
           
                
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

            
              <div class="pad-1">
              @if(!empty($user->getProfileSummary('summary')))        
              <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>OBJECTIVE</b></span></p>     
              <hr style="width:100%; height:2px; margin-top: -0.5em; color:black;background-color:black">
                    <p style="font-size:14px; margin-top:-6px">{{$user->getProfileSummary('summary')}} </p>
                  @endif
              </div>
                            
      
              <div class="pad-1">
                

                  @if(count($user_experience) > 0)
                  <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>EXPERIENCE</b></span></p>
                  <hr style="width:100%; height:2px; margin-top: -0.5em; color:black;background-color:black">

                    @foreach($user_experience as $user_exp)
                      <p class="fw-t" style="font-size:14px; margin-top:-6px"><b>{{ $user_exp->title }}</b></p>
                      <p class="fw-t" style="padding-top: -18px; font-size:14px; color:#007FFF">{{ $user_exp->company }}, {{ $user_exp->city_name }}</p>
                      <p style="font-size:11px; text-align:right; padding-top:-31px">
                            {{-- {{ date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }} --}}
                            {{date('d M, Y', strtotime($user_exp->date_start)) . ' to ' }}
                            {{-- . date('d M, Y', strtotime($user_exp->date_end)) --}}
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
                          <b>{{ $total_years }}
                          @if($total_months)
                            {{ '.' . $total_months . ' Year' }}</b>
                          @endif

                        @elseif($total_years > 1)
                          <b>{{ $total_years }}
                          @if($total_months)
                           {{ '.' . $total_months . ' Years' }}</b>
                          @endif                            


                        @else
                          @if($total_months == 1)
                            <b>{{ $total_months . ' Month'  }}</b>
                          @else
                            <b>{{ $total_months . ' Months'  }}</b>
                          @endif
                        @endif
                        
                      @endif
                    </span>
              
                  
                     
                    

                
                      <ul>
                          <li class="ft1" >{{$user_exp->description}}</li>
                          {{-- <li class="ft1">Improved database performance by optimizing MySQL queries, boosting query response times by 11%.</li>
                          <li class="ft1">Streamlined the continuous integration and deployment (CI/CD) pipeline, reducing build times by 27%.</li>
                          <li class="ft1">Cut merge conﬂicts by 13% using Git for version control and collaboration.</li> --}}
                      </ul>
                      <hr style="width:100%; height:0.5px; margin-top: -0.5em">
                    @endforeach
                    
                  @endif
                  </div>
                  
                    
                    <div class="pad-1">
                  @if(count($user_educations) > 0)
                  <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>EDUCATION</b></span></p>
                  <hr style="width:100%; height:2px; margin-top: -0.5em; color:black;background-color:black">
                  
                  @foreach($user_educations as $user_edu)
                  <p class="fw-t" style="font-size:13px; color:#007FFF; margin-top:-6px">{{ $user_edu->institution }}, {{ $user_edu->city }}</p>
          
                  <p class="fw-t" style="font-size:13px; padding-top: -15px"><b>{{ $user_edu->degree_level }}</b></p>
                  <p style="padding-top: -29px; text-align:right">{{ $user_edu->date_completion }}</p>                  
                                        
                  @endforeach
                  @endif
                  
                          </div>
                          <div class="pad-1">
              
              @if(count($user_projects) > 0)
                
                
                <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>PROJECTS</b></span></p>
                <hr style="width:100%; height:2px; margin-top: -0.5em; color:black;background-color:black">
                @foreach($user_projects as $project)
                  <p class="fw-t " style="font-size:13px; margin-top:-6px"><b>{{ $project->name }}</b></p>
                  <p class="txt-clr fw-t" style="padding-top: -18px; font-size:13px; color:#007FFF">{{ $project->url }}</p>


                      
                      <p class="ft mb0 mt0" style="padding-top: -31px; text-align:right">{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</p>
                  
                  <ul>
                      <li class="ft1">{{$project->description}}</li>
                      {{-- <li class="ft1">Employed Django ORM to manage database interactions, streamlining and reducing development time by 19%.</li>
                      <li class="ft1">Collaborated with a team of 4 to ensure timely project delivery while adhering to best practices.</li> --}}
                  </ul>   
                @endforeach           
              @endif
                </div>
                      
                          <div class="pad-1">
                  @if(count($user_skills) > 0)
                  
                  <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>SKILLS</b></span></p>
                  <hr style="width:100%; height:2px; margin-top: -0.5em; color:black;background-color:black">
                  <ul style="margin-top: -6px">
                      @foreach($user_skills as $user_skill)
                      <li class="ft1"><b>{{ $user_skill->job_skill}}</b> - <span style="font-size:12px">{{ $user_skill->job_experience}}</span></li>
                      {{-- <li class="ft1">MySQL</li>
                      <li class="ft1">Django  </li>
                      <li class="ft1">Heroku </li>
                      <li class="ft1">macOS </li>
                      <li class="ft1">Python</li> --}}
                      @endforeach
                  </ul>
                  @endif
                      </div>
                      
                                            
              <div class="pad-1">
              <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>PERSONAL INFORMATION</b></span></p>
              <hr style="width:100%; height:2px; margin-top: -0.5em; color:color:#007FFF; background-color:black">

                @isset($user->father_name)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                   
                      <span style="font-size:13px">Father Name :</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->father_name }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->date_of_birth)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">Date of Birth :</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->gender_id)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">Gender</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->gender }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->marital_status) 
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Marital Status : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->marital_status }}</span>
                    </div>
                  </div>

                  
                @endisset
                @isset($user->nationality)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Nationality : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->nationality }}</span>
                    </div>
                  </div>
                @endisset
                {{-- @isset($user->national_id_card_number)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'National ID : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->national_id_card_number }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->phone)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Phone : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->phone }}</span>
                    </div>
                  </div>
                @endisset --}}
                @isset($user->job_experience)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Job Experience : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->job_experience }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->industry)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Industry : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->industry }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->functional_area)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Functional Area : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->functional_area }}</span>
                    </div>
                  </div>
                @endisset
                {{-- @isset($user->current_salary)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Current Salary : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->current_salary }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->expected_salary)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Expected Salary : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->expected_salary }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->salary_currency)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Salary Currency : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->salary_currency }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->street_address)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Street Address : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->street_address }}</span>
                    </div>
                  </div>
                @endisset --}}
                @isset($user->video_link)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde" style="margin-left:25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Video Profile : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde" style="margin-left:-25px">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->video_link }}</span>
                    </div>
                  </div>
                @endisset
              </div>
              @endif
  

                </div>
              


                <div class="pad-1">
                  @if(count($user_languages) > 0)
                  <p style="text-align:left; font-family:serif"><span style="font-size:13px"><b>LANGUAGE</b></span></p>
                  <hr style="width:100%; height:2px; margin-top: -0.5em; color:black;background-color:black">
                  <ul>
                      @foreach($user_languages as $user_language)
                      <li class="ft1">{{ $user_language->lang }}</li>
                  @endforeach
                  </ul>
              
              @endif
                      </div>

               

              </div>


            </div>
            
          {{-- </div> --}}
           





        </body>
        </html>