////MENU FUNCTION
//
//(function($) {
//
//  $.fn.menumaker = function(options) {
//      
//      var cssmenu = $(this), settings = $.extend({
//        title: "Menu",
//        format: "dropdown",
//        sticky: false
//      }, options);
//
//      return this.each(function() {
//        cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
//        $(this).find("#menu-button").on('click', function(){
//          $(this).toggleClass('menu-opened');
//          var mainmenu = $(this).next('ul');
//          if (mainmenu.hasClass('open')) { 
//            mainmenu.hide().removeClass('open');
//          }
//          else {
//            mainmenu.show().addClass('open');
//            if (settings.format === "dropdown") {
//              mainmenu.find('ul').show();
//            }
//          }
//        });
//
//        cssmenu.find('li ul').parent().addClass('has-sub');
//
//        multiTg = function() {
//          cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
//          cssmenu.find('.submenu-button').on('click', function() {
//            $(this).toggleClass('submenu-opened');
//            if ($(this).siblings('ul').hasClass('open')) {
//              $(this).siblings('ul').removeClass('open').hide();
//            }
//            else {
//              $(this).siblings('ul').addClass('open').show();
//            }
//          });
//        };
//
//        if (settings.format === 'multitoggle') multiTg();
//        else cssmenu.addClass('dropdown');
//
//        if (settings.sticky === true) cssmenu.css('position', 'fixed');
//
//        resizeFix = function() {
//          if ($( window ).width() > 768) {
//            cssmenu.find('ul').show();
//          }
//
//          if ($(window).width() <= 768) {
//            cssmenu.find('ul').hide().removeClass('open');
//          }
//        };
//        resizeFix();
//        return $(window).on('resize', resizeFix);
//
//      });
//  };
//})(jQuery);
//
//(function($){
//$(document).ready(function(){
//
//$(".navigation").menumaker({
//   title: "<i class='icon-list8'></i>",
//   format: "multitoggle"
//});
//
//
//});
//})(jQuery);
//
//
///*SLIDERS CODE*/
//jQuery('.jobs-list').slick({
//	autoplay: true,
//  autoplaySpeed: 2000,
//});
//
//jQuery('.blog-slider').slick({
//  slidesToShow: 3,
//  slidesToScroll: 1,
//  autoplay: true,
//  autoplaySpeed: 2000,
//  responsive: [
//  {
//      breakpoint: 600,
//      settings: {
//        slidesToShow: 1,
//        slidesToScroll: 1
//      }
//    },
//    {
//      breakpoint: 480,
//      settings: {
//        slidesToShow: 1,
//        slidesToScroll: 1,
//        dots: false
//      }
//    }
//]
//});
//
//jQuery('.testimonial-slider').slick({
//  autoplay: true,
//  autoplaySpeed: 2000,
//});
//jQuery('.save-info').slick({
//  autoplay: true,
//  autoplaySpeed: 2000,
//});
//jQuery('.hiring-slider').on('init', function(slick) {
//	console.log('fired!');
//	$('.hiring-slider').find('>ul').fadeIn(2000);
//	$('.hiring-slider').addClass('loaded');
//});
//jQuery('.hiring-slider').slick({
//  autoplay: true,
//  autoplaySpeed: 2000,
//});
//
//jQuery('.clients').slick({
//  dots: false,
//  speed: 300,
//  slidesToShow: 6,
//  slidesToScroll: 1,
//  autoplay: true,
//  autoplaySpeed: 2000,
//  responsive: [
//    {
//      breakpoint: 1024,
//      settings: {
//        slidesToShow: 4,
//        slidesToScroll: 3,
//        dots: false
//      }
//    },
//    {
//      breakpoint: 600,
//      settings: {
//        slidesToShow: 2,
//        slidesToScroll: 2
//      }
//    },
//    {
//      breakpoint: 480,
//      settings: {
//        slidesToShow: 1,
//        slidesToScroll: 1
//      }
//    }
//  ]
//});
//jQuery('.slider-medium').slick({
//  slidesToShow: 1,
//  dots: true,
//  slidesToScroll: 1,
//  autoplay: false,
//  autoplaySpeed: 2000,
//  arrows: false,
//});
