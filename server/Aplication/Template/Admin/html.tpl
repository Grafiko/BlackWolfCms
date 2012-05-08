<!-- 
{bw_css type="admin" file="style.css"}
{bw_css type="admin" file="reset.css"}

{bw_js dir="library/jquery/" file="common.js"}
{bw_js dir="library/jquery/" file="jquery-ui-1.8.20.custom.min.js"}
{bw_js dir="library/jquery/" file="1.7.2.min.js"}
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<html>
<head>
	{bw_metadata action="display"}
</head>

<body>
	{$CONTENT}

	<script type="text/javascript">
		$(document).ready(function() {
			$('.centerElements').centerElements();
		});
	</script>
</body>

</html>