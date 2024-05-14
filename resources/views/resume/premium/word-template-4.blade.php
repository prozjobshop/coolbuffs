
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
            <td style="width:50pt;"></td>
            <td style="width:450pt;"><table>
                    <tr>
                        <td><p style="font-size:18pt; font-weight:bold;line-height:1; padding:0; margin:0;">{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</p>@isset($user_meta->career_level)<p style="font-size:18pt; color:#28B3B5;line-height:1; padding:0; margin:0;">{{$user_meta->career_level}}</p>@endisset<br><table>
                                <tr>
                                    @isset($user->mobile_num)<td style="width:100pt;"><p style="font-size:10pt;"><img src="{{asset('/word-icons/word9-icon-1.png')}}" alt="" height="14" width="16"> {{ $user->mobile_num }}</p></td>@endisset
                                    @isset($user->email)<td style="width:140pt;"><p style="font-size:10pt;"><img src="{{asset('/word-icons/word9-icon-2.png')}}" alt="" height="14" width="18"> {{ $user->email }}  </p></td>@endisset
                                    @if(isset($user->country) || isset($user->state) || isset($user->city))<td style="width:120pt;"><p style="font-size:10pt;"><img src="{{asset('/word-icons/word9-icon-3.png')}}" alt="" height="16" width="14">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</p></td>@endif
                                </tr>
                            </table></td>
                    </tr>
                </table>@if($user->getProfileSummary('summary'))<p style="font-size:16pt; font-weight:bold; line-height:1;">SUMMARY<img src="{{asset('/word-icons/word9-border-1.png')}}" alt="" height="5" width="480"></p><p style="line-height:1; font-size:11pt;">{{ $user->getProfileSummary('summary') }}</p>@endif<?php
                        ?>@if(count($user_experience) > 0)<br><p style="font-weight:bold; font-size:16pt;"><b>WORK EXPERIENCE</b><img src="{{asset('/word-icons/word9-border-1.png')}}" alt="" height="5" width="480"></p>@foreach($user_experience as $user_exp)<table><tr>
                            <td><p style="line-height:1; font-size:11pt;">{{$user_exp->title}}</p></td><td><p style="line-height:1;font-size:11pt;">{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                            <td><p style="color:#28B3B5; line-height:1;font-size:11pt;">{{$user_exp->company}}</p></td><td><p style="line-height:1;font-size:11pt;">{{$user_exp->city_name}}</p></td>
                        </tr></table><p style="line-height:1;font-size:11pt;">{{$user_exp->description}}</p>
                    @endforeach
                @endif @if(count($user_educations) > 0)<p style="font-weight:bold; font-size:16pt; line-height:1;"><b>EDUCATION</b><img src="{{asset('/word-icons/word9-border-1.png')}}" alt="" height="5" width="480"></p><table>
                    @foreach($user_educations as $user_edu)
                    <tr><td><p style="font-size:11pt; line-height:1;">{{ $user_edu->degree_level . ' | ' . $user_edu->degree_type }}</p></td></tr>
                    <tr><td><table><tr><td><p style="color: #28B3B5;font-size:11pt;">{{ $user_edu->institution }}</p></td><td><p style="font-size:11pt;">{{ $user_edu->date_completion }}</p></td></tr></table></td></tr>
                    @endforeach
                </table>
                    @endif
            </td>
            <td style="width:50pt"></td>
            <td style="width:250pt; background-color:#006666; color:#FFFFFF;"><table><tr><td style="width:20pt;"></td><td>@if(isset($user->father_name) ||
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
                isset($user->video_link))
                <p style="font-size:16pt; font-weight:bold; padding:0; margin:0;">PERSONAL DETAILS<img src="{{asset('/word-icons/word9-border-2.png')}}" alt="" height="5" width="300"> </p><table>
                @isset($user->father_name)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Father Name :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->father_name }}</p></td>
                    </tr>
                @endisset
                @isset($user->date_of_birth)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Date of Birth :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                    </tr>
                @endisset
                @isset($user->gender_id)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Gender :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->gender }}</p></td>
                    </tr>
                @endisset
                @isset($user->marital_status)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Marital Status :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->marital_status }}</p></td>
                    </tr>
                @endisset
                @isset($user->nationality)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Nationality :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->nationality }}</p></td>
                    </tr>
                @endisset
                @isset($user->job_experience)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Job Experience :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->job_experience }}</p></td>
                    </tr>
                @endisset
                @isset($user->industry)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Industry :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->industry }}</p></td>
                    </tr>
                @endisset
                @isset($user->functional_area)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Functional Area :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->functional_area }}</p></td>
                    </tr>
                @endisset
                @isset($user->video_link)
                    <tr>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">Video Profile :</p></td>
                        <td><p style="line-height:1.15; font-size:10pt; padding:0; margin:0;">{{ $user->video_link }}</p></td>
                    </tr>
                @endisset
                </table>
            @endif  @if(count($user_skills) > 0)<p style="font-weight:bold; font-size:16pt; padding:0; margin:0;"><b>SKILLS</b><img src="{{asset('/word-icons/word9-border-2.png')}}" alt="" height="5" width="300"> </p><table>
                    @foreach($user_skills as $user_skill)
                        <tr><td><p style="font-size: 11pt; line-height:1;">{{ $user_skill->job_skill }} | <span style="font-weight:bold;">{{ $user_skill->job_experience}}</span></p></td></tr>
                    @endforeach
                </table>
            @endif @if(count($user_languages) > 0)<p style="font-weight:bold; font-size:16pt; padding:0; margin:0;"><b>LANGUAGES</b><img src="{{asset('/word-icons/word9-border-2.png')}}" alt="" height="5" width="300"> </p><table>
                @foreach($user_languages as $user_language)
                    <tr><td><p style="font-size: 11pt; line-height:1;">{{ $user_language->lang }}</p></td></tr>
                @endforeach
            </table>
            @endif</td><td style="width:35pt;"></td></tr></table>
            </td>
        </tr>
    </table>
</body>
</html>

