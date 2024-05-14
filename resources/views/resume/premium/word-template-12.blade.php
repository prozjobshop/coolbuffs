<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body><table style="padding:0; margin:0;">
        <tr>
            <td><table style="margin:0; padding:0;">
                    <tr>
                        <td style="width: 15pt;"></td>
                        <td style="width:450pt"><p style="font-size:24pt; font-weight:bold; line-height:1;">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p><p>@isset($user_meta->career_level)<span style="font-size:12pt; line-height:1;">{{$user_meta->career_level}}</span><br>@endisset<br>@if($user->getProfileSummary('summary'))<span style="font-size:12pt; line-height:1.15;">{{$user->getProfileSummary('summary')}}</span>@endif</p></td>
                        <td style="width: 250pt; text-align:right;"><table style="margin:0; padding:0;">
                            @isset($user->email)<tr><td><p style="text-align: right; color:#0000ff; font-size:11pt;"><u>{{ $user->email }}</u> <img src="{{asset('/word-icons/word5-icon-1.png')}}" alt="" height="12" width="15"></p></td></tr>@endisset
                            @isset($user->mobile_num)<tr><td><p style="text-align: right; font-size:11pt;">{{ $user->mobile_num }} <img src="{{asset('/word-icons/word5-icon-2.png')}}" alt="" height="12" width="16"></p></td></tr>@endisset
                            @if(isset($user->country) || isset($user->state) || isset($user->city))<tr><td><p style="text-align: right; font-size:11pt;">{{ $user->city . ', ' . $user->state . ', ' . $user->country }} <img src="{{asset('/word-icons/word5-icon-3.png')}}" alt="" height="12" width="15"></p></td></tr>@endif
                        </table></td>
                        <td style="width: 15pt;"></td>
                    </tr>
                </table></td>
        </tr>
        <tr><td><table>
            <tr><td style="width: 15pt;"> </td>
                <td style="text-align: center;"><img src="{{asset('/word-icons/word5-border-1.png')}}" height="5" width="786" alt=""></td>
                <td style="width: 15pt;"> </td></tr>
        </table></td></tr><tr>
        <td><table style=" margin:0; padding:0;">
        <tr>
            <td style="width:20pt;"></td>
            <td style="width:350pt;">@if(isset($user->father_name) ||
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
                isset($user->video_link))<p style="font-weight:bold; font-size:18pt;">PERSONAL DETAILS</p><table>
                @isset($user->father_name)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Father Name :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->father_name }}</p></td>
                    </tr>
                @endisset
                @isset($user->date_of_birth)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Date of Birth :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                    </tr>
                @endisset
                @isset($user->gender_id)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Gender :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->gender }}</p></td>
                    </tr>
                @endisset
                @isset($user->marital_status)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Marital Status :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->marital_status }}</p></td>
                    </tr>
                @endisset
                @isset($user->nationality)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Nationality :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->nationality }}</p></td>
                    </tr>
                @endisset
                @isset($user->job_experience)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Job Experience :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->job_experience }}</p></td>
                    </tr>
                @endisset
                @isset($user->industry)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Industry :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->industry }}</p></td>
                    </tr>
                @endisset
                @isset($user->functional_area)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Functional Area :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->functional_area }}</p></td>
                    </tr>
                @endisset
                @isset($user->video_link)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">Video Profile :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.15; margin:0; padding:0; font-size:11pt; font-style:italic;">{{ $user->video_link }}</p></td>
                    </tr>
                @endisset
                </table>@endif @if(count($user_educations)>0)<p style="font-weight:bold; font-size:18pt;"><b>EDUCATION</b></p>@foreach($user_educations as $user_edu)<p style="font-size: 11pt; line-height:1;"><b>{{ $user_edu->institution }}</b></span><br><span style="font-size: 11pt; line-height:1;">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</span><br><span style="font-size: 11pt; line-height:1; font-style:italic;">{{ $user_edu->date_completion . ' | ' . $user_edu->city }}</span></p>@endforeach @endif<?php 
                ?>@if(count($user_experience) > 0)<p style="font-weight:bold; font-size:18pt;"><b>WORK EXPERIENCE</b></p>@foreach($user_experience as $user_exp)<p style="font-size: 11pt;"><b>{{$user_exp->title }}</b></span><br><span>{{ $user_exp->company }}</span><br><span style="font-size: 12pt;"><i>{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                    @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</i></span><br><span><i>{{ $user_exp->city_name }}</i></span><br><br><span style="font-size: 12pt;">{{$user_exp->description}}</span></p>@endforeach @endif<?php 
                ?>@if(count($user_languages)>0)<p style="font-weight:bold; font-size:18pt;"><b>LANGUAGES</b></p>@foreach($user_languages as $user_language)<p style="font-size: 11pt; line-height:1; margin:0; padding:0;">{{ $user_language->lang }}</p>@endforeach @endif
            </td>
            <td style="width:20pt"></td>
            <td style="width:250pt">@if(count($user_skills) > 0)<p style="font-weight:bold; font-size:18pt;"><b>TECHNICAL SKILLS</b></p>@foreach($user_skills as $user_skill)<p><span style="font-size: 12pt; line-height:1;"><span>{{ $user_skill->job_skill }}</span><img src="{{asset('/word-icons/word5-border-2.png')}}" height="5" width="350" alt=""><span style="font-size: 12pt; line-height:1;">{{ $user_skill->job_experience }}</span></p>@endforeach @endif<?php
        ?>@if(count($user_projects)>0)<p style="font-weight:bold; font-size:18pt;"><b>PROJECTS</b></p>@foreach($user_projects as $project)<p><span style="font-size: 11pt; line-height:1;"><b>{{ $project->name }}</b></span><br><span style="font-size: 11pt; line-height:1;"> <i>{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</i></span><br><br><span style="font-size: 11pt; line-height:1;">{{$project->description}}</span></p>@endforeach @endif
            </td>
            <td style="width:20pt"></td>
        </tr>
        </table></td></tr>
    </table>
</body>
</html>