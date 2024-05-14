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
            <td style="background-color:#0bb5f4; width:250pt; height:100%;">
                <table>
                    <tr>
                        <td style="text-align: center;">
                        
                        
                        <?php
                        if (Auth::user()->image && file_exists(public_path('user_images/' . Auth::user()->image))) {
                            $user_imgg = 'user_images/' . Auth::user()->image;
                        } else {
                            $user_imgg = 'resumes/user-2.png';
                        }
                        ?><img
                                src="{{asset($user_imgg)}}" alt="profile_pic"
                                width="200" height="200" style="margin-top:30pt; object-fit:cover">
                        </td>
                    </tr>
                    <tr>
                        <td><table>
                                <tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="color: #ffffff; font-size:16pt; font-family:calibri; padding:0;"><b>{{$user->first_name.' ' .$user->middle_name.' '.$user->last_name}}</b></p></td>
                                </tr>
                                @isset($user_meta->career_level)<tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="color: #b1eaff; font-size:11pt; padding:0; margin:0;">{{ $user_meta->career_level }}</p></td>
                                </tr>@endisset</table><table> @if(isset($user->country) || isset($user->state) || isset($user->city))<tr>
                                    <td style="width:18pt"></td>
                                    <td style="width:50pt; height:18pt"><img src="{{asset('/word-icons/word-icon-1.png')}}" alt=""></td>
                                    <td><p style="color: #b1eaff; font-size:11pt; line-height:1;">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</p></td>
                                </tr>@endif
                                @isset($user->mobile_num)<tr>
                                    <td style="width:18pt"></td>
                                    <td style="width:50pt; height:18pt"><img src="{{asset('/word-icons/word-icon-2.png')}}" alt=""></td>
                                    <td><p style="color: #b1eaff; font-size:11pt; line-height:1; margin-top:5pt">{{ $user->mobile_num }}</p></td>
                                </tr>@endisset
                                @isset($user_meta->email)<tr>
                                    <td style="width:18pt"></td>
                                    <td style="width:50pt; height:18pt"><img src="{{asset('/word-icons/word-icon-3.png')}}" alt=""></td>
                                    <td><p style="color: #b1eaff; font-size:11pt; line-height:1; margin-top:5pt">{{ $user_meta->email }}</p></td>
                                </tr>@endisset </table><table><tr><td style="width:18pt;"></td><td><img src="{{asset('/word-icons/word-border-1.png')}}" alt="" width="370" height="10"></td><td style="width:18pt;"></td></tr></table>
                        </td>
                    </tr>
                    @if(count($user_skills) > 0)<tr>
                        <td><table>
                                <tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="color: #ffffff; font-size:16pt;"><b>SKILLS</b></p></td>
                                </tr>
                                @foreach ($user_skills as $user_skill)<tr>
                                    <td style="width:18pt; padding:0; margin:0;"></td>
                                    <td><p style="color: #b1eaff; font-size:11pt; line-height:1; margin:0; padding:0;">{{ $user_skill->job_skill }}<img src="{{asset('/word-icons/word-border-1.png')}}" alt="" width="370" height="5" style="margin: 0; padding:0;">{{ $user_skill->job_experience }}</p><br></td>
                                </tr>@endforeach
                            </table><table><tr><td style="width:18pt;"></td><td><img src="{{asset('/word-icons/word-border-1.png')}}" alt="" width="370" height="10"></td><td style="width:18pt;"></td></tr></table>
                        </td>
                    </tr>@endif
                </table>
            </td>
            <td style="width:34pt;"></td>
            <td style="width:350pt;"><p>@if($user->getProfileSummary('summary'))<p style="color:#0bb5f4; font-size:16pt; font-weight:bold">ABOUT ME</p><p style="color: #555555; line-height:1.15; font-size:12pt;">{{ $user->getProfileSummary('summary') }}<img src="{{asset('/word-icons/word-border-2.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;"></p>@endif</p>@if(isset($user->father_name) ||
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
                    isset($user->video_link))<table><tr><td colspan="2" style="color:#0bb5f4; line-height:1; font-size:16pt; font-weight:bold; padding:0; margin:0;">PERSONAL DETAILS</td></tr>@isset($user->father_name)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Father Name :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->father_name }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr>@endisset @isset($user->date_of_birth)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Date of Birth :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr>@endisset @isset($user->gender_id)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Gender :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->gender }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr> @endisset @isset($user->marital_status)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Marital Status :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->marital_status }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr>@endisset @isset($user->nationality)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Nationality :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->nationality }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr> @endisset @isset($user->job_experience)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Job Experience :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->job_experience }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr> @endisset @isset($user->industry)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Industry :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->industry }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr> @endisset @isset($user->functional_area)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Functional Area :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->functional_area }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr> @endisset @isset($user->video_link)
                        <tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">Video Profile :</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user->video_link }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1" sty><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr> @endisset <tr><td colspan="2" style="line-height:1" ><img src="{{asset('/word-icons/word-border-2.png')}}" alt="" width="500" height="10"></td></tr></table>@endif<p>@if(count($user_experience)>0)<span style="color:#0bb5f4; font-size:16pt; font-weight:bold;">WORK EXPERIENCE</span><ul style="margin:0; padding:0;">@foreach ($user_experience as $user_exp)<li style="margin:0; padding:0;"><p style="color: #555555; line-height:1; font-size: 13pt; margin-bottom:15pt;">{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                        @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</p><br><br><p style="color: #555555; line-height:1; font-size: 13pt;">{{ $user_exp->company . ' | ' . $user_exp->city_name }}</p><br><p style="color: #555555; line-height:1; font-size: 11pt;">{{ $user_exp->title }}</p><br><p style="color: #555555; line-height:1; font-size: 11pt;">{{ $user_exp->description }}</p></li>@endforeach</ul><br><img src="{{asset('/word-icons/word-border-2.png')}}" alt="" width="500" height="10">@endif</p><p>@if(count($user_educations)>0)<span style="color:#0bb5f4; font-size:16pt; font-weight:bold;">EDUCATION</span><ul style="margin: 0; padding:0;">@foreach($user_educations as $user_edu)<li style="margin: 0;  padding:0;"><p style="color: #555555; line-height:1; font-size: 12pt;">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</p><br><p style="color: #555555; line-height:1; font-size: 11pt;">{{ $user_edu->date_completion . ' - ' . $user_edu->city }}</p><br><br><p style="color: #555555; font-size: 12pt;">{{ $user_edu->degree_title . ' (' . $user_edu->institution . ')' }}</p><br><p style="color: #555555; line-height:1; font-size: 11pt;">{{ $user_edu->major_subject }}</p></li>@endforeach</ul><img src="{{asset('/word-icons/word-border-2.png')}}" alt="" width="500" height="10">@endif</p>@if(count($user_languages) > 0)<p style="color:#0bb5f4; font-size:16pt; font-weight:bold; line-height:1; margin:0; padding:0;">LANGUAGES</p><br><table>@foreach($user_languages as $user_language)<tr>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user_language->lang }}</p></td>
                            <td><p style="color: #555555; line-height:1; font-size:12pt; width:150pt; margin:0; padding:0;">{{ $user_language->language_level }}</p></td>
                        </tr><tr><td colspan="2" style="line-height:1"><p style="margin:0; padding:0; line-height:1.5;"><img src="{{asset('/word-icons/word-border-3.png')}}" alt="" width="500" height="10"></p></td></tr>@endforeach</table><img src="{{asset('/word-icons/word-border-2.png')}}" alt="" width="500" height="10">@endif
                </td>
            <td style="width:34pt;"></td>
        </tr>
    </table>

</body>

</html>
