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
            <td style="background-color:#39383a; width:240pt;">
                <p style="text-align: center;"><?php
                        if (Auth::user()->image && file_exists(public_path('user_images/' . Auth::user()->image))) {
                            $user_imgg = 'user_images/' . Auth::user()->image;
                        } else {
                            $user_imgg = 'resumes/user.png';
                        }
                        ?><img src="{{asset($user_imgg)}}" alt="profile_pic"
                                width="240" height="220" style="margin-top:30pt; object-fit:cover"></p><table><tr><td style="width:30pt;"></td><td style="width:200pt;">@if($user->getProfileSummary('summary'))<p style="color: #ffffff; font-size:16pt;"><b>ABOUT</b><img src="{{asset('word-icons/word2-border-1.png')}}" alt="" height="10" width="230"></p><br><p style="color: #ababab; font-size:11pt; line-height:1.5;"> {{ $user->getProfileSummary('summary') }}</p>@endif
                        @if(isset($user->mobile_num))<p><span><img src="{{asset('word-icons/word2-icon-1.png')}}" alt="" height="16" width="16"></span><span style="font-size:12pt; line-height:1"> <b>Phone</b></span><p style="color: #ababab; font-size:12pt; margin-top:10pt;"> {{ $user->mobile_num }}</p><img src="{{asset('word-icons/word2-border-1.png')}}" alt="" height="10" width="240"></p>@endif
                        @if(isset($user->email))<p><span><img src="{{asset('word-icons/word2-icon-2.png')}}" alt="" height="16" width="16"></span><span style="font-size:12pt; line-height:1"> <b>Email</b></span><p style="color: #ababab; font-size:12pt; margin-top:10pt;"> {{ $user->email }}</p><img src="{{asset('word-icons/word2-border-1.png')}}" alt="" height="10" width="240"></p>@endif
                        @if(isset($user->country) || isset($user->state) || isset($user->city))<p><span><img src="{{asset('word-icons/word2-icon-3.png')}}" alt="" height="16" width="14"></span><span style="font-size:12pt; line-height:1"> <b>Home</b></span><p style="color: #ababab; font-size:12pt; margin-top:10pt;"> {{ $user->city . ', ' . $user->state . ', ' . $user->country }}</p><img src="{{asset('word-icons/word2-border-1.png')}}" alt="" height="10" width="240"></p>@endif
                        @if(count($user_languages) > 0)<p style="color: #ffffff; font-size:16pt;"><b>LANGUAGES</b><img src="{{asset('word-icons/word2-border-1.png')}}" alt="" height="10" width="230"></p><table>@foreach ($user_languages as $user_language)<tr>
                                        <td><p style="color: #ababab; font-size:12pt; line-height:1;">  {{ $user_language->lang }}</p></td>
                                        <td><p style="color: #ababab; font-size:12pt; line-height:1;">{{ $user_language->language_level }}</p></td>
                                    </tr>@endforeach
                                </table>
                        @endif
                        <table><tr><td style="width: 350pt;"></td></tr></table>
                </td><td style="width:30pt;"></td></tr></table>
            </td>
            <td style="width:50pt;"></td>
            <td style="width:400pt"><table>
                <tr>
                    <td><p style="font-size: 24pt; font-weight:bold; text-align:center;">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p></td>
                </tr>@isset($user_meta->career_level)
                <tr>
                    <td><p style="font-size: 9pt; font-weight:bold; color:#808080; text-align:center;">{{ $user_meta->career_level }}</p></td>
                </tr>@endisset
                @if(isset($user->country) || isset($user->state) || isset($user->city)) <tr>
                    <td><p style="font-size: 12pt; text-align:center;">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</p></td>
                </tr>@endif</table><img src="{{asset('/word-icons/word2-border-2.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;">@if(isset($user->father_name) ||
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
                        isset($user->video_link))<p style="font-size:16pt;">PERSONAL DETAILS<img src="{{asset('/word-icons/word2-border-2.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;"></p><table><tr><td style="width:15pt;"></td><td><table>
                        @isset($user->father_name)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Father Name :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->father_name }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->date_of_birth)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Date of Birth :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->gender_id)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Gender :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->gender }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->marital_status)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Marital Status :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->marital_status }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->nationality)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Nationality :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->nationality }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->job_experience)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Job Experience :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->job_experience }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->industry)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Industry :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->industry }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->functional_area)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Functional Area :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->functional_area }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->video_link)
                            <tr>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">Video Profile :</p></td>
                                <td><p style="line-height:1; font-size:12pt; width:150pt;">{{ $user->video_link }}</p></td>
                            </tr>@endisset
                    </table></td></tr></table>@endif<?php ?>@if(count($user_experience)>0)<p style="font-size:16pt;">EXPERIENCE<img src="{{asset('/word-icons/word2-border-2.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;"></p><table><tr><td style="width:15pt;"></td><td><table>
                        @foreach ($user_experience as $user_exp)  
                            <tr>
                                <td><p style="line-height:1; font-size: 11pt;"><b>{{ $user_exp->title . ' - ' . $user_exp->company . ' ('. $user_exp->city_name.')' }}</b></p></td>
                            </tr>
                            <tr>
                                <td><p style="line-height:1; font-size: 10pt; margin-bottom:15pt; color:#555555;">{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                                @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</p></td>
                            </tr>
                            <tr>
                                <td><p style="line-height:1; font-size: 10pt; color:#777777;">{{ $user_exp->description }}</p><p style="line-height: 1;"><img src="{{asset('/word-icons/word2-border-3.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;"></p></td></tr>
                        @endforeach
                    </table></td></tr></table>@endif<?php ?>@if(count($user_educations)>0)<p style="font-size:16pt; line-height:1;">EDUCATION<img src="{{asset('/word-icons/word2-border-2.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;"></p><table><tr><td style="width:15pt;"></td><td><table>
                        @foreach ($user_educations as $user_edu)
                            <tr>
                                <td><p style="line-height:1; font-size: 11pt;"><b>{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</b></p></td>
                            </tr>
                            <tr>
                                <td><p style="line-height:1; font-size: 10pt; color:#494949;">{{ $user_edu->date_completion . ' - ' . $user_edu->city }}</p></td>
                            </tr>
                            <tr>
                                <td><p style="font-size: 12pt;">{{ $user_edu->degree_title . ' (' . $user_edu->institution . ')' }}</p></td>
                            </tr>
                            <tr>
                                <td><p style="line-height:1; font-size: 12pt;">{{ $user_edu->major_subject }}</p></td>
                            </tr>
                        @endforeach
                    </table></td></tr></table>@endif</p>@if (count($user_skills) > 0)<p style="font-size:16pt;">SKILLS<img src="{{asset('/word-icons/word2-border-2.png')}}" alt="" width="500" height="10" style="padding: 0; margin:0;"></p><table><tr><td style="width:15pt;"></td><td><table>
                        @foreach ($user_skills as $user_skill)
                            <tr>
                                <td><p style="line-height:1; font-size: 11pt;"><b>{{ $user_skill->job_skill }}</b><br><span>{{ $user_skill->job_experience }}</span></p></td>
                            </tr>
                        @endforeach
                    </table></td></tr></table>@endif
            </td>
            <td style="width:50pt;"></td>
        </tr>
    </table>

</body>

</html>
