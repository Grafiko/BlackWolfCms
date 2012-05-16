{bw_css file="style.css"}

<div class="adminSelectLanguage">
	<span class="name">{bw_i18n txt="language"}:</span>
	<dl>
		<dt>
			<a href="#">
				<span class="flag"><img src="/asset/admin/language/selectLanguage/image/{$oCurrentLanguage->code}.png" /></span>
				<span class="arrow"></span>
				<span class="name">{$oCurrentLanguage->name} ({$oCurrentLanguage->native})</span>
			</a>
		</dt>
		<dd>
			<ul>
				{foreach $oLanguageRowset as $oLanguage}
				<li>
					<a href="{$oLanguage->getChangeUrl()}">
						<span class="flag"><img src="/asset/admin/language/selectLanguage/image/{$oLanguage->code}.png" /></span>
						<span class="name">{$oLanguage->name} ({$oLanguage->native})</span>
					</a>
				</li>
				{/foreach}
			</ul>
		</dd>
	</dl>
</div>

{bw_jquery type="ready"}
<script type="text/javascript">
	var $adminSelectLanguage = $('.adminSelectLanguage');

	$("dd>ul>li>a>span.flag", $adminSelectLanguage).css({ opacity: 0.5 });

	$("dd>ul>li>a", $adminSelectLanguage).hover(
		function() { $("span.flag", this).css({ opacity: 1 }); },
		function() { $("span.flag", this).css({ opacity: 0.5 }); }
	)

	$("dl>dt>a", $adminSelectLanguage).click(function() {
		$("dl>dd>ul", $adminSelectLanguage).css({ minWidth: $("dl>dt", $adminSelectLanguage).width() });
		$("dl>dd>ul", $adminSelectLanguage).toggle();
	});

	$("dd>ul>li>a", $adminSelectLanguage).click(function() {
		var text = $(this).html();
		$(".dropdown dt a span").html(text);
		$("dd>ul", $adminSelectLanguage).hide();
	});

	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (!$clicked.parents($("dl", $adminSelectLanguage))) {
			$("dd>ul", $adminSelectLanguage).hide();
		}
	});
</script>
{/bw_jquery}