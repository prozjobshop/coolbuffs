<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Template 2</title>
  <link rel="stylesheet" href="{{ asset('css/templates/template-2.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('css/templates/download-resume-2.css') }}"> --}}

  <style>
    .profile-box img{
      height: 220px;
    }


    /* .skill-title p:nth-child(1){
      margin: 0 auto;
      font-weight: 600;
      border-bottom: 1px dotted #434343;
    }
    .skill-title p:nth-child(2){
      margin-top: 5px;
    } */

    *{
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <div class="resume-wrapper">
    <section class="intro">
      <figure class="profile-box">
        <!-- <img src="{{ asset('resumes/user.png') }}" alt=""> -->
        {{$user->printUserImage()}}
      </figure>
      <div class="contact-box">
        <dl class="intro">
          <dt>Call</dt>
          <dd>{{ $user->phone }}</dd>
          <dt>Email</dt>
          <dd>{{ $user->email }}</dd>
          <dt>Home</dt>
          <dd>{{ $user_meta->city . ' , ' . $user_meta->country}}</dd>
          <!-- <dt>Freelance</dt>
          <dd>Not Available</dd> -->
        </dl>
      </div>
      <!-- <div class="word-box">
        <p class="">
          {{$user->getProfileSummary('summary')}}
        </p>
      </div> -->
      <!-- <div class="social-box">
        <ul class="intro">
          <li><a href="#" class="twitter" title="Twitter">
            <svg viewbox="0 0 512 512">
              <path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"/>
            </svg>
          </a>
          </li>
          <li><a href="#" class="flickr" title="flickr">
             <svg viewbox="0 0 512 512">
               <path d="M344.5 156.9c-38.7 0-72.1 22.1-88.5 54.4 -16.4-32.3-49.8-54.4-88.5-54.4 -54.8 0-99.1 44.4-99.1 99.1 0 54.8 44.4 99.1 99.1 99.1 38.6 0 72.1-22.1 88.5-54.4 16.4 32.3 49.8 54.4 88.5 54.4 54.8 0 99.1-44.4 99.1-99.1C443.6 201.2 399.2 156.9 344.5 156.9zM344.5 328.7c-40.1 0-72.7-32.6-72.7-72.7s32.6-72.7 72.7-72.7 72.7 32.6 72.7 72.7C417.2 296.1 384.6 328.7 344.5 328.7z"/>
             </svg>
           </a>
          </li>
          <li><a href="#" class="github" title="github">
           <svg viewbox="0 0 512 512">
             <path d="M256 70.7c-102.6 0-185.9 83.2-185.9 185.9 0 82.1 53.3 151.8 127.1 176.4 9.3 1.7 12.3-4 12.3-8.9V389.4c-51.7 11.3-62.5-21.9-62.5-21.9 -8.4-21.5-20.6-27.2-20.6-27.2 -16.9-11.5 1.3-11.3 1.3-11.3 18.7 1.3 28.5 19.2 28.5 19.2 16.6 28.4 43.5 20.2 54.1 15.4 1.7-12 6.5-20.2 11.8-24.9 -41.3-4.7-84.7-20.6-84.7-91.9 0-20.3 7.3-36.9 19.2-49.9 -1.9-4.7-8.3-23.6 1.8-49.2 0 0 15.6-5 51.1 19.1 14.8-4.1 30.7-6.2 46.5-6.3 15.8 0.1 31.7 2.1 46.6 6.3 35.5-24 51.1-19.1 51.1-19.1 10.1 25.6 3.8 44.5 1.8 49.2 11.9 13 19.1 29.6 19.1 49.9 0 71.4-43.5 87.1-84.9 91.7 6.7 5.8 12.8 17.1 12.8 34.4 0 24.9 0 44.9 0 51 0 4.9 3 10.7 12.4 8.9 73.8-24.6 127-94.3 127-176.4C441.9 153.9 358.6 70.7 256 70.7z"/>
         </svg>
       </a>
          </li>
          <li>
            <a href="#" class="icon-17 linkedin" title="LinkedIn">
         <svg viewbox="0 0 512 512">
           <path d="M186.4 142.4c0 19-15.3 34.5-34.2 34.5 -18.9 0-34.2-15.4-34.2-34.5 0-19 15.3-34.5 34.2-34.5C171.1 107.9 186.4 123.4 186.4 142.4zM181.4 201.3h-57.8V388.1h57.8V201.3zM273.8 201.3h-55.4V388.1h55.4c0 0 0-69.3 0-98 0-26.3 12.1-41.9 35.2-41.9 21.3 0 31.5 15 31.5 41.9 0 26.9 0 98 0 98h57.5c0 0 0-68.2 0-118.3 0-50-28.3-74.2-68-74.2 -39.6 0-56.3 30.9-56.3 30.9v-25.2H273.8z"/>
         </svg>
         </a>
          </li>
          <li>
            <a href="#" class="icon-4 codepen" title="codepen">
             <svg viewbox="0 0 512 512">
               <path d="M427 201.9c-0.6-4.2-2.9-8-6.4-10.3L264.2 87.3c-4.9-3.3-11.4-3.3-16.3 0L91.4 191.6c-4 2.7-6.5 7.4-6.5 12.2v104.3c0 4.8 2.5 9.6 6.5 12.2l156.4 104.3c4.9 3.3 11.4 3.3 16.3 0L420.6 320.4c4-2.6 6.6-7.4 6.6-12.2V203.9C427.1 203.2 427.1 202.6 427 201.9 427 201.7 427.1 202.6 427 201.9zM270.7 127.1l115.2 76.8 -51.5 34.4 -63.8-42.7V127.1zM241.3 127.1v68.6l-63.8 42.7 -51.5-34.4L241.3 127.1zM114.3 231.4l36.8 24.6 -36.8 24.6V231.4zM241.3 384.9L126.1 308.1l51.5-34.4 63.8 42.6V384.9zM256 290.8l-52-34.8 52-34.8 52 34.8L256 290.8zM270.7 384.9V316.3l63.8-42.6 51.5 34.4L270.7 384.9zM397.7 280.6l-36.8-24.6 36.8-24.6V280.6z"/>
             </svg>
           </a>
          </li>
        </ul>
      </div> -->
      <!-- <div class="box">
        <h3 class="title">Portfolio</h3>
        <a class="link" href="#">MY LATEST WORK</a>
      </div> -->
      <div class="box">
        <h3 class="title">Skills</h3>
        <div class="skills">
          <!-- <h4>Coding</h4> -->
          <ul>
            @foreach($user_skills as $user_skill)
            <li class="skill-title">
              <p>{{ $user_skill->job_skill}}</p>
              <p>{{ $user_skill->job_experience }}</p>
            </li>
            @endforeach
            <!-- <li><span class="ill tn"></span><b>HTML5</b></li> -->
            <!-- <li><span class="fill ten"></span><b>CSS3 and SCSS</b></li>
            <li><span class="fill nine"></span><b>Javascript&Jquery</b></li>
            <li><span class="fill three"></span><b>ES6</b></li>
            <li><span class="fill three"></span><b>PHP</b></li>
            <li><span class="fill seven"></span><b>Wordpress</b></li>
            <li><span class="fill three"></span><b>Vue</b></li> -->
          </ul>
          <!-- <h4>Design</h4>
          <ul>
            <li><span class="fill five"></span><b>Analog Channels</b></li>
            <li><span class="fill nine"></span><b>Digital Channels</b></li>
          </ul> -->
          <!-- <h4>Tools</h4>
          <ul>
            <li><span class="fill seven"></span><b>MAMP</b></li>
            <li><span class="fill seven"></span><b>Bitbucket</b></li>
            <li><span class="fill five"></span><b>Adobe Photoshop</b></li>
            <li><span class="fill nine"></span><b>Adobe Illustrator</b></li>
            <li><span class="fill nine"></span><b>Sketch</b></li>
            <li><span class="fill seven"></span><b>Zeplin</b></li>
            <li><span class="fill nine"></span><b>Flinto</b></li>
            <li><span class="fill five"></span><b>Invision</b></li>
          </ul> -->
        </div>
      </div>
      <!-- <div class="btn-box">
        <button type="button" name="button" id="print-btn">Print My Resume</button>
      </div> -->
    </section>
    <section class="detail">
      <header class="">
        <!-- <h1>Me Peach</h1> -->
        <h1>{{ $user->first_name . ' ' . $user->last_name }}</h1>

      </header>
      <div class="sub-header">
        <h4 id="type-js">
          <em class="text-js">{{ $user_meta->career_level }}</em>
        </h4>
      </div>
      <div class="box">
        <h3 class="title">About me</h3>
        <p>{{$user->getProfileSummary('summary')}}</p>
      </div>
      <div class="box">
        <h3 class="title">Work-Experience</h3>

        @foreach($user_experience as $user_exp)
          <!-- <h4>UX / UI Designer - Aleph Co.,Ltd.<span>SEP 2017 - Present</span></h4> -->
          <h4>{{ $user_exp->title . ' - ' . $user_exp->company . ' ('. $user_exp->city_name.')' }}
            <span>
          {{ date('M, Y', strtotime($user_exp->date_start)) . ' - ' . date('M, Y', strtotime($user_exp->date_end)) }}
          </span></h4>
          <p>{{$user_exp->description}}</p>
        @endforeach
         <!-- <h4>UX / UI Designer - Aleph Co.,Ltd.<span>SEP 2017 - Present</span></h4>
         <ul>
          <li>Attend the workshop or the meeting with client to collect the requirement ie. GUT testing, UT testing, card sorting, A/B testing</li>
          <li>Collaborate with team members ei. product owner, graphic designer, developer and stakeholders including identify design problems and devise elegant solutions</li>
          <li>Research and create realistic, conceptual customer journeys, wireframes to design the website and mobile application (ie: Bank corporate website, Loyalty program mobile application and Insurance mobile application/web application)</li>
          <li>Deliver designs for digital channels, all the way from rough sketches to pixel-perfect interacts including developing wireframes, prototypes and task flows based on user needs</li>
          <li>Setting up A/B tests or Usability tests including gather feedback</li>
          <li>Deliver a development reviewing all defects about the UI part</li>
        </ul>
        <h4>Web Developer - E-bird(Thailand) Co.,Ltd.<span>OCT 2017 - SEP 2016</span></h4>
        <ul>
          <li>Developed the website template layouts with PHP, HTML5 and CSS3</li>
          <li>Duplicated or created a multi languages website using PHP and XML</li>
          <li>Fixed issues that are discovered in the existing code</li>
          <li>Did on site SEO implementations to increase traffic to client websites</li>
          <li>Developed and integrate a website function by using jquery and update data by JSON</li>
          <li>Created a responsive website from desktop base website</li>
          <li>Converted design (PSD, AI) specifications into a functional php website</li>
          <li>Created Intranet UI modules from PSD design and support to Back end developers for Front end issues especially a cross-browser compatibility issues</li>
        </ul>
        <h4>Web Developer - Outsourcify Co. Ltd.<span>MAR 2014 - OCT 2016</span></h4>
        <ul>
          <li>Converted client’s designs (PSD, AI) or word ideas specifications into a functional website focus on open sources technologies</li>
          <li>Developed wireframes from a customer requirement</li>
          <li>Designed and created graphic content such as logo images, icons or banners</li>
          <li>Developed or fix a UI, Intranet modules and Website across major devices and resolutions (from Mobile, Tablet and Desktop), also a cross-browser compatibility issues (Chrome, Firefox, IE10+, Safari)</li>
          <li>Created and maintained the front-end production of Javascript, HTML, and CSS (and PHP for the wordpress blog).</li>
          <li>Created custom plugins, templates, and functions for Wordpress based sites</li>
          <li>Supported to Back-end developers for Front-end issues</li>
          <li>Developed apps e-learning modules using pure javascript/HTML5 from customer design or Flash</li>
          <li>Discussed with team and customers to collect a requirement and write SRS</li>
        </ul>
          <h4>Freelance<span>MAR 2013 - OCT 2017</span></h4>
        <ul>
          <li>Designed a graphic element such as banner, logo and web template</li>
          <li>Developed and designed HTML5 templates</li>
        </ul> -->
        <!-- <h3 class="title">School-Experience</h3>
        <h4>
          iNCEB2015: Conference The 10th International Conference on e-Business
          <span>November 23rd - 24th , 2015</span>
        </h4>
        <dl class="detail">
          <dt>Paper</dt>
          <dd>Effect of Using Human Images in Product Presentation of E-Commerce Website on Trust, Fixation and Purchase Intention: A Design of Experiment
          </dd>
          <dt>Place</dt>
          <dd>Chatrium Hotel Riverside, Bangkok, Thailand</dd>
          <dt>Source</dt>
          <dd>http://www.inceb2015.sit.kmutt.ac.th/paper/P09Timaporn.pdf</dd>
        </dl>
        <h4>
          ICEB 2015: Conference The 15th International Conference on Electronic Business
          <span>December 6-10, 2015</span>
        </h4>
        <dl class="detail">
          <dt>Paper</dt>
          <dd>Effect Of Using Human Images In Product Presentation Of E-Commerce Website On Trust, Fixation And Purchase Intention” The 15th Experiment
          </dd>
          <dt>Place</dt>
          <dd>Hyatt Regency Hotel, CUHK, ShaTin, Hong Kong</dd>
          <dt>Source</dt>
          <dd>http://cuir.car.chula.ac.th/handle/123456789/50090</dd>
        </dl> -->
      </div>
      <div class="box">
        <h3 class="title">Education</h3>
        @foreach($user_educations as $user_edu)
          <h4>{{$user_edu->degree_level . ' - ' . $user_edu->degree_type }} <span>{{ $user_edu->date_completion . ' - ' . $user_edu->city }}</span></h4>
          <p class="semi-bold">{{ $user_edu->degree_title . ' (' . $user_edu->institution . ')' }}</p> 
          <p>{{ $user_edu->major_subject }}</p>
        @endforeach

        <!-- <h4>Master’s Degree <span>(May 2013 – DECEMBER 2015)</span></h4>
        <p>Science Program in Business Software Development Department of Statistics Faculty of Commerce and Accountancy, Chulalongkorn University</p>
        <h4>Bachelor’s Degree <span>(May 2008 - June 2012)</span></h4>
        <p>College of Engineering, Major Computer Engineering Rangsit University</p>
        <h4>High School <span>(April 2005 - MARCH 2008)</span></h4>
        <p>Satri Thungsong School, Major Science-Math</p> -->
      </div>
      <div class="box">
        <h3 class="title">Skills</h3>
        <div class="skills">
          <!-- <h4>Coding</h4> -->
          <ul>
            @foreach($user_skills as $user_skill)
            <li class="skill-title">
              <p>{{ $user_skill->job_skill}}</p>
              <p>{{ $user_skill->job_experience }}</p>
            </li>
            @endforeach
            <!-- <li><span class="ill tn"></span><b>HTML5</b></li> -->
            <!-- <li><span class="fill ten"></span><b>CSS3 and SCSS</b></li>
            <li><span class="fill nine"></span><b>Javascript&Jquery</b></li>
            <li><span class="fill three"></span><b>ES6</b></li>
            <li><span class="fill three"></span><b>PHP</b></li>
            <li><span class="fill seven"></span><b>Wordpress</b></li>
            <li><span class="fill three"></span><b>Vue</b></li> -->
          </ul>
          <!-- <h4>Design</h4>
          <ul>
            <li><span class="fill five"></span><b>Analog Channels</b></li>
            <li><span class="fill nine"></span><b>Digital Channels</b></li>
          </ul> -->
          <!-- <h4>Tools</h4>
          <ul>
            <li><span class="fill seven"></span><b>MAMP</b></li>
            <li><span class="fill seven"></span><b>Bitbucket</b></li>
            <li><span class="fill five"></span><b>Adobe Photoshop</b></li>
            <li><span class="fill nine"></span><b>Adobe Illustrator</b></li>
            <li><span class="fill nine"></span><b>Sketch</b></li>
            <li><span class="fill seven"></span><b>Zeplin</b></li>
            <li><span class="fill nine"></span><b>Flinto</b></li>
            <li><span class="fill five"></span><b>Invision</b></li>
          </ul> -->
        </div>
      </div>

      <!-- <div class="box">
        <h3 class="title">Get in Touch</h3>
      </div> -->
    </section>
    <footer>

    </footer>
  </div>


</body>

</html>
