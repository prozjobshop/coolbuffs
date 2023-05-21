<h5>{{__('Job Details')}}</h5>
@if(isset($job))
{!! Form::model($job, array('method' => 'put', 'route' => array('update.front.job', $job->id), 'class' => 'form', 'id' => 'submit-job-form')) !!}
{!! Form::hidden('id', $job->id) !!}
@else
{!! Form::open(array('method' => 'post', 'route' => array('store.front.job'), 'class' => 'form', 'id' => 'submit-job-form')) !!}
@endif
<div class="row">  
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'title') !!}"> 
            <label class='bold'>Job Title<span style="color:red"> *</span></label>
            {!! Form::text('title', null, array('class'=>'form-control typeahead typeahead_job', 'id'=>'title', 'placeholder'=>__('Job title'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'title') !!} 
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'description') !!}">
            <label class='bold'>Job description<span style="color:red"> *</span></label>
            {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>__('Job description'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'description') !!} 
        </div>
    </div>
	
	 <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'benefits') !!}">
            <label class='bold'>Job Benefits</label>
            {!! Form::textarea('benefits', null, array('class'=>'form-control', 'id'=>'benefits', 'placeholder'=>__('Job Benefits'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'benefits') !!} 
        </div>
    </div>
	
	
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'skills') !!}">
            <label class='bold'>Skills<span style="color:red"> *</span></label>
            <?php
            $skills = old('skills', $jobSkillIds);
            ?>
            {!! Form::select('skills[]', $jobSkills, $skills, array('class'=>'form-control select2-multiple', 'id'=>'skills', 'multiple'=>'multiple')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'skills') !!} 
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'country_id') !!}" id="country_id_div">
            <label class='bold'>Country<span style="color:red"> *</span></label>
            {!! Form::select('country_id', ['' => __('All Countries')]+$countries, old('country_id', (isset($job))? $job->country_id:''), array('class'=>'form-control', 'id'=>'country_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'country_id') !!} 
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}" id="state_id_div">
            <label class='bold'>State<span style="color:red"> *</span></label>
            <span id="default_state_dd"> {!! Form::select('state_id', ['' => __('All States')], null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span>
             {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} 
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}" id="city_id_div">
            <label class='bold'>City<span style="color:red"> *</span></label>
            <span id="default_city_dd"> {!! Form::select('city_id', ['' => __('All Cities')], null, array('class'=>'form-control', 'id'=>'city_id')) !!} </span>
             {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_from') !!}" id="salary_from_div"> 
            <label class='bold'>Salary from<span style="color:red"> *</span></label>
            {!! Form::number('salary_from', null, array('class'=>'form-control', 'id'=>'salary_from', 'placeholder'=>__('Salary from'), 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_from') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_to') !!}" id="salary_to_div">
            <label class='bold'>Salary to<span style="color:red"> *</span></label>
            {!! Form::number('salary_to', null, array('class'=>'form-control', 'id'=>'salary_to', 'placeholder'=>__('Salary to'), 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_to') !!}
            <span id="salary_to_greater" style="color: red;"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}" id="salary_currency_div">
            @php
            $salary_currency = Request::get('salary_currency', (isset($job))? $job->salary_currency:$siteSetting->default_currency_code);
            @endphp
            <label class='bold'>Currency</label>
            {!! Form::select('salary_currency', ['' => __('Select Salary Currency')]+$currencies, $salary_currency, array('class'=>'form-control', 'id'=>'salary_currency')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_period_id') !!}" id="salary_period_id_div">
            <label class='bold'>Period</label>
            {!! Form::select('salary_period_id', ['' => __('Select Salary Period')]+$salaryPeriods, null, array('class'=>'form-control', 'id'=>'salary_period_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_period_id') !!} 
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'current_location_id') !!}" id="current_location_id_div"> 
            <label class='bold'>Current Location</label>
            {!! Form::select('current_location_id', ['' => __('All Countries')]+$countries, old('current_location_id', (isset($job))? $job->current_location_id:''), array('class'=>'form-control','required'=>'required', 'id'=>'current_location_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'current_location_id') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'hide_salary') !!}"> {!! Form::label('hide_salary', __('Hide Salary?'), ['class' => 'bold']) !!}
            <div class="radio-list">
                <?php
                $hide_salary_1 = '';
                $hide_salary_2 = 'checked="checked"';
                if (old('hide_salary', ((isset($job)) ? $job->hide_salary : 0)) == 1) {
                    $hide_salary_1 = 'checked="checked"';
                    $hide_salary_2 = '';
                }
                ?>
                <label class="radio-inline">
                    <input id="hide_salary_yes" name="hide_salary" type="radio" value="1" {{$hide_salary_1}}>
                    {{__('Yes')}} </label>
                <label class="radio-inline">
                    <input id="hide_salary_no" name="hide_salary" type="radio" value="0" {{$hide_salary_2}}>
                    {{__('No')}} </label>
            </div>
            {!! APFrmErrHelp::showErrors($errors, 'hide_salary') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'career_level_id') !!}" id="career_level_id_div">
            <label class='bold'>Career level</label>
            {!! Form::select('career_level_id', ['' => __('Select Career level')]+$careerLevels, null, array('class'=>'form-control', 'id'=>'career_level_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'career_level_id') !!} 
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}" id="functional_area_id_div">
            <label class='bold'>Functional Area<span style="color:red"> *</span></label>
            {!! Form::select('functional_area_id', ['' => __('Select Functional Area')]+$functionalAreas, null, array('class'=>'form-control', 'id'=>'functional_area_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_type_id') !!}" id="job_type_id_div">
            <label class='bold'>Job Type<span style="color:red"> *</span></label>
            {!! Form::select('job_type_id', ['' => __('Select Job Type')]+$jobTypes, null, array('class'=>'form-control', 'id'=>'job_type_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_type_id') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_shift_id') !!}" id="job_shift_id_div">
            <label class='bold'>Job Shift</label>
            {!! Form::select('job_shift_id', ['' => __('Select Job Shift')]+$jobShifts, null, array('class'=>'form-control', 'id'=>'job_shift_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_shift_id') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'num_of_positions') !!}" id="num_of_positions_div"> 
            <label class='bold'>Number of Positions</label>
            {!! Form::number('num_of_positions', null, array('class'=>'form-control', 'id'=>'num_of_positions', 'placeholder'=>__('Number of Positions'), 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
            {!! APFrmErrHelp::showErrors($errors, 'num_of_positions') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'gender_id') !!}" id="gender_id_div">
            <label class='bold'>Gender</label>
            {!! Form::select('gender_id', ['' => __('No preference')]+$genders, null, array('class'=>'form-control', 'id'=>'gender_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'expiry_date') !!}">
            <label class='bold'>Job expiry date<span style="color:red"> *</span></label>
            {!! Form::text('expiry_date', null, array('class'=>'form-control datepicker', 'id'=>'expiry_date', 'placeholder'=>__('Job expiry date'), 'autocomplete'=>'off')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'expiry_date') !!} 
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'degree_level_id') !!}" id="degree_level_id_div"> 
            <label class='bold'>Degree Level</label>
            {!! Form::select('degree_level_id', ['' =>__('Select Required Degree Level')]+$degreeLevels, null, array('class'=>'form-control', 'id'=>'degree_level_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'degree_level_id') !!} 
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'major_subject_id') !!}" id="major_subject_id_div">
            <label class='bold'>Major Subjects</label>
            <span id="default_subject_dd"> 
                {!! Form::select('major_subject_id', ['' => __('Major Subjects')], null, array('class'=>'form-control', 'id'=>'major_subject_id')) !!} 
            </span> {!! APFrmErrHelp::showErrors($errors, 'major_subject_id') !!} 
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}" id="job_experience_id_div">
            <label class='bold'>job experience<span style="color:red"> *</span></label>
            {!! Form::select('job_experience_id', ['' => __('Select Required job experience')]+$jobExperiences, null, array('class'=>'form-control', 'id'=>'job_experience_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!} </div>
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_freelance') !!}"> {!! Form::label('is_freelance', __('Is Freelance?'), ['class' => 'bold']) !!}
            <div class="radio-list">
                <?php
                $is_freelance_1 = '';
                $is_freelance_2 = 'checked="checked"';
                if (old('is_freelance', ((isset($job)) ? $job->is_freelance : 0)) == 1) {
                    $is_freelance_1 = 'checked="checked"';
                    $is_freelance_2 = '';
                }
                ?>
                <label class="radio-inline">
                    <input id="is_freelance_yes" name="is_freelance" type="radio" value="1" {{$is_freelance_1}}>
                    {{__('Yes')}} </label>
                <label class="radio-inline">
                    <input id="is_freelance_no" name="is_freelance" type="radio" value="0" {{$is_freelance_2}}>
                    {{__('No')}} </label>
            </div>
            {!! APFrmErrHelp::showErrors($errors, 'is_freelance') !!} </div>
    </div>

        <?php
        $all_questions = "";
        $question_type  = "";
        if( isset($job->data) && $job->data != '' ) {
            $JSON = json_decode($job->data);
            if( $JSON != '' && count($JSON) > 0 ) {
                $all_questions = $JSON;
            }
        }
        ?>
        <div class="col-sm-10">

                <div class="formrow">
                    <label class="bold" for="is_featured">Add Questions</label>
                </div>
                <style type="text/css">
                    .delete_question {
                        width: 48%;
                        height: 34px;
                        display: block;
                        text-align: left;
                        line-height: 30px;
                        font-size: 32px;
                        color: red;
                        cursor: pointer;
                    }
                    .each_question_container {
                        margin-top: 10px;
                    }
                </style>
                <div class="row dynamic_questions_container" id="dynamic_questions_container">
                    <div class="col-md-10" style="margin-top: 0px; margin-bottom: 15px;">
                        <button type="button" class="btn btn-success mt-0" onClick="return addQuestionsRow()"> <i class="fa fa-plus"></i> Add new Question</button>
                    </div>
                    <div class="col-md-12 all_multiple_questions_container">
                        
                        <?php
                        $counter_questions = 2;
                        if( $all_questions != '' && count($all_questions) > 0 ) {
                            foreach ($all_questions as $key => $question) {
                                ?>
                                <div class="row each_question_container question_no_<?php echo $key;?>">
                                    
                                    <div class="col-md-3">
                                        <label>Question Type</label>
                                        <select class="form-control" name="questions[<?php echo $key;?>][question_type]" required>
                                            <option value="text" <?php if( $question->question_type == "text" ) {echo "selected";}?>>Text</option>
                                            <option value="video" <?php if( $question->question_type == "video" ) {echo "selected";}?>>Video</option>
                                        </select>
                                    </div>

                                    <div class="col-md-7">
                                        <label>Question</label>
                                        <input class="form-control" type="text" maxlength="2000" name="questions[<?php echo $key;?>][question]" value="<?php echo $question->question;?>" placeholder="Enter your question here..." required />
                                    </div>
                                    <div class="col-md-2" style="padding-left: 0;">
                                        <label>&nbsp;</label>
                                        <span class="delete_question" onclick="delete_question(<?php echo $key;?>)"><i class="fa fa-trash"></i></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            <?php
                                $counter_questions = $key;
                            }
                        }?>
                    </div>
                </div>
        </div>


    <div class="col-md-12">
        <div class="formrow">
            <button type="button" onclick="submitJob()" class="btn">{{__('SUBMIT')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </div>


</div>
<input type="file" name="image" id="image" style="display:none;" accept="image/*"/>
{!! Form::close() !!}
<hr>
@push('styles')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('includes.tinyMCEFront')
<script type="text/javascript">

    var i=<?php echo $counter_questions+1?>;
    function addQuestionsRow(){ 
        var htm = '<div class="row each_question_container question_no_'+i+'">\
                        <div class="col-md-3">\
                            <label>Question Type</label>\
                            <select class="form-control" name="questions['+i+'][question_type]" required>\
                                <option value="text">Text</option>\
                                <option value="video">Video</option>\
                            </select>\
                        </div>\
                        <div class="col-md-7">\
                            <label>Question</label>\
                            <input class="form-control" type="text" maxlength="2000" name="questions['+i+'][question]" value="" placeholder="Enter your question here..." required />\
                        </div>\
                        <div class="col-md-2" style="padding-left: 0;">\
                            <label>&nbsp;</label>\
                            <span class="delete_question" onclick="delete_question('+i+')"><i class="fa fa-trash"></i></span>\
                        </div>\
                        <div class="clearfix"></div>\
                    </div>';
                    $('.all_multiple_questions_container').append(htm);
                    i+=1;
    }

    function delete_question(question_number) {
        $(".question_no_"+question_number).remove();
    }

    $(document).ready(function () {
        $('.select2-multiple').select2({
            placeholder: "{{__('Select Required Skills')}}",
            allowClear: true
        });
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d',
            startDate: new Date()
        });
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(<?php echo old('state_id', (isset($job)) ? $job->state_id : 0); ?>);

        $('#degree_level_id').on('change', function (e) {
            e.preventDefault();
            filterDefaultSubjects(0);
        });
        filterDefaultSubjects(<?php echo old('state_id', (isset($job)) ? $job->major_subject_id : 0); ?>);
    });
    function filterDefaultSubjects(subject_id)
    {
        var degree_level_id = $('#degree_level_id').val();
        if (degree_level_id != '') {
            $.post("{{ route('filter.default.subject.dropdown.job') }}", {degree_level_id: degree_level_id, subject_id: subject_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_subject_dd').html(response);
                    });
        }
    }
    function filterLangStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown.job') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterLangCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
                    });
        }
    }
    function filterLangCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown.job') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }
    function submitJob(){
        // var salary_from = parseInt($('#salary_from').val());
        // var salary_to = parseInt($('#salary_to').val());
        var is_true = true;

        // if(salary_from >= salary_to){
        //     $('#salary_to_greater').text('(SalaryTo) must be greater than (Salary From)');
        //     is_true = false;
        // }else{
        //     $('#salary_to_greater').text('');
        //     is_true = true;
        // }
        if(is_true){
            $('#submit-job-form').submit();
        }
    }
</script> 
@endpush