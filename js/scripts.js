// JavaScript Document
//dropdownmeny
$(document).ready(function() {
	$(".burgermeny").click(function() {
		if ($(".burgerlist").hasClass("burgerstyle")) {
			$(".burgerlist").removeClass("burgerstyle");
		} else {
			$(".burgerlist").addClass("burgerstyle");
		}
	});
});