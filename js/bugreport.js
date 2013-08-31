

function updateReportLength() {	document.getElementById('reportDescription').value = document.getElementById('reportDescription').value.substr(0,1000);
	document.getElementById('DescriptionCharactersLeft').innerHTML = 1000-document.getElementById('reportDescription').value.length+' characters left';
}

function openReport() {	updateReportLength();
	document.getElementById('bugreport').style.display ='block';
}

function closeReport() {	document.getElementById('bugreport').style.display ='none';
}

function reportValidateDescription() {	var desc = document.getElementById('reportDescription').value;	if(desc.length==0) {		alert('Enter description!');
		return false;
	}else if(desc.length>1000) {		alert('Description is too long! (Max. 1000 characters)');
		return false;
	}
	return true;
}

function reportBug() {
	if(!reportValidateDescription()) return;	var userInput = document.getElementById('reportDescription').value;
	var location = parent.location;
	var userAgent = navigator.userAgent;

	AJAX = getAjaxObject();
	if(AJAX) {       var url = 'ajax/bugreport.php';
       var params = 'userInput='+userInput+'&location='+location+'&userAgent='+userAgent;
       AJAX.open("POST", url, true);
       AJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	   AJAX.setRequestHeader("Content-length", params.length);
	   AJAX.setRequestHeader("Connection", "close");
       AJAX.onreadystatechange = function() {
			if(AJAX.readyState == 4 && AJAX.status == 200) {
				if(AJAX.responseText == 1) {                     alert('Bug reported! Thank you :)');
                     closeReport();
                     return;
				}else if(AJAX.responseText == -1) {					alert('You can send only one bug report in one minute. Please try again later :)');
				}
				else reportError();
			}else if(AJAX.readyState == 4 && Number(AJAX.status) >= 400) {				reportError();
			}
	   }
	   AJAX.send(params);
	}else reportError();

}

function reportError() {	alert('Bug Report cannot be send :(');
	closeReport();
}