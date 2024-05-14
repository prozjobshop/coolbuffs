
<?php $__env->startSection('content'); ?>
<!-- Header start -->
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Header end --> 
<!-- Search start -->
<?php echo $__env->make('includes.searchV1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Search End --> 
<!-- Top Employers start -->
<?php echo $__env->make('includes.top_employers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Top Employers ends --> 
<!-- Popular Searches start -->
<?php echo $__env->make('includes.popular_searches', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Popular Searches ends --> 
<!-- Featured Jobs start -->
<?php echo $__env->make('includes.featured_jobsV1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Featured Jobs ends -->

<?php echo $__env->make('includes.job_categories', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Login box start -->
<?php echo $__env->make('includes.login_textV1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Login box ends --> 
<!-- How it Works start -->
<?php echo $__env->make('includes.how_it_worksV1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- How it Works Ends -->

<?php echo $__env->make('includes.home_blogs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Latest Jobs start -->

<?php echo $__env->make('includes.latest_jobs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Latest Jobs ends --> 

<!-- Testimonials start -->
<?php echo $__env->make('includes.testimonials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Testimonials End -->
<!-- Video start -->

<!-- Video end --> 
<!-- Login box start -->

<!-- Login box ends --> 

<!-- Subscribe start -->
<!-- Subscribe End -->
<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?> 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);
    });
</script>
<?php echo $__env->make('includes.country_state_city_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prozjobs\resources\views/welcome.blade.php ENDPATH**/ ?>