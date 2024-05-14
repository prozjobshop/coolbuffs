<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Template 3</title>
  <link rel="stylesheet" href="{{ asset('css/templates/normalize.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/templates/template-3.css') }}">
  <link href="{{asset('/')}}css/font-awesome.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="./normalize.min.css">

  <link rel="stylesheet" href="./font-awesome.css">

  <link rel="stylesheet" href="./style.css"> -->

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <div class="profile">
    <div class="profile-photo">
    {{$user->printUserImage()}}
    </div>
    <div class="profile-info">
      <h2 class="heading heading-light">
      {{ $user->first_name . ' ' . $user->last_name }}
    </h2>
    <p class="profile-text">
      {{$user->getProfileSummary('summary')}}
    </p>
      <div class="contacts">
        <div class="contacts-item">
           <h3 class="contacts-title">
             <i class="fas fa-phone-volume"></i>
             Phone
          </h3>
          <a href="tel:+18001234567" class="contacts-text">{{ $user->phone }}</a>
        </div>
        <div class="contacts-item">
          <h3 class="contacts-title">
             <i class="fas fa-envelope"></i>
             Email
          </h3>
          <a href="mailto:Robertsmith@gamil.com" class="contacts-text">{{ $user->email }}</a>
        </div>
        <!-- <div class="contacts-item">
          <h3 class="contacts-title">
             <i class="fas fa-globe-americas"></i>
             Web
          </h3>
          <a href="http://www.robertsmith.com" class="contacts-text">www.robertsmith.com</a>
        </div> -->
        <div class="contacts-item">
          <h3 class="contacts-title">
             <i class="fas fa-map-marker-alt"></i>
             Home
          </h3>
          <address class="contacts-text">
            <!-- 24058, Belgium, Brussels, <br>Liutte 27, BE -->
            {{ $user->street_address }}
          </address>
        </div>
      </div>
      <h2 class="heading heading-light">Languages</h2>
      <div class="languages">
        <div class="language">
          <span class="language-text">English</span>
          <strong class="languages-per">100%</strong>
        </div>
        <div class="language">
          <span class="language-text">French</span>
          <strong class="languages-per">90%</strong>
        </div>
        <div class="language">
          <span class="language-text">Greak</span>
          <strong class="languages-per">80%</strong>
        </div>
        <div class="lines">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>
      </div>
    </div>
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
          J/C
        </div>
        <div class="logo-lines logo-lines_right">
          <span class="logo-line"></span>
          <span class="logo-line"></span>
          <span class="logo-line"></span>
        </div>
      </div>
      <div class="about">
        <h1 class="name">{{ $user->first_name . ' ' . $user->last_name }}</h1>
        <span class="position">{{ $user_meta->career_level }}</span>
        <address class="about-address">{{ $user->street_address }}</address>
        <!-- <div class="about-contacts">  
          <a class="about-contacts__link" href="#">
            <b>t</b>: (1800) 123 45678</a> |
          <a class="about-contacts__link" href="#">
            <b>e</b>: Robertsmith@gmail.com </a> |
          <a class="about-contacts__link" href="#">
            <b>w</b>: www.robertsmith.com</a>
        </div> -->
      </div>
      <div class="experience">
        <h2 class="heading heading_dark">
          Experience
        </h2>
        <ul class="list">
          @foreach($user_experience as $user_exp)
          <li class="list-item">
            <h4 class="list-item__title">{{ $user_exp->title . ' - ' . $user_exp->company . ' ('. $user_exp->city_name.')' }}</h4>
            <span class="list-item__date">{{ date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }}</span>
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
      <div class="skills">
        <h2 class="heading heading_dark heading_skills">
          Skills
        </h2>
        <ul class="skills-list">
          @foreach($user_skills as $user_skill)
            <li class="skills-list__item">
              <p>{{ $user_skill->job_skill}}</p>
              <span>{{ $user_skill->job_experience}}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  
</body>
</html>
