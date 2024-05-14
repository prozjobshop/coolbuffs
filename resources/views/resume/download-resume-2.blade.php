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
        <h1 class="f-50 mb0" style="font-size: 24px; text-align:center; color:#24779A">{{ $user->name }}</h1>
        @endisset
        <hr style="margin-top: 1px; color:#24779A">
    </div>    

        <div>
          
            <div class="pad-1" style="text-align:center; color:#24779A; font-size:18px; font-family:Courier, monospace">
                @isset($user->email)
                
                    
                    <span class="ft mb0 mt0">{{ $user->email }} |</span>
                
                @endisset
                @isset($user->mobile_num)
                
                    
                    <span class="ft mb0 mt0">{{ $user->mobile_num }} |</span>
                
                @endisset
                @if(isset($user->country) || isset($user->state) || isset($user->city))
                
                    
                    <span class="ft2 mb0 mt0">{{ $user->city . ', ' . $user->state . ', ' . $user->country }} |</span>
                
                @endisset
            </div>
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
                    <p style="font-size:14pz; text-align:center">{{$user->getProfileSummary('summary')}} </p>
                  @endif
              </div>
              <div class="experiences personal_details pad-1">
              
      
              <div class="pad-1">

                

                  @if(count($user_experience) > 0)
                  <p style="text-align:center"><span style="font-size:18px; color:white; background-color:#24779A">PROFESSIONAL EXPERIENCE</span></p>
                    

                    @foreach($user_experience as $user_exp)
                      <p class="fw-t" style="margin-top: -8px; text-align:center; font-size:14px">{{ $user_exp->title }}</p>
                      <p class="fw-t" style="padding-top: -18px; text-align:center; font-size:14px"><b>{{ $user_exp->company }}, {{ $user_exp->city_name }}</b></p>
                      <p class="ft" style="padding-top: -18px; text-align:center; font-size:11px">
                            {{-- {{ date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }} --}}
                            {{date('d M, Y', strtotime($user_exp->date_start)) . ' - ' }}
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
              
                  
                     
                  

                    
                      <ul>
                          <li class="ft1" style="margin-left:-80px">{{$user_exp->description}}</li>
                          {{-- <li class="ft1" style="margin-left:-80px">Improved database performance by optimizing MySQL queries, boosting query response times by 11%.</li>
                          <li class="ft1" style="margin-left:-80px">Streamlined the continuous integration and deployment (CI/CD) pipeline, reducing build times by 27%.</li>
                          <li class="ft1" style="margin-left:-80px">Cut merge conﬂicts by 13% using Git for version control and collaboration.</li> --}}
                      </ul>
                    @endforeach
                  @endif
                  </div>
                  
                  
              
                  @if(count($user_projects) > 0)
                    
                    <p style="text-align:center"><span style="font-size:18px; color:white; background-color:#24779A">PROJECTS</span></p>
                    

                    @foreach($user_projects as $project)
                      <p class="fw-t " style="margin-top: 2px; text-align:center; font-size:13px"><b>{{ $project->name }}</b></p>
                      <p class="txt-clr fw-t" style="padding-top: -18px; text-align:center; font-size:13px">{{ $project->url }}</p>

                      
                          
                          <p class="ft mb0 mt0" style="padding-top: -15px; text-align:center">{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</p>
                      
                      <ul>
                          <li class="ft1" style="margin-left:-20px">{{$project->description}}</li>
                          {{-- <li class="ft1" style="margin-left:-20px">Employed Django ORM to manage database interactions, streamlining and reducing development time by 19%.</li>
                          <li class="ft1" style="margin-left:-20px">Collaborated with a team of 4 to ensure timely project delivery while adhering to best practices.</li> --}}
                      </ul>   
                    @endforeach           
                  @endif
      
              <div class="pad-1">
                  @if(count($user_educations) > 0)
                  
                  <p style="text-align:center"><span style="font-size:18px; color:white; background-color:#24779A">EDUCATION</span></p>

                  
                  @foreach($user_educations as $user_edu)
                  <p class="fw-t" style="text-align:center; font-size:13px">{{ $user_edu->institution }}, {{ $user_edu->city }}</p>
                  <p class="fw-t" style="padding-top: -15px; text-align:center; font-size:13px">{{ $user_edu->degree_type }} {{ $user_edu->date_completion }}</p>
                  <p class="fw-t" style="padding-top: -15px; text-align:center; font-size:13px"><b>{{ $user_edu->degree_level }}</b></p>
                  
                  
                  
                  
                      
                                   
                                        
                  @endforeach
                  @endif
                   
                  
                  @if(count($user_skills) > 0)
                  <p style="text-align:center"><span style="font-size:18px; color:white; background-color:#24779A">SKILLS</span></p>
                  
                  <ul style="margin-top: -8px">
                      @foreach($user_skills as $user_skill)
                      <li class="ft1">{{ $user_skill->job_skill}} - <span class="ft1 f-b txt-clr">{{ $user_skill->job_experience}}</span></li>                        <li class="ft1">Git </li>
                      {{-- <li class="ft1">MySQL</li>
                      <li class="ft1">Django  </li>
                      <li class="ft1">Heroku </li>
                      <li class="ft1">macOS </li>
                      <li class="ft1">Python</li> --}}
                      @endforeach
                  </ul>
                  @endif


                  @if(count($user_languages) > 0)
                  <p style="text-align:center"><span style="font-size:18px; color:white; background-color:#24779A">LANGUAGES</span></p>
                  <ul>
                      @foreach($user_languages as $user_language)
                      <li class="ft1">{{ $user_language->lang }}</li>
                  @endforeach
                  </ul>
              
              @endif


                  <p style="text-align:center"><span style="font-size:18px; color:white; background-color:#24779A">PERSONAL INFORMATION</span></p>

                @isset($user->father_name)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                   
                      <span class="f-14 mb0 mt0" style="font-size:13px">Father Name :</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->father_name }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->date_of_birth)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">Date of Birth :</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->gender_id)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">Gender</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->gender }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->marital_status)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Marital Status : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->marital_status }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->nationality)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Nationality : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
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
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Job Experience : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->job_experience }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->industry)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Industry : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->industry }}</span>
                    </div>
                  </div>
                @endisset
                @isset($user->functional_area)
                  <div class="experience">
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Functional Area : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
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
                    <div class="wid-50 f-left  test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ 'Video Profile : ' }}</span>
                    </div>
    
                    <div class="wid-50 f-left tc test-borde">
                      <span class="f-14 mb0 mt0" style="font-size:13px">{{ $user->video_link }}</span>
                    </div>
                  </div>
                @endisset
              </div>
              @endif
  


              

               

              </div>


            </div>
            
          {{-- </div> --}}
           





        </body>
        </html>