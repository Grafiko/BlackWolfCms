{bw_js file="clock.js"}
{bw_css file="style.css"}

<div id="clockbase">
	<div id="hours"></div>
	<div id="minutes"></div>
	<div id="seconds"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		cssClock('hours', 'minutes', 'seconds');
	});
</script>