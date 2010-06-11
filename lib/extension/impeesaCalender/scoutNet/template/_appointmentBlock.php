<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<div class="appointmentBlock">
	<div class="appointmentBlock_title">
		<h2>{title}</h2>
	</div>
	<div class="appointmentBlock_info gradient">
	<p>
		<strong>Datum:</strong> {startDate} {if}{endDate} != ""{/if} - {endDate} {/endif}<br/>
		<strong>Stufen:</strong> {groups}<br/>
		<strong>Kategorie:</strong> {category}
	</p>
	<p>
		{info}
	</p>
	</div>
</div>