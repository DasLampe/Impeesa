<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
//Script from: http://www.swfupload.org/
?>
<p>
Bitte beim Upload dadrauf achten, dass die Bilder...
</p>
<ul>
	<li>...im JPG-Format sind</li>
	<li>...unter 2 MB groß sind</li>
	<li>...wenn möglich die Abmessung 640x480 oder 360x480 haben.(BreitexHöhe)</li>
</ul>
<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
	<div class="fieldset flash" id="fsUploadProgress1">
		Bilder hochladen
	</div>
	<div style="padding-left: 5px;">
		<span id="spanButtonPlaceholder1"></span>
		<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;" />
		<br />
	</div>
</form>