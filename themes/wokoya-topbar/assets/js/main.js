/* ===================================================================

		Theme Name: Wokoya | Laravel CMS
		Author: DUCOR
		Version : 2.0

* ================================================================= */
/* ----------------------------------------------------------- */
/*  Page redirect http to https
/* ----------------------------------------------------------- */
if (location.protocol !== 'https:' && location.hostname !== '127.0.0.1') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);
}

(function($) {
    "use strict";

    $(document).on('ready', function() {

		// Preloader
		$(window).on('load', function () {
			$('.lds-ellipsis').fadeOut(); // will first fade out the loading animation
			$('.preloader').delay(333).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(333);
		});


		// Header Sticky

			$(window).on("scroll", function() {
				$(window).scrollTop() >= 50 ? $(".sticky").addClass("stickyadd") : $(".sticky").removeClass("stickyadd")
			})

			  $(document).on("click", ".navbar-collapse.show", function(e) {
				$(e.target).is("a") && $(this).collapse("hide")
			})

			 $(".navbar-nav a, .scroll_down a").on("click", function(e) {
				var a = $(this);
				$("html, body").stop().animate({
					scrollTop: $(a.attr("href")).offset().top - 0
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
		$('.smooth-scroll').on('click', function() {
			event.preventDefault();
			var sectionTo = $(this).attr('href');
			$('html, body').stop().animate({
			  scrollTop: $(sectionTo).offset().top}, 1500, 'easeInOutExpo');
		});
		   }else {
		$('.smooth-scroll').on('click', function() {
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
			# Accordion Menu
		 =============================================== */

		  $(document).on('click','.panel-group .panel',function(e) {
			e.preventDefault();
			$(this).addClass('panel-active').siblings().removeClass('panel-active');
		});

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

			a.find("a").on("click", function() {
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
			typeSpeed: 100,
			backSpeed: 50,
			backDelay: 1500,
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
            # imagesLoaded active
        ===============================================*/
        $('#portfolio-grid,.blog-masonry').imagesLoaded(function() {

            /* Filter menu */
            $('.mix-item-menu').on('click', 'button', function() {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            /* filter menu active class  */
            $('.mix-item-menu button').on('click', function(event) {
                $(this).siblings('.active').removeClass('active');
                $(this).addClass('active');
                event.preventDefault();
            });

            /* Filter active */
            var $grid = $('#portfolio-grid').isotope({
                itemSelector: '.pf-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.pf-item',
                }
            });

            /* Filter active */
            $('.blog-masonry').isotope({
                itemSelector: '.blog-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.blog-item',
                }
            });

        });


        /* ==================================================
            # Magnific popup init
         ===============================================*/
        $(".popup-link").magnificPopup({
            type: 'image',
            // other options
        });

        $(".popup-gallery").magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
            // other options
        });

        $(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        $('.magnific-mix-gallery').each(function() {
            var $container = $(this);
            var $imageLinks = $container.find('.item');

            var items = [];
            $imageLinks.each(function() {
                var $item = $(this);
                var type = 'image';
                if ($item.hasClass('magnific-iframe')) {
                    type = 'iframe';
                }
                var magItem = {
                    src: $item.attr('href'),
                    type: type
                };
                magItem.title = $item.data('title');
                items.push(magItem);
            });

            $imageLinks.magnificPopup({
                mainClass: 'mfp-fade',
                items: items,
                gallery: {
                    enabled: true,
                    tPrev: $(this).data('prev-text'),
                    tNext: $(this).data('next-text')
                },
                type: 'image',
                callbacks: {
                    beforeOpen: function() {
                        var index = $imageLinks.index(this.st.el);
                        if (-1 !== index) {
                            this.goTo(index);
                        }
                    }
                }
            });
        });

        /* ==================================================
            # MouseMove image
         ===============================================*/

		$(".about-img").mousemove(function(e){
			var moveX = ( e.pageX * -1 / 25 );
			var moveY = ( e.pageY * -1 / 25 );
			$(this).css( 'background-position' , moveX + 'px ' + moveY + 'px' );
		})

			function img_moving_animations(){

				var image = document.getElementsByClassName('thumbnail');
				new simpleParallax(image, {
					delay:2,
					overflow: true,
					orientation:'down'
				});

				var image2 = document.getElementsByClassName('thumbnail-2');
				new simpleParallax(image2, {
					delay:2,
					overflow: true,
					orientation:'left'
				});

				var image3 = document.getElementsByClassName('thumbnail-3');
				new simpleParallax(image3, {
					delay:2
				});

				var image4 = document.getElementsByClassName('thumbnail-4');
				new simpleParallax(image4, {
					delay:2,
					orientation:'left'
				});
			}
			img_moving_animations();

        /* ==================================================
            # Feedback Carousel
         ===============================================*/

        $('.feed-sldr').owlCarousel({
            loop: true,
            margin:30,
            nav: true,
            navText: [
                "<i class='icofont-long-arrow-left'></i>",
                "<i class='icofont-long-arrow-right'></i>"
            ],
            dots: false,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });

        /* ==================================================
            # Blog Slider Carousel
         ===============================================*/

        $('.blog-sldr').owlCarousel({
            loop: true,
            margin:30,
            nav: false,
            navText: [
                "<i class='icofont-long-arrow-left'></i>",
                "<i class='icofont-long-arrow-right'></i>"
            ],
            dots: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });




        /* ==================================================
            # Hero Slider Carousel
         ===============================================*/

        $('.hero-slider').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            autoplay: true,
			autoplayTimeout:5000,
            items: 1,
            navText: [
                "<i class='ti-angle-left'></i>",
                "<i class='ti-angle-right'></i>"
            ],
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
            Preloader Init
         ===============================================*/
        $(window).on('load', function() {
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

})(jQuery); // End jQuery

