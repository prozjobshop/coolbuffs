<?php if(Auth::guard('company')->check()): ?>
<h3 class="seekertxt" style="margin-top: 100px !important;"><?php echo e(__('One million success stories')); ?>. <span><?php echo e(__('Search Applicant')); ?>.</span></h3>
<form action="<?php echo e(route('job.seeker.list')); ?>" method="get">
	<div class="searchbar">
		<div class="srchbox seekersrch input-group ">
			<div class="col-lg-8">
				<input type="text" name="search" id="empsearch" value="<?php echo e(Request::get('search', '')); ?>" class="form-control w-100 typeahead typeahead_user" placeholder="<?php echo e(__('Enter Applicant Details')); ?>" autocomplete="off" /> 
				
					
			</div>
			<div class="col-lg-4">
				<input type="submit" class="btn" value="<?php echo e(__('Search Applicant')); ?>">
			</div>
		</div>
	</div>
</form> <?php else: ?>
<div class="searchbar ml-xs-0 ml-sm-0 ml-md-2">
	<p class="find_dream_job">FIND YOUR <span>DREAM JOB</span></p>
	<p class="find_dream_job easily_quickly">EASILY AND QUICKLY</p>

	<!-- <h3><?php echo e(__('One million success job stories')); ?>. <span><?php echo e(__('Start yours today')); ?>.</span></h3> -->
		<div class="row">
			<div class="col-lg-12 col-xl-6">
				<form action="<?php echo e(route('job.list')); ?>" method="get" class="find_jobs_filter">
					<div class="srchbox">
						<div class="srform mb-xs-1 mb-sm-1 mb-md-2 mb-lg-2 mb-xl-4 custom_margin_responsive">
							<!-- <label for=""> <?php echo e(__('Keywords / Job Title')); ?></label> -->
							<input type="text" name="search" id="jbsearch" value="<?php echo e(Request::get('search', '')); ?>" class="form-control custom_job_title_field typeahead typeahead_job" placeholder="<?php echo e(__('Enter Skills / Job Title')); ?>" autocomplete="off" style="font-size:18px; margin-left:-6px;" />
						</div>
						<?php if((bool)$siteSetting->country_specific_site): ?>
        <?php echo Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')); ?>

        <?php else: ?>
		<div class="srform mb-xs-1 mb-sm-1 mb-md-2 mb-lg-2 mb-xl-10" >
			<!-- <label for=""><?php echo e(__('Select Country')); ?></label>-->
            <?php echo Form::select('country_id[]', ['' => __('Select Country')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control custom_job_title_field typeahead typeahead_job', 'id'=>'country_id' ,'style'=>'font-size:18px;  margin-left:-6px; text-align:left')); ?>

               <?php endif; ?>
		</div>
							<!-- <div class="row">
								<div class="col-md-6"><div class="srform">
									<label for=""><?php echo e(__('Select State')); ?></label>
			            			<span id="state_dd">
			                			<?php echo Form::select('state_id[]', ['' => __('Select State')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')); ?>

						            </span>
						        </div>
						        </div>	
									<div class="col-md-6"> <div class="srform">
										<label for=""><?php echo e(__('Select City')); ?></label>
							            <span id="city_dd">
							                <?php echo Form::select('city_id[]', ['' => __('Select City')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')); ?>

							            </span>
						        	</div>
						       	</div>	
							</div> -->
					</div>
					<div class="srchbtn">
						<input type="submit" style="margin-left:-12px;" class="btn w-100 custom_margin_top_search_job" value="<?php echo e(__('Search Job')); ?>">
					</div>
				</form>
			</div>
		
		
			<div class="col-lg-12 col-xl-6">
				<form action="<?php echo e(route('job.list')); ?>" method="get" class="find_jobs_filter get_noticed_background_image">
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
							<?php if(Auth::check() || Auth::guard('company')->check()): ?>
			                    <a href="<?php echo e(route('my.profile')); ?>">
		                    		<input type="button" class="btn w-100 custom_margin_top_search_job" value="Profile">	
		                    	
								</a>
		                    <?php endif; ?> <?php if(!Auth::user() && !Auth::guard('company')->user()): ?>
		                    	<a href="<?php echo e(route('register')); ?>">
		                    		<input type="button" class="btn w-100 custom_margin_top_search_job" value="Register">	
		                    	</a>
		                    <?php endif; ?>
						</a>
					</div>
				</form>
			</div>

		</div>
</div> <?php endif; ?><?php /**PATH C:\xampp\htdocs\prozjobs\resources\views/includes/search_formV1.blade.php ENDPATH**/ ?>