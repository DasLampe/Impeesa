<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
//Script from: http://www.swfupload.org/
?>
<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
	<input id="dir" type="text" name="ordner" value="Ordner" />
	<div class="fieldset flash" id="fsUploadProgress1">
		Bilder hochladen
	</div>
	<div style="padding-left: 5px;">
		<span id="spanButtonPlaceholder1"></span>
		<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
		<br />
	</div>
</form>