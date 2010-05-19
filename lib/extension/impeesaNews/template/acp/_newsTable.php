<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<tr id="newsId_{newsId}">
	<td class="newsTitle_table">{headline}
		<div class="newsEditOption">
			<a href="{LINK_ACP}news/edit/{newsId}">Bearbeiten</a> | <a href="{LINK_ACP}news/del/{newsId}" id="newsId_{newsId}" class="linkDel">Papierkorb</a> | <a href="{LINK_MAIN}content/newsEntry/{newsId}">Ansehen</a>
		</div>
	</td>
	<td class="newsAuthor_table">{username}</td>
	<td class="newsTags_table">{tags}</td>
	<td class="newsDate_table">{startDate}
		{if}{endDate} != 0 {/if}
		- {endDate}
		{/endif}<br/>
		{newsStatus}
	</td>
</tr>