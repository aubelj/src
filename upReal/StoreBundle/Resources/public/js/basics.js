
/* clik on tr ------------------*/

$(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).data('href');
        return false;
    });

$(".panel-btn").click(function(){
	that =  this;
	$('#'+$('.active').attr('data-check')).fadeOut(function(){
		$('#'+$(that).data('check')).fadeIn();
	});
	$('.panel-btn').removeClass('active');
	$(this).addClass('active');	
})

});

/*
$('.carousel').carousel()*/
/*$('.carousel').carousel({
  interval: 2000
})*/

/**************  multi table **********/

