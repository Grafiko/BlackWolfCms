{bw_css dir="/library/fancybox/" name="jquery.fancybox-1.3.4"}
{bw_css name="cloak"}
{bw_css name="style"}
{bw_css name="reset"}
{bw_css dir="/library/jquery/" name="jquery-ui-1.8.16.custom"}

{bw_js dir="/library/fancybox/" name="jquery.fancybox-1.3.4.pack"}
{bw_js dir="/library/jquery/" name="common"}
{bw_js dir="/library/tmpl/" name="jquery.tmpl.min"}
{bw_js dir="/library/jquery/" name="jquery-ui-fix"}
{bw_js dir="/library/jquery/" name="jquery-ui-1.8.16.custom.min"}
{bw_js dir="/library/jquery/" name="1.6.4.min"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Tarnsitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	{bw_metadata action="display"}
</head>

<body>

	<div id="container">

		<div id="top">
			<div class="left">
				<div class="logo"><img src="{$PATH.IMG}logo2.png" /></div>
			</div>
			<div class="middle">
				<div id="clockbase">
	    			<div id="hours"></div>
	    			<div id="minutes"></div>
	    			<div id="seconds"></div>
				</div>
			</div>
			<div class="right">{$MENU_TOP}</div>
		</div>

		<div id="messages">
			{$MESSAGES}
		</div>

		<div id="middle" class="tab">
			<div class="left">
				<div class="module_title">{$MODULE_TITLE}</div>
				<div class="container">{$PANEL_LEFT}</div>
			</div>
			<div class="right">{$PANEL_RIGHT}</div>
		</div>

		<div id="bottom"></div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.centerElements').centerElements();
			$('#messages').bwMessages();
			$("a.lb").fancybox({
				titlePosition: 'over',
				overlayColor: '#000',
				overlayOpacity: 0.6,
				cyclic: true,
				transitionIn: 'elastic',
				transitionOut: 'elastic'
			});
			cssClock('hours', 'minutes', 'seconds');
		});
	</script>
</body>
</html>