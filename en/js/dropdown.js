$(function() {
	var nav = document.getElementById('nav');
	var navlist = nav.querySelectorAll('.navlist');
	for(var i = 0; i < navlist.length; i++) {
		navlist[i].onmouseover = function() {
			var navdropdown = this.querySelector('.navdropdown');
			if(navdropdown) {
				navdropdown.style.display = 'block';
			}

		}
		navlist[i].onmouseout = function() {
			var navdropdown = this.querySelector('.navdropdown');
			if(navdropdown) {
				navdropdown.style.display = 'none';
			}

		}
	}

})



$(function() {
	var windoWidth = $(window).width();
	var windowHeight = $(window).height();
	$(".navClick").click(function(e) {
		//$(".screen").toggle();
		$("body").toggleClass("body_Skin");
		e.stopPropagation();
	});

	$(".pages a").attr("style", "none");
	$(".pages span").attr("style", "none");
});