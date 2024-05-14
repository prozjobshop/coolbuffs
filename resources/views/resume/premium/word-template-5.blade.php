<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body><table style="width: 100%;">
        <tr>
            <td style="background-color: #495862; font-family: 'Times New Roman', Times, serif;"><br><table>
                    <tr>
                        <td style="width: 15pt;"></td>
                        <td style="color:#FFFFFF"><p style="color:#FFFFFF; font-size:24pt; font-weight:bold; line-height:1;">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p>@isset($user_meta->career_level)<p style="color:#FFFFFF; font-size:14pt; line-height:1;">{{$user_meta->career_level}}</p>@endisset<br><table>
                                <tr>
                                    <td style="color:#FFFFFF; font-size:12pt; line-height:1; width:200pt;">@if(isset($user->country) || isset($user->state) || isset($user->city))<img src="{{asset('/word-icons/word4-icon-1.png')}}" alt="" height="16" width="18"> {{ $user->city . ', ' . $user->state . ', ' . $user->country }}  @endif</td>
                                    <td style="color:#FFFFFF; font-size:12pt; line-height:1; width:200pt;">@isset($user->email)   <img src="{{asset('/word-icons/word4-icon-2.png')}}" alt="" height="16" width="20"> {{ $user->email }}@endisset</td>
                                </tr>
                                <tr>
                                    <td style="color:#FFFFFF; font-size:12pt; line-height:1; width:200pt;">@isset($user->mobile_num)<img src="{{asset('/word-icons/word4-icon-3.png')}}" alt="" height="16" width="18"> {{ $user->mobile_num }}@endisset</td>
                                    <td></td>
                                </tr>
                            </table></td>
                        <td><?php
                            if(Auth::user()->image && file_exists(public_path('user_images/' . Auth::user()->image))){
                              $user_imgg = 'user_images/'.Auth::user()->image;
                            }else{
                              $user_imgg = 'resumes/user-sqq.png';
                            }
                          ?><img class="img-tag" src="{{ asset($user_imgg) }}" alt="Profile Image" height="150" width="150"></td>
                        <td style="width: 15pt;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> <table>
        <tr>
            <td style="width:20pt;"></td>
            <td style="width:120pt;">@if($user->getProfileSummary('summary'))<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center; margin:0pt;"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380">PROFILE SUMMARY<img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p><p style="font-size: 11pt;">{{$user->getProfileSummary('summary')}}</p>@endif<?php 
            ?>@if(count($user_experience) > 0)<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"><b>WORK EXPERIENCE</b><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p>@foreach($user_experience as $user_exp)<p style="font-size: 11pt; line-height:1.3; padding:0; margin:0;"><b>{{ $user_exp->company . ' - ' . $user_exp->city_name }}</b></p><p style="font-size: 11pt; line-height:1.3; padding:0; margin:0;"><b>{{ $user_exp->title }} {{date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                        if ($end->day >= $start->day) {
                            $total_months += 1;
                        }
                        $total_years += intdiv($total_months, 12);
                        $total_months %= 12;
                    @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</b></p><p style="font-size: 11pt;">{{$user_exp->description}}</p>@endforeach @endif<?php
                     ?>@if(count($user_projects)>0)<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"><b>PROJECTS</b><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p>@foreach($user_projects as $project)<p style="font-size: 11pt; line-height:1.3; padding:0; margin:0;"><b>{{ $project->name }}</b></p><p style="font-size: 11pt; line-height:1.3; padding:0; margin:0;"><b>{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</b></p><p style="font-size: 11pt; line-height:1.3; padding:0; margin:0;">{{$project->description}}<br></p>@endforeach @endif
            </td>
            <td style="width:20pt;"></td>
            <td style="width:120pt;">@if (isset($user->father_name) ||
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
                isset($user->video_link))<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center; margin:0pt;"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380">PERSONAL DETAILS<img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p><table>
                @isset($user->father_name)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Father Name :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->father_name }}</p></td>
                    </tr>
                @endisset
                @isset($user->date_of_birth)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Date of Birth :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                    </tr>
                @endisset
                @isset($user->gender_id)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Gender :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->gender }}</p></td>
                    </tr>
                @endisset
                @isset($user->marital_status)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Marital Status :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->marital_status }}</p></td>
                    </tr>
                @endisset
                @isset($user->nationality)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Nationality :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->nationality }}</p></td>
                    </tr>
                @endisset
                @isset($user->job_experience)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Job Experience :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->job_experience }}</p></td>
                    </tr>
                @endisset
                @isset($user->industry)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Industry :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->industry }}</p></td>
                    </tr>
                @endisset
                @isset($user->functional_area)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Functional Area :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->functional_area }}</p></td>
                    </tr>
                @endisset
                @isset($user->video_link)
                    <tr>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0; font-weight:bold;">Video Profile :</p></td>
                        <td><p style="line-height:1.5; font-size:11pt; margin:0; padding:0;">{{ $user->video_link }}</p></td>
                    </tr>
                @endisset</table>@endif<?php ?>@if(count($user_educations) > 0)<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"><b>EDUCATION</b><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p>@foreach($user_educations as $user_edu)<p style="font-size: 11pt; line-height:1.3; padding:0; margin:0;"><b>{{ $user_edu->institution }}<br>{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</b><br>{{ $user_edu->date_completion . ' | ' . $user_edu->city }}<br></p>@endforeach @endif<?php ?>@if(count($user_skills)>0)<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"><b>TECHNICAL SKILLS</b><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p><table>
            @foreach($user_skills as $user_skill)
                <tr><td style="font-size: 11pt; line-height:1; padding:0; margin:0;"><b>{{ $user_skill->job_skill }}<img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380">{{ $user_skill->job_experience }}</b></td></tr>
            @endforeach</table>@endif<?php ?>@if(count($user_languages) > 0)<p style="color: #495862; font-weight:bold; font-size:14pt; line-height:1; text-align:center"><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"><b>LANGUAGES</b><img src="{{asset('word-icons/word4-border-1.png')}}" alt="" height="10" width="380"></p><table>
                <tr><td style="font-size: 11pt; line-height:1; padding:0; margin:0;">@foreach($user_languages as $user_language){{ $user_language->lang }} |@endforeach</td></tr>
            </table>@endif</td>
            <td style="width:20pt;"></td>
        </tr>
    </table>
</body>
</html>