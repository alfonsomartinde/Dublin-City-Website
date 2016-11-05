jQuery(document).ready(function( $ ) {

	// Add underline class to top level menu items
	$('ul.top-menu li a').addClass('vdc-menu-underline');
	$('ul.sub-menu li a').removeClass('vdc-menu-underline');

	$('.wb-l-blue-bg a').addClass('vdc-menu-underline');
	$('.wb-l-purple-bg a').addClass('vdc-menu-underline');
	
	// Mobile Menu Icon Trigger
	function mobile_menu_trigger() {
		var $hamburger = $(".hamburger");
		$hamburger.on("click", function(e) {
		$hamburger.toggleClass("is-active");
		// Do something else, like open/close menu

			$('.mobile-menu').slideToggle(300);
			//$('.header-content-wrapper').fadeToggle('300');
			// Sub menu Item
		});
		if ( $(window).width() < 1200 ) {
			if ( $('li.menu-item-has-children ul').hasClass('sub-menu') ) {
				$('li.menu-item-has-children ul').removeClass('sub-menu')
				.addClass('mobile-sub-menu');					
			}
			
		} 
		$('li.menu-item-has-children').on('click', function(event) {
			// event.preventDefault();
			$(this).children('.mobile-sub-menu').slideToggle(300);
			// $('.mobile-sub-menu').slideToggle(300);
		});
	}

	// Full Back Ground Images
	function wb_full_bg_img(selector) {
		var $selector = $(''+selector+'');
		var $img = $selector.attr('data-img');
		if ($selector[0]) {
			$selector.backstretch($img);
		}
	}

	function wb_slick_fullbg(parent, child) {
		var $parent = $(''+parent+'');
		var $child = $(''+child+'');
		// Init Slider
		$parent.slick({
			dots: false,
			arrows: false, 
			// autoplay: true, 
			fade: true
		});

		// Add Background Images
		$child.each(function(index, el) {
			var $this = $(this);
			// console.log($this);
			wb_full_bg_img($this);
		});
	}

	if ( $(window).width() > 1200) {
		// Sub Menus
		function vdc_sub_menu() {
			var $parent = $('ul.top-menu li.menu-item-has-children');
			var $child = $("ul.sub-menu");
			var $this = $(this);
			
			/*==============
			Click to Open .stop
			==============*/
			$parent.click(function(e) {
				// Prevent defaults and Bubbling
				// e.preventDefault();
	    			e.stopPropagation();
	    			var w = $(window).width(); // Window Width
	    			var c = 1170; // Container Width
	    			var $mW = $('.vdc-specific-menu').width(); // Main Menu Width
	    			var $mDL = $('.vdc-specific-menu').offset(); // Main Menu Distance Left/Top
	    			var sMW = ( $(this).children('ul').width() + ( parseInt(  $(this).children('ul').css('padding-left')   ) * 2 ) ); // Sub Menu Width
	    			var $mME = ($mDL.left + $mW); // Main menu End
	    			var sMDL = $(this).offset(); // Sub Menu Distance Left/Top
	    			var sME = (sMDL.left + sMW); //Sub Menu End
	                  var $uO = (-1 * ($mME - sME) ); //Unknown Overlap OLD ( sMW - ( $mW - ( sMDL.left - $clikedDL.left ) ) )
	    			// console.log('---------------------------------- \n'+
	    			// 				'Window: ' + w + '\n'+
	    			// 				'Container: ' + c + '\n'+
	    			// 				'Main Menu Width: ' + $mW + '\n' +
	    			// 				'Main Menu Left: ' + $clikedDL.left + '\n'+
	    			// 				'Sub Menu Width: ' + sMW + '\n' +
	    			// 				'Sub Menu Left: ' + sMDL.left + '\n'+
	    			// 				'-------------------- \n'+
	    			// 				'Main Menu end: ' + $mME + '\n'+
	    			// 				'Sub Menu end: ' + sME + '\n'+
	    			// 				'-------------------- \n'+
	    			// 				'Unknown Overlap: ' + ( $uO ) );
	    			if ( $uO > 0 ) {
	    				$(this).children('ul').css('left', + -$uO+'px');
	    			} else {
	    				// console.log("No Overlap");
	    			}

	    			// Current Sub Menu Arrow under link Positioning
	    			var $parentMW = $(this).parent('ul').width();
	    			var $parentDL = $(this).parent('ul').offset();
	    			var $menuItemWidth = $(this).width();
	    			var $menuText = $(this).children('a').text();
	    			var $arrowPosition = ($menuItemWidth/2) + $parentDL.left;
	    			var $uOArrow;
	    			// Log the position of the arrow
	    			// console.log($menuText + ' menu item width is: ' +$menuItemWidth+ '\n' +
	    			// 				'Sub Menu Distance Left: ' + sMDL.left + '\n'+
	    			// 				'The Arrow should be at: ' + $arrowPosition + '\n');
	 
	    			// Set the arrow position
	    			if ( $uO > 0 ) {
	    				$('<style>.sub-menu::before{left:'+( ( ($menuItemWidth/2 ) - 10 ) + $uO )+'px}</style>').appendTo('head');
	    			} else {
	    				$('<style>.sub-menu::before{left:'+( ($menuItemWidth/2 ) - 10 )+'px}</style>').appendTo('head');
	    			}

	    			// Close Currently Open Menu
				$child.not( $(this).children('ul') ).fadeOut(100, function(){
					$(this).removeClass('active arrow');
				});

				// Fade open the menu
				$(this).children('ul').stop(true, false, true).fadeToggle(400, function() {
					$(this).addClass('active arrow')
				});

				// Close on click to document
				$(document).one('click', function() {

					if ( $('ul').hasClass('active') ) {
						$('ul.sub-menu.active').fadeOut('300', function() {
					  		$(this).removeClass('active');
					  	});
					}
				  	
				});

			});
		}vdc_sub_menu();
	}
	

	// Add Background Images
	$('figure').each(function(index, el) {
		var $this = $(this);
		var img = $(this).attr('data-img');
		$this.backstretch(img);
	});

	// Add class on scrolling mobile menu
	if ( $(window).width() < 1200 )  {
		if ( $(".mobile-nav").hasClass('transparent') ) {
			$(window).scroll(function(event) {
				var scroll = $(window).scrollTop();
				var nav = $(".mobile-nav");
				var cookie = getCook('page_name');

				if ( scroll > 50 ) {
					nav.addClass(cookie);
				} else{
					nav.removeClass(cookie);
				};
				console.log(cookie);
			});
		}
		
		
	}

	function getCook(cookiename) {
		// Get name followed by anything except a semicolon
		var cookiestring=RegExp(""+cookiename+"[^;]+").exec(document.cookie);
		// Return everything after the equal sign
		return unescape(!!cookiestring ? cookiestring.toString().replace(/^[^=]+./,"") : "");
	}


	
	// accordion
	function accordion_slides() {
		var $tab = $('.vdc-accordion-tab');

		$tab.click(function(){
			
			// plus icon animation
			$('.vdc-accordion-plus span:last-child').fadeIn('100');

			// sliding animation
			if($(this).hasClass('is-active')) {
				
				$tab.children('.vdc-accordion-content').slideUp('300');
				$tab.removeClass('is-active');
			} 

			else {

				$tab.children('.vdc-accordion-content').slideUp('300');
				$tab.removeClass('is-active');

				$(this).children('.vdc-accordion-content').slideDown('300');
				$(this).closest('.vdc-accordion-tab').addClass('is-active');

				// plus icon animation
				$(this).find('.vdc-accordion-plus span:last-child').fadeOut('100');
			}
		});
	};

	// tabs
	function tabs() {
		// $trigger = $('.vdc-tab');
		$panel = $('.vdc-tab-panel');

		// $trigger.click(function() {
			
		// 	// hide all panels
		// 	$panel.fadeOut("200");
		// });

		$('.vdc-tab').click(function(){
			// panel to show
			var $panelToShow = $(this).attr('data-panel');

			// decide what button gets active styles
			$('.vdc-tab.is-active').removeClass('is-active');
			$(this).addClass('is-active');

			// decide which tabs to show and hide
			var $activePanel = $('.vdc-tab-panel.is-active');

			if($activePanel.attr("data-panel") != $(this).attr('data-panel')) {

				$activePanel.fadeOut(300, function(){
					$(this).removeClass('is-active');

					$("#vdc-panel-"+$panelToShow).fadeIn(300, function(){
						$(this).addClass('is-active');
					});
				});
			}

		});
	}

	// staff section
	function staff_section() {
		$('.vdc-staff-member').hover(function(){
			$(this).toggleClass('is-active');
			$(this).find('.vdc-staff-txt').stop().slideToggle('500');
		});
	}

	function staff_isotope_grid() {
		var $grid = $('.vdc-staff-grid');
		var $sortBtn = $('.vdc-staff-buttons button');
		var $startFilter = $grid.attr('data-start-filter');
		$grid.isotope({
			itemSelector: '.vdc-staff-member',
			layoutMode: 'fitRows', 
			filter: $startFilter
		});

		// var whatPage;
		// if(whatPage) {
		// 	if(whatPage.page == 'governance') {
		// 		$grid.isotope({ filter: ".143" });
		// 	} else if((whatPage.page == 'people')) {
		// 		$grid.isotope({ filter: ".141" });
		// 	}
		// }

		$sortBtn.click(function(){
			// what are we filtering?
			var filterTerm = $(this).attr('data-filter');
			// now we filter
			$grid.isotope({ filter: "."+filterTerm });

			$sortBtn.removeClass('is-active');
			$(this).addClass('is-active');
		});

	}

	
	

	// CALL ALL FUNCTIONS HERE
	mobile_menu_trigger();
	accordion_slides();
	tabs();
	if($(window).width() >= 992) {
		staff_section();
	}
	staff_isotope_grid();
	
	// Full BG Slider
	wb_slick_fullbg('.wb-slider', '.wb-slider-item');

	// Full Backgrounds
	wb_full_bg_img('.home');
	wb_full_bg_img('#vol-home');
	wb_full_bg_img('#org-home');
	wb_full_bg_img('.bottom-bg');
	
});

