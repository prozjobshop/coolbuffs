<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>My Resume</title>
  <link rel="stylesheet" href="{{ public_path('css/templates/download-resume.css') }}">
  

  <style>
    /* .resume_profile{
      align-items: center;
      display: flex;
      justify-content: center;
    } */
    /* .resume .resume_left .resume_profile img {
      width: 35%;
      height: 35%;
    }  */

    p{
      margin: 0;
      padding: 0;
    }

    .skill_nam{
      width: 100%;
    }
    .skill_nam p{
      font-weight: 600;
      border-bottom: 1px solid #fff;
    }
  </style>
</head>
<body>

<div class="resume">
   <div class="resume_left" style="height: 100vh;">
     <div class="resume_profile">
      <?php
        if(Auth::user()->image){
          $user_imgg = 'user_images/'.Auth::user()->image;
        }else{
          $user_imgg = 'resumes/user-2.png';
        }
      ?>
      <img src="{{ public_path($user_imgg) }}" alt="profile_pic" width="200" height="200" style="margin-top: 55px;">
      <!-- <img src="{{ public_path('user_images/'.Auth::user()->image) }}" alt="profile_pic" width="200" height="200" style="margin-top: 55px;"> -->
     </div>
     <div class="resume_content">
       <div class="resume_item resume_info">
         <div class="title">
           <p class="bold">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p>
           <p class="regular">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</p>
         </div>

         <ul>
            @if(isset($user->country) || isset($user->state) || isset($user->city))
            <li>
             <div class="icon">
               <i style="font-family: fontawesome;" class="fa">&#xf277;</i>
             </div>
             <div class="data">
               {{ $user->city . ', ' . $user->state . ', ' . $user->country }}
             </div>
           </li>
           @endif
           @isset($user->mobile_num)
           <li>
             <div class="icon">
               <i style="font-family: fontawesome; font-size: 28px;" class="fa">&#xf10b;</i>
             </div>
             <div class="data">
              {{ $user->mobile_num }}
             </div>
           </li>
           @endisset
           @isset($user->email)
           <li>
             <div class="icon">
               <i style="font-family: fontawesome;" class="fa">&#xf199;</i>
             </div>
             <div class="data">
              {{ $user->email }}
             </div>
           </li>
           @endisset
           <!-- <li>
             <div class="icon">
               <i class="fa fa-globe"></i>
             </div>
             <div class="data">
                www.candi_date.com
             </div>
           </li> -->
         </ul>
       </div>
       @if(count($user_skills) > 0)
       <div class="resume_item resume_skills">
         <div class="title">
           <p class="bold">skill's</p>
         </div>
         <ul>
          @foreach ($user_skills as $user_skill)
          <li>
            <div class="skill_nam">
              <p>{{ $user_skill->job_skill }}</p>
              <span>{{ $user_skill->job_experience }}</span>
            </div>
          </li>
          @endforeach
         </ul>
       </div>
       @endif
       <div class="extra_spacing">&nbsp;</div>
       </div>
  </div>
  <div class="resume_right">
    @if($user->getProfileSummary('summary'))
    <div class="resume_item resume_about">
        <div class="title">
           <p class="bold">About me</p>
         </div>
        <p>{{$user->getProfileSummary('summary')}}</p>
    </div>
    @endif


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
    <div class="resume_item resume_languages resume_personal_details">
      <div class="title">
        <p class="bold">Personal Details</p>
      </div>
      <ul>
        @isset($user->father_name)
          <li>
            <div class="lang">Father Name : </div> 
            <div class="lang_level">{{ $user->father_name }}</div> 
          </li>
        @endisset
        @isset($user->date_of_birth)
          <li>
            <div class="lang">Date of Birth : </div> 
            <div class="lang_level">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</div> 
          </li>
        @endisset
        @isset($user->gender_id)
          <li>
            <div class="lang">Gender : </div> 
            <div class="lang_level">{{ $user->gender }}</div> 
          </li>
          <li>
        @endisset
        @isset($user->marital_status)
            <div class="lang">Marital Status : </div> 
            <div class="lang_level">{{ $user->marital_status }}</div> 
          </li>
        @endisset
        @isset($user->nationality)
          <li>
            <div class="lang">Nationality : </div> 
            <div class="lang_level">{{ $user->nationality }}</div> 
          </li>
        @endisset
        {{-- @isset($user->national_id_card_number)
          <li>
            <div class="lang">National ID : </div>
            <div class="lang_level">{{ $user->national_id_card_number }}</div> 
          </li>
        @endisset --}}
        {{-- @isset($user->phone)
          <li>
            <div class="lang">Phone : </div> 
            <div class="lang_level">{{ $user->phone }}</div> 
          </li>
        @endisset --}}
        @isset($user->job_experience)
          <li>
            <div class="lang">Job Experience : </div> 
            <div class="lang_level">{{ $user->job_experience }}</div> 
          </li>
        @endisset
        @isset($user->industry)
          <li>
            <div class="lang">Industry : </div> 
            <div class="lang_level">{{ $user->industry }}</div> 
          </li>
        @endisset
        @isset($user->functional_area)
          <li>
            <div class="lang">Functional Area : </div> 
            <div class="lang_level">{{ $user->functional_area }}</div> 
          </li>
        @endisset
        {{-- @isset($user->current_salary)
          <li>
            <div class="lang">Current Salary : </div> 
            <div class="lang_level">{{ $user->current_salary }}</div> 
          </li>
        @endisset --}}
        {{-- @isset($user->expected_salary)
          <li>
            <div class="lang">Expected Salary : </div> 
            <div class="lang_level">{{ $user->expected_salary }}</div> 
          </li>
        @endisset --}}
        {{-- @isset($user->salary_currency)
          <li>
            <div class="lang">Salary Currency : </div> 
            <div class="lang_level">{{ $user->salary_currency }}</div> 
          </li>
        @endisset --}}
        {{-- @isset($user->street_address)
          <li>
            <div class="lang">Street Address : </div> 
            <div class="lang_level">{{ $user->street_address }}</div> 
          </li>
        @endisset --}}
        @isset($user->video_link)
          <li>
            <div class="lang">Video Profile : </div> 
            <div class="lang_level">{{ $user->video_link }}</div> 
          </li>
        @endisset
      </ul>
    </div>
    @endif


    @if(count($user_experience) > 0)
    <div class="resume_item resume_work">
        <div class="title">
           <p class="bold">Work Experience</p>
         </div>
        <ul>
          @foreach($user_experience as $user_exp)
            <li>
              <div class="date">
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
                    {{-- <span class="f-14 exp_meta"> --}}
                      - 
                        {{-- @if($total_years) --}}
                        
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

                        {{-- @endif --}}


                        {{-- @if($total_months)
                          @if($total_months == 1)
                            {{ '.' . $total_months . ' Months' }}
                          @else
                            {{ '.' . $total_months . ' Years' }}
                          @endif
                        @else

                        @endif --}}
                      
                    {{-- </span> --}}
                  {{-- </div> --}}
                @endif
              </div>
              <div class="info">
                     <p class="semi-bold">{{ $user_exp->company . ' | ' . $user_exp->city_name}}</p> 
                     <p>{{ $user_exp->title}}</p>
                  <p>{{ $user_exp->description }}</p>
              </div>
            </li>
          @endforeach
        </ul>
    </div>
    @endif
    @if(count($user_educations) > 0)
    <div class="resume_item resume_education">
      <div class="title">
           <p class="bold">Education</p>
         </div>
      <ul>
            @foreach($user_educations as $user_edu)
              <li>
                <div class="date" style="margin-bottom: 0;">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</div> 
                <div style="margin-bottom: 10px;">{{ $user_edu->date_completion . ' - ' . $user_edu->city }}</div> 
                <div class="info">
                  <p class="semi-bold">{{ $user_edu->degree_title . ' (' . $user_edu->institution . ')' }}</p> 
                  <p>{{ $user_edu->major_subject }}</p>
                </div>
              </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(count($user_languages) > 0)
    <div class="resume_item resume_languages">
      <div class="title">
        <p class="bold">Languages</p>
      </div>
      <ul>
        @foreach($user_languages as $user_language)
          <li>
            <div class="lang">{{ $user_language->lang }}</div> 
            <div class="lang_level">{{ $user_language->language_level }}</div> 
          </li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
  <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
</div>
  
</body>
</html>