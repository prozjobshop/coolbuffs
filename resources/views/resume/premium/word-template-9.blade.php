<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td style="width: 15pt;"></td>
            <td style="width: 300pt;"><p style="color:#4459A2; font-size:24pt; font-weight:bold;">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p>@isset($user_meta->career_level)<p style="color:#3FB180; font-size:12pt;">{{$user_meta->career_level}}</p>@endisset</td>
            <td style="width: 220pt; text-align:center;"><?php
                if(Auth::user()->image && file_exists(public_path('user_images/' . Auth::user()->image))){
                    $user_imgg = 'user_images/'.Auth::user()->image;
                }else{
                    $user_imgg = 'resumes/user-2.png';
                }
                ?><img class="img-tag" src="{{ asset($user_imgg) }}" alt="Profile Image" height="200" width="200"></td>
            <td style="width: 300pt; text-align:right;"><table>
                    @isset($user->email)<tr><td><p style="text-align: right; color:#4459A2; text-align: right;">{{ $user->email }} <img src="{{asset('/word-icons/word10-icon-1.png')}}" alt="" height="11" width="17" style="margin-top:10pt;"></p></td></tr>@endisset
                    @isset($user->mobile_num)<tr><td><p style="text-align: right;">{{ $user->mobile_num }} <img src="{{asset('/word-icons/word10-icon-2.png')}}" alt="" height="11" width="15"></p></td></tr>@endisset
                    @if(isset($user->country) || isset($user->state) || isset($user->city))<tr><td><p style="text-align: right;">{{ $user->city . ', ' . $user->state . ', ' . $user->country }} <img src="{{asset('/word-icons/word10-icon-3.png')}}" alt="" height="11" width="15"></p></td></tr>@endif
                </table></td>
            <td style="width: 15pt;"></td>
        </tr><tr>
            <td style="width: 15pt;"></td>
            <td colspan="3"><img src="{{asset('/word-icons/word10-border-1.png')}}" alt="" height="5" width="780"></td>
            <td style="width: 15pt;"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width:20pt;"></td>
            <td style="width:350pt">@if(isset($user->father_name) ||
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
                isset($user->video_link))<p style="font-size:18pt; padding:0; margin:0; font-weight:bold">PERSONAL DETAILS</p><table>
                @isset($user->father_name)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Father Name :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->father_name }}</p></td>
                    </tr>
                @endisset
                @isset($user->date_of_birth)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Date of Birth :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                    </tr>
                @endisset
                @isset($user->gender_id)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Gender :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->gender }}</p></td>
                    </tr>
                @endisset
                @isset($user->marital_status)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Marital Status :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->marital_status }}</p></td>
                    </tr>
                @endisset
                @isset($user->nationality)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Nationality :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->nationality }}</p></td>
                    </tr>
                @endisset
                @isset($user->job_experience)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Job Experience :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->job_experience }}</p></td>
                    </tr>
                @endisset
                @isset($user->industry)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Industry :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->industry }}</p></td>
                    </tr>
                @endisset
                @isset($user->functional_area)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Functional Area :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->functional_area }}</p></td>
                    </tr>
                @endisset
                @isset($user->video_link)
                    <tr>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">Video Profile :</p></td>
                        <td style="width:150pt;"><p style="line-height:1.3; font-size:11pt; font-style:italic; padding:0; margin:0;">{{ $user->video_link }}</p></td>
                    </tr>
                @endisset
                </table>
            @endif  @if(count($user_experience) > 0)<p style="font-weight:bold; font-size:18pt; padding:0; margin:0;"><b>WORK EXPERIENCE</b></p><table>
                @foreach($user_experience as $user_exp)
                    <tr><td><p style="font-size: 11pt; margin:0; padding:0;"><b>{{$user_exp->title }}</b></p></td></tr>
                    <tr><td><p style="font-size: 11pt; margin:0; padding:0;">{{ $user_exp->company }}</p></td></tr>
                    <tr><td><p style="font-size: 11pt; margin:0; padding:0; color:#3FB180;"><i>{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                    @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</i></p></td></tr>
                    <tr><td><p style="font-size: 11pt; color:#3FB180;"><i>Achievements/Tasks</i></p></td></tr>
                    <tr><td><p style="font-size: 11pt;">{{$user_exp->description}}</p></td></tr>
                @endforeach
            </table>
            @endif @if(count($user_educations) > 0)<p style="font-weight:bold; font-size:18pt; padding:0; margin:0;"><b>EDUCATION</b></p><table>
                @foreach($user_educations as $user_edu)
                    <tr><td><p style="font-size: 14pt; line-height:1;"><b>{{ $user_edu->institution }}</b></p></td></tr>
                    <tr><td><p style="font-size: 12pt; line-height:1;">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</p></td></tr>
                    <tr><td><p style="font-size: 11pt; line-height:1; font-style:italic; color:#3FB180;">{{ $user_edu->date_completion . ' | ' . $user_edu->city }}</p></td></tr>
                @endforeach
            </table>
        @endif
            </td>
            <td style="width:20pt;"></td>
            <td style="width:300pt;">@if(count($user_skills) > 0)<p style="font-weight:bold; font-size:18pt; padding:0; margin:0;"><b>TECHNICAL SKILLS</b></p><table>
                    @foreach($user_skills as $user_skill)
                        <tr><td><p style="font-size: 11pt; line-height:1; margin:0; padding:0;"><br>{{ $user_skill->job_skill }}</p></td></tr>
                        <tr><td><p style="font-size: 11pt; line-height:1; margin:0; padding:0;"><img src="{{asset('/word-icons/word10-border-2.png')}}" alt="" height="5" width="300"><br></p></td></tr>
                        <tr><td><p style="font-size: 11pt; line-height:1; margin:0; padding:0;">{{ $user_skill->job_experience }}</p></td></tr>
                    @endforeach
                </table>
                @endif  @if(count($user_projects) > 0)<p style="font-weight:bold; font-size:18pt; padding:0; margin:0;"><b>PERSONAL PROJECTS</b></p><table>
                        @foreach($user_projects as $project)
                            <tr><td><p style="font-size: 11pt; line-height:1;">{{ $project->name }}</p></td></tr>
                        @endforeach
                    </table>
                @endif </td>
            <td style="width:20pt;"></td>
        </tr>
    </table>
</body>
</html>