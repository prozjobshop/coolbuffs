<div class="modal-body">
    <div class="form-body">
        <div class="formrow" id="div_degree_level_id">
            <?php
            $degree_level_id = (isset($profileEducation) ? $profileEducation->degree_level_id : null);

            $array1 = $degreeLevels;
            $array2 = isset($resume_data['education']['edu_title']) ? $resume_data['education']['edu_title'] : [];

            function checkArrayValues($array1, $array2) {
                foreach ($array1 as $key => $value1) {
                    foreach ($array2 as $key1 => $value2) {
                        if (strpos($value2, $value1) !== false) {
                            return $key;
                        }
                    }
                }
                return false;
            }
            
            $result = checkArrayValues($array1, $array2);

            ?>
            @if($result)
              {!! Form::select('degree_level_id', [''=>__('Select Degree Level')]+$degreeLevels, $result, array('class'=>'form-control', 'id'=>'degree_level_id')) !!}
            @else
              {!! Form::select('degree_level_id', [''=>__('Select Degree Level')]+$degreeLevels, $degree_level_id, array('class'=>'form-control', 'id'=>'degree_level_id')) !!}
            @endif
            <span class="help-block degree_level_id-error text-danger"></span>
        </div>


        {{-- <div class="formrow" id="div_degree_type_id">
            @php
                $degree_type_id = (isset($profileEducation) ? $profileEducation->degree_type_id : null);
            @endphp
            <span id="degree_types_dd">
                {!! Form::select('degree_type_id', [''=>__('Select Degree Type')], $degree_type_id, array('class'=>'form-control', 'id'=>'degree_type_id')) !!}
            </span>
            <span class="help-block degree_type_id-error"></span>
        </div>

        <div class="formrow" id="div_degree_title">
            <input class="form-control" id="degree_title" placeholder="{{__('Degree Title')}}" name="degree_title" type="text" value="{{(isset($profileEducation)? $profileEducation->degree_title:'')}}">
            <span class="help-block degree_title-error"></span>
        </div> --}}

        {{-- <div class="formrow" id="div_major_subjects">
            @php
                $profileEducationMajorSubjectIds = old('major_subjects', $profileEducationMajorSubjectIds);
            @endphp
            {{ $profileEducationMajorSubjectIds[0] }}
            {!! Form::select('major_subjects[]', $majorSubjects, $profileEducationMajorSubjectIds, array('class'=>'form-control select2-multiple', 'id'=>'major_subjects', 'multiple'=>'multiple')) !!}
            <span class="help-block major_subjects-error"></span>
        </div> --}}

        
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'major_subjects') !!}" id="major_subject_div">
            <span id="default_subject_dd"> 
                {!! Form::select('major_subjects[]', ['' => __('Major Subjects')], null, array('class'=>'form-control', 'id'=>'major_subjects')) !!} 
            </span>
            <span class="help-block major_subjects-error text-danger"></span>
        </div>
        

        <div class="formrow" id="div_country_id">
            <?php
            $country_id = (isset($profileEducation) ? $profileEducation->country_id : $siteSetting->default_country_id);
            ?>
            {!! Form::select('country_id', [''=>__('Select Country')]+$countries, $country_id, array('class'=>'form-control', 'id'=>'education_country_id')) !!}
            <span class="help-block country_id-error text-danger"></span> </div>

        <div class="formrow" id="div_state_id">
            <span id="default_state_education_dd">
                {!! Form::select('state_id', [''=>__('Select State')], null, array('class'=>'form-control', 'id'=>'education_state_id')) !!}
            </span>
            <span class="help-block state_id-error text-danger"></span> </div>

        <div class="formrow" id="div_city_id">
            <span id="default_city_education_dd">
                {!! Form::select('city_id', [''=>__('Select City')], null, array('class'=>'form-control', 'id'=>'city_id')) !!}
            </span>
            <span class="help-block city_id-error text-danger"></span> </div>

            <?php
              $degree_institution = '';

              if(isset($resume_data['education']['edu_title'])){
                if(count($resume_data['education']['edu_title']) > 0){
                    
                    if ($resume_data['education']['edu_title'][3]) {
                        
                        $degree_institution = $resume_data['education']['edu_title'][3];
                    }else{
                        $degree_institution = $resume_data['education']['edu_title'][2];
                        
                    }
                  $degree_institution = preg_replace('/[^A-Za-z\s]/', '', $degree_institution);
                  
                }
              }
            ?>
        <div class="formrow" id="div_institution">
            {{-- <input class="form-control" id="institution" placeholder="{{__('Institution')}}" name="institution" type="text" value="{{(isset($profileEducation)? $profileEducation->institution:'')}}"> --}}
            {{-- <input class="form-control" id="institution" placeholder="{{__('Institution')}}" name="institution" type="text" value="{{ trim($degree_institution," ") }}"> --}}
            <input class="form-control" id="institution" placeholder="{{__('Institution')}}" name="institution" type="text" value="{{ isset($resume_data['education']['edu_title']) ? trim($degree_institution,' ') : (isset($profileEducation) ? $profileEducation->institution : '') }}">
            <span class="help-block institution-error text-danger"></span> </div>


        <div class="formrow" id="div_date_completion">
            <?php
            $date_completion = (isset($profileEducation) ? $profileEducation->date_completion : null);

            $array1 = MiscHelper::getEstablishedIn();
            $array2 = isset($resume_data['education']['edu_dates']) ? $resume_data['education']['edu_dates'] : [];

            $result = checkArrayValues($array1, $array2);

            ?>
            @if($result)
              {!! Form::select('date_completion', [''=>__('Select Year')]+MiscHelper::getEstablishedIn(), $result, array('class'=>'form-control', 'id'=>'date_completion')) !!}
            @else
              {!! Form::select('date_completion', [''=>__('Select Year')]+MiscHelper::getEstablishedIn(), $date_completion, array('class'=>'form-control', 'id'=>'date_completion')) !!}
            @endif
            <span class="help-block date_completion-error text-danger"></span> </div>


        <div class="formrow" id="div_degree_result">
            <input class="form-control" id="degree_result" placeholder="{{__('Degree Result')}}" name="degree_result" type="text" value="{{(isset($profileEducation)? $profileEducation->degree_result:'')}}">
            <span class="help-block degree_result-error text-danger"></span> </div>



        {{-- <div class="formrow" id="div_result_type_id">
            <?php
            // $result_type_id = (isset($profileEducation) ? $profileEducation->result_type_id : '1');
            ?>
            {!! Form::select('result_type_id', ['1'=>__('Select Result Type')]+$resultTypes, $result_type_id, array('class'=>'form-control', 'id'=>'result_type_id')) !!}
            <span class="help-block result_type_id-error text-danger"></span> </div> --}}
        <div class="formrow" id="div_result_type_id">
            <?php
            $result_type_id = (isset($profileEducation) ? $profileEducation->result_type_id : null);
            ?>
            {!! Form::select('result_type_id', [''=>__('Select Result Type')]+$resultTypes, $result_type_id, array('class'=>'form-control', 'id'=>'result_type_id')) !!}
            <span class="help-block result_type_id-error text-danger"></span> </div>        

    </div>
</div>
<script>
    filterDefaultSubjects(<?php echo old('state_id',  @$profileEducationMajorSubjectIds[0]); ?>);
</script>