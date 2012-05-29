{bw_css dir="/library/fancybox-1.3.4/default/" file="style.css"}
{bw_css file="style.css"}
{bw_css file="reset.css"}

{bw_js dir="/library/tmpl/" file="jquery.tmpl.min.js"}
{bw_js dir="/library/fancybox-1.3.4/" file="jquery.fancybox-1.3.4.pack.js"}
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
			<div class="right">{$TOP_MENU}</div>
		</div>
		<div id="middle"></div>
		<div id="bottom"></div>
	</div>
</BODY>

</html>