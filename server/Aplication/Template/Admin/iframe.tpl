{bw_css file="iframe.css"}
{bw_css file="jquery-ui-1.8.20.custom.css"}
{bw_css file="style.css"}
{bw_css file="reset.css"}

{bw_js file="library.js"}
{bw_js dir="/library/jquery/" file="jquery.cookie.js"}
{bw_js dir="/library/jquery/" file="jquery-ui-1.8.20.custom.min.js"}
{bw_js dir="/library/jquery/" file="jquery-1.7.2.min.js"}

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Tarnsitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	{bw_metadata action="display"}

	<script type="text/javascript">
		function wClose() {
			parent.$('div[rel="_window"]')._window('destroy');
		}

		function wResize() {
			parent.$('div[rel="_window"]').find('.content').height($('body').height());
			parent.$('div[rel="_window"]').find('.content').height($(document).height());
			parent.$('div[rel="_window"]').find('.content').width($('body').width());
			parent.$('div[rel="_window"]').find('.content').width($(document).width());
			parent.$('div[rel="_window"]').width($(document).width() + 40);
			parent.$('div[rel="_window"]').center();
		}

		$(document).ready(function() {
			$('.centerElements').centerElements();
			$('body').css({ visibility:'hidden' });
			wResize();
			//$(window).resize(wResize);
			$('body').css({ visibility:'visible' });
		});
	</script>
</head>

<body style="background:none;" onload="wResize();">
	{$CONTENT}
	<script type="text/javascript">
		$(document).ready(function() {
			wResize();
			//$(window).resize(wResize);
		});
	</script>
</body>

</html>