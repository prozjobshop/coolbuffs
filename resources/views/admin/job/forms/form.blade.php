{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')

    {!! Form::hidden('id', null) !!}
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'company_id') !!}" id="company_id_div">
        {!! Form::label('company_id', 'Company', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        {!! Form::select('company_id', ['' => 'Select Company']+$companies, null, array('class'=>'form-control', 'id'=>'company_id', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'company_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('title', 'Job title', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        {!! Form::text('title', null, array('class'=>'form-control typeahead typeahead_job', 'id'=>'title', 'placeholder'=>'Job title', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
        {!! Form::label('description', 'Job description', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>'Job description')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'description') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'benefits') !!}"> 
        {!! Form::label('description', 'Benefits', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        {!! Form::textarea('benefits', null, array('class'=>'form-control', 'id'=>'benefits', 'placeholder'=>__('Job Benefits'))) !!}
        {!! APFrmErrHelp::showErrors($errors, 'benefits') !!} 
    </div>
  
    
    
    
    

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'skills') !!}">
        {!! Form::label('skills', 'Job skills', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        <?php
        $skills = old('skills', $jobSkillIds);
        ?>
        {!! Form::select('skills[]', $jobSkills, $skills, array('class'=>'form-control select2-multiple', 'id'=>'skills', 'multiple'=>'multiple', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'skills') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'country_id') !!}" id="country_id_div">
        {!! Form::label('country_id', 'Country', ['class' => 'bold']) !!}<font style="color:red;">*</font>                    
        {!! Form::select('country_id', ['' => 'All Countries']+$countries, old('country_id', (isset($job))? $job->country_id:''), array('class'=>'form-control', 'id'=>'country_id', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'state_id') !!}" id="state_id_div">
        {!! Form::label('state_id', 'State', ['class' => 'bold']) !!} <font style="color:red;">*</font>                   
        <span id="default_state_dd">
            {!! Form::select('state_id', ['' => 'All States'], null, array('class'=>'form-control', 'id'=>'state_id', 'required'=>'required')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'city_id') !!}" id="city_id_div">
        {!! Form::label('city_id', 'City', ['class' => 'bold']) !!} <font style="color:red;">*</font>                   
        <span id="default_city_dd">
            {!! Form::select('city_id', ['' => 'Select City','' => 'All Cities'], null, array('class'=>'form-control', 'id'=>'city_id', 'required'=>'required')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}                                       
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'current_location_id') !!}" id="current_location_id_div">
        {!! Form::label('current_location_id', 'Current Location', ['class' => 'bold']) !!}<font style="color:red;">*</font>                    
        {!! Form::select('current_location_id', ['' => 'All Countries']+$countries, old('current_location_id', (isset($job))? $job->current_location_id:''), array('class'=>'form-control', 'id'=>'current_location_id', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'current_location_id') !!}                                       
    </div>

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_freelance') !!}">
        {!! Form::label('is_freelance', 'Is Freelance?', ['class' => 'bold']) !!}
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
                Yes </label>
            <label class="radio-inline">
                <input id="is_freelance_no" name="is_freelance" type="radio" value="0" {{$is_freelance_2}}>
                No </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_freelance') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'career_level_id') !!}" id="career_level_id_div">
        {!! Form::label('career_level_id', 'Career level', ['class' => 'bold']) !!}                    
        {!! Form::select('career_level_id', ['' => 'Select Career level']+$careerLevels, null, array('class'=>'form-control', 'id'=>'career_level_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'career_level_id') !!}                                       
    </div>

    <div class="row">
        <div class="col-md-2 form-group {!! APFrmErrHelp::hasError($errors, 'salary_from') !!}" id="salary_from_div">
            {!! Form::label('salary_from', 'Salary From', ['class' => 'bold']) !!}                    
            {!! Form::number('salary_from', null, array('class'=>'form-control', 'id'=>'salary_from', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_from') !!}                                       
        </div>
        <div class="col-md-2 form-group {!! APFrmErrHelp::hasError($errors, 'salary_to') !!}" id="salary_to_div">
            {!! Form::label('salary_to', 'Salary To', ['class' => 'bold']) !!}                    
            {!! Form::number('salary_to', null, array('class'=>'form-control', 'id'=>'salary_to', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_to') !!} 
            <span id="salary_to_greater" style="color:red;"></span>                                     
        </div>
        <div class="col-md-2 form-group {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}" id="salary_currency_div">
            {!! Form::label('salary_currency', 'Salary Currency', ['class' => 'bold']) !!}                    
            {!! Form::select('salary_currency', ['' => 'Select Salary Currency']+$currencies, null, array('class'=>'form-control', 'id'=>'salary_currency')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!}                                       
        </div>
        <div class="col-md-2 form-group {!! APFrmErrHelp::hasError($errors, 'salary_period_id') !!}" id="salary_period_id_div">
            {!! Form::label('salary_period_id', 'Salary Period', ['class' => 'bold']) !!}                    
            {!! Form::select('salary_period_id', ['' => 'Select Salary Period']+$salaryPeriods, null, array('class'=>'form-control', 'id'=>'salary_period_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_period_id') !!}                                       
        </div>
        <div class="col-md-2 form-group {!! APFrmErrHelp::hasError($errors, 'hide_salary') !!}">
            {!! Form::label('hide_salary', 'Hide Salary?', ['class' => 'bold']) !!}
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
                    Yes </label>
                <label class="radio-inline">
                    <input id="hide_salary_no" name="hide_salary" type="radio" value="0" {{$hide_salary_2}}>
                    No </label>
            </div>
            {!! APFrmErrHelp::showErrors($errors, 'hide_salary') !!}
        </div>    
    </div>
    

    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}" id="functional_area_id_div">
        {!! Form::label('functional_area_id', 'Functional Area', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        {!! Form::select('functional_area_id', ['' => 'Select Functional Area']+$functionalAreas, null, array('class'=>'form-control', 'id'=>'functional_area_id', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_type_id') !!}" id="job_type_id_div">
        {!! Form::label('job_type_id', 'Job Type', ['class' => 'bold']) !!}<font style="color:red;">*</font>                    
        {!! Form::select('job_type_id', ['' => 'Select Job Type']+$jobTypes, null, array('class'=>'form-control', 'id'=>'job_type_id', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'job_type_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_shift_id') !!}" id="job_shift_id_div">
        {!! Form::label('job_shift_id', 'Job Shift', ['class' => 'bold']) !!}                    
        {!! Form::select('job_shift_id', ['' => 'Select Job Shift']+$jobShifts, null, array('class'=>'form-control', 'id'=>'job_shift_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'job_shift_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'num_of_positions') !!}" id="num_of_positions_div">
        {!! Form::label('num_of_positions', 'Positions#', ['class' => 'bold']) !!}                    
        {!! Form::number('num_of_positions', null, array('class'=>'form-control', 'id'=>'num_of_positions', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
        {!! APFrmErrHelp::showErrors($errors, 'num_of_positions') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'gender_id') !!}" id="gender_id_div">
        {!! Form::label('gender_id', 'Gender', ['class' => 'bold']) !!}                    
        {!! Form::select('gender_id', ['' => __('No preference')]+$genders, null, array('class'=>'form-control', 'id'=>'gender_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'expiry_date') !!}">
        {!! Form::label('expiry_date', 'Job expiry date', ['class' => 'bold']) !!}<font style="color:red;">*</font>
        {!! Form::text('expiry_date', null, array('class'=>'form-control datepicker', 'id'=>'expiry_date', 'placeholder'=>'Job expiry date', 'autocomplete'=>'off', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'expiry_date') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'degree_level_id') !!}" id="degree_level_id_div">
        {!! Form::label('degree_level_id', 'Required Degree Level', ['class' => 'bold']) !!}                    
        {!! Form::select('degree_level_id', ['' => 'Select Required Degree Level']+$degreeLevels, null, array('class'=>'form-control', 'id'=>'degree_level_id')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'degree_level_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'major_subject_id') !!}" id="subject_id_div">
        {!! Form::label('major_subject_id', 'Major Subject', ['class' => 'bold']) !!} <font style="color:red;">*</font>                   
        <span id="default_subject_dd">
            {!! Form::select('major_subject_id', ['' => 'Major Subjects'], null, array('class'=>'form-control', 'id'=>'major_subject_id', 'required'=>'required')) !!}
        </span>
        {!! APFrmErrHelp::showErrors($errors, 'major_subject_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}" id="job_experience_id_div">
        {!! Form::label('job_experience_id', 'Required job experience', ['class' => 'bold']) !!}    <font style="color:red;">*</font>                
        {!! Form::select('job_experience_id', ['' => 'Select Required job experience']+$jobExperiences, null, array('class'=>'form-control', 'id'=>'job_experience_id', 'required'=>'required')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!}                                       
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_active') !!}">
        {!! Form::label('is_active', 'Is Active?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_active_1 = 'checked="checked"';
            $is_active_2 = '';
            if (old('is_active', ((isset($job)) ? $job->is_active : 1)) == 0) {
                $is_active_1 = '';
                $is_active_2 = 'checked="checked"';
            }
            ?>
            <label class="radio-inline">
                <input id="active" name="is_active" type="radio" value="1" {{$is_active_1}}>
                Active </label>
            <label class="radio-inline">
                <input id="not_active" name="is_active" type="radio" value="0" {{$is_active_2}}>
                Inactive </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_active') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_featured') !!}">
        {!! Form::label('is_featured', 'Is Featured?', ['class' => 'bold']) !!}
        <div class="radio-list">
            <?php
            $is_featured_1 = '';
            $is_featured_2 = 'checked="checked"';
            if (old('is_featured', ((isset($job)) ? $job->is_featured : 0)) == 1) {
                $is_featured_1 = 'checked="checked"';
                $is_featured_2 = '';
            }
            ?>
            <label class="radio-inline">
                <input id="featured" name="is_featured" type="radio" value="1" {{$is_featured_1}}>
                Featured </label>
            <label class="radio-inline">
                <input id="not_featured" name="is_featured" type="radio" value="0" {{$is_featured_2}}>
                Not Featured </label>
        </div>
        {!! APFrmErrHelp::showErrors($errors, 'is_featured') !!}
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

    <div class="form-group">
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
        <div class="form-group ">
            <label for="is_featured" class="bold">Add Questions to the Job? Click below button.</label>
        </div>

        <div class="row dynamic_questions_container" id="dynamic_questions_container">
            
            <div class="col-md-12" style="margin-top: 12px; margin-bottom: 15px;">
                <button type="button" class="btn btn-success" onClick="return addQuestionsRow()"> <i class="fa fa-plus"></i> Add new Question</button>
            </div>
            <div class="col-md-12 all_multiple_questions_container">
                
                <?php
                $counter_questions = 2;
                if( $all_questions != '' && count($all_questions) > 0 ) {
                    foreach ($all_questions as $key => $question) {
                        ?>
                        <div class="each_question_container question_no_<?php echo $key;?>">
                            
                            <div class="col-md-2">
                                <label>Question Type</label>
                                <select class="form-control" name="questions[<?php echo $key;?>][question_type]" required>
                                    <option value="text" <?php if( $question->question_type == "text" ) {echo "selected";}?>>Text</option>
                                    <option value="video" <?php if( $question->question_type == "video" ) {echo "selected";}?>>Video</option>
                                </select>
                            </div>

                            <div class="col-md-5">
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

    <div class="form-actions">
        {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'button','onclick'=>"submitJob()")) !!}
    </div>
</div>
@push('css')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('admin.shared.tinyMCEFront') 
<script type="text/javascript">
    
    var i=<?php echo $counter_questions+1?>;
    function addQuestionsRow(){ 
        var htm = '<div class="each_question_container question_no_'+i+'">\
                        <div class="col-md-2">\
                            <label>Question Type</label>\
                            <select class="form-control" name="questions['+i+'][question_type]" required>\
                                <option value="text">Text</option>\
                                <option value="video">Video</option>\
                            </select>\
                        </div>\
                        <div class="col-md-5">\
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
    $("input[name='quetions_type']").change(function(){
        if( $(this).val() ) {
            if( $(this).val() == "0" ) {
            } else if( $(this).val() == "video" ) {
            } else if( $(this).val() == "multiple_questions" ) {
            }
        }
    });

    $(document).ready(function () {
        $('.select2-multiple').select2({
            placeholder: "Select Required Skills",
            allowClear: true
        });
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d',
            startDate: new Date()
        });
        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterDefaultStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterDefaultCities(0);
        });
        filterDefaultStates(<?php echo old('state_id', (isset($job)) ? $job->state_id : 0); ?>);
        
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
    function filterDefaultStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.default.states.dropdown.job') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_state_dd').html(response);
                        filterDefaultCities(<?php echo old('city_id', (isset($job)) ? $job->city_id : 0); ?>);
                    });
        }
    }
    function filterDefaultCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.default.cities.dropdown.job') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#default_city_dd').html(response);
                    });
        }
    }

    var delay = 0;
    var offset = 150;

    document.addEventListener('invalid', function(e){
    $(e.target).addClass("invalid");
    $('html, body').animate({scrollTop: $($(".invalid")[0]).offset().top - offset }, delay);
    }, true);
    document.addEventListener('change', function(e){
    $(e.target).removeClass("invalid")
    }, true);

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