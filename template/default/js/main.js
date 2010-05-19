$(document).ready(function () {	
	$('.no-js-hide').show();
	
	$('input[type="submit"]').click(function()
	{
		$('input').removeClass('inputError');
		
		var	error	= false;
		var form	= $('form').children($(this));
		var	label	= $(form).find('label:contains("*")');
		
		$(label).each(function(index)
		{
			var name	= $(this).attr('for');
			if($('input[name='+name+']').val() == "")
			{
				error	= true;
				$('input[name='+name+']')
						.addClass('inputError');
			}
		});
		
		if(error == true)
		{
			return false;
		}
		else
		{
			return true;
		}
	});
	
	$('textarea.autoResize').autoResize({
	    // On resize:
	    onResize : function() {
	        $(this).css({opacity:0.8});
	    },
	    // After resize:
	    animateCallback : function() {
	        $(this).css({opacity:1});
	    },
	    // Quite slow animation:
	    animateDuration : 300,
	    extraSpace: 5
	});
});

function actionDialog(text)
{
	$('#dialog-action').html(text);
	$('#dialog-action').show('blind');
	setTimeout("$('#dialog-action').hide('blind')", 5000);
}