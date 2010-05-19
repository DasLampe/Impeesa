<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
{if}{errorMsg} != "" {/if}
<div class="error">
<p>
{errorMsg}
</p>
</div>
{/endif}
<form method="post">
<input type="hidden" name="newsId" value="{newsId}" />
<fieldset>
<label for="newsHeadline">Titel *</label>
<input type="text" name="newsHeadline" value="{newsHeadline}" /><br/>

<fieldset>
<label for="startDate">Veröffentlichen *</label>
<input type="text" name="startDate" value="{startDate}" id="datePicker" /><br/>
<label for="endDate">Löschen am</label>
<input type="text" name="endDate" value="{endDate}" id="datePicker2" /> (0 = niemals) <br/>
<label for="newsStatus">Status</label>
<select name="newsStatus">{newsStatus}</select>
</fieldset>

<fieldset>
<label for="newsTags">Schlagworte</label>
<textarea name="newsTags" class="autoResize">{tags}</textarea>(Mit Komma getrennt)<br/>
<div class="no-js-hide">
Häufigste: {mostTags}
</div>
</fieldset>

<label for="newsContent">News *</label>
<textarea rows="15" cols="90" name="newsContent" id="wysiwyg">{newsContent}</textarea><br/>
<input type="submit" name="submit" value="Ändern" />
</fieldset>
</form>