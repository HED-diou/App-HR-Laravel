/*Form advanced Init*/
$(document).ready(function() {

	/* Switchery Init*/
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	$('.js-switch-1').each(function() {
		new Switchery($(this)[0], $(this).data());
	});
});