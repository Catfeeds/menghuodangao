$(document).ready(function(){
	$('.dot').dotdotdot({
		wrap: 'letter' 
	});
	$(".lazy").lazyimg();
	$('.lazybg').lazybg();
	
	$(".menu li").hover(function() {
		$(this).children(".submenu").slideDown(500)
	}, function() {
		$(this).children(".submenu").slideUp(0)
	});
	$('.banner').slick({
		infinite: true,
		dots: true,
		autoplay: true,
		arrows: false,
		autoplaySpeed: 2000
	});
	
	jQuery(".tab").slide({trigger:"click"});
	
	$('.picshow').slick({
		infinite: true,
		arrows: true
	});
	
	$(window).scroll(function(){
		var htmlTop = $(document).scrollTop();
		if( htmlTop > $('.header').outerHeight()+$('.inbanner').outerHeight()){
			$(".nav").addClass('fixed');	
		}else{
			$(".nav").removeClass('fixed');
		}
	});

});
function side(el1,el2,zt){
    var canGo = true;
    var al= $(el1);
    var main = $(el2);
    var on=zt;
    var abc=main.length;
	$(window).scroll(function() {
   		 main.each(function(index, element) {
        if ($(window).scrollTop()>=$(this).offset().top-70) {
            al.removeClass(on);
            al.eq(index).addClass(on);
        }
    	});
	})
    al.each(function(index, element) {
        $(this).click(function() {
            canGo = false;
            al.removeClass(on);
            $(this).addClass(on);
            $("html,body").stop(true, true).animate({
                "scrollTop": main.eq(index).offset().top-60
            }, 500,function(){
                canGo=true;
            });
        });
 });
}