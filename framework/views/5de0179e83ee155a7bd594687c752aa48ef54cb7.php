<div class="subscribe pl-xs-0 pl-sm-0 pl-md-5 pl-lg-5">
  <div class="container-fluid subscribe_custom_pafdding">
   
    <div class="row subscribe_custom_container m-0">
		
		<div class="col-lg-12">
		
		    <h6>Subscribe Our Newsletter For The Daily Update</h6> 
            <p>By Entering your email address, you are agreeing to receive marketing emails from ProzTech Job Portal. You will receive the latest information about portal. Subscribe to receive our offers in preview.</p>	
		
		</div>
		
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8" style="margin: 0 auto;">
      <div id="alert_messages"></div>       
       <form method="post" action="<?php echo e(route('subscribe.newsletter')); ?>" name="subscribe_newsletter_form" id="subscribe_newsletter_form">
      <?php echo e(csrf_field()); ?>

		  
		   
		   
		  <div class="input-group">
		    <!-- <input type="text" class="form-control" placeholder="<?php echo e(__('Name')); ?>" name="name" id="name" required="required"> -->
			<input type="text" class="form-control subscribed_input_email" placeholder="Enter Your Email Here ...." name="email" id="email" required="required">
		  <div class="input-group-append custom_width_100_percentage">
			<button class="btn btn-default subscribed_input_button" type="button" id="send_subscription_form"><?php echo e(__('Subscribe')); ?></button>			  
		  </div>
		</div> 
      
    
</form>         
      </div>
    </div>
  </div>
</div>

<!--<div class="section greybg">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 align-center"><?php echo $siteSetting->index_page_below_subscribe_ad; ?></div>
    <div class="col-md-1"></div>
  </div>
</div>-->


<?php $__env->startPush('scripts'); ?> 
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#send_subscription_form', function () {
            var postData = $('#subscribe_newsletter_form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('subscribe.newsletter')); ?>",
                data: postData,
                //dataType: 'json',
                success: function (data)
                {
                    response = JSON.parse(data);
                    var res = response.success;
                    if (res == 'success')
                    {
                        var errorString = '<div role="alert" class="alert alert-success">' + response.message + '</div>';
                        $('#alert_messages').html(errorString);
                        $('#subscribe_newsletter_form').hide('slow');
                        $(document).scrollTo('.alert', 2000);
                    } else
                    {
                        var errorString = '<div class="alert alert-danger" role="alert"><ul>';
                        response = JSON.parse(data);
                        $.each(response, function (index, value)
                        {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul></div>';
                        $('#alert_messages').html(errorString);
                        $(document).scrollTo('.alert', 2000);
                    }
                },
            });
        });
    });
</script> 
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\prozjobs\resources\views/includes/subscribe.blade.php ENDPATH**/ ?>