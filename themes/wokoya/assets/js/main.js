/* ===================================================================

		Theme Name:  Woloya | Laravel CMS
		Author: Ducor
		Version: 1.0

* ================================================================= */
	/* ----------------------------------------------------------- */
	/*  Page redirect http to https
	/* ----------------------------------------------------------- */
    if (location.protocol !== 'https:' && location.hostname !== '127.0.0.1') {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
    }

jQuery(document).ready(function(){

	"use strict";

		// Preloader
		$(window).on("load", function () {
			$('.lds-ellipsis').fadeOut(); // will first fade out the loading animation
			$('.preloader').delay(333).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(333);
		});


		// Header Sticky


			$(window).scroll( function() {
				$(window).scrollTop() >= 50 ? $(".sticky").addClass("stickyadd") : $(".sticky").removeClass("stickyadd")
			})

			  $(document).on("click", ".navbar-collapse.show", function(e) {
				$(e.target).is("a") && $(this).collapse("hide")
			})

			 $(".navbar-nav a, .scroll_down a").click( function(e) {
				var a = $(this);

				var hrefId = $(this).attr('href').toString().replace('/', '');
				$("html, body").stop().animate({
					scrollTop: $(hrefId).offset().top - 0
				}, 1500, "easeInOutExpo"), e.preventDefault()
			})

			  $("#navbarCollapse").scrollspy({
				offset: 20
			})



        /* ==================================================
            # Smooth Scroll
         =============================================== */

		// Sections Scroll
		if($("body").hasClass("side-header")){
			$('.smooth-scroll').click( function() {
				event.preventDefault();
				// var sectionTo = $(this).attr('href');
				var sectionTo = $(this).attr('href').toString().replace('/', '');

				$('html, body').stop().animate({
				  scrollTop: $(sectionTo).offset().top}, 1500, 'easeInOutExpo');
			});
		   }
		 else {
			$('.smooth-scroll').click( function() {
				event.preventDefault();
				var sectionTo = $(this).attr('href');
				$('html, body').stop().animate({
				  scrollTop: $(sectionTo).offset().top - 10}, 1500, 'easeInOutExpo');
			});
		}

		 /* ==================================================
            # Scroll to top
         =============================================== */
			//Get the button
			var mybutton = document.getElementById("scrtop");

			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			  if (document.body.scrollTop >10 || document.documentElement.scrollTop > 10) {
				mybutton.style.display = "block";
			  } else {
				mybutton.style.display = "none";
			  }
			}


		 /* ==================================================
            # Youtube Video Init
         ===============================================*/
        $('.player').mb_YTPlayer();

		/* ==================================================
			# Portfolio Menu
		 =============================================== */

		$(window).on("load", function() {
			var e = $(".work-filter"),
				a = $("#menu-filter");
			e.isotope({
				filter: "*",
				layoutMode: "masonry",
				animationOptions: {
					duration: 750,
					easing: "linear"
				}
			}),

			a.find("a").click( function() {
				var o = $(this).attr("data-filter");
				return a.find("a").removeClass("active"), $(this).addClass("active"), e.isotope({
					filter: o,
					animationOptions: {
						animationDuration: 750,
						easing: "linear",
						queue: !1
					}
				}), !1
			})
		}),

		$(".img-zoom").magnificPopup({
			type: "image",
			closeOnContentClick: !0,
			mainClass: "mfp-fade",
			gallery: {
				enabled: !0,
				navigateByImgClick: !0,
				preload: [0, 1]
			}
		}),

		/*------------------------------------
			Typed
		-------------------------------------- */

		$(".typed").each(function() {
		var typed = new Typed('.typed', {
			stringsElement: '.typed-strings',
			loop: true,
			typeSpeed: 20,
			backSpeed: 10,
			backDelay: 3000,
		});
		});


		/*------------------------------------
			WOW animation
		-------------------------------------- */

		$(".wow").each(function() {
		 if ($(window).width() > 767) {
		   var wow = new WOW({
			 boxClass: 'wow',
			 animateClass: 'animated',
			 offset: 0,
			 mobile: true,
			 live: true
		   });
		  new WOW().init();
		 }
		});


        /* ==================================================
            # Magnific popup init
         ===============================================*/

        $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });


        /* ==================================================
            # Feedback Slider
         =================================================*/

	   $('.feed-sldr').slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: true,
			arrows: false,
			dots: true,
			autoplaySpeed: 4000,
			responsive: [{
					breakpoint: 1199,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						arrows: false
					}
				}
			]
		});

        /* ==================================================
            # Blog Slider
         ================================================*/

	   $('.blog-sldr').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: true,
			arrows: false,
			dots: true,
			autoplaySpeed: 4000,
			responsive: [{
					breakpoint: 1150,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						arrows: false
					}
				}
			]
		});

        /* ==================================================
            # Fun Factor Init
        ===============================================*/
        $('.timer').countTo();
        $('.fun-fact').appear(function() {
            $('.timer').countTo();
        }, {
            accY: -100
        });

	/* ==================================================
		Contact Form Validations
	================================================== */

    $(function() {

        // Get the form.
        var form = $('#contact-form');

        // Get the messages div.
        var formMessages = $('.form-message');

        var removeValidation = function(){
            if ($('#contact-form input[name="name"]').hasClass("is-invalid")) {
                $('#contact-form input[name="name"]').removeClass("is-invalid");
                $('#contact-form input[name="name"]').parent().find(".invalid-feedback").remove();
            }
            if ($('#contact-form input[name="email"]').hasClass("is-invalid")) {
                $('#contact-form input[name="email"]').removeClass("is-invalid");
                $('#contact-form input[name="email"]').parent().find(".invalid-feedback").remove();
            }
            if ($('#contact-form input[name="subject"]').hasClass("is-invalid")) {
                $('#contact-form input[name="subject"]').removeClass("is-invalid");
                $('#contact-form input[name="subject"]').parent().find(".invalid-feedback").remove();
            }
            if ($('#contact-form textarea[name="message"]').hasClass("is-invalid")) {
                $('#contact-form textarea[name="message"]').removeClass("is-invalid");
                $('#contact-form textarea[name="message"]').parent().find(".invalid-feedback").remove();
            }

        }

        // Set up an event listener for the contact form.
        $(form).submit(function(e) {
            // Stop the browser from submitting the form.
            e.preventDefault();

            // removeValidation();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Serialize the form data.
            var formData = $(form).serialize();

            // Submit the form using AJAX.
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData
            })
            .done(function(response) {
                // Make sure that the formMessages div has the 'success' class.
                $(formMessages).removeClass('error');
                $(formMessages).addClass('success');

                // Set the message text.
                $(formMessages).html('<div class="alert alert-success" role="alert">'+response.message+'</div>');

                // Clear the form.
                $('#contact-form input,#contact-form textarea').val('');
            })
            .fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                $(formMessages).html();

                var errors = data.responseJSON.errors;

                var errorMessage = function(message){
                    return '<div class="invalid-feedback">'+message+'</div>';
                }

                if (typeof errors.name !== 'undefined' ) {
                    $('#contact-form input[name="name"]').addClass("is-invalid");
                    $('#contact-form input[name="name"]').parent().append(errorMessage(
                        errors.name[0]
                    ))
                }
                if (typeof errors.email !== 'undefined' ) {
                    $('#contact-form input[name="email"]').addClass("is-invalid");
                    $('#contact-form input[name="email"]').parent().append(errorMessage(
                        errors.email[0]
                    ))
                }
                if (typeof errors.subject !== 'undefined' ) {
                    $('#contact-form input[name="subject"]').addClass("is-invalid");
                    $('#contact-form input[name="subject"]').parent().append(errorMessage(
                        errors.subject[0]
                    ))
                }
                if (typeof errors.message !== 'undefined' ) {
                    $('#contact-form textarea[name="message"]').addClass("is-invalid");
                    $('#contact-form textarea[name="message"]').parent().append(errorMessage(
                        errors.message[0]
                    ))
                }

                var message = data.responseJSON.message;

                // Set the message text.
                if (data.responseText !== '') {
                    $(formMessages).html('<div class="mb-5 alert mb-0 alert-danger" role="alert">'+message+'</div>');
                } else {
                    $(formMessages).html('<div class="mb-5 alert mb-0 alert-danger" role="alert">Oops! An error occured and your message could not be sent.</div>');
                }
            });
        });

    });

        /* ==================================================
            Preloader Init
         ===============================================*/

        $(window).on("load", function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });


		 /* ==================================================
            Mouse Animation
        ================================================== */

			function theme_tm_cursor(){

				var myCursor	= jQuery('.mouse-cursor');

				if(myCursor.length){
					if ($("body")) {
					const e = document.querySelector(".cursor-inner"),
						t = document.querySelector(".cursor-outer");
					let n, i = 0,
						o = !1;
					window.onmousemove = function (s) {
						o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
					}, $("body").on("mouseenter", "a, .cursor-pointer", function () {
						e.classList.add("cursor-hover"), t.classList.add("cursor-hover")
					}), $("body").on("mouseleave", "a, .cursor-pointer", function () {
						$(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove("cursor-hover"), t.classList.remove("cursor-hover"))
					}), e.style.visibility = "visible", t.style.visibility = "visible"
				}
				}
			};
			theme_tm_cursor()

}); // end document ready function
