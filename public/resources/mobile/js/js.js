$(document).ready(function() {
	(function(){
		var $html=$('html');
		var $window=$(window);
		var $body=$("body");
		var psdsize=840;
		var htmlfont=$body.width()/psdsize*100+'px';
		$html.css('font-size',htmlfont);
		$body.css('opacity',1);
		$window.resize(function () {
			htmlfont=$body.width()/psdsize*100+'px';
			$html.css('font-size',htmlfont)
		});
	})();
	$(".menubtn").toggle(function(){
		$('.menu').fadeIn(500);
		$(this).addClass('close');
		$('body').css('overflow-y','hidden');
	}, function(){
		$('.menu').fadeOut(0);
		$(this).removeClass('close');
		$('body').css('overflow-y','auto');
	});
	
	$(".pbtn").toggle(function(){
		$(this).parents().children('.hidp').css('height','auto');
		$(this).addClass('on');
	}, function() {
		$(this).parents().children('.hidp').css('height','3.9rem');
		$(this).removeClass('on');
	});
});