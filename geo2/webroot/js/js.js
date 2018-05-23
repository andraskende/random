$(document).ready(function(){

	$('.nav li a[href="'+window.location+'"]').parent('li').addClass('active');

	// $(function() {
	// 	$.vegas('slideshow', {
	// 		delay: 15000,
	// 		backgrounds: [
	// 			{ src: '/img/bg/1.jpg', fade: 2500 },
	// 			{ src: '/img/bg/2.jpg', fade: 2500 },
	// 			{ src: '/img/bg/3.jpg', fade: 2500 }
	// 		]
	// 	});
	// 	$.vegas('overlay', {
	// 		src: '/img/overlays/02.png'
	// 		// opacity: 1
	// 	});
	// });

	var cache = {};
	$( "#s" ).autocomplete({
		minLength: 1,
		select: function(event, ui) {
			$("#s").val(ui.item.label);
			$("#searchform").submit();
		},
		source: function(request, response) {
			var term = request.term;
			if(term in cache) {
				response($.map(cache[term], function(el, index) {
					return {
						value: el.name,
						title: el.name,
						city: el.city,
						state: el.state
					};
				}));
				return;
			}
			$.getJSON( "/locations/autocomplete", request, function(data, status, xhr) {
				cache[term] = data;
				response($.map(data, function(el, index) {
					return {
						value: el.name,
						title: el.name,
						city: el.city,
						state: el.state
					};
				}));
			});
		}
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li>" )
		.append( "<a style='font-size:14px'>" + item.value + " - " + item.city + ", " + item.state + "</a>" )
		.appendTo(ul);
	};

});
