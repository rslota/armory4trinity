
LG = new Array();
var GUID;
var tipobj = null;
function load__() {
	bindToolTips();
	tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""
	try {

	}catch(e){

	}
}

function getAjaxObject() {
	var AJAX = false;
	if (window.XMLHttpRequest) {
	   AJAX = new XMLHttpRequest();
	   if(AJAX.overrideMimeType){
		  AJAX.overrideMimeType('text/xml');
		}
	}else if (window.ActiveXObject) {
	   AJAX = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return AJAX;
}

function viewIn3D(get) {
	//window.open(_DOMAIN+"char3dview.php?"+get,'3D View','status=0,toolbar=0,menubar=0,width=600,height=420,location=0');
	document.getElementById('character3D').style.display = 'block';
}

function selectTab(id) {
	tabs = document.getElementsByTagName('div');
	for(i=0;i<tabs.length;i++) {
		if(tabs[i].className=='selected-tab') tabs[i].className='tab';
	}
	document.getElementById(id+'Tab').className = 'selected-tab';
}
function selectSubTab(id) {
	tabs = document.getElementsByTagName('div');
	for(i=0;i<tabs.length;i++) {
		if(tabs[i].className=='selected-subTab') tabs[i].className='subTab';
	}
	document.getElementById(id+'SubTab').className = 'selected-subTab';
}

function goTo(to) {
  parent.location=_DOMAIN+to;
}

function characterSwitchTo(where) {
	    conteners = new Array('profile','reputation','skills','talents','achievements');
		for(i=0;i<conteners.length;i++) {
			document.getElementById(conteners[i]+'-contener').style.display = 'none';
			document.getElementById('switch_'+conteners[i]).className = 'smallframe-b';
		}

		document.getElementById(where+'-contener').style.display = 'block';
		document.getElementById('switch_'+where).className = 'smallframe-b-active';
}

function addProvider(url,adult) {
	if (adult == "true") {
		var confirmAdult = confirm("This search plugin points to a website which may contain adult content. By clicking 'OK' you confirm you are old enough and it is legal in your country of residence to view this type of content.")
		if (confirmAdult) {

		} else {
			return;
		}
	}
	try {
		window.external.AddSearchProvider(_DOMAIN+url);
	} catch (e) {
		alert("You need to be using IE7+ or Firefox2+ to add a search engine.\r\n");
		return;
	}
}
