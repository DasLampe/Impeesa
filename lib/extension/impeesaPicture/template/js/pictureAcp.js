$(document).ready(function () {
	function reloadByUpdate()
	{
		$('a[class="linkDel"]').click(function() {
			var url, parent;
			url		= $(this).attr('href');
			parent	= $(this).parents('#pictureBlock:first');
			
			$.ajax({
				url: url,
				type: "POST",
				data: 'dataType=json',
				success: function(data)
				{
					if(data.status == true)
					{
						$(parent).remove();
						actionDialog(data.msg);
					}
					else
					{
						actionDialog(data.msg);	
					}
				}
			});
			return false
		});
	}
	
	$('a[name="delDir"]').click(function() {
		$.ajax({
			url: $(this).attr('href'),
			type: "POST",
			data: "dataType=json",
			success: function(data)
			{
				if(data.status == true)
				{
					$('select option:selected').remove();
					$('#galerie').html('');
					$('a[name="delDir"]').hide();
					$('a[name="uploadLink"]').hide();
				}
				actionDialog(data.msg);
			}
		});
		return false;
	});
	
	$('select').change(function() {
		var dir = $('select option:selected').attr('value');
		var url	= $('input[name="uploadUrl"]').attr('value');
		
		if(dir != "")
		{
			$('a[name="uploadLink"]').attr('href', url + 'upload/'+ dir).show();
			$('a[name="delDir"]').attr('href', url + 'delDir/' + dir).show();
			
			$.ajax({
				url: url + 'editPicture/',
				type: "POST",
				data: 'dataType=json&dir='+dir+'&action=getGalerie',
				success: function(data)
				{
					$('#galerie').html(data.msg);
					
					reloadByUpdate();					
				}
			});
		}
		else
		{
			$('a[name="uploadLink"]').hide();
		}
	});
	
	$('#galerieForm').submit(function() {
		var newDir, newsDirYear;
		var url		= $('input[name="uploadUrl"]').attr('value');
		newDir		= $('input[name="newDir"]').attr('value');
		newDirYear	= $('input[name="newDirYear"]').attr('value');
		
		$.ajax({
			url: url + 'addDir',
			type: "POST",
			data: 'dataType=json&newDir='+newDir+'&newDirYear='+newDirYear,
			success: function(data)
			{
				if(data.status == true)
				{
					$('select').append( new Option(newDirYear + ' - ' + newDir,data.dir) );
				}

				actionDialog(data.msg);
			}
		});

		return false;
	});
});