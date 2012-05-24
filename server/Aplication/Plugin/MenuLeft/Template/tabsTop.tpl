{bw_css file="style.css"}

<div id="tabsTop">
	<ul>
		{foreach $oTabs->getItems() as $oTab}
		<li>
			<a href="#{$oTab->getHash()}">{$oTab->getName()}</a>
		</li>
		{/foreach}
	</ul>
	{foreach $oTabs->getItems() as $oTab}
	<div id="{$oTab->getHash()}">
		{$oTab->getContent()}
	</div>
	{/foreach}
</div>

{bw_jquery type="ready"}
<script type="text/javascript">
	$("#tabsTop").tabs();
	{if $oTabs->getActiv()}
	$("#tabsTop").tabs('select', '{$oTabs->getActiv()}');
	{/if}
</script>
{/bw_jquery}