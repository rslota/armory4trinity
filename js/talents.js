// JavaScript Document
var talentConf = null;

var talentDescription = new Array();
var talentName = new Array();
var talentID = new Array();
var talentHID = new Array();

function talentLoad() {
	pointer = 0;
	talentConf = talentConf.split('');
	divs = document.getElementsByTagName('div');
	coss=false;
	for(i=0; i<divs.length; i++) {
		if(divs[i].className == 'iconmedium') {
			
			div = divs[i].getElementsByTagName('div');
			count = div[1];
			border = div[0];
			a = divs[i].getElementsByTagName('a');
			a = a[0];
			
			href = a.href.split('/?spell=');
			a.href = "javascript:void(0)";
			if(talentID[href[1]] == undefined) a.id = talentHID[href[1]];
			else a.id = talentID[href[1]];
			a.rank = talentConf[pointer];
			a.target = '';
			a.className = 'staticTip';
			a.onmouseover = function() {
				if(talentName[this.id] == undefined) talentName[this.id] = 'Unknown :(';
			    if(talentDescription[this.id] == undefined) talentDescription[this.id] = '';
				setTipText('<span class="tooltip-header">'+talentName[this.id]+' (Rank '+this.rank+')</span><br><span class="description">'+talentDescription[this.id]+'</span>');
			};
			ins = divs[i].getElementsByTagName('ins');
			ins=ins[0];
			count.innerHTML = talentConf[pointer];
			if(Number(talentConf[pointer])>0) {
			    
			   count.style.visibility = 'visible';
			   pos = ins.style.backgroundPosition.split(" ");
			   ins.style.backgroundPosition = pos[0]+' 0px';
			   border.style.backgroundPosition = '-84px 0pt';
			}
			
			pointer++;
		}
			
	}
}