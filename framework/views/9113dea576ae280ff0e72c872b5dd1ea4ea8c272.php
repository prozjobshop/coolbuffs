<div class="section">
    <div class="container-fluid p-0">
        <!-- title start -->
        <div class="row titleTop pl-5 pr-5">
            <h3 class="text-center w-100">Build Your Dream Job</h3>
            <p class="featuredJobsHeading">Featured Jobs</p>
            <p class="featuredJobsdescription">
                A featured job search allows you to influence your user's search results by ranking jobs according to promotional value rather than purely by relevance. A featured job search only returns relevant jobs with an assigned promotional value.
            </p>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="feature_jobs_advert">
                    <?php echo $siteSetting->index_page_below_top_employes_ad; ?>

                </div>
            </div>
            <div class="col-lg-9 mt-0">
                <ul class="jobslistCarousal jobslist row owl-carousel">
                    <?php if(isset($featuredJobs) && count($featuredJobs)): ?>
                    <?php $__currentLoopData = $featuredJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featuredJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php $company = $featuredJob->getCompany(); ?>
                    <?php
                    // echo "<pre>";
                    //     print_r();
                    // echo "</pre>";
                    ?>
                    <?php if(null !== $company): ?>
                        <li class="col-md-12 mt-0">
                            <div class="jobint pl-5 pt-4">
                                <div class="row mb-4">
                                    <div class="col-lg-3 col-md-3 mr-4 p-0">
                                        <a href="<?php echo e(route('job.detail', [$featuredJob->slug])); ?>" title="<?php echo e($featuredJob->title); ?>" class="featured_job_logo_anchor">
                                            <?php echo e($company->printCompanyImage()); ?>

                                        </a>
                                    </div>
                                    <div class="col-lg-7 col-md-7">
                                        <div class="company">
                                            <a href="<?php echo e(route('company.detail', $company->slug)); ?>" title="<?php echo e($company->name); ?>"><?php echo e($company->name); ?></a>
                                            <p> <?php echo $company->location;?> </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 mb-4">
                                    <h4 class="w-100 pr-3">
                                        <a href="<?php echo e(route('job.detail', [$featuredJob->slug])); ?>" title="<?php echo e($featuredJob->title); ?>">
                                            <?php echo e($featuredJob->title); ?>

                                        </a>
                                    </h4>
                                    <p class="w-100 job_type mb-3  pr-3"><?php echo $featuredJob->getJobType('job_type');?></p>
                                </div>

                                <div class="row companyoverview">
                                    <p class="pr-3"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($company->description), 350, '...')); ?> <a href="<?php echo e(route('company.detail',$company->slug)); ?>">Read More</a></p>
                                </div>

                                <div class="row mt-3 mb-4">
                                    <div class="col-lg-12 col-md-12 text-right">
                                        <a href="<?php echo e(route('job.detail', [$featuredJob->slug])); ?>" class="applybtn apply_jobs_btn">Apply Now</a>
                                    </div>
                                </div>

                            </div>
                        </li>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>

            </div>
        </div>


        <?php
        /*
            <!--Featured Job start-->
            <ul class="jobslist row">
                @if(isset($featuredJobs) && count($featuredJobs))
                @foreach($featuredJobs as $featuredJob)
                <?php $company = $featuredJob->getCompany(); ?>
                @if(null !== $company)
                <!--Job start-->
                <li class="col-md-6">
                    <div class="jobint">
                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <a href="{{route('job.detail', [$featuredJob->slug])}}" title="{{$featuredJob->title}}">
                                    {{$company->printCompanyImage()}}
                                </a>
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <h4><a href="{{route('job.detail', [$featuredJob->slug])}}" title="{{$featuredJob->title}}">{{$featuredJob->title}}</a></h4>
                                <div class="company"><a href="{{route('company.detail', $company->slug)}}" title="{{$company->name}}">{{$company->name}}</a></div>
                                <div class="jobloc">
                                    <label class="fulltime" title="{{$featuredJob->getJobType('job_type')}}">{{$featuredJob->getJobType('job_type')}}</label> - <span>{{$featuredJob->getCity('city')}}</span></div>
                            </div>
                            <div class="col-lg-3 col-md-3"><a href="{{route('job.detail', [$featuredJob->slug])}}" class="applybtn">{{__('View Detail')}}</a></div>
                        </div>
                    </div>
                </li>
                <!--Job end--> 
                @endif
                @endforeach
                @endif
            </ul>
            <!--Featured Job end--> 
            <?php

            */
        ?>

        <!--button start-->
        <div class="viewallbtn"><a href="<?php echo e(route('job.list', ['is_featured'=>1])); ?>"><?php echo e(__('View All Featured Jobs')); ?></a></div>
        <!--button end--> 
    </div>
</div><?php /**PATH C:\xampp\htdocs\prozjobs\resources\views/includes/featured_jobsV1.blade.php ENDPATH**/ ?>