$(document).ready(function () {
	$('.linkDel').click(function() {
		var url	= $(this).attr('href');
		var	id	= $(this).attr('id');
		
		$.ajax({
			url: url,
			type: 'POST',
			data: 'dataType=json',
			success: function(data)
			{
				if(data.status == true)
				{
					$('#'+id).remove();
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
	
	$('.mostTag').click(function() {
		var mostTags 	= $('textarea[name="newsTags"]').val();
		var tag			= $(this).html();
		var tagId		= $(this).attr('href');
				
		if(mostTags != "")
		{
			$('textarea[name="newsTags"]').val(mostTags + ', ');
		}
		
		var mostTags 	= $('textarea[name="newsTags"]').val();
		
		$('textarea[name="newsTags"]').val(mostTags + tag);
		
		return false;
	});
	

	$("#datePicker").datepicker( {
								dateFormat: 'dd.mm.yy'
								} );
	$("#datePicker2").datepicker( {
		dateFormat: 'dd.mm.yy'
		} );
});
