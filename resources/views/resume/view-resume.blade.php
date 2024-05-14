<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Template 1</title>
  <link rel="stylesheet" href="{{ asset('css/templates/template-1.css') }}">
  <link href="{{asset('/')}}css/font-awesome.css" rel="stylesheet">
  
  <style>
    .resume_profile{
      align-items: center;
      display: flex;
      justify-content: center;
    }
    .resume .resume_left .resume_profile img {
      width: 65%;
      height: 65%;
      border-radius: 50%;
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
<!-- partial:index.partial.html -->

<div class="resume">
   <div class="resume_left">
     <div class="resume_profile">
       <!-- <img src="{{ asset('resumes/user-2.png') }}" alt="profile_pic"> -->
       {{$user->printUserImage()}}
     </div>
     <div class="resume_content">
       <div class="resume_item resume_info">
         <div class="title">
           <p class="bold">{{ $user->first_name . ' ' . $user->last_name }}</p>
           <p class="regular">{{ $user_meta->career_level }}</p>
         </div>
         <ul>
           <li>
             <div class="icon">
               <i class="fa fa-map-signs"></i>
             </div>
             <div class="data">
               21 Street, Al Batinah, <br />Liwa, Oman
               <!-- {{ $user->street_address }} -->
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fa fa-mobile"></i>
             </div>
             <div class="data">
              {{ $user->phone }}
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fa fa-envelope"></i>
             </div>
             <div class="data">
              {{ $user->email }}
             </div>
           </li>
           <li>
             <div class="icon">
               <i class="fa fa-globe"></i>
             </div>
             <div class="data">
                www.candi_date.com
             </div>
           </li>
         </ul>
       </div>
       <div class="resume_item resume_skills">
         <div class="title">
           <p class="bold">skill's</p>
         </div>
         <ul>
            @foreach($user_skills as $user_skill)
              <li>
              <div class="skill_nam">
                <p>{{ $user_skill->job_skill}}</p>
                <span>{{ $user_skill->job_experience }}</span>
              </div>
            </li>
            @endforeach
           <!-- <li>
             <div class="skill_name">
               CSS
             </div>
             <div class="skill_progress">
               <span style="width: 85%;"></span>
             </div>
             <div class="skill_per">85%</div>
           </li> -->
         </ul>
       </div>
     </div>
  </div>
  <div class="resume_right">
    <div class="resume_item resume_about">
        <div class="title">
           <p class="bold">About me</p>
         </div>
        <!-- <p>Software engineers focus on applying the principles of engineering to software development. Their role includes analyzing and modifying existing software as well as designing, constructing and testing end-user applications that meet user needs — all through software programming languages. The role also focuses on the complex and large software systems that make up the core systems for an organization.</p> -->
        <p>{{$user->getProfileSummary('summary')}}</p>
    </div>
    <div class="resume_item resume_work">
        <div class="title">
           <p class="bold">Work Experience</p>
         </div>
        <ul>
          @foreach($user_experience as $user_exp)
            <li>
              <div class="date">
                {{ 'From ' . date('d M, Y', strtotime($user_exp->date_start)) . ' - ' . date('d M, Y', strtotime($user_exp->date_end)) }}
              </div>
              <div class="info">
                     <p class="semi-bold">{{ $user_exp->company . ' | ' . $user_exp->city_name}}</p> 
                     <p>{{ $user_exp->title}}</p>
                  <p>{{ $user_exp->description }}</p>
              </div>
            </li>
          @endforeach
            <!-- <li>
                <div class="date">2013 - 2015</div> 
                <div class="info">
                     <p class="semi-bold">Lorem ipsum dolor sit amet.</p>
                     <p>Web Developer</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                </div>
            </li>
            <li>
              <div class="date">2015 - 2017</div>
              <div class="info">
                     <p class="semi-bold">Lorem ipsum dolor sit amet.</p> 
                     <p>UX Designer</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                </div>
            </li>
            <li>
              <div class="date">2017 - Present</div>
              <div class="info">
                     <p class="semi-bold">Lorem ipsum dolor sit amet.</p> 
                     <p>UI Expert</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                </div>
            </li> -->
        </ul>
    </div>
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
            <!-- <li>
                <div class="date">2010 - 2013</div> 
                <div class="info">
                  <p class="semi-bold">Web Designing (Texas University)</p>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                </div>
            </li>
            <li>
              <div class="date">2000 - 2010</div>
              <div class="info">
                     <p class="semi-bold">Texas International School</p> 
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, voluptatibus!</p>
                </div>
            </li> -->
        </ul>
    </div>
  </div>
</div>
<!-- partial -->
  
</body>
</html>


