<div class="section">
    <div class="container-fluid p-0">
        <!-- title start -->
        <div class="row titleTop pl-5 pr-5">
            <h3 class="text-center w-100">Popular Job Categories</h3>
            <p class="featuredJobsdescription">
                Filter Jobs by their categories, Select any category to start filtering jobs according to the Job Category. A categoriy job search only returns relevant jobs with an assigned value.
            </p>
        </div>
        


            <div class="container-fluid custom_padding_container_how_it_works">     
                <ul class="row">
                    
                    <?php
                    if( isset($industries) && $industries != '' && count($industries) > 0 ) {
                        foreach ($industries as $key => $industry) {
                            $company = App\Job::where('functional_area_id', '=', $industry->id)->active()->notExpire()->get();
                            ?>
                            <li class="col-lg-6 col-xl-4 col-md-6 col-sm-6 col-xs-12 mt-xs-5 mt-sm-5 mt-md-3 mt-lg-3 mt-xl-4 margin-top-bottom">
                                <div class="how_it_works_inner">
                                    
                                        <div class="row">
                                                <div class="col-md-3">
                                                    <div class="iconcircle">
                                                        <img src="<?php echo url("public/images/sebd_resume.png");?>" class="how_works_icons">
                                                    </div>  
                                                </div>
                                                <div class="col-md-7">
                                                    <a href="<?php echo url("");?>/jobs?search=&functional_area_id%5B%5D=<?php echo $industry->id;?>">
                                                        <h4 style="color: #000;"><?php echo $industry->functional_area;?></h4>
                                                        <p style="color: #000;"><?php echo $industry->functional_area;?></p>
                                                    </a>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-2 p-0">
                                                    <span class="number_of_jobs_counter">
                                                        <a href="<?php echo url("");?>/jobs?search=&functional_area_id%5B%5D=<?php echo $industry->id;?>" class="category_number_jobs">
                                                        <?php
                                                        if( count($company) > 1 ) {
                                                            echo count($company)." Jobs";
                                                        } else {
                                                            echo count($company)." Job";
                                                        }
                                                        ?>
                                                        </a>
                                                    </span>
                                                </div>
                                        </div>
                                </div>
                            </li>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>




    </div>
</div>