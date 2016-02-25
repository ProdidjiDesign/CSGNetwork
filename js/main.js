//mdr
function lightbox(data){
	$("body").append('<div class = "overlay"></div>'+
	'<div class = "lightbox">'+data+
		'<div id = "lightbox-close" class="glyphicon glyphicon-remove"></div>'+
	'</div>');
}

function detectActive(number){

	$('.navbar-nav').children().eq(number).addClass('act');

}

function detectViPo(){

   	var width = $( window ).width();
    if(width<799){

    	$('.left-nav').css('display','none');
    	$('.portable-nav .txt').css('display','none')

    }
    else{

    	$('.left-nav').css('display','inline');

    }
}



$(document).ready(function() {


    detectViPo();

	var toggled = 0;

	$(window).resize(function() {
		detectViPo();
	});


	$('body').on('swiperight',function(){

		if(toggled === 0 && $(window).width()<799){
  			$('.left-nav').toggle('fast');
  			toggled = 1;
		}

	});

	$('body').on('click','#lightbox-close',function(){
		$(".lightbox, .overlay").fadeOut(300, function() { $(this).remove(); });
	});

	$('body').on('swipeleft',function(){

		if(toggled === 1 && $(window).width()<799){
  			$('.left-nav').toggle('fast');
  			toggled = 0;
		}

	});

	$('body').on('click','img',function(){

		lightbox("<img style='width:80%;' src='"+$(this).attr('src')+"' />");

	});

	$('.navbar-nav [data-toggle="tooltip"]').tooltip();

});
