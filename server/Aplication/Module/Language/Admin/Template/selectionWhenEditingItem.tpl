{bw_css file="style.css"}

<div class="selectionLanguageWhenEditItem">
	<span class="name">{bw_i18n txt="language_of_input"}:</span>
	<ul>
		{foreach $oLanguageRowset as $oLanguage}
		<li {if $oLanguage->_isCurrent}class="activ"{/if}>
			<a href="{$oLanguage->getChangeEditUrl()}">
				<span class="flag"><img src="/asset/admin/language/selectionWhenEditingItem/image/{$oLanguage->code}.png" /></span>
			</a>
		</li>
		{/foreach}
	</ul>
</div>

{bw_jquery type="ready"}
<script type="text/javascript">
	var $selectionLanguageWhenEditItem = $('.selectionLanguageWhenEditItem');

	$("li:not(.activ)>a>span.flag", $selectionLanguageWhenEditItem).css({ opacity: 0.4 });

	$("li:not(.activ)>a", $selectionLanguageWhenEditItem).hover(
		function() { $("span.flag", this).css({ opacity: 0.9 }); },
		function() { $("span.flag", this).css({ opacity: 0.4 }); }
	);
</script>
{/bw_jquery}