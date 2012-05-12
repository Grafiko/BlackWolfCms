var g_nLastTime = null;
		
function cssClock(hourElementId, minuteElementId, secElementId)
{
	var objDate = new Date();
	if (!hourElementId || !minuteElementId || !secElementId) {
		return;
	}

	var objHour = document.getElementById(hourElementId);
	var objMinutes = document.getElementById(minuteElementId);
	var objSec = document.getElementById(secElementId);

	if (!objHour || !objMinutes || !objSec) {
		return;
	}

	var nSec = objDate.getSeconds();
	var nMinutes = objDate.getMinutes();

	var nHour = objDate.getHours();
	if (nHour > 12) {
		nHour -= 12;
	}

	nHour = nHour * 5;

	if(nMinutes > 0 && nMinutes <= 11) {
		nHour = nHour + 0;
	}
	if(nMinutes >= 12 && nMinutes <= 23) {
		nHour = nHour + 1;
	}
	if(nMinutes >= 24 && nMinutes < 35) {
		nHour = nHour + 2;
	}
	if(nMinutes >= 36 && nMinutes < 47) {
		nHour = nHour + 3;
	}
	if(nMinutes >= 48 && nMinutes < 59) {
		nHour = nHour + 4;
	}

	objHour.className = 'hr' + nHour;
	objMinutes.className = 'min' + nMinutes;
	objSec.className = 'sec' + nSec;

	g_nLastTime = objDate;

	setTimeout(function() { cssClock(hourElementId, minuteElementId, secElementId); }, 1000);
}