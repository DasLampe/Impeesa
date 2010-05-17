<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<form action="{formAction}" method="post">
	<ul class="errorMsg">
		{errorMsg}
	</ul>

	<fieldset id="newsOptionsSetting">
		<legend>Optionen</legend>
		
		<label for="startDate">Startzeit</label>
		<input type="text" name="startDate" value="{startDate}" /> (Format: d.m.Y - H:i)<br/>
		
		<label for="endDate">Endzeit</label>
		<input type="text" name="endDate" value="{endDate}" /> (Format: d.m.Y - H:i;0=kein Ende)<br/>
		
		<label for="tags">Schlagworte</label>
		<input type="text" name="tags" value="{tags}" /> (Mit Komme getrennt)<br/>
	</fieldset>
	
	<fieldset id="newsSetContent">
		<legend>Inhalt</legend>
		
		<label for="contentHeadline">Überschrift</label>
		<input type="text" name="contentHeadline" value="{contentHeadline}" /><br/>
		
		<label for="newsContent">&nbsp;</label>
		<textarea name="newsContent">{newşContent}</textarea>
	</fieldset>
	
	<fieldset>
		<input type="submit" name="submit" value="Eintragen" />
	</fieldset>
</form>