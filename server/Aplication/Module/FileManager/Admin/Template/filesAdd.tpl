<div style="width:500px;">
	<form name="filesAdd" method="post" action="{$URL.POST}" class="standard">
		<fieldset>
			<label>Dodaj pliko do kategorii:</label>
			<select name="gallery_category_id">
				{if isset($L.CATEGORY)}
				{foreach $L.CATEGORY as $ITEM}
				<option value="{$ITEM.id}" {if $V.gallery_category_id==$ITEM.id || $CATEGORY_ID==$ITEM.id}selected="selected"{/if}>{$ITEM.name}</option>
				{/foreach}
				{/if}
			</select>
			{if isset($E.gallery_category_id)}<div class="error">{$E.gallery_category_id}</div>{/if}
		</fieldset>

		<fieldset>
			<label>Ustawić jako aktywne:</label>
			<select name="is_activ">
				<option value="1" {if $V.is_activ===1}selected="selected"{/if}>Tak</option>
				<option value="0" {if $V.is_activ===0}selected="selected"{/if}>Nie</option>
			</select>
			{if isset($E.is_activ)}<div class="error">{$E.is_activ}</div>{/if}
		</fieldset>

		<div class="buttons centerElements">
			<a class="btnSmall orange" href="javascript:void(0);" onClick="$('form[name=photoAdd]').submit();">dodaj</a>
			<a class="btnSmall black last" href="javascript:void(0);" onClick="wClose();">anuluj</a>
		</div>
	</form>
</div>