{* @$Revision: 80 $ *}
<h2>{$name}</h2>
<div class="wrap">
	{if $success}
		<script type="text/javascript" src="javascript/fat.js"></script>
		<div id="message" class="updated fade"><p>{$smarty.const.LANG_SETTINGS_SAVED}</p></div>
	{/if}
				
	<form action="modules.php" method="post" id="form" name="mainform">
		<input type="hidden" name="action" value="save" />
		<input type="hidden" name="id" value="{$id}" />
		<input type="hidden" name="mod" value="customcats" />
		
		<p class="{cycle values="row1,row2" advance=true}">
			<label for="ccTemplate">{$smarty.const.LANG_CC_TEMPLATE}{$smarty.const.LANG_COLON}</label>
			<select name="ccTemplate" id="ccTemplate">
				<option value=""{if $ccTemplate == ""} selected{/if}>Default</option>
				{foreach from=$files item=entry}
					 <option value="{$entry}"{if $entry==$ccTemplate} SELECTED{/if}>{$entry}</option>
				{/foreach}
			</select>
		</p>
		
		<div align="center">
			<input type="submit" value="{$smarty.const.LANG_SUBMIT}" />
		</div>
	</form>
</div>