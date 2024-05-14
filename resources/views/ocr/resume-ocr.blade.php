<!-- @extends('layouts.app') -->
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Resume Upload')])

<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
              {{-- @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif --}}


              {{-- @if(session('errorMsg'))
                  <div class="alert alert-danger">{{ session('errorMsg') }}</div>
              @endif

              @if(session('successMsg'))
                  <div class="alert alert-success">{{ session('successMsg') }}</div>
              @endif --}}


              <h5 id="testFunc">Resume Upload</h5>
              <div class="userccount">
                  <div class="formpanel mt0">  
                      <!-- Personal Information -->
                      <form method="POST" action="{{ route('resume-ocr-post') }}" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="_token" value="{!! csrf_token() !!}"> --}}
                        @csrf
                        {{-- <h5>Resume Upload</h5> --}}

                        <div class="row">
                          <div class="col-12">

                            @if ($errors->any())
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                                </ul>
                                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button> --}}
                              </div>
                            @endif

              
                            @if(Session::has('successMsg'))
                              {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{Session::get('successMsg')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div> --}}

                              <div class="alert alert-success" role="alert">
                                {{Session::get('successMsg')}}
                              </div>
                            @endif
                          </div>
                          
                          <div class="col-md-6">
                            <div class="formrow">
                            <label>Upload your resume (PDF)</label>
                              <label for="file" class="btn btn-default"> 
                                <input type="file" name="file" id="file" required>
                              </label>
                            </div>
                          </div>
                         <!--
                          <span style="margin-left:13px; margin-top:20px; margin-bottom:-12px">
                          <div class="formrow">
                            
                          <label>
                          AI may not capture all essential information from your resume. Please complete any missing details in the preview after uploading your resume to ensure accuracy.</label>  
                           
                            </div>   </span> 
                              -->          
                                                          
                          <div class="col-md-12">
                            <div class="formrow">
                              <button type="submit" class="btn">Submit  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                      </form>
                  </div>
              </div>

              {{-- @isset ($user)
                <div class="">
                  <p>Name : {{ $user['name'] }}</p>
                  <p>Phone : {{ $user['phone'] }}</p>
                  <p>Email : {{ $user['email'] }}</p>

                  <h4>Education</h4>
                  @foreach ($user['education'] as $key => $value )
                    <p>{{ $value }}</p>
                  @endforeach

                  <hr><hr>
                  <h4>Experience</h4>
                  @foreach ($user['experience'] as $key => $value )
                    <p>{{ $value }}</p>
                  @endforeach
                </div>
              @endisset --}}
            
              @isset($user)
              <hr>
              <br>

              <h5>Resume Information</h5>
              <div class="userccount">
                  
                <div class="formpanel mt0">  

                  <!-- Personal Information -->
                  <form id="updateUploadedResume" method="POST" action="{{ route('resume-ocr-post') }}" accept-charset="UTF-8" class="form">
                    @csrf
                    
                    <div class="row">
                      <?php

                      // dd($user);
                        // $fullName = explode(" ", $user['name']);
                        // $firstWord = array_key_first($fullName);
                        $nameParts = explode(" ", $user['name'], 2);
                        $firstName = isset($nameParts[0]) ? $nameParts[0] :'';
                        $restOfName = isset($nameParts[1]) ?  $nameParts[1] : '';
                      ?>

                      <div class="col-md-6">
                        <div class="formrow ">
                          <label for="first_name">First Name</label>
                          <input class="form-control" id="first_name" placeholder="First Name" name="first_name" type="text" value="{{ $firstName }}">
                        </div>
                      </div>

                      

                      <div class="col-md-6">
                        <div class="formrow ">
                          <label for="last_name">Last Name</label>
                          <input class="form-control" id="last_name" placeholder="Last Name" name="last_name" type="text" value="{{ $restOfName }}">
                        </div>
                      </div>
                  

                      <div class="col-md-6">
                        <div class="formrow ">
                          <label for="mobile_num">Mobile</label>
                          {{-- <input class="form-control" id="mobile_num" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.,+,' ']/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="mobile_num" type="text" value=""> --}}
                          <input class="form-control" id="mobile_num" placeholder="Mobile Number" name="mobile_num" type="text" value="{{ isset($user['phone']) ? $user['phone'] : '' }}">
                        </div>
                      </div>

                    </div>

                    <hr>

                  </form>

                    <div id="add_education_modal"></div>




                    <div id="add_experience_modal"></div>




                    <div class="row">

                      <div class="col-md-12">
                        <div class="formrow">
                          <button type="button" id="UploadedResumeSubmit" class="btn">Update Profile and Save  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                        </div>
                      </div>

                    </div>

                  {{-- </form> --}}
                </div>
              </div>
              @endisset
              

            </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
    <style type="text/css">
        .userccount {
          padding: 30px 50px 20px;
        }
        .datepicker>div {
            display: block;
        }
    </style>
@endpush



@isset($user)

  <?php
    $jsonArray = json_encode($user);
  ?>

  @push('scripts')
    <script>

      $(document).ready(function(){
        // var dataArray = [1, 2, 3, 4, 5];

        var resume_data = <?php echo $jsonArray; ?>;
        $.ajax({
    
            type: "POST",
    
            url: "{{ route('get.front.profile.education.form', Auth()->user()->id) }}",
    
            // data: {"_token": "{{ csrf_token() }}"},

            data: {
              "_token": "{{ csrf_token() }}",
              "from_ocr": "1",
              "resume_data": resume_data
            },

    
            datatype: 'json',
    
            success: function (json) {
    
              $("#add_education_modal").html(json.html);
              console.log(json);
          
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });

        $.ajax({

          type: "POST",

          url: "{{ route('get.front.profile.experience.form', Auth()->user()->id) }}",

          data: {
              "_token": "{{ csrf_token() }}",
              "from_ocr": "1",
              "resume_data": resume_data
          },

          datatype: 'json',

          success: function (json) {

            $("#add_experience_modal").html(json.html);

            initdatepicker();

            // filterDefaultStatesExperience(0, 0);

          }

        });

      // });

      // $(document).ready(function(){

        // showEducation();
        // initdatepicker();
        $(document).on('change', '#degree_level_id', function (e) {
                e.preventDefault();
                // filterDegreeTypes(0);
                filterDefaultSubjects(0);
        });

        $(document).on('change', '#education_country_id', function (e) {
                e.preventDefault();
                filterLangStatesEducation(0, 0);
        });

        $(document).on('change', '#education_state_id', function (e) {
                e.preventDefault();
                filterLangCitiesEducation(0);
        });


        $(document).on('change', '#experience_country_id', function (e) {

          e.preventDefault();

          filterDefaultStatesExperience(0, 0);

        });

        $(document).on('change', '#experience_state_id', function (e) {

          e.preventDefault();

          filterDefaultCitiesExperience(0);

        });


        exp_successful = 0;
        edu_successful = 0;

        // $('#updateUploadedResume').submit(function(event) {
        // $('#UploadedResumeSubmit').click(function(event) {
        $(document).on('click', '#UploadedResumeSubmit', function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // submitProfileExperienceForm().then(function(is_profile_education) {
            //     if (is_profile_education) {
            //         // console.log('true1');
            //         $('#updateUploadedResume').submit();
            //     } else {
            //         console.log('false123');
            //         // return false;
            //     }
            // });

            

            if(exp_successful == 0){
              var experiencePromise = submitProfileExperienceForm();
            }
            if(edu_successful == 0){
              var educationPromise = submitProfileEducationForm();
            }

            Promise.all([experiencePromise, educationPromise]).then(function(results) {
              
                // var is_experience_successful = results[0];
                // var is_education_successful = results[1];

                
                // if(exp_successful == 0){
                  var is_experience_successful = results[0];

                  if(is_experience_successful){
                    exp_successful = 1;
                  }
                // }
                // if(edu_successful == 0){
                  var is_education_successful = results[1];
                  
                  if(is_education_successful){
                    edu_successful = 1;
                  }
                // }

                // console.log(exp_successful);
                // if (is_experience_successful && is_education_successful) {
                if (exp_successful == 1 && edu_successful == 1) {
                    $('#first_name').val('1');
                    $('#updateUploadedResume').submit();
                } else {
                  // $('#updateUploadedResume').submit();
                    console.log('One or both AJAX calls failed, form not submitted.');
                }
            });

            // $('#updateUploadedResume').submit();
        });

        function submitProfileExperienceForm() {
          return new Promise(function(resolve, reject) {

            var form = $('#add_edit_profile_experience');
            // var csrf = $('#add_education_modal').find('input[name="_token"]');
            // var form = $('#add_edit_profile_experience_ih');


            // console.log(form.serialize());
            // throw new Error('something went wrong');


            $.ajax({

              url     : form.attr('action'),

              type    : form.attr('method'),

              // data    : form.serialize() + '&_token=' + csrf.val(),
              data    : form.serialize(),

              dataType: 'json',

              success : function (json){

                // $ ("#add_experience_modal").html(json.html);

                // showExperience();

                // console.log('Experience form submitted successfully.');
                resolve(true);
              },

              error: function(json){

                if (json.status === 422) {

                  var resJSON = json.responseJSON;

                  $('.help-block').html('');

                  $.each(resJSON.errors, function (key, value) {

                    $('.' + key + '-error').html('<strong>' + value + '</strong>');

                    $('#div_' + key).addClass('has-error');

                  });

                } else {

                // Error

                // Incorrect credentials

                // alert('Incorrect credentials. Please try again.')

                }
                // console.log('Experience form submit failure.');
                resolve(false);
              }

            });
          });
        }

        function submitProfileEducationForm() {
          return new Promise(function(resolve, reject) {
          // return false;
          
            var form = $('#add_edit_profile_education');

            // console.log(form.serialize());
            // throw new Error('something went wrong');

            
            var additionalData = {
              x_first_name: $('#first_name').val(),
              x_last_name: $('#last_name').val(),
              x_mobile_num: $('#mobile_num').val(),
            };
            
            var formData = form.serialize();
            
            formData += '&' + $.param(additionalData);

            // throw new Error('Something not found....');

            $.ajax({

                    url     : form.attr('action'),
                    type    : form.attr('method'),
                    data    : formData,
                    dataType: 'json',

                    success : function (json){

                      // $ ("#add_education_modal").html(json.html);
                      resolve(true);

                    },

                    error: function(json){

                      if (json.status === 422) {

                        var resJSON = json.responseJSON;

                        // console.log('resJSON 123');

                        $('.help-block').html('');

                        $.each(resJSON.errors, function (key, value) {

                        $('.' + key + '-error').html('<strong>' + value + '</strong>');

                        $('#div_' + key).addClass('has-error');

                        });

                        // return false;
                      } else {

                        // Error

                        // Incorrect credentials

                        // alert('Incorrect credentials. Please try again.')
                        // console.log('json 321');

                      }

                      resolve(false);
                    }

            });
          });

        }


      });


      function filterDefaultSubjects(subject_id)
      {
          var degree_level_id = $('#degree_level_id').val();
          if (degree_level_id != '') {
              $.post("{{ route('filter.default.subject.dropdown.job.profile') }}", {degree_level_id: degree_level_id, subject_id: subject_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                      .done(function (response) {
                          $('#default_subject_dd').html(response);
                      });
          }
      }

      function filterLangStatesEducation(state_id, city_id){

        var country_id = $('#education_country_id').val();

        if (country_id != ''){

        $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, new_state_id: 'education_state_id', _method: 'POST', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                $('#default_state_education_dd').html(response);

                filterLangCitiesEducation(city_id);

                });

        }

      }

      function filterLangCitiesEducation(city_id){

        var state_id = $('#education_state_id').val();

        if (state_id != ''){

        $.post("{{ route('filter.lang.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                $('#default_city_education_dd').html(response);

                });

        }

      }



      function filterDefaultStatesExperience(state_id, city_id)
      {

        var country_id = $('#experience_country_id').val();

        if (country_id != ''){

        $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, new_state_id: 'experience_state_id', _method: 'POST', _token: '{{ csrf_token() }}'})

                .done(function (response) {

                $('#default_state_experience_dd').html(response);

                filterDefaultCitiesExperience(city_id);

                });

        }

      }

    function filterDefaultCitiesExperience(city_id)
    {

      var state_id = $('#experience_state_id').val();

      if (state_id != ''){

      $.post("{{ route('filter.lang.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})

              .done(function (response) {

              $('#default_city_experience_dd').html(response);

              });

      }

    }
      

    function initdatepicker(){

      $('#date_start').datepicker({
          autoclose:true,
          format:'yyyy-m-d',
          'endDate': new Date()
      }).on('changeDate',function(e){
          $('#date_end').datepicker('setStartDate',e.date)
      });

      $('#date_end').datepicker({
          autoclose:true,
          format:'yyyy-m-d',
          'endDate': new Date()
      }).on('changeDate',function(e){
          $('#date_start').datepicker('setEndDate',e.date)
      })
    }
      
            
    </script>
  @endpush
@endisset


@push('scripts')
@include('includes.immediate_available_btn')
<script>

  $(document).ready(function(){
    // var profileEducationStatus = 0;
    // console.log(profileEducationStatus);
    // $.ajax({

    //     type: "POST",

    //     url: "{{ route('get.front.profile.education.form', '1') }}",

    //     data: {"_token": "{{ csrf_token() }}"},

    //     datatype: 'json',

    //     success: function (json) {

    //       $("#add_education_modal").html(json.html);
    //       console.log(json);
       
    //     },
    //     error: function(xhr, status, error) {
    //         // Handle errors
    //         console.error(error);
    //     }
    // });
    
    $('.get-temp').click(function(){
      
      // title = $(this).find('figcaption').text();
      // img = $(this).find('img').attr('src');

      // $('.jobimg').find('img').attr('src', img);
      // $('.jobinfo').find('h3 a').text(title);

      _this = $(this);
      temp_id = _this.attr('data-get-temp');

      $.ajax({
        url: "{{url('set-resume-template')}}",
        method: "post",
        dataType: 'json',
        data: {
            _token: '{{ csrf_token() }}',
            temp_id: temp_id,
        },
        beforeSend: function(){
          // $('.order_history').css('min-height', '180px');
          $('.cv-template').removeClass('selected_border');
          $('.cv-template').find('label').removeClass('d-inline-block');
          $('.cv-template').find('label').addClass('d-none');
        },
        success: function (response) {
          // console.log(response);

          // reload page only once if resume is first time generated
          if(response == '0'){
            location.reload();
          }else{
            title = _this.find('figcaption').text();
            img = _this.find('img').attr('src');

            $('.jobimg').find('img').attr('src', img);
            $('.jobinfo').find('h3 a').text(title);

            _this.parent('div').addClass('selected_border');
            _this.find('label').addClass('d-inline-block');
          }

        },
        error: function () {
          console.log('fail consol.e')
        }
      });

      

    })
    
  });

  function showProfileEducationModal(){

    alert('ok');
    // $("#add_education_modal").modal();

    // loadProfileEducationForm();

  }

  // showProfileEducationModal();
</script>
@endpush