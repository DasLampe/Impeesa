<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<form action="/intern/news/add/1" method="post">
	<ul class="errorMsg">
		
	</ul>

	<fieldset id="newsOptionsSetting">
		<legend>Optionen</legend>
		
		<label for="startDate">Startzeit</label>
		<input type="text" name="startDate" value="16.12.2009 - 20:08" /> (Format: d.m.Y - H:i)<br/>
		
		<label for="endDate">Endzeit</label>
		<input type="text" name="endDate" value="0" /> (Format: d.m.Y - H:i;0=kein Ende)<br/>
		
		<label for="tags">Schlagworte</label>
		<input type="text" name="tags" value="" /> (Mit Komme getrennt)<br/>
	</fieldset>
	
	<fieldset id="newsSetContent">
		<legend>Inhalt</legend>
		
		<label for="newsHeadline">Überschrift</label>
		<input type="text" name="newsHeadline" value="" /><br/>
		
		<label for="newsContent">&nbsp;</label>
		<textarea name="newsContent"></textarea>
	</fieldset>
	
	<fieldset>
		<input type="submit" name="submit" value="Eintragen" />
	</fieldset>
</form>