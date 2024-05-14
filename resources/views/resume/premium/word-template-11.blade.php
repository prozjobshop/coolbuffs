<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body><table style="">
        <tr>
            <td style="width:250pt"><table>
                    <tr>
                        <td style="text-align: center;"><?php
                        if (Auth::user()->image && file_exists(public_path('user_images/' . Auth::user()->image))) {
                            $user_imgg = 'user_images/' . Auth::user()->image;
                        } else {
                            $user_imgg = 'resumes/user-sqq.png';
                        }
                        ?><table><tr><td style="width:18pt;"></td><td style="width:250pt; text-align:center;"><img
                                src="{{asset($user_imgg)}}" alt="profile_pic"
                                width="220" height="200" style="margin-top:30pt; object-fit:cover"></td></tr></table></td>
                    </tr>
                    <tr>
                        <td><br><table> @isset($user->mobile_num)<tr>
                                    <td style="width:18pt"></td>
                                    <td style="width:35pt; height:18pt"><p style="margin-top: 4pt; margin-bottom:0; padding:0"><img src="{{asset('/word-icons/word3-icon-1.png')}}" height="18" width="18" alt=""></p></td>
                                    <td><p style="font-size:11pt; line-height:1; margin-top:5pt">{{ $user->mobile_num }}</p></td>
                                </tr>@endisset
                                @isset($user_meta->email)<tr>
                                    <td style="width:18pt"></td>
                                    <td style="width:35pt; height:18pt"><p style="margin-top: 4pt; margin-bottom:0; padding:0"><img src="{{asset('/word-icons/word3-icon-2.png')}}" height="18" width="20" alt=""></p></td>
                                    <td><p style="font-size:11pt; line-height:1; margin-top:5pt">{{ $user_meta->email }}</p></td>
                                </tr>@endisset @if(isset($user->country) || isset($user->state) || isset($user->city))<tr>
                                    <td style="width:18pt"></td>
                                    <td style="width:35pt; height:18pt"><p style="margin-top: 4pt; margin-bottom:0; padding:0"><img src="{{asset('/word-icons/word3-icon-3.png')}}" height="18" width="18" alt=""></p></td>
                                    <td><p style="font-size:11pt; line-height:1;">{{ $user->city . ', ' . $user->state . ', ' . $user->country }}</p></td>
                                </tr>@endif </table>
                        </td>
                    </tr>
                    @if(count($user_skills) > 0)<tr>
                        <td><table>
                                <tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="color: #2BBEA9; font-size:14pt;"><u><b>SKILLS AND COMPETENCES</b></u></p></td>
                                </tr>
                                @foreach ($user_skills as $user_skill)<tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="font-size:11pt; line-height:1;">{{ $user_skill->job_skill }}<img src="{{asset('word-icons/word3-border-1.png')}}" alt="" height="2" width="280"><span style="color: #2BBEA9; font-size:11pt; line-height:1;">{{ $user_skill->job_experience }}</span></p></td>
                                </tr>@endforeach
                            </table>
                        </td>
                    </tr>@endif 
                    @if(count($user_languages) > 0)<tr>
                        <td><table>
                                <tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="color: #2BBEA9; font-size:14pt;"><u><b>LANGUAGES</b></u></p></td>
                                </tr>
                                @foreach ($user_languages as $user_language)<tr>
                                    <td style="width:18pt"></td>
                                    <td><p style="font-size:11pt; line-height:1;">{{ $user_language->lang }}<br><span style="color: #2BBEA9; font-size:11pt; line-height:1;"><i>{{ $user_language->language_level }}</i></span></p></td>
                                </tr>@endforeach
                            </table>
                        </td>
                    </tr>@endif 
                </table>
            </td>
            <td style="width:10pt"></td>
            <td style="width:650pt"><table>
                    <tr>
                        <td style="background-color:#2BBEA9; width:450pt"><table>
                                <tr>
                                    <td style="width: 15pt"></td>
                                    <td><p style="font-size: 22pt; color:#FFFFFF; line-height:1; margin-top:10pt;"><b>{{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}</b></p></td>
                                </tr>
                                @isset($user_meta->career_level)
                                <tr>
                                    <td style="width: 15pt"></td>
                                    <td><p style="color:#FFFFFF; line-height:1; font-size:14pt;"><b>{{$user_meta->career_level}}</b><img src="{{asset('word-icons/word3-border-2.png')}}" alt="" height="15" width="530" style="margin:0; padding:0;"></p></td>
                                </tr>
                                @endisset
                                @if($user->getProfileSummary('summary'))
                                <tr>
                                    <td style="width: 15pt"></td>
                                    <td><p style="color:#FFFFFF; font-size:11pt; margin-bottom:10pt;"><I>{{$user->getProfileSummary('summary')}}</I></p></td>
                                </tr>
                                @endif
                            </table></td>
                    </tr>
                </table>
                @if (isset($user->father_name) ||
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
                        isset($user->video_link))<p style="color:#2BBEA9; font-size:14pt; font-weight:bold; line-height:1; padding:0; margin:0;">PERSONAL DETAILS<img src="{{asset('word-icons/word3-border-3.png')}}" alt="" height="5" width="530" style="margin:0; padding:0;"> </p><table style="width: 100%;">
                        @isset($user->father_name)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Father Name :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->father_name }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->date_of_birth)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Date of Birth :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ date('d F, Y', strtotime($user->date_of_birth)) }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->gender_id)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Gender :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->gender }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->marital_status)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Marital Status :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->marital_status }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->nationality)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Nationality :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->nationality }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->job_experience)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Job Experience :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->job_experience }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->industry)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Industry :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->industry }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->functional_area)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Functional Area :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->functional_area }}</p></td>
                            </tr>
                        @endisset
                        @isset($user->video_link)
                            <tr>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">Video Profile :</p></td>
                                <td style="width:100pt;"><p style="color: #333333; line-height:1.5; font-size:12pt; margin:0; padding:0;">{{ $user->video_link }}</p></td>
                            </tr>
                        @endisset
                    </table>@endif @if(count($user_experience)>0)<p><span style="color:#2BBEA9; font-weight:bold; line-height:1; padding:0; margin:0;font-size: 14pt;">WORK EXPERIENCE</span><img src="{{asset('word-icons/word3-border-3.png')}}" alt="" height="5" width="530" style=" margin-bottom:20pt; padding:0;">@foreach($user_experience as $user_exp)<span style="color:#2BBEA9; font-size:14pt; font-weight:bold; line-height:1;">{{ $user_exp->title }}</span><br><span style="color: #333333; line-height:1; font-size: 12pt;">{{ $user_exp->company }}</span><br><span style="color: #2BBEA9; line-height:1; font-size: 12pt;">{{'From '.date('d M, Y', strtotime($user_exp->date_start)).' - ' }}@if($user_exp->date_end){{date('d M, Y', strtotime($user_exp->date_end))}}@else<?php ?>Currently Working<?php ?>@endif @php
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
                    @endphp-@if($total_years || $total_months)@if($total_years==1){{$total_years}}@if($total_months){{'.'.$total_months}}@endif Year @elseif($total_years > 1){{ $total_years }}@if($total_months){{ '.' . $total_months . ' Years' }}@else Years @endif @else @if($total_months == 1){{ $total_months . ' Month' }}@else{{ $total_months . ' Months' }}@endif @endif @endif</span><span style="color: #2BBEA9; line-height:1; font-size: 12pt; text-align:right;">    {{$user_exp->city_name}}</span><br><span style="color: #7B7B7B; line-height:1.15; font-size: 11pt;"><i>{{ $user_exp->description }}</i></span>@if(!$loop->last)<br><br>@endif @endforeach</p>@endif<?php
                                        ?> @if(count($user_educations)>0)<p><span style="color:#2BBEA9; font-size:14pt; font-weight:bold; line-height:1;">EDUCATION</span><img src="{{asset('word-icons/word3-border-3.png')}}" alt="" height="5" width="530" style="margin:0; padding:0;">@foreach($user_educations as $user_edu)<span style="color:#2BBEA9; font-size:14pt; font-weight:bold; line-height:1;">{{ $user_edu->degree_level . ' - ' . $user_edu->degree_type }}</span><br><span style="color: #333333; font-size: 12pt; line-height:1;">{{ $user_edu->degree_title . ' ' . $user_edu->institution }}</span><br><span style="color:#2BBEA9; font-size:11pt; line-height:1; width:300pt;">{{ $user_edu->date_completion}}</span><span style="color:#2BBEA9; font-size:11pt; line-height:1; text-align:right;">   {{ $user_edu->city }}</span>@if(!$loop->last)<br><br>@endif @endforeach</p>@endif @if(count($user_projects)>0)<p><span style="color:#2BBEA9; font-size:14pt; font-weight:bold; line-height:1;">PROJECTS</span><img src="{{asset('word-icons/word3-border-3.png')}}" alt="" height="5" width="530" style="margin:0; padding:0;">@foreach ($user_projects as $project)<span style="color:#2BBEA9; font-size:12pt; font-weight:bold; line-height:1;">{{ $project->name }}</span><br><span style="color: #333333; font-size: 11pt; line-height:1;">{{ $project->url }}</span><br><span style="color: #2BBEA9; font-size: 11pt; line-height:1;">{{ date('M, Y', strtotime($project->date_start)) . ' - ' . date('M, Y', strtotime($project->date_end)) }}</span><br><br><span style="color: #7B7B7B; font-size: 11pt; line-height:1;"><i>{{$project->description}}</i></span>@if(!$loop->last)<br><br>@endif @endforeach @endif
            </td>
        </tr>
    </table>

</body>

</html>
