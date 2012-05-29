<div style="width:450px;">
	<form name="categoryAdd" method="post" action="{$URL.POST}" class="standard">
		<fieldset>
			<label>{bw_i18n txt="category_name"}:</label>
			<input class="w225" type="text" name="_name" value="{$oCategory->name|escape}" />
			{if isset($error.name)}<div class="error">{$error.name}</div>{/if}
		</fieldset>

		<fieldset>
			<label>{bw_i18n txt="parent"}:</label>
			<select name="parent_id">
				<option value="">- {bw_i18n txt="no_parent"} -</option>
				{foreach $library.oCategoryList as $ITEM}
				<option value="{$ITEM.id}" {if $oCategory->parent_id==$ITEM.id || ($category_id==$ITEM.id && !$oCategory->parent_id)}selected="selected"{/if}>{$ITEM.name}</option>
				{/foreach}
			</select>
			{if isset($error.parent_id)}<div class="error">{$error.parent_id}</div>{/if}
		</fieldset>

		<fieldset>
			<label>{bw_i18n txt="is_activ"}:</label>
			<select name="is_activ">
				<option value="">- {bw_i18n txt="select"} -</option>
				<option value="0" {if $oCategory->is_activ===0}selected="selected"{/if}>{bw_i18n txt="no"}</option>
				<option value="1" {if $oCategory->is_activ===1}selected="selected"{/if}>{bw_i18n txt="yes"}</option>
			</select>
			{if isset($error.is_activ)}<div class="error">{$error.is_activ}</div>{/if}
		</fieldset>

		<fieldset>
			<label>{bw_i18n txt="sequence"}:</label>
			<select name="sort">
				{section name=foo start=1 loop=100 step=1}
				<option value="{$smarty.section.foo.index}" {if $oCategory->sort== $smarty.section.foo.index}selected="selected"{/if}>{$smarty.section.foo.index}</option>
				{/section}
			</select>
			{if isset($error.sort)}<div class="error">{$error.sort}</div>{/if}
		</fieldset>

		<div class="buttons centerElements">
			<a class="btnSmall orange" href="javascript:void(0);" onClick="$('form[name=categoryAdd]').submit();">{bw_i18n txt="add"}</a>
			<a class="btnSmall black last" href="javascript:void(0);" onClick="wClose();">{bw_i18n txt="cancel"}</a>
		</div>
	</form>
</div>