{bw_css file="style.css"}

<div id="system_logs">
	<div class="btnLog"><a href="#"></a></div>
	<div class="box {if !$isOpen}off{/if}">
		<div class="right">&nbsp;</div>
		<div class="left">
			<div class="name">Historia ostatnich akcji</div>
			<ul>
				{foreach $oLogRowset as $oLog}
				<li class="{if $oLog@index is div by 2}n2{/if} {if $oLog@last}last{/if}">
					<span class="time">{$oLog->created_at}</span>
					<span class="info">{$oLog->getMessage()}</span>
				</li>
				{/foreach}
			</ul>
		</div>
	</div>
</div>
{bw_jquery type="ready"}
<script type="text/javascript">
	$('.btnLog', $('#system_logs')).bind('click', function() {
		if ( $('.box', $('#system_logs')).hasClass('off') ) {
			$('.box', $('#system_logs')).slideDown('slow', function() {
				$('.box', $('#system_logs')).removeClass('off');
				$.cookie('system_logs', 1);
			});
		} else {
			$('.box', $('#system_logs')).slideUp('slow', function() {
				$('.box', $('#system_logs')).addClass('off');
				$.cookie('system_logs', 0);
			});
		}
	});
</script>
{/bw_jquery}
