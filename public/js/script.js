"use strict";
/* ==== Jquery Functions ==== */
(function($) {
		
	
	/* ==== Testimonials Slider ==== */	
  	$(".testimonialsList").owlCarousel({      
	   loop:true,
		margin:30,
		nav:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:false
			},
			768:{
				items:1,
				nav:false
			},
			1170:{
				items:2,
				nav:false,
				loop:true
			}
		}
  	});
	
	/* ==== employerList Slider ==== */	
  	$(".employerList").owlCarousel({      
	    loop:true,
		margin:50,
		width:150,
		nav:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:2,
				nav:true
			},
			768:{
				items:5,
				nav:true
			},
			1170:{
				items:9,
				nav:true,
				loop:true
			}
		}
  	});

  	$(".jobslistCarousal").owlCarousel({      
	    loop:true,
		// margin:50,
		// width:150,
		nav:true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1,
				nav:true
			},
			768:{
				items:2,
				nav:true
			},
			1170:{
				items:3,
				nav:true,
				loop:true
			}
		}
  	});
	
	
	/* ==== Revolution Slider ==== */
	if($('.tp-banner').length > 0){
		$('.tp-banner').show().revolution({
			delay:6000,
	        startheight:550,
	        startwidth: 1140,
	        hideThumbs: 1000,
	        navigationType: 'none',
	        touchenabled: 'on',
	        onHoverStop: 'on',
	        navOffsetHorizontal: 0,
	        navOffsetVertical: 0,
	        dottedOverlay: 'none',
	        fullWidth: 'on'
		});
	}
	
	
	//Top search bar open/close
    if (!$('.srchbox').hasClass("searchStayOpen")) {
        $("#jbsearch").click(function() {
            $(".srchbox").addClass("openSearch");
            $(".additional_fields").slideDown();
        });


        $(".srchbox").click(function(e) {
            e.stopPropagation();
        });
    }


    $('#myCarouse').carousel({
            interval: 500000
        })

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });

	
})(jQuery);