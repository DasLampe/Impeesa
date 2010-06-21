$(document).ready(function () {
	$('#wysiwyg').wysiwyg();
	
	//Blende alle aktiven Modul Positionen ein
	$('input[name="modulEnabled[]"][checked]').each(function() {
		$(this).next('input[type="text"]').show();
	});
	
	$('input[name="modulEnabled[]"]').change(function() {
		if($(this).is(':checked') == true)
		{
			$(this).next('input[type="text"]').show();
		}
		else
		{
			$(this).next('input[type="text"]').hide();
		}
	});
});