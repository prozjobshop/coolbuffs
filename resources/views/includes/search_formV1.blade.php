@if(Auth::guard('company')->check())
<h3 class="seekertxt" style="margin-top: 100px !important;">{{__('One million success stories')}}. <span>{{__('Search Applicant')}}.</span></h3>
<form action="{{route('job.seeker.list')}}" method="get">
	<div class="searchbar">
		<div class="srchbox seekersrch input-group ">
		<div class="input-group">
		  <input type="search"  name="search" id="empsearch" value="{{Request::get('search', '')}}" class="form-control" placeholder="{{__('Enter Applicant Details')}}" autocomplete="off" />
		  <span class="input-group-btn">
			<input type="submit" class="btn" value="{{__('Search Applicant')}}">
		  </span>
		</div>
		</div>
	</div>
</form> 
@else
<div class="searchbar ml-xs-0 ml-sm-0 ml-md-2">
	<p class="find_dream_job">FIND YOUR <span>DREAM JOB</span></p>
	<p class="find_dream_job easily_quickly">EASILY AND QUICKLY</p>

	<!-- <h3>{{__('One million success job stories')}}. <span>{{__('Start yours today')}}.</span></h3> -->
		<div class="row">
			<div class="col-lg-12 col-xl-6">
				<form action="{{route('job.list')}}" method="get" class="find_jobs_filter">
					<div class="srchbox">
						<div class="srform mb-xs-1 mb-sm-1 mb-md-2 mb-lg-2 mb-xl-4 custom_margin_responsive">
							<!-- <label for=""> {{__('Keywords / Job Title')}}</label> -->
							<input type="text" name="search" value="{{Request::get('search', '')}}" class="form-control custom_job_title_field typeahead typeahead_job" placeholder="{{__('Enter Skills / Job Title')}}" autocomplete="off" id="job_page_typehead" style="font-size:18px; margin-left:-6px;" />
						</div>
						@if((bool)$siteSetting->country_specific_site)
        {!! Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')) !!}
        @else
		<div class="srform mb-xs-1 mb-sm-1 mb-md-2 mb-lg-2 mb-xl-10" >
			<!-- <label for="">{{__('Select Country')}}</label>-->
            {!! Form::select('country_id[]', ['' => __('Select Country')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control custom_job_title_field typeahead typeahead_job', 'id'=>'country_id' ,'style'=>'font-size:18px;  margin-left:-6px; text-align:left')) !!}
               @endif
		</div>
							<!-- <div class="row">
								<div class="col-md-6"><div class="srform">
									<label for="">{{__('Select State')}}</label>
			            			<span id="state_dd">
			                			{!! Form::select('state_id[]', ['' => __('Select State')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')) !!}
						            </span>
						        </div>
						        </div>	
									<div class="col-md-6"> <div class="srform">
										<label for="">{{__('Select City')}}</label>
							            <span id="city_dd">
							                {!! Form::select('city_id[]', ['' => __('Select City')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')) !!}
							            </span>
						        	</div>
						       	</div>	
							</div> -->
					</div>
					<div class="srchbtn">
						<input type="submit" style="margin-left:-12px;" class="btn w-100 custom_margin_top_search_job" value="{{__('Search Job')}}">
					</div>
				</form>
			</div>
		
		
			<div class="col-lg-12 col-xl-6">
				<form action="{{route('job.list')}}" method="get" class="find_jobs_filter get_noticed_background_image">
					<div class="srchbox">
						
						<p class="get_noticed">
							GET NOTICED!
						</p>
						<p class="lets_register">
							Let’s Get Started, <br />
							Create Your Profile Now. 
						</p>
					</div>

					<div class="srchbtn get_noticed_register_btn_container">
							@if(Auth::check() || Auth::guard('company')->check())
			                    <a href="{{ route('my.profile') }}">
		                    		<input type="button" class="btn w-100 custom_margin_top_search_job" value="Profile">	
		                    	
								</a>
		                    @endif @if(!Auth::user() && !Auth::guard('company')->user())
		                    	<a href="{{route('register')}}">
		                    		<input type="button" class="btn w-100 custom_margin_top_search_job" value="Register">	
		                    	</a>
		                    @endif
						</a>
					</div>
				</form>
			</div>

		</div>
</div> @endif
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>
   var availableTags = [];
   var availableTagsJob = [];
   $.ajax({
	method: "GET",
	url: "{{route('job.seeker.applicant.searching')}}",
	success: function(response){
		// console.log(response);
		startAutoComplete(response);

	}
   })
   function startAutoComplete(availableTags)
   {
	$( "#empsearch" ).autocomplete({
      source: availableTags,
	  minLength: 1, // Minimum number of characters to trigger autocomplete
      maxResults: 5, // Maximum number of results to display
    });
   }
   
</script>
<script>
	 $(document).ready(function ($) {
        $("#search-job-list").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("#search-job-list").find(":input").prop("disabled", false);
		}
		)
</script>