{* @$Revision: 80 $ *}
<script type="text/javascript" src="javascript/fat.js"></script>
<h2>{$smarty.const.LANG_CC_TITLE}</h2>
	<table width="100%" class="wrap">
		<tr>
			<td>
			{if $success}
				<div id="message" class="updated fade"><p>{$smarty.const.LANG_SETTINGS_SAVED}</p></div>
			{/if}
			
			<table width="100%"  border="0" cellspacing="0" cellpadding="3" class="main">
				<tr>
					<th scope="col">{$smarty.const.LANG_ID}</th>
					<th scope="col">{$smarty.const.LANG_FULLNAME}</th>
					<th scope="col" width="15%">{$smarty.const.LANG_ACTIONS}</th>
				</tr>
				
				{foreach from=$results item="entry" name=status}
				<tr>
					<td width="5%" class="{cycle values="row1,row2" advance=false}">{$entry.id}</td>
					<td class="{cycle values="row1,row2" advance=false}">{$entry.name}</td>
					<td class="{cycle values="row1,row2" advance=true}">
						<a href="modules.php?mod=customcats&amp;action=modify&amp;id={$entry.id}"><img src="images/page_edit.png" alt="{$smarty.const.LANG_MODIFY}" border="0" /></a>
					</td>
				</tr>
				{foreachelse}
				<tr><td colspan="6">{$smarty.const.LANG_NO_RESULTS}</td></tr>
				{/foreach}
			</table>
			</td>
		</tr>
	</table>
