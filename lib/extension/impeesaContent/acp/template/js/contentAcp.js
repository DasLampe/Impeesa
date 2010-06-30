$(document).ready(function () {
	
	$('.linkDel').click(function() {
		var url	= $(this).attr('href');
		$.ajax({
			url: url,
			type: 'POST',
			data: 'dataType=json',
			success: function(data)
			{
				if(data.status == true)
				{
					$('a[href="'+url+'"]').parent().remove();
					actionDialog(data.msg, 'success');
				}
				else
				{
					actionDialog(data.msg, 'error');
				}
			}
		});
		return false;
	});
	
	$('#wysiwyg').wysiwyg();
	
	$('input[name="pageTitle"]').blur(function() {
		if($('input[name="siteName"]').val() == "")
		{
			var siteName	= $(this).val();
			$('input[name="siteName"]').val(siteName.toLowerCase());
		}
	});
	
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