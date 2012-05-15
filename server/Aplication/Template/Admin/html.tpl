{bw_css file="style.css"}
{bw_css file="reset.css"}

{bw_js dir="/library/jquery/" file="jquery-ui-1.8.20.custom.min.js"}
{bw_js dir="/library/jquery/" file="jquery-1.7.2.min.js"}

{bw_jquery type="ready"}
<script type="text/javascript">
	$('.centerElements').centerElements();
</script>
{/bw_jquery}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
	{bw_metadata action="display"}
</head>

<body>
	{$CONTENT}
</body>

</html>