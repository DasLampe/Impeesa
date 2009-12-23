<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<div class="newsBox">
{if} {editUserRights}==true{/if}
<div class="newsEdit">
	<a href="{newsEditLink}id/{newsId}" name="{newsId}" title="News bearbeiten">News bearbeiten</a>
</div>
{/endif}
	<h2>{newsHeadline}</h2>
	<p>
		{newsContent}<br/>
		Tags: {newsTags}
	</p>
</div>
