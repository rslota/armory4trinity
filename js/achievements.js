var achievements_data = new Array();
var statistics_data = new Array();

function selectCat(cat,stats) {
	try{
		table = document.getElementById('a_category');
	}catch(e) {return;}
	if(!table) return;
	divs=table.getElementsByTagName('div');
	for(i=0;i<divs.length;i++) {
		if(divs[i].className=='a_bodycat_sel')divs[i].className = 'a_bodycat';
	}
	a=table.getElementsByTagName('a');
	for(i=0;i<a.length;i++) {
		if(a[i].className=='sel') a[i].className = 'sub';
	}
	item2 = document.getElementById('ach_'+cat);
	item2.parentNode.className = 'a_bodycat_sel';
	if(item2.className == 'sub') item2.className = 'sel';
	try {
		if(!stats) achievement_load_data(cat);
		else statistics_load_data(cat);
	}catch(e) {};
	return false;
}

function AchReq(req,div) {
	table = document.getElementById('a_data');
	divs=table.getElementsByTagName('div');

	for(i=0;i<divs.length;i++) {
		if(divs[i].className=='ach_show-sel') divs[i].className='ach_show';
		else if(divs[i].className=='ach_show' && divs[i]==div) divs[i].className='ach_show-sel';
		if(divs[i].className=='ach_cshow-sel') divs[i].className='ach_cshow';
		else if(divs[i].className=='ach_cshow' && divs[i]==div) divs[i].className='ach_cshow-sel';
		if(divs[i].className=='ach_req' && divs[i].id!='ach_req_'+req) divs[i].style.display = 'none';
	}
	achi = document.getElementById('ach_req_'+req);
	//alert(achi.style.display);
	if(achi.style.display=='block') achi.style.display='none';
	else achi.style.display='block';
}
function achievement_load_data(cat) {
	data_table = document.getElementById('a_data');
	data_table.innerHTML = 'Loading...';


	if(!achievements_data[cat]) {
		if(AJAX=getAjaxObject()) {
			AJAX.abort();
			var _GET = '?cat='+cat+'&guid='+GUID;
			AJAX.open('GET', _DOMAIN+'ajax/achievements.php'+_GET, true);
			AJAX.onreadystatechange=function() {
				if((AJAX.readyState == 4) && (AJAX.status == 200) ) {
					wait_end();
					data_table.innerHTML=achievements_data[cat]=AJAX.responseText;

				}else if( (AJAX.readyState == 4) && AJAX.status > 400) {
				   error();
				}
			}
			wait();
			AJAX.send(null);
		}else{
			data_table.innerHTML = 'Error: Cannot initialize ajax obejct :(';
		}
	}else data_table.innerHTML = achievements_data[cat];
}
function statistics_load_data(cat) {
	data_table = document.getElementById('a_data');
	data_table.innerHTML = 'Loading...';


	if(!statistics_data[cat]) {
		if(AJAX=getAjaxObject()) {
			AJAX.abort();
			var _GET = '?cat='+cat+'&guid='+GUID;
			AJAX.open('GET', _DOMAIN+'ajax/statistics.php'+_GET, true);
			AJAX.onreadystatechange=function() {
				if((AJAX.readyState == 4) && (AJAX.status == 200) ) {
					wait_end();
					data_table.innerHTML=statistics_data[cat]=AJAX.responseText;

				}else if( (AJAX.readyState == 4) && AJAX.status > 400) {
				   error();
				}
			}
			wait();
			AJAX.send(null);
		}else{
			data_table.innerHTML = 'Error: Cannot initialize ajax obejct :(';
		}
	}else data_table.innerHTML = statistics_data[cat];
}