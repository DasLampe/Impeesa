$(document).ready(function () {
	function reloadByUpdate()
	{
		//Gallery Löschen
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
		
		
		//Gallery Verschieben
		$('#galerie').sortable({
			connectWith: '#galerie',
			update: function(event, ui) {
				var next, now, dir, url;
				url		= $('input[name="uploadUrl"]').attr('value');
				dir		= $('select option:selected').attr('value');
				next	= $(ui.item).next('li[class="pictureListItem"]').attr('id');
				now		= $(ui.item).attr('id');
				
				$.ajax({
					url: url + 'editPosition/',
					type: "POST",
					data: 'dataType=json&dir='+dir+'&next='+next+'&now='+now,
					success: function(data)
					{
						actionDialog(data.msg, 'success');
						$(ui.item).attr('id', data.newName);
						$(ui.item).find('img').attr('src', data.newThumb);
						$(ui.item).find('a').remove('a');
						$(ui.item).find('pictureOption').html('');
						$(ui.item).find('.pictureOption').append('Gallerie neu laden, für alle Aktionen!');
					}
				});
			}
		});
		
		$('#galerie').disableSelection();
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
				actionDialog(data.msg, 'success');
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

				actionDialog(data.msg, 'success');
			}
		});

		return false;
	});
});