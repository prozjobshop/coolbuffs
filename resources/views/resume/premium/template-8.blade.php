
text/x-generic download-resume-3.blade.php ( HTML document, UTF-8 Unicode text )
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>My Resume</title>
  <link rel="stylesheet" href="{{ public_path('css/templates/normalize.min.css') }}">
  <link rel="stylesheet" href="{{ public_path('css/templates/download-resume-3.css') }}">
  {{-- <link href="{{asset('/')}}css/font-awesome.css" rel="stylesheet"> --}}

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <div class="profile">
    <div class="profile-photo">
      <?php
        if(Auth::user()->image){
          $user_imgg = 'user_images/'.Auth::user()->image;
        }else{
          $user_imgg = 'resumes/user.png';
        }
      ?>
      <img src="{{ public_path($user_imgg) }}" alt="profile_pic" width="300" style="margin-top: 30px;">
    </div>
    

    <div class="profile-info">

      @if($user->getProfileSummary('summary'))
        <h2 class="heading heading-light">About</h2>
      @endif
    
    
    <p class="profile-text">
      @if($user->getProfileSummary('summary'))
        {{$user->getProfileSummary('summary')}}
      @endif
    </p>
      <div class="contacts">
        @isset($user->mobile_num)
        <div class="contacts-item">
           <h3 class="contacts-title">
             {{-- <i class="fas fa-phone-volume"></i> --}}
             <i style="font-family: fontawesome;" class="fa">&#xf2a0; </i>
             Phone
          </h3>
          <a href="tel:+18001234567" class="contacts-text">{{ $user->mobile_num }}</a>
        </div>
        @endisset
        @isset($user->email)
        <div class="contacts-item">
          <h3 class="contacts-title">
             {{-- <i class="fas fa-envelope"></i> --}}
             <i style="font-family: fontawesome;" class="fa">&#xf199; </i>
             Email
          </h3>
          <a href="mailto:proztec@gamil.com" class="contacts-text">{{ $user->email }}</a>
        </div>
        <!-- <div class="contacts-item">
          <h3 class="contacts-title">
             <i class="fas fa-globe-americas"></i>
             Web
          </h3>
          <a href="http://www.proztec.com" class="contacts-text">www.proztec.com</a>
        </div> -->
        @endisset
        @if(isset($user->country) || isset($user->state) || isset($user->city))
        <div class="contacts-item">
          <h3 class="contacts-title">
             {{-- <i class="fas fa-map-marker-alt"></i> --}}
             <i style="font-family: fontawesome;" class="fa">&#xf041; </i>
             Home
          </h3>
          <address class="contacts-text">
            <!-- 24058, Belgium, Brussels, <br>Liutte 27, BE -->
            {{ $user->city . ', ' . $user->state . ', ' . $user->country }}
          </address>
        </div>
        @endif
      </div>
      @if(count($user_languages) > 0)
      <h2 class="heading heading-light">Languages</h2>
      <div class="languages">
        @foreach ($user_languages as $user_language)
          <div class="language">
            <span class="language-text">{{ $user_language->lang }}</span>
            <br>
            <strong class="languages-per">{{ $user_language->language_level }}</strong>
          </div>  
        @endforeach
      </div>
      @endif
    </div>
    <div class="extra_spacing">&nbsp;</div>
  </div>
  <div class="resume">
    <div class="resume-wrap">
      <div class="logo">
        <div class="logo-lines logo-lines_left">
          <span class="logo-line"></span>
          <span class="logo-line"></span>
          <span class="logo-line"></span>
        </div>
        <div class="logo-img">
          {{-- J/C --}}
          {{ substr($user->first_name, 0, 1) . ' / ' . substr($user->last_name, 0, 1) }}
        </div>
        <div class="logo-lines logo-lines_right">
          <span class="logo-line"></span>
          <span class="logo-line"></span>
          <span class="logo-line"></span>
        </div>
      </div>
      <div class="about">
        <h1 class="name">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</h1>
        <span class="position">@isset($user_meta->career_level){{ $user_meta->career_level }}@endisset</span>
        @if(isset($user->country) || isset($user->state) || isset($user->city))
          <address class="about-address">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</address>
        @endif
        {{-- @endisset --}}
        <!-- <div class="about-contacts">  
          <a class="about-contacts__link" href="#">
            <b>t</b>: (1800) 123 45678</a> |
          <a class="about-contacts__link" href="#">
            <b>e</b>: Robertsmith@gmail.com </a> |
          <a class="about-contacts__link" href="#">
            <b>w</b>: www.robertsmith.com</a>
        </div> -->
      </div>

      {{-- Personal Details --}}
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
        <h2 class="heading heading_dark">
          Personal Details
        </h2>

        <table>

          @isset($user->father_name)
          <tr>
            <td>Father Name</td>
            <td>{{ $user->father_name }}</td>
          </tr>
          @endisset
          @isset($user->date_of_birth)
          <tr>
            <td>Date of Birth</td>
            <td>{{ date('d F, Y', strtotime($user->date_of_birth)) }}</td>
          </tr>
          @endisset
          @isset($user->gender_id)
          <tr>
            <td>Gender</td>
            <td>{{ $user->gender }}</td>
          </tr>
          @endisset
          @isset($user->marital_status)
          <tr>
            <td>Marital Status</td>
            <td>{{ $user->marital_status }}</td>
          </tr>
          @endisset
          @isset($user->nationality)
          <tr>
            <td>Nationality</td>
            <td>{{ $user->nationality }}</td>
          </tr>
          @endisset
          {{-- @isset($user->national_id_card_number)
          <tr>
            <td>National ID</td>
            <td>{{ $user->national_id_card_number }}</td>
          </tr>
          @endisset
          @isset($user->phone)
          <tr>
            <td>Phone</td>
            <td>{{ $user->phone }}</td>
          </tr>
          @endisset --}}
          @isset($user->job_experience)
          <tr>
            <td>Job Experience</td>
            <td>{{ $user->job_experience }}</td>
          </tr>
          @endisset
          @isset($user->industry)
          <tr>
            <td>Industry</td>
            <td>{{ $user->industry }}</td>
          </tr>
          @endisset
          @isset($user->functional_area)
          <tr>
            <td>Functional Area</td>
            <td>{{ $user->functional_area }}</td>
          </tr>
          @endisset
          {{-- @isset($user->current_salary)
          <tr>
            <td>Current Salary</td>
            <td>{{ $user->current_salary }}</td>
          </tr>
          @endisset
          @isset($user->expected_salary)
          <tr>
            <td>Expected Salary</td>
            <td>{{ $user->expected_salary }}</td>
          </tr>
          @endisset
          @isset($user->salary_currency)
          <tr>
            <td>Salary Currency</td>
            <td>{{ $user->salary_currency }}</td>
          </tr>
          @endisset
          @isset($user->street_address)
          <tr>
            <td>Street Address</td>
            <td>{{ $user->street_address }}</td>
          </tr>
          @endisset --}}
          @isset($user->video_link)
          <tr>
            <td>Video Profile</td>
            <td>{{ $user->video_link }}</td>
          </tr>
          @endisset
        </table>
        {{-- <ul class="list">
          <li class="list-item">
            <span class="list-item__date">Fater Name : Quaid-e-Azam</span>
          </li>
        </ul> --}}
      </div>
      @endif




      @if(count($user_experience) > 0)
      <div class="experience">
        <h2 class="heading heading_dark">
          Experience
        </h2>
        <ul class="list">
          @foreach($user_experience as $user_exp)
          <li class="list-item">
            <h4 class="list-item__title">{{ $user_exp->title . ' - ' . $user_exp->company . ' ('. $user_exp->city_name.')' }}</h4>
            <span class="list-item__date">
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
                {{-- <div class="list-item__date"> --}}
                  {{-- <span class="f-14 exp_meta"> --}}
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
            <p class="list-item__text">{{$user_exp->description}}</p>
          </li>
          @endforeach
          <!-- <li class="list-item">
            <h4 class="list-item__title">Hexogan Web Development Company</h4>
            <span class="list-item__date">Jan 2016 - 0ct 2016</span>
            <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica - leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth? Texas tea.</p>
          </li>
          <li class="list-item">
            <h4 class="list-item__title">Hexogan Web Development Company</h4>
            <span class="list-item__date">Jan 2016 - 0ct 2016</span>
            <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica - leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth? Texas tea.</p>
          </li> -->
        </ul>
      </div>
      @endif
      @if(count($user_educations) > 0)
      <div class="education">
        <h2 class="heading heading_dark">
          Education
        </h2>
        <ul class="list">
        @foreach($user_educations as $user_edu)
          <li class="list-item list-item_non-border">
            <h4 class="list-item__title">{{$user_edu->degree_level . ' - ' . $user_edu->degree_type }}</h4>
            <span class="list-item__date">{{ $user_edu->date_completion . ' - ' . $user_edu->city }}</span>
            <!-- <p class="list-item__text">Fleeing from the Cylon tyranny the last Battlestar – Galactica - leads a rag-tag fugitive fleet on a lonely quest - a shining planet known as Earth? Texas tea.</p> -->
            <p class="semi-bold">{{ $user_edu->degree_title . ' (' . $user_edu->institution . ')' }}</p> 
            <p>{{ $user_edu->major_subject }}</p>
          </li>
        @endforeach
        </ul>
      </div>
      @endif
      @if(count($user_skills) > 0)
      <div class="skills">
        <h2 class="heading heading_dark heading_skills">
          Skills
        </h2>
        <ul class="skills-list">
          @foreach($user_skills as $user_skill)
            <li class="">
              <h4 class="list-item__title">{{ $user_skill->job_skill}}</h4>
              <span>{{ $user_skill->job_experience}}</span>
            </li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>
</div>
<!-- partial -->
  
</body>
</html>