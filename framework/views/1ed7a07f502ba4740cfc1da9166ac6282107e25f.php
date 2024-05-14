<div class="section pt-0 pb-0">
    <div class="container-fluid pt-xs-0 pt-sm-0 pt-md-2 pl-xs-0 pl-sm-0 pl-md-4"> 
        <!-- <div class="row">
            <div class="col-lg-12 pl-5">
                <div class="searchbar ml-2 looking_right_talent"> -->
                    <div class="row p-xs-0 p-sm-0 p-md-5" style="padding-top: 29px !important;">
                        <div class="col-lg-12 p-4" style="background: #FFF;box-shadow: 0px 10px 20px 0px #ddd;">

                            <!-- title start -->
                            <!-- <div class="titleTop">            
                                <h3><?php echo e(__('Featured')); ?> <span><?php echo e(__('Companies')); ?></span></h3>
                            </div> -->
                            <!-- title end -->

                            <ul class="employerList owl-carousel">
                                <!--employer-->
                                <?php if(isset($topCompanyIds) && count($topCompanyIds)): ?>
                                <?php $__currentLoopData = $topCompanyIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_id_num_jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $company = App\Company::where('id', '=', $company_id_num_jobs->company_id)->active()->first();
                                if (null !== $company) {
                                    ?>
                                    <li class="item" data-toggle="tooltip" data-placement="bottom" title="<?php echo e($company->name); ?>" data-original-title="<?php echo e($company->name); ?>">
                    					<div class="empint">
                    					   <a href="<?php echo e(route('company.detail', $company->slug)); ?>" title="<?php echo e($company->name); ?>">
                                                <?php echo e($company->printCompanyImage()); ?>               
                                           </a>
                    					</div>
                    			     </li>
                                    <?php
                                }
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <!-- </div>
            </div>
        </div> -->
    </div> 
	
	
<!-- <div class="largebanner shadow3">
    <div class="adin">
    <?php echo $siteSetting->index_page_below_top_employes_ad; ?>

    </div>
    <div class="clearfix"></div>
</div> -->

	
	
</div>


<?php /**PATH C:\xampp\htdocs\prozjobs\resources\views/includes/top_employers.blade.php ENDPATH**/ ?>