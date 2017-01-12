/*#####################
Additional jQuery (required)
#####################*/
    var boxheight = $('.carousel-inner').height();
	var itemlength = $('.item').length;
	var triggerheight = Math.round(boxheight/itemlength+1);
	$('.list-group-item').height(triggerheight);
	
	var clickEvent = false;
	$('#myCarousel').carousel({
		interval:   4000	
	}).on('click', '.list-group li', function() {
			clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});