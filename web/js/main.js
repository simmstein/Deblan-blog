var deblan_boostrap = function() {
	set_form_style();
	set_categories_more();
	set_pre_events();
	set_popovers();
	set_comment_answerto_events();
	set_auth_modal();
	set_lightboxes();
	//set_rotation();
	//set_moving_background();
	//set_ajax_links();
	$('input[type=file]').uniform();
}

$(document).ready(function() {
	deblan_boostrap();
});

/*var infinityScroll = function(urltpl) {
	var load = false;
	var offset = $('.page:last').offset(); 
	$(window).scroll(function() {
		if((offset.top-$(window).height() <= $(window).scrollTop()) && load != window.currentPage) {
				window.currentPage++;
				var id = 'page-'+window.currentPage;
				var new_page = $('<div>').addClass('page').attr('id', id);
				$('<div>').load(urltpl.replace('-page-', window.currentPage)+' .pages', function(html) {
					new_page.append(html);
					$('#next-pages').append(new_page);
					load = window.currentPage;
					offset = $('#'+id).offset(); 
				});
		}
	});
}*/

var set_rotation = function() {
	var r = 6;
	var _the_event = function(e) {
		if(!window.bodyX) {
			window.bodyX = 0;
			window.exPageX = 0;
			window.rotateYv = 0;
		}

		$(window).unbind('mousemove', _the_event);

		window.bodyX+= (window.exPageX > e.pageX) ? -1 : +1;

		var ry = (window.exPageX > e.pageX) ? -r : +r;
		

		var _f = function(i, o, re_bind) {
			$('body').css({'-webkit-transform': 'rotateY('+i+'deg)'});

			if(i != o) {
				i = i > o ? i-1 : i+1;
				window.setTimeout(function() { _f(i, o); }, 50);
			}
			else {
				if(!re_bind) {
					_f(i, -0, true);
				}
				else {
					$(window).bind('mousemove', _the_event);
				}
			}
		}

		_f(window.rotateYv, ry, false);

		window.exPageX = e.pageX;
	}

	$('html').css({'-webkit-perspective': '10000'});

	$(window).bind('mousemove', _the_event);
}

var set_moving_background = function() {
	$(window).bind('mousemove', function(e) {
		if(!window.bodyX) {
			window.bodyX = 0;
			window.exPageX = 0;
		}

		window.bodyX+= (window.exPageX > e.pageX) ? -1 : +1;
		$('body').css('background-position', window.bodyX+'px 0');
		window.exPageX = e.pageX;
	});
}

var set_lightboxes = function() {
	var datas = [];

	$('*[rel^="milkbox"]').each(function() {
		var rel = $(this).attr('rel').replace('milkbox', 'lightbox');
		$(this).attr('rel', rel);
	});
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
				'<textarea style="max-width: 520px; width:520px; height:200px"">'+script+'</textarea>'+
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
			document.location.href = '#comment_form';
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

