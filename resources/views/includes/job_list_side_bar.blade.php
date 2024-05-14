<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3"> 
	<div class="jobreqbtn">
	@if (Request::get('search') != '' || Request::get('functional_area_id') != '' || Request::get('country_id') != ''|| Request::get('state_id') != '' || Request::get('city_id') != ''|| Request::get('city_id') != '')
	<a class="btn btn-job-alert" href="javascript:;">
		<i class="fa fa-bell" style="font-size:1.125rem;"></i> {{__('Save Job Alert')}} </a>
	@else
	<a class="btn btn-job-alert-disabled" disabled href="javascript:;">
		<i class="fa fa-bell" style="font-size:1.125rem;"></i> {{__('Save Job Alert')}}</a>
	@endif
	
	
	@if(Auth::guard('company')->check())
	<a href="{{ route('post.job') }}" class="btn"><i class="fa fa-file-text" aria-hidden="true"></i> {{__('Post Job')}}</a>
	@else
	<a href="{{url('my-profile#cvs')}}" class="btn"><i class="fa fa-file-text" aria-hidden="true"></i> {{__('Upload Your Resume')}}</a>
	@endif
	</div>
    <!-- Side Bar start -->
    <div class="sidebar">
        <input type="hidden" name="search" value="{{Request::get('search', '')}}"/>
        
        <!-- Jobs By Title -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Title')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($jobTitlesArray) && count($jobTitlesArray))
            @php
                $sortedJobTitles = collect($jobTitlesArray)->sort();
            @endphp
            @foreach($sortedJobTitles as $key => $jobTitle)
                <li>
                    @php
                        $checked = (in_array($jobTitle, Request::get('job_title', array()))) ? 'checked="checked"' : '';
                    @endphp
                    <input type="checkbox" name="job_title[]" id="job_title_{{ $key }}" value="{{ $jobTitle }}" {{ $checked }} onclick="submit_form()">
                    <label for="job_title_{{ $key }}"></label>
                    {{ $jobTitle }} <span>{{ App\Job::countNumJobs('title', $jobTitle) }}</span>
                </li>
            @endforeach
        @endif
    </ul>

    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
    <!-- title end --> 


                <!-- Jobs By Skill -->
                <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Skill')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($skillIdsArray) && count($skillIdsArray))
            @php
                $jobSkills = App\JobSkill::whereIn('job_skill_id', $skillIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('job_skill') // Order by the 'job_skill' column
                    ->get();
            @endphp
            @foreach($jobSkills as $jobSkill)
                @php
                    $checked = (in_array($jobSkill->job_skill_id, Request::get('job_skill_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="job_skill_id[]" id="job_skill_{{ $jobSkill->job_skill_id }}" value="{{ $jobSkill->job_skill_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="job_skill_{{ $jobSkill->job_skill_id }}"></label>
                    {{ $jobSkill->job_skill }} <span>{{ App\Job::countNumJobs('job_skill_id', $jobSkill->job_skill_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Jobs By Skill end --> 


        <!-- Jobs By Industry -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Industry')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($industryIdsArray) && count($industryIdsArray))
            @php
                $industries = App\Industry::whereIn('id', $industryIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('industry') // Order by the 'industry' column
                    ->get();
            @endphp
            @foreach($industries as $industry)
                @php
                    $checked = (in_array($industry->id, Request::get('industry_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="industry_id[]" id="industry_{{ $industry->id }}" value="{{ $industry->id }}" {{ $checked }} onclick="submit_form()">
                    <label for="industry_{{ $industry->id }}"></label>
                    {{ $industry->industry }} <span>{{ App\Job::countNumJobs('industry_id', $industry->id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
<!-- Jobs By Industry end --> 


<!-- Jobs By Functional areas start --> 
<div class="widget">
    <h4 class="widget-title">{{__('Jobs By Functional Areas')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($functionalAreaIdsArray) && count($functionalAreaIdsArray))
            @php
                $functionalAreas = App\FunctionalArea::whereIn('functional_area_id', $functionalAreaIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('functional_area') // Order by the 'functional_area' column
                    ->get();
            @endphp
            @foreach($functionalAreas as $functionalArea)
                @php
                    $checked = (in_array($functionalArea->functional_area_id, Request::get('functional_area_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="functional_area_id[]" id="functional_area_id_{{ $functionalArea->functional_area_id }}" value="{{ $functionalArea->functional_area_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="functional_area_id_{{ $functionalArea->functional_area_id }}"></label>
                    {{ $functionalArea->functional_area }} <span>{{ App\Job::countNumJobs('functional_area_id', $functionalArea->functional_area_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
<!-- Jobs by Functional areas end --> 

 <!-- Jobs By Career Level -->
 <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Career Level')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($careerLevelIdsArray) && count($careerLevelIdsArray))
            @php
                $careerLevels = App\CareerLevel::whereIn('career_level_id', $careerLevelIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('career_level') // Order by the 'career_level' column
                    ->get();
            @endphp
            @foreach($careerLevels as $careerLevel)
                @php
                    $checked = (in_array($careerLevel->career_level_id, Request::get('career_level_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="career_level_id[]" id="career_level_{{ $careerLevel->career_level_id }}" value="{{ $careerLevel->career_level_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="career_level_{{ $careerLevel->career_level_id }}"></label>
                    {{ $careerLevel->career_level }} <span>{{ App\Job::countNumJobs('career_level_id', $careerLevel->career_level_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Jobs By Career Level end --> 

        <!-- Jobs By Experience -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Experience')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($jobExperienceIdsArray) && count($jobExperienceIdsArray))
            @php
                $jobExperiences = App\JobExperience::whereIn('job_experience_id', $jobExperienceIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('job_experience') // Order by the 'job_experience' column
                    ->get();
            @endphp
            @foreach($jobExperiences as $jobExperience)
                @php
                    $checked = (in_array($jobExperience->job_experience_id, Request::get('job_experience_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="job_experience_id[]" id="job_experience_{{ $jobExperience->job_experience_id }}" value="{{ $jobExperience->job_experience_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="job_experience_{{ $jobExperience->job_experience_id }}"></label>
                    {{ $jobExperience->job_experience }} <span>{{ App\Job::countNumJobs('job_experience_id', $jobExperience->job_experience_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Jobs By Experience end --> 

        <!-- Jobs By Job Type -->
        <div class="widget">
            <h4 class="widget-title">{{__('Jobs By Job Type')}}</h4>
            <ul class="optionlist view_more_ul">
                @if(isset($jobTypeIdsArray) && count($jobTypeIdsArray))
                @foreach($jobTypeIdsArray as $key=>$job_type_id)
                @php
                $jobType = App\JobType::where('job_type_id','=',$job_type_id)->lang()->active()->first();
                @endphp
                @if(null !== $jobType)
                @php
                $checked = (in_array($jobType->job_type_id, Request::get('job_type_id', array())))? 'checked="checked"':'';
                @endphp
                <li>
                    <input type="checkbox" name="job_type_id[]" id="job_type_{{$jobType->job_type_id}}" value="{{$jobType->job_type_id}}" {{$checked}} onclick="submit_form()">
                    <label for="job_type_{{$jobType->job_type_id}}"></label>
                    {{$jobType->job_type}} <span>{{App\Job::countNumJobs('job_type_id', $jobType->job_type_id)}}</span> </li>
                @endif
                @endforeach
                @endif
            </ul>
            <span class="text text-primary view_more hide_vm">{{__('View More')}}</span> </div>
        <!-- Jobs By Job Type end --> 

        <!-- Jobs By Job Shift -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Job Shift')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($jobShiftIdsArray) && count($jobShiftIdsArray))
            @php
                $jobShifts = App\JobShift::whereIn('job_shift_id', $jobShiftIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('job_shift') // Order by the 'job_shift' column
                    ->get();
            @endphp
            @foreach($jobShifts as $jobShift)
                @php
                    $checked = (in_array($jobShift->job_shift_id, Request::get('job_shift_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="job_shift_id[]" id="job_shift_{{ $jobShift->job_shift_id }}" value="{{ $jobShift->job_shift_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="job_shift_{{ $jobShift->job_shift_id }}"></label>
                    {{ $jobShift->job_shift }} <span>{{ App\Job::countNumJobs('job_shift_id', $jobShift->job_shift_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
<!-- Jobs By Job Shift end --> 

       

        <!-- Jobs By Degree Level -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Degree Level')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($degreeLevelIdsArray) && count($degreeLevelIdsArray))
            @php
                $degreeLevels = App\DegreeLevel::whereIn('degree_level_id', $degreeLevelIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('degree_level') // Order by the 'degree_level' column
                    ->get();
            @endphp
            @foreach($degreeLevels as $degreeLevel)
                @php
                    $checked = (in_array($degreeLevel->degree_level_id, Request::get('degree_level_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="degree_level_id[]" id="degree_level_{{ $degreeLevel->degree_level_id }}" value="{{ $degreeLevel->degree_level_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="degree_level_{{ $degreeLevel->degree_level_id }}"></label>
                    {{ $degreeLevel->degree_level }} <span>{{ App\Job::countNumJobs('degree_level_id', $degreeLevel->degree_level_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Jobs By Degree Level end --> 


<!-- Top Companies -->
<div class="widget">
    <h4 class="widget-title">{{__('Jobs By Company')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($companyIdsArray) && count($companyIdsArray))
            @php
                $companies = App\Company::whereIn('id', $companyIdsArray)
                    ->active()
                    ->orderBy('name') // Order by the 'name' column
                    ->get();
            @endphp
            @foreach($companies as $company)
                @php
                    $checked = (in_array($company->id, Request::get('company_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="company_id[]" id="company_{{ $company->id }}" value="{{ $company->id }}" {{ $checked }} onclick="submit_form()">
                    <label for="company_{{ $company->id }}"></label>
                    {{ $company->name }} <span>{{ App\Job::countNumJobs('company_id', $company->id) }}</span> 
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Top Companies end --> 


        <!-- Jobs By Country -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By Country')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($countryIdsArray) && count($countryIdsArray))
            @php
                $countries = App\Country::whereIn('country_id', $countryIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('country') // Order by the 'country' column
                    ->get();
            @endphp
            @foreach($countries as $country)
                @php
                    $checked = (in_array($country->country_id, Request::get('country_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="country_id[]" id="country_{{ $country->country_id }}" value="{{ $country->country_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="country_{{ $country->country_id }}"></label>
                    {{ $country->country }} <span>{{ App\Job::countNumJobs('country_id', $country->country_id) }}</span> 
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Jobs By Country end--> 

        
        <!-- Jobs By City -->
        <div class="widget">
    <h4 class="widget-title">{{__('Jobs By City')}}</h4>
    <ul class="optionlist view_more_ul">
        @if(isset($cityIdsArray) && count($cityIdsArray))
            @php
                $cities = App\City::whereIn('city_id', $cityIdsArray)
                    ->lang()
                    ->active()
                    ->orderBy('city') // Order by the 'city' column
                    ->get();
            @endphp
            @foreach($cities as $city)
                @php
                    $checked = (in_array($city->city_id, Request::get('city_id', array()))) ? 'checked="checked"' : '';
                @endphp
                <li>
                    <input type="checkbox" name="city_id[]" id="city_{{ $city->city_id }}" value="{{ $city->city_id }}" {{ $checked }} onclick="submit_form()">
                    <label for="city_{{ $city->city_id }}"></label>
                    {{ $city->city }} <span>{{ App\Job::countNumJobs('city_id', $city->city_id) }}</span>
                </li>
            @endforeach
        @endif
    </ul>
    <span class="text text-primary view_more hide_vm">{{__('View More')}}</span>
</div>
        <!-- Jobs By City end--> 
 
 <!-- Jobs By Gender -->
 <div class="widget">
            <h4 class="widget-title">{{__('Jobs By Gender')}}</h4>
            <ul class="optionlist view_more_ul">
                @if(isset($genderIdsArray) && count($genderIdsArray))
                @foreach($genderIdsArray as $key=>$gender_id)
                @php
                $gender = App\Gender::where('gender_id','=',$gender_id)->lang()->active()->first();
                @endphp
                @if(null !== $gender)
                @php
                $checked = (in_array($gender->gender_id, Request::get('gender_id', array())))? 'checked="checked"':'';
                @endphp
                <li>
                    <input type="checkbox" name="gender_id[]" id="gender_{{$gender->gender_id}}" value="{{$gender->gender_id}}" {{$checked}} onclick="submit_form()">
                    <label for="gender_{{$gender->gender_id}}"></label>
                    {{$gender->gender}} <span>{{App\Job::countNumJobs('gender_id', $gender->gender_id)}}</span> </li>
                @endif
                @endforeach
                @endif
            </ul>
            <span class="text text-primary view_more hide_vm">{{__('View More')}}</span> </div>
        <!-- Jobs By Gender end --> 





        <!-- 
        <div class="widget">
            <h4 class="widget-title">{{__('Jobs By State')}}</h4>
            <ul class="optionlist view_more_ul">
                @if(isset($stateIdsArray) && count($stateIdsArray))
                @foreach($stateIdsArray as $key=>$state_id)
                @php
                $state = App\State::where('state_id','=',$state_id)->lang()->active()->first();			  
                @endphp
                @if(null !== $state)
                @php
                $checked = (in_array($state->state_id, Request::get('state_id', array())))? 'checked="checked"':'';
                @endphp
                <li>
                    <input type="checkbox" name="state_id[]" id="state_{{$state->state_id}}" value="{{$state->state_id}}" {{$checked}} onclick="submit_form()">
                    <label for="state_{{$state->state_id}}"></label>
                    {{$state->state}} <span>{{App\Job::countNumJobs('state_id', $state->state_id)}}</span> </li>
                @endif
                @endforeach
                @endif
            </ul>
            <span class="text text-primary view_more hide_vm">{{__('View More')}}</span> </div>
        --> 


        
        <!--
        <div class="widget">
            <h4 class="widget-title">{{__('Jobs By Subjects')}}</h4>
            <ul class="optionlist view_more_ul">
                @if(isset($majorSubjectsIdsArrary) && count($majorSubjectsIdsArrary))
                @foreach($majorSubjectsIdsArrary as $key=>$major_subject_id)
                @php
                $majorSubject = App\MajorSubject::where('major_subject_id','=',$major_subject_id)->lang()->active()->first();
                @endphp
                @if(null !== $majorSubject)
                @php
                $checked = (in_array($majorSubject->major_subject_id, Request::get('major_subject_id', array())))? 'checked="checked"':'';
                @endphp
                <li>
                    <input type="checkbox" name="major_subject_id[]" id="degree_level_{{$majorSubject->major_subject_id}}" value="{{$majorSubject->major_subject_id}}" {{$checked}} onclick="submit_form()">
                    <label for="degree_level_{{$majorSubject->major_subject_id}}"></label>
                    {{$majorSubject->major_subject}} <span>{{App\Job::countNumJobs('major_subject_id', $majorSubject->major_subject_id)}}</span> </li>
                @endif
                @endforeach
                @endif
            </ul>
            <span class="text text-primary view_more hide_vm">{{__('View More')}}</span> </div>
         --> 


       
        



        
        <!-- Salary -->
        <div class="widget">
            <h4 class="widget-title">{{__('Salary Range')}}</h4>
            <div class="form-group">
                {!! Form::text('salary_from', Request::get('salary_from', null), array('class'=>'form-control', 'id'=>'salary_from', 'onkeyup'=>'this.value=this.value.replace(/[^\d]/,"")' , 'placeholder'=>__('Salary From'))) !!}
            </div>
            <div class="form-group">
                {!! Form::text('salary_to', Request::get('salary_to', null), array('class'=>'form-control', 'onkeyup'=>'this.value=this.value.replace(/[^\d]/,"")', 'id'=>'salary_to', 'placeholder'=>__('Salary To'))) !!}
                <span style="color: red" id="salary_to_greater"></span>
            </div>
            <div class="form-group">
                {!! Form::select('salary_currency', ['' =>__('Select Salary Currency')]+$currencies, Request::get('salary_currency'), array('class'=>'form-control', 'id'=>'salary_currency')) !!}
            </div>
            <!-- Salary end --> 

            <!-- button -->
            <div class="searchnt">
                <button type="button" class="btn click_on_button_when_click_filter" onclick="searchJob()">
                    <i class="fa fa-search" aria-hidden="true"></i> {{__('Search Jobs')}}
                </button>
            </div>
            <!-- button end--> 
        </div>
        <!-- Side Bar end --> 
    </div>
</div>