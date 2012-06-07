$(document).ready(function() {
	$('input[type=text], input[type=password], input[type=submit], select[multiple!=multiple], button').uniform();

	$('textarea').each(function(i, textarea) {
		if(!$(this).hasClass('markitup')) {
			$(this).uniform();
		}
	});

	/*$('.markitup').each(function() {
		new nicEditor({fullPanel : true}).panelInstance($(this).attr('id')); 
	});*/

	if(typeof mySettings != 'undefined') {
		$('.markitup').markItUp(mySettings);
	}
});
