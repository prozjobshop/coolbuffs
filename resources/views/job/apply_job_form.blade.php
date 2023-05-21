@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Apply on Job')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container"> @include('flash::message')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="userccount">
                    <div class="formpanel"> {!! Form::open(array('enctype' => 'multipart/form-data', 'id' => 'submit-job-form', 'method' => 'post', 'route' => ['post.apply.job', $job_slug])) !!} 
                        <!-- Job Information -->
                        <h6>{{$job->title}}</h6>
                        <div class="row">
                                
                            <div class="col-md-12">
                                <h5>CV<span style="color:red"> *</span></h5>
                                <div class="formrow{{ $errors->has('cv_id') ? ' has-error' : '' }}"> {!! Form::select('cv_id', [''=>__('Select CV ')]+$myCvs, null, array('required'=>'required','class'=>'form-control', 'id'=>'cv_id')) !!}
                                    @if ($errors->has('cv_id')) <span class="help-block"> <strong>{{ $errors->first('cv_id') }}</strong> </span> @endif </div>
                            </div>
                            <div class="col-md-6">
                            <h5>Current Salary<span style="color:red"> *</span></h5>
                                <div class="formrow{{ $errors->has('current_salary') ? ' has-error' : '' }}"> {!! Form::number('current_salary', null, array('required'=>'required','class'=>'form-control', 'id'=>'current_salary', 'placeholder'=>__('Enter Current CTC ').' ('.$job->getSalaryPeriod('salary_period').')', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" )) !!}
                                    @if ($errors->has('current_salary')) <span class="help-block"> <strong>{{ $errors->first('current_salary') }}</strong> </span> @endif </div>
                            </div>
                            <div class="col-md-6">
                            <h5>Expected Salary<span style="color:red"> *</span></h5>
                                <div class="formrow{{ $errors->has('expected_salary') ? ' has-error' : '' }}"> {!! Form::number('expected_salary', null, array('required'=>'required','class'=>'form-control', 'id'=>'expected_salary', 'placeholder'=>__('Enter Expected CTC').' ('.$job->getSalaryPeriod('salary_period').')', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');")) !!}
                                    @if ($errors->has('expected_salary')) 
                                        <span class="help-block"> 
                                            <strong>{{ $errors->first('expected_salary') }}</strong> 
                                        </span> 
                                    @endif
                                    <span id="expected_salary_greater" style="color:red;"></span> 
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                            <h5>Salary Currency<span style="color:red"> *</span></h5>
                                <!-- <div class="formrow{{ $errors->has('salary_currency') ? ' has-error' : '' }}"> {!! Form::text('salary_currency', Request::get('salary_currency', $siteSetting->default_currency_code), array('required'=>'required','class'=>'form-control', 'id'=>'salary_currency', 'placeholder'=>__('Salary Currency'), 'autocomplete'=>'off')) !!}
                                    @if ($errors->has('salary_currency')) <span class="help-block"> <strong>{{ $errors->first('salary_currency') }}</strong> </span> @endif </div> -->
                                <select class="form-control" required id="salary_currency" name="salary_currency">
                                    <?php
                                    if( isset($currencies) && $currencies != '' && is_array($currencies) && count($currencies) > 0 ) {?>
                                        <option value="">Select Salary Currency</option><?php
                                        foreach ($currencies as $key => $currency) {?>
                                            <option value="<?php echo $currency;?>"><?php echo $currency;?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class="col-md-12">
                                    <?php
                                    $all_questions = "";
                                    if( isset($job->data) && $job->data != '' ) {
                                        $JSON = json_decode($job->data);
                                        if( $JSON != '' && count($JSON) > 0 ) {
                                            $all_questions = $JSON;
                                        }
                                    }

                                    if( ( $all_questions != '' && count($all_questions) > 0 ) ) {?>
                                        <div class="col-md-12 pl-0">
                                            <span style="color: red;">
                                                *Please answer of the following questions to apply on the job.
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8 pl-0">    
                                                    <?php
                                                    if( $all_questions != '' && count($all_questions) > 0 ) {
                                                        foreach ($all_questions as $key => $question) {
                                                            ?>
                                                            <div class="row mt-3">
                                                                <div class="col-md-12"><?php echo "<span style='color:red;'>*</span>".$question->question;?></div>
                                                                <div class="col-md-12">
                                                                    <input type="hidden" class="form-control" name="question_answers[<?php echo $key;?>][question]" value="<?php echo $question->question;?>" />
                                                                    <input type="hidden" class="form-control" name="question_answers[<?php echo $key;?>][question_type]" value="<?php echo $question->question_type;?>" />
                                                                    <?php
                                                                        if( $question->question_type == "text" ) {?>
                                                                            <input type="text" class="form-control" name="question_answers[<?php echo $key;?>][answer]" maxlength="10000" required />
                                                                        <?php
                                                                        } else if( $question->question_type == "video" ) {?>
                                                                            <input type="file" class="form-control" name="question_answers_files[<?php echo $key;?>]" required onchange="checkextension(this)" />
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                            </div>

                        </div>
                        <br>
                        <input type="button" onclick="submitJob()" class="btn" value="{{__('Apply on Job')}}">
                        {!! Form::close() !!} </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts') 
<script>

    function checkextension(_this){
        var fileExtension = ['mp4'];
        if ($.inArray($(_this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only .MP4 formats are allowed : "+fileExtension.join(', '));
            $(_this).val("");
        }
    }

    // $("#FilUploader").change(function () {
    //     var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    //     if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
    //         alert("Only formats are allowed : "+fileExtension.join(', '));
    //     }
    // });

    // $(document).ready(function () {
    //     $('#salary_currency').typeahead({
    //         source: function (query, process) {
    //             return $.get("{{ route('typeahead.currency_codes') }}", {query: query}, function (data) {
    //                 console.log(data);
    //                 data = $.parseJSON(data);
    //                 return process(data);
    //             });
    //         }
    //     });

    // });
    function submitJob(){
        var current_salary = parseInt($('#current_salary').val());
        var expected_salary = parseInt($('#expected_salary').val());
        var is_true = true;

        if(current_salary >= expected_salary){
            $('#expected_salary_greater').text('(Expected salary) must be greater than (Current salary)');
            is_true = false;
        }else{
            $('#expected_salary_greater').text('');
            is_true = true;
        }
        if(is_true){
            $('#submit-job-form').submit();
        }
    }
</script> 
@endpush