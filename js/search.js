var page=0;
var lastpage=0;
var per_page=20;
var section;
var sort_by;
var sort_by_nr = new Array();
var sort_by_st = new Array();
var sort_asc=1;
var guildid = 0;
var ItemClass = -1;
var ItemSubClass = -1;


var list = new Array;
list['character'] = 0;
list['guild'] = 0;
list['arenateam'] = 0;
list['item'] = 0;

var characterFilter = new Array();
resetCharacterFilters();
var PagerBody = false;

var tooltipCache = new Array();

var RealmID = 0;

var dots=0;

function printPagerBody() {
	document.getElementById('pager').innerHTML = '<form id="pagingForm" onsubmit="return false;" style="margin: 0; padding: 0; display: inline;"><div id="searchTypeHolder"></div><div style="float: left; margin-left: 5px;">Page <input id="pagingInput" onKeyUp="jumpToPage(false)" type="text"> of <span id="totalPages"></span></div><div style="float: left; margin-left: 25px; line-height: 24px; height: 24px;">Showing <span class="bold" id="currResults"></span> of <span class="bold" id="totalResults"></span> results</div><div id="pageSelector" style="float: right"></div>Results Per Page<select id="pageSize" onChange="setPerPage(true)"<option value="10">10</option><option selected value="20">20</option><option value="30">30</option><option value="40">40</option></select></form>';
	PagerBody=true;
}


function wait() {
	try {
		PagerBody = false;
		document.getElementById('pager').innerHTML = '<div style="width:100%;text-align:left;font-size:14px;font-weight:bold;">Loading...</div>';
	}catch(e) {};
}
function wait_end() {
	try {
		PagerBody = false;
		document.getElementById('pager').innerHTML = '';
	}catch(e) {};
}

function preproces() {
	var table = document.getElementById('res_table');
	tds = table.getElementsByTagName('td');
	for(i=0;i<tds.length;i++) {
		txt = tds[i].innerHTML;
		try {
			sort_by_nr[txt.toLowerCase()] = i;
			sort_by_st[i] = txt;
		}catch(e) {};
	}
}

function selectSearchTab(searchTab) {
	tabs_cont = document.getElementById('tabs');
	tabss = document.getElementsByTagName('div');
	for(i=0;i<tabss.length;i++) {
		if(tabss[i].className=='selected-tab') {
			tabss[i].className = 'tab';
		}
		if(tabss[i].id==searchTab && tabss[i].className=='tab') {
			tabss[i].className='selected-tab';
		}
	}
	delRows('searchResultsTable');
	setSearchHeader(searchTab);

	section=(searchTab==1?'guild':(searchTab==2?'arenateam':searchTab==3?'item':'character'));
	page=0;
	view();
}

function createSearchHeader(tr,name1,name2,width) {
		th = document.createElement('TH');
		th.onclick = function () {set_sort(name2,this);}
		if(width) th.style.width = width+'px';
		th.innerHTML = '<a>'+name1+'<span class="sortArw"></span></a>';
		tr.appendChild(th);
}

function setSearchHeader(searchTab) {
	header = document.getElementById('replaceHeaderTitle');
	table = document.getElementById('searchTableHeader');
	delRows('searchTableHeader');
	tr = document.createElement('TR');
	tr.className = 'masthead';
	table.parentNode.parentNode.id = '';
	if(searchTab==1) {
		header.innerHTML = 'Guilds';
		createSearchHeader(tr,'Guild','name',0);
		createSearchHeader(tr,'Faction','faction',80);
		createSearchHeader(tr,'Leader','leader',150);
		createSearchHeader(tr,'Members','members',80);
		createSearchHeader(tr,'Realm','realm',100);
		header.parentNode.className='iguilds';
	}else if(searchTab==0) {
		header.innerHTML = 'Characters';
		createSearchHeader(tr,'Character Name','name',0);
		createSearchHeader(tr,'Level','level',80);
		createSearchHeader(tr,'Race','race',80);
		createSearchHeader(tr,'Class','class',80);
		createSearchHeader(tr,'Faction','alliance',80);
		createSearchHeader(tr,'Guild','guild',200);
		createSearchHeader(tr,'Realm','realm',150);
		header.parentNode.className='icharacters';
	}else if(searchTab==2) {
		header.innerHTML = 'Arena Teams';
		createSearchHeader(tr,'Team Name','name',0);
		createSearchHeader(tr,'Rating','rating',80);
		createSearchHeader(tr,'Team Type','type',80);
		createSearchHeader(tr,'Faction','faction',80);
		createSearchHeader(tr,'Realm','realm',100);
		header.parentNode.className='iarenateams';
	}else if(searchTab==3) {
		header.innerHTML = 'Items';
		header.parentNode.className='iitems';
		table.parentNode.parentNode.id = 'big-results';
		createSearchHeader(tr,'Item Name','name',0);
		createSearchHeader(tr,'Level','ItemLevel',150);
		createSearchHeader(tr,'Category','subcategory',150);
		createSearchHeader(tr,'Source','source',150);
	}else if(searchTab==5) {
		createSearchHeader(tr,'Character Name','name',0);
		createSearchHeader(tr,'Level','level',80);
		createSearchHeader(tr,'Race','race',80);
		createSearchHeader(tr,'Class','class',80);
		createSearchHeader(tr,'Faction','alliance',80);
		createSearchHeader(tr,'Guild Rank','rid',0);
		createSearchHeader(tr,'HK','hk',100);
	}
	table.appendChild(tr);
}


function view() {
	if(section=='character') view_char_list();else if(section=='guild')view_guild_list();else if(section=='arenateam')view_arenateam_list();else if(section=='item')view_item_list();
}

function enableNextButtons() {
	buttons = document.getElementById('pageSelector').childNodes;
	for(i=0;i<buttons.length;i++) {
		if(buttons[i].className=="lastPg lastPg-off") {buttons[i].className = "lastPg lastPg-on";buttons[i].onclick = last_page;}
		if(buttons[i].className=="nextPg nextPg-off") {buttons[i].className = "nextPg nextPg-on";buttons[i].onclick = next_page;}
	}
}
function enablePrevButtons() {
	buttons = document.getElementById('pageSelector').childNodes;
	for(i=0;i<buttons.length;i++) {
		if(buttons[i].className=="firstPg firstPg-off") {buttons[i].className = "firstPg firstPg-on";buttons[i].onclick = first_page;}
		if(buttons[i].className=="prevPg prevPg-off") {buttons[i].className = "prevPg prevPg-on";buttons[i].onclick = prev_page;}
	}
}

function disableNextButtons() {try{next = document.getElementById('next_button');next.className = "page_next_disabled csearch-page-button";next.onclick = null;}catch(e){};try{next = document.getElementById('fastnext_button');next.className = "page_fastnext_disabled csearch-page-button";next.onclick = null;}catch(e){};}

function disablePrevButtons() {try{prev = document.getElementById('prev_button');prev.className = "page_prev_disabled csearch-page-button";prev.onclick = null;}catch(e){};try{prev = document.getElementById('fastprev_button');prev.className = "page_fastprev_disabled csearch-page-button";prev.onclick = null;}catch(e){};}

JTP_time = 0;

function jumpToPage(pg) {
	clearTimeout(JTP_time);
	field = document.getElementById('pagingInput');
	value = field.value;

	if((value<1 && !isNaN(value)) && !pg) {
		JTP_time=setTimeout("jumpToPage(true)",2000);
		return;
	}else if(pg || isNaN(value)) {
		value = 1;
	}
	if(value>lastpage+1) value=lastpage+1;
	field.value = value;
	goToPage(value-1);
	document.getElementById('pagingInput').focus();
}

function setPerPage(fg) {
	sel = document.getElementById('pageSize');
	if(!sel) return;
	if(fg) {
		if(sel.value<=0) return;
		per_page = sel.value;
		page=0;
		view();
	}
	sel = document.getElementById('pageSize');
	sel = sel.getElementsByTagName('option');
	for(i=0;i<sel.length;i++) {
		if(per_page==sel[i].value) sel[i].selected = 1;
	}
}



function next_page() {page++;view();}
function prev_page() {page--;view();}
function last_page() {page=Number(lastpage);view();}
function first_page() {page=0;view();}
function goToPage(nr) {page=Number(nr);view();}

function sort_cmp(a,b) {
	if(sort_asc) {
		tmp=a;a=b;b=tmp;
	}
	v1 = a.getElementsByTagName(sort_by)[0].childNodes[0].nodeValue;
	v2 = b.getElementsByTagName(sort_by)[0].childNodes[0].nodeValue
	if(!isNaN(Number(v1))) {
		v1 = Number(v1);
		v2 = Number(v2);
	}
	if(v1>v2) return 1;
	else return -1;
}

function set_sort(sort_,th) {
	sort_by = sort_;sort_asc = (sort_asc+1)%2;
	ths = th.parentNode.childNodes;
	for(i=0;i<ths.length;i++) {
		ths[i].className='';
	}
	if(!sort_asc) th.className = 'headerSortUp';
	else th.className = 'headerSortDown';
	list[section].sort(sort_cmp);
	view();
}
function getNodeValue(field,nodeName) {
	if(!field.getElementsByTagName(nodeName)[0].childNodes[0]) return '';
	return field.getElementsByTagName(nodeName)[0].childNodes[0].nodeValue;
}


function checkCharacterFilters(field) {
	var ret = true;
	ret = ret && (characterFilter['name']!=-1?(getNodeValue(field,'name').toLowerCase().indexOf(characterFilter['name'].toLowerCase())!=-1):true);
	ret = ret && (characterFilter['lvldown']<=Number(getNodeValue(field,'level')));
	ret = ret && (characterFilter['lvlup']>=Number(getNodeValue(field,'level')));
	ret = ret && (characterFilter['class']!=-1?characterFilter['class']==getNodeValue(field,'class'):true);
	ret = ret && (characterFilter['race']!=-1?characterFilter['race']==getNodeValue(field,'race'):true);
	ret = ret && (characterFilter['gender']!=-1?characterFilter['gender']==getNodeValue(field,'gender'):true);
	ret = ret && (characterFilter['guild']!=-1?characterFilter['guild']==getNodeValue(field,'guild'):true);
	ret = ret && (characterFilter['guildrank']!=-1?(getNodeValue(field,'rname').toLowerCase().indexOf(characterFilter['guildrank'].toLowerCase())!=-1):true);
	return ret;
}

function setCharacterFilter(filter,value) {
	if(filter=='lvldown' && (isNaN(Number(value)) || Number(value)<1) ) value = 1;
	if(filter=='lvlup' && (isNaN(Number(value)) || Number(value)>80) ) value = 80;
	if(filter=='lvldown' || filter=='lvlup') value = Number(value);
	characterFilter[filter] = value;
	page=0; // Wracamy do pierwszej strony
	view();
}

function resetCharacterFilters() {
	characterFilter['name'] = -1;
	characterFilter['lvldown'] = 1;
	characterFilter['lvlup'] = 80;
	characterFilter['race'] = -1;
	characterFilter['gender'] = -1;
	characterFilter['class'] = -1;
	characterFilter['guild'] = -1;
	characterFilter['guildrank'] = -1;
    page=0;
	view();
}


function view_char_list() {
				delRows('searchResultsTable');
	 			if(typeof(list['character'])=='number') {
					ajax_search(searchQuery,guildid);
					return;
				}

				var chars=list['character'];
				var count = chars.length;
				var start=page*per_page;
				var end=(page+1)*per_page;
				j=0;

				for(i=0;i<chars.length;i++) {
				   if(!checkCharacterFilters(chars[i])) continue;
				   if(++j<=start || j>end) continue;
				   color='1';
				   tds = new Array();
				   classes = new Array();
				   id = chars[i].getElementsByTagName('guid')[0].childNodes[0].nodeValue;
				   tds[0] = '<a href="'+_DOMAIN+'character-sheet.php?name='+getNodeValue(chars[i],'name')+'&Realm='+getNodeValue(chars[i],'realm')+'">'+getNodeValue(chars[i],'name')+'</a>';

				   tds[1]=getNodeValue(chars[i],'level');

				   tds[2] = '<img class="staticTip" onMouseOver="setTipText(\''+getNodeValue(chars[i],'race_string')+'\')" src="'+_DOMAIN+'images/icons/race/'+
					   getNodeValue(chars[i],'race')+'-'+
					   getNodeValue(chars[i],'gender')+'.gif" alt="">';
				   tds[3] = '<img class="staticTip" onMouseOver="setTipText(\''+getNodeValue(chars[i],'class_string')+'\')" src="'+_DOMAIN+'images/icons/class/'+
					   getNodeValue(chars[i],'class')+'.gif" alt="">';
				   if(guildid>0) {
					   tds[5]=getNodeValue(chars[i],'rname');
					   if(getNodeValue(chars[i],'rid') == '0') color='3';
				   }else {
					   if(getNodeValue(chars[i],'guildid')>0) {
					   	tds[5]='<a href="'+_DOMAIN+'guild-info.php?name='+getNodeValue(chars[i],'guild')+'&Realm='+getNodeValue(chars[i],'realm')+'">'+getNodeValue(chars[i],'guild')+'</a>';
					   }else{
						   tds[5]=getNodeValue(chars[i],'guild');
					   }
				   }
				   tds[4]='<img src="'+_DOMAIN+'images/icons/'+getNodeValue(chars[i],'alliance')+'.png" alt="">';


				   if(guildid) {
					   tds[6]=getNodeValue(chars[i],'hk');
				   }else{
					   tds[6]=getNodeValue(chars[i],'realm');
				   }
				   classes[1] = classes[4] = 'centeralign';
				   classes[5] = classes[6] = '';
				   classes[2] = 'rightalign nopadding';
				   classes[3] = 'leftalign nopadding';

				   classes[sort_by_nr[sort_by]] = classes[sort_by_nr[sort_by]]+' csearch-results-table-item-ordered';
				   addRow(tds,'searchResultsTable',id,classes,'data'+color);

				}

				if(j==0) {
				   tds = new Array();
				   classes = new Array();
				   classes[0] = classes[1] = classes[2] = classes[3]= classes[4]= classes[5] = classes[6] = 'csearch-results-table-item';;
				   tds[1]=tds[2]=tds[3]=tds[4]=tds[5]=tds[6]='';
				   tds[0]='No Results';
				   addRow(tds,'searchResultsTable','no-results',classes);
				}
				count=j;
				bindToolTips();
				table_bottom(count);
}


function view_guild_list() {
				delRows('searchResultsTable');
	 			if(typeof(list['guild'])=='number') {
					ajax_search(searchQuery);
					return;
				}

				var guild=list['guild'];
				var count = list['guild'].length;
				if(guild.length==0) {
				   tds = new Array();
				   classes = new Array();
				   classes[0] = classes[1] = classes[2] = classes[3]= classes[4] = 'csearch-results-table-item';;
				   tds[1]=tds[2]=tds[3]=tds[4]='';
				   tds[0]='No results';
				   addRow(tds,'searchResultsTable','no-results',classes);
				}
				//if(overcount>0) overcount=0;
				for(var i=page*per_page;i<guild.length && i<(page+1)*per_page;i++) {
				   tds = new Array();
				   classes = new Array();
				   tds[1] = '<img src="'+_DOMAIN+'images/icons/'+guild[i].getElementsByTagName('faction')[0].childNodes[0].nodeValue+'.png" alt="">';

				   tds[0]='<a href="'+_DOMAIN+'guild-info.php?name='+getNodeValue(guild[i],'name')+'&Realm='+guild[i].getElementsByTagName('realm')[0].childNodes[0].nodeValue+'">'+guild[i].getElementsByTagName('name')[0].childNodes[0].nodeValue+'</a>';

				   tds[2] = '<a href="'+_DOMAIN+'character-sheet.php?name='+guild[i].getElementsByTagName('leader')[0].childNodes[0].nodeValue+'&Realm='+guild[i].getElementsByTagName('realm')[0].childNodes[0].nodeValue+'">'+guild[i].getElementsByTagName('leader')[0].childNodes[0].nodeValue+'</a>';
				   tds[3] = guild[i].getElementsByTagName('members')[0].childNodes[0].nodeValue;
				   tds[4]=guild[i].getElementsByTagName('realm')[0].childNodes[0].nodeValue;
				   id = guild[i].getElementsByTagName('id')[0].childNodes[0].nodeValue;
				   classes[0] = classes[4] = classes[2] = '';
				   classes[1] = 'centeralign';
				   classes[3] = 'centeralign';

				   classes[sort_by_nr[sort_by]] = classes[sort_by_nr[sort_by]]+' csearch-results-table-item-ordered';
				   addRow(tds,'searchResultsTable',id,classes,'csearch-results-table-item');
				}
				bindToolTips();
				table_bottom(count);
}
function view_arenateam_list() {
				delRows('searchResultsTable');
	 			if(typeof(list['arenateam'])=='number') {
					ajax_search(searchQuery);
					return;
				}

				var arenateam=list['arenateam'];
				var count = list['arenateam'].length;
				if(arenateam.length==0) {
				   tds = new Array();
				   classes = new Array();
				   classes[0] = classes[1] = classes[2] = classes[3]= classes[4] = 'csearch-results-table-item';;
				   tds[1]=tds[2]=tds[3]=tds[4]='';
				   tds[0]='No results';
				   addRow(tds,'searchResultsTable','no-results',classes);
				}
				//if(overcount>0) overcount=0;
				for(var i=page*per_page;i<arenateam.length && i<(page+1)*per_page;i++) {
				   tds = new Array();
				   classes = new Array();
				   tds[1] = arenateam[i].getElementsByTagName('rating')[0].childNodes[0].nodeValue;

				   tds[0]='<a href="'+_DOMAIN+'team-info.php?name='+arenateam[i].getElementsByTagName('name')[0].childNodes[0].nodeValue+'&Realm='+arenateam[i].getElementsByTagName('realm')[0].childNodes[0].nodeValue+'&type='+getNodeValue(arenateam[i],'type')+'">'+arenateam[i].getElementsByTagName('name')[0].childNodes[0].nodeValue+'</a>';

				   tds[2] = arenateam[i].getElementsByTagName('type')[0].childNodes[0].nodeValue+'v'+arenateam[i].getElementsByTagName('type')[0].childNodes[0].nodeValue;
				   tds[3] = '<img src="'+_DOMAIN+'images/icons/'+arenateam[i].getElementsByTagName('faction')[0].childNodes[0].nodeValue+'.png" alt="">';
				   tds[4]=arenateam[i].getElementsByTagName('realm')[0].childNodes[0].nodeValue;
				   id = arenateam[i].getElementsByTagName('id')[0].childNodes[0].nodeValue;
				   classes[0] = classes[4] = classes[2] = '';
				   classes[1] = 'centeralign';
				   classes[3] = 'centeralign';

				   classes[sort_by_nr[sort_by]] = classes[sort_by_nr[sort_by]]+' csearch-results-table-item-ordered';
				   addRow(tds,'searchResultsTable',id,classes,'csearch-results-table-item');
				}
				bindToolTips();
				table_bottom(count);
}
function view_item_list() {
				delRows('searchResultsTable');
	 			if(typeof(list['item'])=='number') {
					ajax_search(searchQuery);
					return;
				}

				var item=list['item'];
				var count = list['item'].length;
				if(item.length==0) {
				   tds = new Array();
				   classes = new Array();
				   classes[0] = classes[1] = classes[2] = classes[3]='csearch-results-table-item';;
				   tds[1]=tds[2]=tds[3]='';
				   tds[0]='No results';
				   addRow(tds,'searchResultsTable','no-results',classes);
				}
				for(var i=page*per_page;i<item.length && i<(page+1)*per_page;i++) {
				   tds = new Array();
				   classes = new Array();
				   tds[1] = getNodeValue(item[i],'ItemLevel');
				   if(getNodeValue(item[i],'RequiredLevel')>0)
				   	    tds[1] += '<br><span class="subClass">Req. '+getNodeValue(item[i],'RequiredLevel')+'</span>';
                   tip = getNodeValue(item[i],'tooltip');
                   tip = tip.replace(/\\\'/g,'\'');
                   tip = tip.replace(/\\\"/g,'"');
                   tip = tip.replace(/&#60;/g,'<');
                   tip = tip.replace(/&#62;/g,'>');
           
           tooltipCache[getNodeValue(item[i],'entry')] = tip;
				   tds[0]='<a class="rarity'+getNodeValue(item[i],'Quality')+' staticTip" onMouseOver="setTipText(tooltipCache['+getNodeValue(item[i],'entry')+'])" href="'+_DOMAIN+'item-info.php?i='+getNodeValue(item[i],'entry')+'"><img height="48" alt="" border="0" align="middle" src="images/icon48/'+getNodeValue(item[i],'icon').replace(' ','')+'.png"> '
				   +getNodeValue(item[i],'name')+
				   '</a>';

				   tds[2] = '<strong>'+getNodeValue(item[i],'category')+'</strong><br><span class="subClass">'+getNodeValue(item[i],'subcategory')+'</span>';
				   tds[3] = '<strong>'+getNodeValue(item[i],'source')+'</strong>';
				   classes[0] = 'leftalign';
				   classes[1] = classes[2] = classes[3] = 'centeralign';

				   classes[sort_by_nr[sort_by]] = classes[sort_by_nr[sort_by]]+' csearch-results-table-item-ordered';
				   addRow(tds,'searchResultsTable',0,classes,'csearch-results-table-item');
				}
				bindToolTips();
				table_bottom(count);
}

var timer = 0;
var AJAX = false;
function ajax_control() {
	if(AJAX.readyState == 4) return;
	timer++;
	setTimeout("ajax_control()",1000);
	if(timer>20 && section=='item') {
		document.getElementById('pager').innerHTML = 'Script not responding. It\'s probably trying to update some item icons, so please be patient, this may take several minutes :)';
	}

}


function ajax_search(name,guild)  {
	timer=0;
	if(AJAX = getAjaxObject()) {
	   	AJAX.abort();
		var _GET = '?name='+name+'&sort_asc='+sort_asc+'&sort_by='+sort_by+'&guildid='+guild+'&ItemClass='+ItemClass+'&ItemSubClass='+ItemSubClass;
	    AJAX.open('GET', _DOMAIN+'ajax/search_'+section+'.php'+_GET, true);
        wait();
		AJAX.onreadystatechange=function() {
			if((AJAX.readyState == 4) && (AJAX.status == 200) ) {
				tmp=AJAX.responseXML;
				try {
					s_count = tmp.getElementsByTagName('count')[0].childNodes[0].nodeValue;
				}catch(e) {

				}
				if(typeof(s_count) == "undefined") {
					ajax_search(name,guild);
					return;
				}
				tmp=tmp.getElementsByTagName(section);
				list[section] = new Array;
				for(i=0;i<tmp.length;i++) {
					list[section][i] = tmp[i];
				}
				view();
			}else if((AJAX.readyState == 4) &&  AJAX.status > 400) {
			   error();
			}
		}
		AJAX.send(null);
		ajax_control();
	}
	return 0;
}


function table_bottom(count,type) {
				if(!PagerBody) printPagerBody();
				tds = new Array();
				per_pages = new Array(5,10,20,40);
				pages = parseInt(count/per_page);

				if(count%per_page>0) pages++;
				if(pages==0) pages=1;
				lastpage=pages-1;
				pp='';
				for(i=0;i<per_pages.length;i++) {
					pp+='<option value="'+per_pages[i]+'" '+(per_pages[i]==per_page?'selected':'')+'>'+per_pages[i]+'</option>';
				}
				document.getElementById('pagingInput').value = Number(Number(page)+1);
				document.getElementById('totalPages').innerHTML = pages;
				document.getElementById('currResults').innerHTML = count;
				document.getElementById('totalResults').innerHTML = s_count;
				pageSelector_ = document.getElementById('pageSelector');
				pageSelector_.innerHTML ='';
				pageSelector_.innerHTML += '<a class="firstPg firstPg-off" href="javascript:void(0)"></a><a class="prevPg prevPg-off" href="javascript:void(0)"></a>';
				k=page-2<0?0:page-2-(page-lastpage+1<0?0:page-lastpage+1);
				for(k=k<0?0:k;k<pages && k<Number(page)+2- (page-2<0?page-2:0);k++) {
					pageSelector_.innerHTML += '<a class="'+(k==page?'sel':'p')+'" href="javascript:void(0)" onclick="goToPage(\''+k+'\')">'+Number(k+1)+'</a>';
				}
				pageSelector_.innerHTML +='<a class="nextPg nextPg-off" href="javascript:void(0)"></a><a class="lastPg lastPg-off" href="javascript:void(0)"></a>';
				if(count>(page+1)*per_page) enableNextButtons();
				if(page>0) enablePrevButtons();
}

function error() {
	document.getElementById('loading-box').innerHTML = 'ERROR';
	document.getElementById('pager').innerHTML = 'ERROR. Please <a href="javascript:openReport();">report this bug</a>';
}