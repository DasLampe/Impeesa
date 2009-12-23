$(document).ready(function() {
	$.ui.dialog.defaults.bgiframe = true;
	
	$(".newsEdit a").attr('href', '#');
	
	$(".newsBox").click(function() {
		$.ajax({
			method:"get",
			url:'http://impeesa/ajax/impeesaNews/var/action/editNews/newsId/1/',
			data:"123=1",
			success: function(html) {
				$("#dialog").html(html);
			}
		});
			
		$("#dialog").dialog();
	});
	
	$(".newsEdit a").click(function() {
		var newsId = $(this).attr('name');
		
		$.ajax({
			method:"get",
			url:'http://impeesa/ajax/impeesaNews/var/action/editNews/newsId/'+ newsId + '/',
			data:"123=1",
			success: function(html) {
				$("#dialog").html(html);
			}
		});
			
		$("#dialog").dialog();
	});

});