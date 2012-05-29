{bw_css dir="/library/fancybox-1.3.4/default/" file="style.css"}
{bw_css file="jquery-ui-1.8.20.custom.css"}
{bw_css file="style.css"}
{bw_css file="reset.css"}

{bw_js dir="/library/fancybox-1.3.4/" file="jquery.fancybox-1.3.4.pack.js"}
{bw_js file="library.js"}
{bw_js dir="/library/jquery/" file="jquery.cookie.js"}
{bw_js dir="/library/jquery/" file="jquery-ui-1.8.20.custom.min.js"}
{bw_js dir="/library/jquery/" file="jquery-1.7.2.min.js"}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
	{bw_metadata action="display"}
</head>

<body>

	<div id="container">

		<div id="top">
			<div class="left">
				<div class="logo">
					<img src="/asset/admin/image/logo.png" />
				</div>
				<div class="cLanguage">{$LANGUAGE}</div>
			</div>
			<div class="middle">{$CLOCK}</div>
			<div class="right">{$MENU_TOP}</div>
		</div>

		{$MESSAGES}

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
			$("a.lb").fancybox({
				titlePosition: 'over',
				overlayColor: '#000',
				overlayOpacity: 0.6,
				cyclic: true,
				transitionIn: 'elastic',
				transitionOut: 'elastic'
			});
		});
	</script>
</body>
</html>