$(document).ready(function() {

	$("a.switch").unbind("change");
	$("a.switch").click(function(){
		var p = this.firstChild;
		if (p.src.match('icon_1.png')) {
			$(p).attr({ src: "/img/icon_0.png", alt: "Activate" });
		} else {
			$(p).attr("src", "/img/icon_1.png");
			$(p).attr("alt","Deactivate");
		};
		$.get(this.href + "?" + new Date().getTime() );
		return false;
	});

});
