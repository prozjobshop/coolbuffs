<div class="section testimonialwrap pl-xs-0 pl-sm-0 pl-md-5  pr-xs-0 pr-sm-0 pr-md-5">
    <div class="container-fluid pl-xs-0 pl-sm-0 pl-md-5  pr-xs-0 pr-sm-0 pr-md-5"> 
        <!-- title start -->
        <div class="titleTop">
            <h3 class="text-center">Success Stories</h3>
            <p class="testimonials_head_2">Testimonials</p>
        </div>
        <!-- title end -->

        <ul class="testimonialsList owl-carousel testimonials_each pl-5 pr-5">
            @if(isset($testimonials) && count($testimonials))
            @foreach($testimonials as $testimonial)
            <li class="item">        
                <div class="ratinguser">
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
				</div>
                <div class="clientname">{{$testimonial->testimonial_by}}</div>
				 <div class="clientinfo">{{$testimonial->company}}</div>
                <p>"{{$testimonial->testimonial}}"</p>
               
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>