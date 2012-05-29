<ul class="panelLeft mb12">
	<li class="title">{$box_title}</li>
	{if $aPathCategoryList}
	<li>
		<table class="structurePath" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody>
		<tr><td>
			{assign var="p" value="-16"}
			{foreach $aPathCategoryList as $oCategory}
			{assign var="p" value="`$p+16`"}
			<table cellspacing="0" cellpadding="0"><tbody>
			<tr>
				<td nowrap="" align="right" width="{$p}">
					<a href="{$oCategory->_url.structure}" class="minus"></a>
				</td>
				<td class="icon {if $oCategory->is_activ}folder{else}folderDisabled{/if} {if $oCategory->_is_current}current{/if} {if $oCategory@index == 0}first{/if}">
					<a href="{$oCategory->_url.edit}"></a>
				</td>
				<td class="title vMiddle">
					<a href="{$oCategory->_url.edit}" class="{if $oCategory->_is_edit}edit{/if}">{$oCategory->name}</a>
				</td>
			</tr>
			</tbody></table>
      	{/foreach}
		</td></tr>
		</tbody></table>
	</li>
	{/if}
	<li class="line {if !$aPathCategoryList}mt10{/if}"></li>
	<li>
		<table class="structureItems" cellspacing="0" cellpadding="0" border="0" width="100%"><tbody>
		<tr><td>

			{foreach $oCategoryList as $oCategory}
			<table cellspacing="0" cellpadding="0"><tbody>
			<tr>
				<td nowrap="" align="right">
					{if $oCategory->countChildren() > 0}
					<a href="{$oCategory->_url.structure}" class="plus"></a>
					{else}
					<a href="javascript:void(0);" class="null"></a>
					{/if}
				</td>
				<td class="icon {if $oCategory->is_activ}folder{else}folderDisabled{/if}"><a href="{$oCategory->_url.edit}"></a></td>
				<td class="title">
					<a href="{$oCategory->_url.edit}" class="{if $oCategory->_is_edit}edit{/if}">{$oCategory->name}</a>
				</td>
			</tr>
			</tbody></table>
			{/foreach}

		</td></tr>
		</tbody></table>
	</li>
</ul>