$(document).ready(function() {
	$('input[type=text], input[type=password], input[type=submit], select[multiple!=multiple], button').uniform();

	$('textarea').each(function(i, textarea) {
		if(!$(this).hasClass('markitup')) {
			$(this).uniform();
		}
	});

	if(typeof mySettings != 'undefined') {
		$('.markitup').markItUp(mySettings);
	}
});
