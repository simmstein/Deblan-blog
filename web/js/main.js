var deblan_boostrap = function() {
	set_form_style();
	set_categories_more();
	set_pre_events();
	set_popovers();
	set_comment_answerto_events();
	set_auth_modal();
	set_lightboxes();
	//set_ajax_links();
	$('input[type=file]').uniform();
}

$(document).ready(function() {
	deblan_boostrap();
});

var set_lightboxes = function() {
	var datas = [];

	$('*[rel^="milkbox"]').each(function() {
		var rel = $(this).attr('rel').replace('milkbox[', '').replace(']', '');
		$(this).addClass('lightbox'+rel);
		if(!datas[rel]) {
			datas[rel] = rel;
		}
	});

	$('.lightbox').colorbox({height:"75%"});

	for(i in datas) {
		$('.lightbox'+i).colorbox({rel: i, height:"75%"});
	}
}

var set_auth_modal = function() {
	$('#auth_close').click(function(e) {
		e.preventDefault();
		$('#modal-auth').modal('toggle');
	});
}

var set_form_style = function() {
	$('.pager-button').uniform();
}

var set_pre_events = function() {
	$('.article-body pre').click(function() {
		var script  = $(this).html().replace(/<[^>]+>/g, '');
		var preview = $('<div class="modal fade">').html(
			'<div class="modal-header">'+
				'<a class="close" href="#" data-dismiss="modal">×</a>'+
				'<h3>Contenu du script</h3>'+
			'</div>'+
			'<div class="modal-body">'+
				'<textarea style="width:520px; height:200px"">'+script+'</textarea>'+
			'</div>'
		);

		$(document.body).append(preview);
		preview.modal({show: true});
	});
}

var set_categories_more = function() {
	if($('#more-categories')) {
		$('#more-categories').click(function() {
			$(this).hide();
			$('.more-categories-list').fadeIn();
		});
	}
}

var set_comment_answerto_events = function() {
	if($('.answerto')) {
		$('#answerto_cancel').click(function() {
			$('#comment_parent_comment_id').val('');
			$('#answerto_info').fadeOut();
		});

		if($('#comment_parent_comment_id').val()) {
			$('#answerto_info').fadeIn();
		}

		$('.answerto').click(function() {
			$('#comment_parent_comment_id').val($(this).attr('rel'));
			$('#answerto_info').fadeIn();
		});
	}
}

var set_popovers = function() {
	$("a[rel=popover-below]").popover({html: true, offset: 5, placement: 'below'}).click(function(e) {
		//e.preventDefault()
	});

	$("a[rel=popover-left]").popover({html: true, offset: 5, placement: 'left'}).click(function(e) {
		//e.preventDefault()
	});

	$("a[rel=popover-right]").popover({html: true, offset: 10, placement: 'right'}).click(function(e) {
		//e.preventDefault()
	});

	$("a[rel=popover-above]").popover({html: true, offset: 5, placement: 'above'}).click(function(e) {
		//e.preventDefault()
	});
}

