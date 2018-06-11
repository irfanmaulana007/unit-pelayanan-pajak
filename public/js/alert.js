function alerts(){
	$(".alert").removeClass("hidden");
	$(".alert").addClass("show");

	setTimeout(function() {
	    $('.alert').fadeOut('slow');
	}, 4000);
}

function alert_alwayhs_show(){
	$(".alert").removeClass("hidden");
}