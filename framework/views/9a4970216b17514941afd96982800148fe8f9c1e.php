
<div class="userloginbox">
	<div class="container-fluid custom_padding_container_how_it_works">

		<div class="section howitwrap">
    
        <!-- title start -->
        <div class="titleTop">
            <h3 class="w-100">How It Works</h3>
            <p class="text-left w-100">Register an account with ProzTech, Start your first job posting / Search job & send your resume / get Candidates CV.</p>
        </div>
        <!-- title end -->
        <ul class="howlist row">
            <!--step 1-->
            <li class="col-md-4 col-sm-4">
             	<div class="how_it_works_inner">
             		<div class="how_it_works_1">
		                <div class="iconcircle">
		                	<img src="<?php echo url("public/images/account.png");?>" class="how_works_icons">
		                </div>
		                <h4><?php echo e(__('Create An Account')); ?></h4>
		                <p>A custom Account Description can be established for each unique Activity Account.</p>
		                <p class="how_it_Works_custom_link mt-3">
		                	<?php if(Auth::check() || Auth::guard('company')->check()): ?>
			                    <a href="<?php echo e(route('my.profile')); ?>">
			                    	Profile
		                    	</a>
		                    <?php endif; ?> <?php if(!Auth::user() && !Auth::guard('company')->user()): ?>
		                    	<a href="<?php echo e(route('register')); ?>">
		                    		Register
		                    	</a>
		                    <?php endif; ?>
		                </p>
		            </div>
	            </div>
            </li>
            <!--step 1 end-->
            <!--step 2-->
            <li class="col-md-4 col-sm-4">
                <div class="how_it_works_inner">
                	<div class="how_it_works_2">
		                <div class="iconcircle">
		                	<img src="<?php echo url("public/images/search_job.png");?>" class="how_works_icons">
		                </div>
		                <h4><?php echo e(__('Search Desired Job')); ?></h4>
		                <p>After creating an account, You can easily search the jobs, save them make them favourite.</p>
		                <p class="how_it_Works_custom_link  mt-3">
		                	<a href="<?php echo e(url('/jobs')); ?>">Find Job</a>
		                </p>
		            </div>
	            </div>
            </li>
            <!--step 2 end-->
            <!--step 3-->
            <li class="col-md-4 col-sm-4">
            	<div class="how_it_works_inner">
            		<div class="how_it_works_3">
		                <div class="iconcircle">
		                	<img src="<?php echo url("public/images/sebd_resume.png");?>" class="how_works_icons">
		                </div>
		                <h4><?php echo e(__('Send Your Resume')); ?></h4>
		                <p>In Step 3, You can upload your latest Resume to the Job you are applying for. CV is easily Customizeable.</p>
		                <p class="how_it_Works_custom_link mt-3">
		                	<a href="javascript:void(0);">Learn More</a>
		                </p>
		            </div>
	            </div>
            </li>
            <!--step 3 end-->
        </ul>
    </div>

<!-- 		<div class="titleTop">
           <h3><?php echo e(__('Are You Looking For Job!')); ?> </h3>
        </div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nunc ex, maximus vel felis ut, vestibulum tristique enim. Proin eu nulla est. Maecenas tempor euismod suscipit. Sed at libero ante. Vestibulum nec odio lacus.</p>
		
		<?php if(!Auth::user() && !Auth::guard('company')->user()): ?>
		<div class="viewallbtn"><a href="<?php echo e(route('register')); ?>"> <?php echo e(__('Get Started Today')); ?> </a></div>
		<?php else: ?>
		<div class="viewallbtn"><a href="<?php echo e(url('my-profile')); ?>"><?php echo e(__('Build Your CV')); ?> </a></div>
		<?php endif; ?> -->
	</div>
</div>
<?php /**PATH C:\xampp\htdocs\prozjobs\resources\views/includes/login_textV1.blade.php ENDPATH**/ ?>