{* user store display *}
{if $storeTitle<>"" || $storeDescription<>"" || $storeImage<>""}
	{if $storeImage<>""}
		<div align="center"><img src="photos/{$storeImage}" alt="{$storeTitle}" /></div><br />
	{else}
		<h3>{$storeTitle}</h3>
	{/if}
	<table width="80%" align="center">
		<tr>
			<td>{$storeDescription}</td>
		</tr>
	</table>
{/if}
{* end user store display *}	

{* This section shows the listings in categories, search results, and user store *}

{if $maxPage > 1 && ($sPagination==1 || $sPagination==3)}
<div class="pageNav">
{* display pagination *}
	<table class="pagination" cellpadding="3" cellspacing="1" border="0" align="right" style="margin-bottom:3px">
		<tr>
			<td class="navigationBack" style="font-weight:normal">{$smarty.const.LANG_SHOWING_PAGE} {$pageNum} of {$maxPage}</td>
			
			{if $first<>""}
			<td class="paginationNum"><a href="{$file}?{$first}">{$smarty.const.LANG_FIRST}</a></td>
			{/if}
			
			{if $prev<>""}
			<td class="paginationNum"><a href="{$file}?{$prev}">{$smarty.const.LANG_PREVIOUS}</a></td>
			{/if}
			
			{foreach from=$pageNumber item="entry"}
				{if $entry.number==$pageNum}
				<td class="paginationNum"><strong>{$entry.number}</strong></td>
				{else}
				<td class="paginationNum"><a href="{$file}?{$entry.link}" class="paginationNum">{$entry.number}</a></td>
				{/if}
			{/foreach}
			
			{if $next<>""}
			<td class="paginationNum"><a href="{$file}?{$next}">{$smarty.const.LANG_NEXT}</a></td>
			{/if}
			
			{if $last<>""}
			<td class="paginationNum"><a href="{$file}?{$last}">{$smarty.const.LANG_LAST}</a></td>
			{/if}
			
		</tr>
	</table>
</div>
<br /><br />
{/if}

	<table class="main" width="100%">
 		<tr>
 			{if $sDisPhoto == "Y"}
			<th scope="col">{$smarty.const.LANG_PHOTO}</th>
			{/if}
			{if $sDisTitle == "Y"}
			<th scope="col"><a href="{$file}?{$querystring_title}" class="sortheader">{$smarty.const.LANG_TITLE}</a> {if $sqlsort=="title"}<img src="templates/{$smarty.const.MAIN_TEMPLATE}/images/sort{$oppositesort}.gif" border="0" alt="Sort" />{/if}</th>
			{/if}
			<th scope="col">{$smarty.const.LANG_VIEW_LISTING}</th>
		</tr>
	
	{foreach from=$results item="entry"}
	<tr>
	     {if $sDisPhoto == "Y"}
	     <td{if $entry.class<>""} class="{$entry.class}"{/if}><a href="{$entry.link}">{if $entry.image != ""}<img src="thumbs/small_{$entry.image|escape:"url"}" border="0" alt="{$entry.title}" />{else}<img src="templates/{$smarty.const.MAIN_TEMPLATE}/images/nophotosmall.gif" border="0" alt="{$entry.title}" />{/if}</a></td>
	     {/if}
          {if $sDisTitle == "Y"}
          <td{if $entry.class<>""} class="{$entry.class}"{/if}>{$entry.title}</td>
          {/if}
	     <td{if $entry.class<>""} class="{$entry.class}"{/if}>
	     	<a href="{$entry.link}">{$smarty.const.LANG_VIEW_LISTING}</a>	     	
	     </td>
	</tr>
	{foreachelse}
	<tr>
	     <td colspan="9" align="center">{$smarty.const.LANG_SEARCH_NO_RESULTS}</td>
	</tr>
	{/foreach}
</table>

{if $maxPage > 1 && ($sPagination==2 || $sPagination==3)}
<div class="pageNav">
{* display pagination *}
	<table class="pagination" cellpadding="3" cellspacing="1" border="0" align="right" style="margin-top:3px">
		<tr>
			<td class="navigationBack" style="font-weight:normal">{$smarty.const.LANG_SHOWING_PAGE} {$pageNum} of {$maxPage}</td>
			
			{if $first<>""}
			<td class="paginationNum"><a href="{$file}?{$first}">{$smarty.const.LANG_FIRST}</a></td>
			{/if}
			
			{if $prev<>""}
			<td class="paginationNum"><a href="{$file}?{$prev}">{$smarty.const.LANG_PREVIOUS}</a></td>
			{/if}
			
			{foreach from=$pageNumber item="entry"}
				{if $entry.number==$pageNum}
				<td class="paginationNum"><strong>{$entry.number}</strong></td>
				{else}
				<td class="paginationNum"><a href="{$file}?{$entry.link}" class="paginationNum">{$entry.number}</a></td>
				{/if}
			{/foreach}
			
			{if $next<>""}
			<td class="paginationNum"><a href="{$file}?{$next}">{$smarty.const.LANG_NEXT}</a></td>
			{/if}
			
			{if $last<>""}
			<td class="paginationNum"><a href="{$file}?{$last}">{$smarty.const.LANG_LAST}</a></td>
			{/if}
			
		</tr>
	</table>
</div>
{/if}

