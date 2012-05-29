{bw_css file="style.css"}

<ul class="menuLeft mb12">
	<li class="title">{$oMenuLeft->getName()}</li>
	{foreach $oMenuLeft->getItems() as $oMenuLeftItem}
	{if !$oMenuLeftItem->isHidden()}
	<li>
		<a 
			href="{if $oMenuLeftItem->getHref()}{$oMenuLeftItem->getHref()}{else}#{/if}"
			{if $oMenuLeftItem->isActiv()}class="activ"{/if}
			{if $oMenuLeftItem->getOnClick()}onClick="{$oMenuLeftItem->getOnClick()}"{/if}
		>{$oMenuLeftItem->getName()}</a>
	</li>
	{/if}
	{/foreach}
</ul>