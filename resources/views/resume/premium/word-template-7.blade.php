<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body><table>
        <tr>
            <td style="width: 25pt;"></td>
            <td><p style="font-size:24pt; font-weight:bold; line-height:1;">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p>@isset($user_meta->career_level)<p style="font-size:14pt; color:#F65C5C; line-height:1;"><b>{{$user_meta->career_level}}</b></p>@endisset<table>
                    <tr>
                        <td style="width:250px;"><p style="font-size:12pt; line-height:1;">@isset($user->email)<img src="{{asset('/word-icons/word6-icon-1.png')}}" alt="" height="14" width="17"> {{ $user->email }}@endisset</p></td>
                        <td style="width:250px;"><p style="font-size:12pt; line-height:1;">@isset($user->mobile_num)<img src="{{asset('/word-icons/word6-icon-2.png')}}" alt="" height="14" width="14">{{ $user->mobile_num }}@endisset</p></td>    
                        <td style="width:250px;"><p style="font-size:12pt; line-height:1;">@if(isset($user->country) || isset($user->state) || isset($user->city))<img src="{{asset('/word-icons/word6-icon-3.png')}}" alt="" height="15" width="14">{{ $user->city . ', ' . $user->state . ', ' . $user->country }} @endif</p></td>
                    </tr>
                </table></td>
            <td style="width: 25pt;"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width:50px;"></td>
            <td style="width:350px">@if (isset($user->father_name) ||
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
                isset($user->video_link))<p style="font-weight:bold; font-size:18pt; line-height:1; padding:0; margin:0;">PERSONAL DETAILS<img src="{{asset('/word-icons/word6-border-1.png')}}" height="5" width="450" alt="" style="line-height: 1;"> </p><table>
                @isset($user->father_name)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Father Name :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->father_name }}</p></td>
                    </tr>
                @endisset
                @isset($user->date_of_birth)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Date of Birth :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                    </tr>
                @endisset
                @isset($user->gender_id)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Gender :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->gender }}</p></td>
                    </tr>
                @endisset
                @isset($user->marital_status)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Marital Status :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->marital_status }}</p></td>
                    </tr>
                @endisset
                @isset($user->nationality)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Nationality :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->nationality }}</p></td>
                    </tr>
                @endisset
                @isset($user->job_experience)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Job Experience :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->job_experience }}</p></td>
                    </tr>
                @endisset
                @isset($user->industry)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Industry :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->industry }}</p></td>
                    </tr>
                @endisset
                @isset($user->functional_area)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Functional Area :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->functional_area }}</p></td>
                    </tr>
                @endisset
                @isset($user->video_link)
                    <tr>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">Video Profile :</p></td>
                        <td><p style="line-height:1.4; font-size:12pt; padding:0; margin:0;">{{ $user->video_link }}</p></td>
                    </tr>
                @endisset</table>@endif @if(count($user_experience) > 0)<p style="font-weight:bold; font-size:18pt; line-height:1; padding:0; margin:0;"><b>WORK EXPERIENCE</b><img src="{{asset('/word-icons/word6-border-1.png')}}" height="5" width="450" alt="" style="line-height: 1;"> </p><table>
                    @foreach($user_experience as $user_exp)
                        <tr><td><p style="font-size: 12pt; margin:0; padding:0;">{{ $user_exp->title }}</p></td></tr>
                        <tr><td><p style="font-size: 13pt; color:#F65C5C; font-weight:bold; margin:0; padding:0;">{{ $user_exp->company }}</p></td></tr>
                        <tr><td><table><tr><td><p style="font-size: 12pt; margin:0; padding:0;"><img src="{{asset('/word-icons/word6-icon-4.png')}}" alt="" height="14" width="16">{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                        @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</b></p></td>
                        <td><p style="font-size: 12pt; margin:0; padding:0;"><img src="{{asset('/word-icons/word6-icon-3.png')}}" alt="" height="15" width="14">{{$user_exp->city_name}}</p></td></tr></table></td>
                        </tr>
                        <tr><td><p style="font-size: 11pt; margin:0; padding:0;">{{$user_exp->description}}<br></p></td></tr>
                    @endforeach
                </table>@endif @if(count($user_projects) > 0)<p style="font-weight:bold; font-size:18pt; line-height:1; padding:0; margin:0;"><b>PROJECTS</b><img src="{{asset('/word-icons/word6-border-1.png')}}" height="5" width="450" alt="" style="line-height: 1;"> </p><table>
                        @foreach($user_projects as $project)
                            <tr><td><p style="font-size: 12pt; line-height:1;"><table><tr><td style="width:160pt; font-size: 12pt; line-height:1">{{ $project->name }}</td><td style=" width:160pt;"><p style="font-size: 12pt; line-height:1;">{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</p></td></tr></table></p></td></tr>
                            <tr><td><p style="font-size: 12pt; line-height:1;color:#F65C5C;"><img src="{{asset('/word-icons/word6-icon-5.png')}}" alt="" height="14" width="16">{{ $project->url }}</p></td></tr>
                            <tr><td><p style="font-size: 12pt; line-height:1;">{{$project->description}}</p></td></tr>
                        @endforeach
                    </table>
                @endif
            </td>
            <td style="width:50px;"></td>
            <td style="width:250px">@if(count($user_educations) > 0)<p style="font-weight:bold; font-size:18pt; line-height:1; padding:0; margin:0;"><b>EDUCATION</b><img src="{{asset('/word-icons/word6-border-1.png')}}" height="5" width="450" alt="" style="line-height: 1;"> </p><table>
                @foreach($user_educations as $user_edu)
                    <tr><td><p style="font-size: 12pt; line-height:1; margin:0; padding:0;">{{ $user_edu->institution }}</p></td></tr>
                    <tr><td><p style="font-size: 12pt; line-height:1; margin:0; padding:0; color:#F65C5C;"><b>{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</b></p></td></tr>
                    <tr><td><p style="font-size: 12pt; line-height:1; margin:0; padding:0;"><img src="{{asset('/word-icons/word6-icon-4.png')}}" alt="" height="14" width="16">{{ $user_edu->date_completion}}</p></td></tr>
                    <tr><td><p style="font-size: 12pt; line-height:1; margin:0; padding:0;"><img src="{{asset('/word-icons/word6-icon-3.png')}}" alt="" height="15" width="14">{{ $user_edu->city }}<br></p></td></tr>
                @endforeach
                </table>@endif 
                @if(count($user_skills) > 0)<p style="font-weight:bold; font-size:18pt; line-height:1; padding:0; margin:0;"><b>SKILLS</b><img src="{{asset('/word-icons/word6-border-1.png')}}" height="5" width="450" alt="" style="line-height: 1;"> </p><ul style="padding: 0; margin:0;">@foreach($user_skills as $user_skill)<li  style="padding: 0pt; margin:0pt; line-height:1;"><p style="font-size: 12pt; line-height:1; margin:0pt; padding:0pt;">{{ $user_skill->job_skill }} - <span style="color:#F65C5C;"><b>{{ $user_skill->job_experience }}</b></span></p></li>@endforeach</ul>@endif 
                @if(count($user_languages) > 0)<p style="font-weight:bold; font-size:18pt; line-height:1; padding:0; margin:0;"><b>LANGUAGES</b><img src="{{asset('/word-icons/word6-border-1.png')}}" height="5" width="450" alt="" style="line-height: 1;"> </p><ul style="padding: 0; margin:0;">@foreach($user_languages as $user_language)<li  style="padding: 0pt; margin:0pt; line-height:1;"><p style="font-size: 12pt; line-height:1; margin:0pt; padding:0pt;">{{ $user_language->lang }} - <span style="color:#F65C5C;"><b>{{ $user_language->language_level }}</b></span></p></li>@endforeach</ul>@endif
            </td>
            <td style="width:50px;"></td>
            </tr>
        </table>
</body>
</html>