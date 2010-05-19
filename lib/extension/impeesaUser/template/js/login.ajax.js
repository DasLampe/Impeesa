$(document).ready(function () {
	$('#loginForm').submit(function(){
		var url			= $('#loginForm').attr("action");
		var username	= $('input[name="username"]').val();
		var password	= $('input[name="password"]').val();
		var closeDialog	= 5000; //ms before close Dialogwindow
			
		$.ajax({
			url: url+'/login',
			type: 'POST',
			data: 'dataType=json&username='+username+'&password='+password+'&PHPSESSID=%IMPEESA_SESSIONID%',
			success: function(data)
			{
				if(data.status == true)
				{
					$('#dialog').html(data.msg);
					$('#dialog').dialog({
						modal: true,
						width: 632,
						beforeClose: function()
							{
								window.location = "%IMPEESA_MAIN_LINK%content/home";
							}
					});
					
					setTimeout("$('#dialog').dialog('close')",closeDialog);
				}
				else
				{
					$('.error').parent().remove();
					$('#loginForm').before(data.msg);
					$('.error').show('shake', {percent: 100}, 1000);
				}
			}
		});
		return false;
	});
});