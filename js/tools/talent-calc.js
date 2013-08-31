
// * waves at people looking at source code *

var talentVars = new Object();
var talentCache = [];
var treeCache = [];
var whichClass = 0;
var WHICH_KEY = 0;
var talentString = 0;
var lock = false;

var ICON_PREFIX = "images/icon43/";
var ICON_PREFIX_GREY = "images/icon43_gray/";
var pageMode = "";

function initTalentCalc(WhichClass, talStr, talStrSingle, talStrPlural, rank, nextRank, reqTreeTalents, PageMode, TBCLower){

	pageMode = PageMode;
	whichClass = WhichClass;
	talentString = talStr;
	if(lock) {
    	document.getElementById('reloadButton').parentNode.parentNode.href = _DOMAIN+'talent-calc.php?cid='+whichClass+'&tal='+talentString;
    }
	//disable context menu so we can right-click to subtract
	document.body.oncontextmenu = handler;

	//store which key we pressed so users can hold down ctrl to subtract
	$(document).keydown(function(e){ WHICH_KEY = e.which; }).keyup(function(){ WHICH_KEY = 0; });

	talentVars = {
		pts: 0,
		maxPts: 71-TBCLower,
		maxTiers: 11,
		pointsLeft: $("#pointsLeft"),
		pointsSpent: $("#pointsSpent"),
		reqLevel: $("#requiredLevel"),
		talHolder: $("#talContainer"),
		talentPtsStr: $("#linkToBuild"),
		reqSingle: talStrSingle,
		reqPlural: talStrPlural,
		rank: rank,
		nextRank: nextRank,
		reqTreeTalents: reqTreeTalents
	}

	updatePointsLeftDisplay(talStr);

	//store vars
	$("#talContainer .talentTree").each(function(){

		var currTree = this.id;

		treeCache[currTree] = { name: $("#treeName_"+currTree)[0].innerHTML,  pts: 0, maxPts: 0, ctr: $("#treespent_" + currTree), tierVals: [0,0,0,0,0,0,0,0,0,0,0,0]  }

		//cache talents and relevant elements
		$("#" + currTree + " .talentHolder").each(function(){
			talentCache[this.id] = { pts: 0, ele: this, ctr: $("#count_" + this.id), tier: stripClass($(this).attr("class"),"tier")*1,  spellInfo: null,
				tree: currTree, reqArrows: [], name: $("#" + this.id + "_name")[0].innerHTML, icon: $("#" + this.id + "_icon")[0].innerHTML,
				iconEle: $("#" + this.id + "_iconHolder") }
			talentCache[this.id].dependent = ($(this).hasClass("requires")); //store if this talent requires another one
			talentCache[this.id].reqSpell = (talentCache[this.id].dependent) ? stripClass($(this).attr("class"),"t_") : null;
			talentCache[this.id].maxPts = $("#total_" + this.id)[0].innerHTML*1;

			if($("#spellInfo_" + this.id)){ talentCache[this.id].spellInfo = $("#spellInfo_" + this.id).html();  }

			treeCache[currTree].maxPts += talentCache[this.id].maxPts;
		});
	});

	drawRequiredArrows();
	applyTalents(talStr);
}


//draw required arrows
function drawRequiredArrows(){

	var parentOffset = $(talentVars.talHolder).offset();

	var arrowClass = "";

	for(var tal in talentCache){

		if((talentCache[tal].dependent == true) && (talentCache[talentCache[tal].reqSpell] != null)){

			var requiredSpellOffset = $(talentCache[talentCache[tal].reqSpell].ele).offset();
			var currSpellOffset = $(talentCache[tal].ele).offset();

			var reqArw = { top: 0, left: 0, height: 0, width: 0};

			//vertical
			if(currSpellOffset.left == requiredSpellOffset.left){
				reqArw.top = (requiredSpellOffset.top + 47) - parentOffset.top;
				reqArw.left = requiredSpellOffset.left - parentOffset.left + 14;
				reqArw.height = currSpellOffset.top - requiredSpellOffset.top - 42;
				reqArw.width = 21;

				talentCache[tal].reqArrows.push(makeReqArrow(reqArw.top, reqArw.left, reqArw.height, reqArw.width, talentVars.talHolder, "vArrow disabledArrow"));

			}else if(currSpellOffset.top == requiredSpellOffset.top){
				//horizontal line
				if(currSpellOffset.left > requiredSpellOffset.left){
					//points right
					reqArw.top = (requiredSpellOffset.top + 15) - parentOffset.top;
					reqArw.left = currSpellOffset.left - 13 - parentOffset.left;
					reqArw.height = 21;
					reqArw.width = currSpellOffset.left - requiredSpellOffset.left - 42;
					arrowClass = "hArrow arrowRight disabledArrow";
				}else{
					//points left
					reqArw.top = (requiredSpellOffset.top + 15) - parentOffset.top;
					reqArw.left = requiredSpellOffset.left - 17 - parentOffset.left;
					reqArw.height = 21;
					reqArw.width = requiredSpellOffset.left - currSpellOffset.left - 42;
					arrowClass = "hArrow arrowLeft disabledArrow";
				}

				talentCache[tal].reqArrows.push(makeReqArrow(reqArw.top, reqArw.left, reqArw.height, reqArw.width, talentVars.talHolder, arrowClass));
			}else{
				//(make angle)
				//vertical line needs to go on bottom in dom for arrow bracket
				reqArw.top = (requiredSpellOffset.top + 24) - parentOffset.top;
				reqArw.left = currSpellOffset.left + 12 - parentOffset.left;
				reqArw.height = currSpellOffset.top - requiredSpellOffset.top - 20;
				reqArw.width = 21;

				talentCache[tal].reqArrows.push(makeReqArrow(reqArw.top, reqArw.left, reqArw.height, reqArw.width, talentVars.talHolder, "vArrow disabledArrow"));

				reqArw.top = reqArw.top - 8;

				//horizontal line
				if(currSpellOffset.left > requiredSpellOffset.left){
					//points right
					reqArw.left = currSpellOffset.left - 15 - parentOffset.left;
					reqArw.height = 21;
					reqArw.width = currSpellOffset.left - requiredSpellOffset.left - 19;
					arrowClass = "hArrow arrowRight plain disabledArrow";
				}else{
					//points left
					reqArw.left = requiredSpellOffset.left - 16 - parentOffset.left - 26;
					reqArw.height = 21;
					reqArw.width = requiredSpellOffset.left - currSpellOffset.left -18;
					arrowClass = "hArrow arrowLeft plain disabledArrowL";
				}

				//make horizontal line
				talentCache[tal].reqArrows.push(makeReqArrow(reqArw.top, reqArw.left, reqArw.height, reqArw.width, talentVars.talHolder, arrowClass));
			}
		}
	}
}


function makeReqArrow(top, left, height, width, parentDiv, arrowClass){
	//add to parent, and return the element so that it can be stored for later use
	return $("<div class='requiredArrow " + arrowClass + "' style='top: " + top +"px; left: "+ left +"px;  height:"+height+"px; width: " + width + "px;'></div>").appendTo(parentDiv);
}

//when a talent is clicked on
function addTalent(e, id, talName){

	if(pageMode != "calc" || lock){ return; }

	//store the tree id of the talent we clicked on
	var talTree = talentCache[id].tree;

	//subtract
	if((e.which == 3 || e.button == 2) || ((e.which == 1) && (WHICH_KEY == 17))){
		if(talentCache[id].pts != 0){

			//figure out if we can subtract or not
			var canSubtract = true;
			var tierTotal = 0;

			//decrement and test
			treeCache[talTree].tierVals[talentCache[id].tier]--;

			//go through tiers and add up pts
			for(var p=1; p <= talentVars.maxTiers; p++){

				tierTotal += treeCache[talTree].tierVals[p-1];

				//ignore tiers with no points in them
				if(treeCache[talTree].tierVals[p] != 0){
					if(tierTotal < ((p-1)*5)){
						canSubtract = false;
					}
				}
			}

			//make sure the talent we're clicking on is not needed by other talents
			if(canSubtract){
				for(var tal in talentCache){
					if(talentCache[tal].reqSpell == id){
						if(talentCache[tal].pts > 0){
							canSubtract = false; //if a dependent talent has pts in it, we can't subtract
						}
					}
				}
			}

			if(canSubtract){
				talentCache[id].pts--; //decrement
				talentVars.pts--;
				treeCache[talentCache[id].tree].pts--;
				$(talentCache[id].ele).removeClass("talentMax"); //no longer maxed if we're subtracting

				//if we're coming from being at max points, check all the trees
				if((talentVars.pts+1) >= talentVars.maxPts){
					checkAllTrees();
				}

			}else{
				treeCache[talTree].tierVals[talentCache[id].tier]++;
			}
		}else{
			return;
		}
	}else if(e.which == 1 || e.button == 1){
		//means talent isnt maxed out
		if((talentCache[id].pts != talentCache[id].maxPts) && (talentVars.pts < talentVars.maxPts)){
			//prevent from adding points above where is allowed
			if((treeCache[talTree].pts >= ((talentCache[id].tier-1)*5)) && (checkDependentTalent(talentCache[id]))){
				talentCache[id].pts++; //increment
				talentVars.pts++;
				treeCache[talTree].pts++;
				treeCache[talTree].tierVals[talentCache[id].tier]++;

				if(talentCache[id].pts == talentCache[id].maxPts){
					$(talentCache[id].ele).addClass("talentMax"); //show orange style
				}
			}else{
				return;
			}
		}else{
			return;
		}
	}

	$(talentCache[id].ctr)[0].innerHTML = talentCache[id].pts; //update counter display
	$(treeCache[talTree].ctr)[0].innerHTML = treeCache[talTree].pts;

	makeTalentTooltip(id, talName);

	checkEnabled(talTree);
}


//checks if the dependent talent has points in it
function checkDependentTalent(talent){
	if(talent.dependent == true){
		if(talentCache[talent.reqSpell].pts == talentCache[talent.reqSpell].maxPts){
			return true;
		}else{
			return false;
		}
	}else{
		return true;
	}
}


function checkAllTrees(){

	calcTreePts();

	if(pageMode != "calc"){ return; }

	if(talentVars.pts >= talentVars.maxPts){
		return;
	}

	for(var tree in treeCache){
		for(var j=1; j <= talentVars.maxTiers; j++){
			if(j == 1){ enableTier(1, tree) } //tier1 can get disabled if the points get maxed out

			if(treeCache[tree].pts < (j*5)){ 	disableTier(j+1, tree) }
			else { 								enableTier(j+1, tree)  }
			if(lock) disableTier(j, tree);
		}
	}

}

function checkEnabled(tree){

	calcTreePts();

	for(var j=1; j <= talentVars.maxTiers; j++){
		if(j == 1){ enableTier(1, tree) } //tier1 can get disabled if the points get maxed out

		if(treeCache[tree].pts < (j*5)){ 	disableTier(j+1, tree) }
		else { 								enableTier(j+1, tree)  }

	}
}

//make the talent tooltip string
function makeTalentTooltip(key){

	//fail-safe incase something bugged out
	try{
		//get pts info
		var currRankNum = talentCache[key].pts;
		var maxRankNum = talentCache[key].maxPts;

		if(currRankNum>maxRankNum) currRankNum = maxRankNum;

		//make string
		var talentTipStr = "<b>"+talentCache[key].name+"</b><br />"; //talent name
		talentTipStr += talentVars.rank.split("{0}").join(talentCache[key].pts).split("{1}").join(maxRankNum) + "<br />"; //rank

		if(talentCache[key].spellInfo){
			talentTipStr += talentCache[key].spellInfo + "<br />";
		}

		//show if the talent has a required talent
		if(talentCache[key].dependent){

			if(talentCache[talentCache[key].reqSpell].maxPts == 1){
				talentTipStr += talentVars.reqSingle.split("{0}").join(talentCache[talentCache[key].reqSpell].maxPts).split("{1}").join(talentCache[talentCache[key].reqSpell].name);
			}else{
				talentTipStr += talentVars.reqPlural.split("{0}").join(talentCache[talentCache[key].reqSpell].maxPts).split("{1}").join(talentCache[talentCache[key].reqSpell].name);
			}
			talentTipStr += "<br />";
		}

		//show how many points is required in the tree
		if((talentCache[key].tier > 1) && (((talentCache[key].tier-1)*5) < treeCache[talentCache[key].tree].tierVals[talentCache[key].tier])){
			talentTipStr += talentVars.reqTreeTalents.split("{0}").join((talentCache[key].tier-1)*5).split("{1}").join(treeCache[talentCache[key].tree].name) + "<br />";
		}



		if(currRankNum != 0){
			talentTipStr += "<span style='color: #ffd200'>" + $("#rank" + (currRankNum) + "_" + key).html() + "</span>";
		}

		if((currRankNum + 1) <= maxRankNum){
			if((maxRankNum > 1) && (currRankNum > 0)){
				talentTipStr += "<br /><br />" + talentVars.nextRank + ":<br />";
			}
			talentTipStr += "<span style='color: #ffd200'>" + $("#rank" + (currRankNum+1) + "_" + key).html() + "</span>";
		}

		talentTipStr = talentTipStr.replace(/\&lt;/g,"<");
		talentTipStr = talentTipStr.replace(/\&gt;/g,">");


		if($.browser.msie && $.browser.version == "6.0"){
			talentTipStr = 	"<div style='width: 300px'>" + talentTipStr + "</div>";
		}

		setTipText(talentTipStr);

	}catch(e){}
}


function enableTier(tierNum, parentTree){


	if(talentVars.pts >= talentVars.maxPts){
		return;
	}

	for(var tal in talentCache){
		if((talentCache[tal].tree == parentTree) && (talentCache[tal].tier == tierNum)){

			//dependent talents have special cases
			if(talentCache[tal].dependent){

				var reqSpell = talentCache[tal].reqSpell;

				if(talentCache[reqSpell].pts == talentCache[reqSpell].maxPts){
					if($(talentCache[tal].ele).hasClass("disabled")){
						enableTalent(talentCache[tal]);
					}
					enableArrows(talentCache[tal]); //show avail arrow style
				}else{
					disableTalent(talentCache[tal]);
					disableArrows(talentCache[tal]);
				}
			}else{
				if($(talentCache[tal].ele).hasClass("disabled")){
					enableTalent(talentCache[tal]);
				}
			}
		}
	}
}

function disableTier(tierNum, parentTree){

	for(var tal in talentCache){
		if((talentCache[tal].tree == parentTree) && (talentCache[tal].tier == tierNum)){

			if(!$(talentCache[tal].ele).hasClass("disabled")){
				disableTalent(talentCache[tal]);
			}

			if($(talentCache[tal].ele).hasClass("requires")){
				disableArrows(talentCache[tal]);
			}
		}
	}
}

function disableArrows(whichTalent){
	for(var x=0; x < whichTalent.reqArrows.length; x++){
		if($(whichTalent.reqArrows[x]).hasClass("arrowLeft")){
			$(whichTalent.reqArrows[x]).addClass("disabledArrowL");
		}else{
			$(whichTalent.reqArrows[x]).addClass("disabledArrow");
		}
	}
}

function enableArrows(whichTalent){
	for(var x=0; x < whichTalent.reqArrows.length; x++){
		$(whichTalent.reqArrows[x]).removeClass("disabledArrow");
		$(whichTalent.reqArrows[x]).removeClass("disabledArrowL");
	}
}

function disableTalent(talent){
	$(talent.ele).addClass("disabled");
	$(talent.iconEle).attr("style", "background-image: url('" + ICON_PREFIX_GREY + talent.icon + ".gif')");
}

function enableTalent(talent){
	$(talent.ele).removeClass("disabled")
	$(talent.iconEle).attr("style", "background-image: url('" + ICON_PREFIX + talent.icon + ".gif')");
}

//parses the talent string to show what the talents are
function applyTalents(talentNums){

	//dont do anything if the string is blank
	if(talentNums == null){
		checkAllTrees();
		return false;
	}

    if(lock) {
    	document.getElementById('reloadButton').parentNode.parentNode.href = _DOMAIN+'talent-calc.php?cid='+whichClass+'&tal='+talentString;
    }

	resetAllTalents(); //reset all the talents first
    if(lock) checkAllTrees();
	var talentNumArr = []; //break numbers into an array

	//break up string into array
	if(talentNums == ""){
		//make empty array
		for(var x=0; x < 400; x++){
			talentNumArr[x] = "0";
		}
	}else{
		for(var x=0; x < talentNums.length; x++){
			talentNumArr[x] = talentNums.substr(x,1);
		}
	}

	var ctr = 0;

	for(var tal in talentCache){
		if(talentNumArr[ctr]){
			talentCache[tal].pts = talentNumArr[ctr]*1;
			if(talentCache[tal].pts>talentCache[tal].maxPts) {
				//talentCache[tal].pts = talentCache[tal].maxPts;
			}

			$(talentCache[tal].ctr)[0].innerHTML = talentCache[tal].pts;
   // FIXED $(talentCache[tal].ctr)[0].innerHTML = (talentCache[tal].pts>talentCache[tal].maxPts?talentCache[tal].maxPts:talentCache[tal].pts);
			if(talentCache[tal].pts > 0){

				$(talentCache[tal].iconEle).attr("style", "background-image: url('" + ICON_PREFIX + talentCache[tal].icon + ".gif')");
				if(pageMode != "calc"){
					$(talentCache[tal].ele).addClass("talentMax");
				}
			}else{
				if(pageMode != "calc"){
					$(talentCache[tal].ele).addClass("disabled");
					$(talentCache[tal].iconEle).attr("style", "background-image: url('" + ICON_PREFIX_GREY + talentCache[tal].icon + ".gif')");
				}
			}

			if(talentCache[tal].pts >= talentCache[tal].maxPts){
				$(talentCache[tal].ele).addClass("talentMax");
			}
		}else{
			talentCache[tal].pts = 0;
			$(talentCache[tal].ctr)[0].innerHTML = 0;
		}
		ctr++;
	}

	if(!lock) checkAllTrees();
	calcTreePts();
}

//util function to return a stripped class value
function stripClass(classStr, prefix){
	var strippedVal = classStr.substr(classStr.indexOf(prefix) + prefix.length);
	if(strippedVal.indexOf(" ") != -1){
		strippedVal = strippedVal.substr(0,strippedVal.indexOf(" "));
	}
	return strippedVal;
}


function resetAllTalents(){

	for(var t in treeCache){
		if(treeCache[t].pts != null)
			resetTalents(t, false);
	}
	calcTreePts();
}

//set talent points back to zero
function resetTalents(tree, check){

	for(var tal in talentCache){
		if(talentCache[tal].tree == tree){
			talentCache[tal].pts = 0;
 			$(talentCache[tal].ctr)[0].innerHTML = 0;
			$(talentCache[tal].ele).removeClass("talentMax");

			if(!$(talentCache[tal].ele).hasClass("tier1")){
				disableTalent(talentCache[tal]);
			}else{
				$(talentCache[tal].iconEle).attr("style", "background-image: url('" + ICON_PREFIX + talentCache[tal].icon + ".gif')");
			}

			if(talentCache[tal].dependent){
				disableArrows(talentCache[tal]);
			}
		}
	}
	//we don't want to calc tree pts if we're resetting all the talents
	if(check){ checkAllTrees(); }
}
//adds up the points in the tree and its tiers
function calcTreePts(){

	talentVars.pts = 0;

	var talentPtsStr = "";

	for(var tree in treeCache){
		if(treeCache[tree].pts != null){
			treeCache[tree].pts = 0;
			treeCache[tree].tierVals = [0,0,0,0,0,0,0,0,0,0,0,0]; //yes it needs 12 values even though there are 11 tiers
			for(var tal in talentCache){
				if(talentCache[tal].tree == tree){
					talentPtsStr += talentCache[tal].pts;
					treeCache[tree].pts += talentCache[tal].pts;
					treeCache[tree].tierVals[talentCache[tal].tier] += talentCache[tal].pts;
				}
			}
			talentVars.pts += treeCache[tree].pts;
			$(treeCache[tree].ctr)[0].innerHTML = treeCache[tree].pts;
		}
	}

	if(talentVars.pts >= talentVars.maxPts){
		for(var tal in talentCache){
			if(!$(talentCache[tal].ele).hasClass("talentMax")){
				if(talentCache[tal].pts == 0){
					disableTalent(talentCache[tal]);
				}

				if((talentCache[tal].dependent) && (talentCache[tal].pts == 0)){
					disableArrows(talentCache[tal])
				}
			}
		}
	}

	updatePointsLeftDisplay(talentPtsStr);
}

//updates ui to show what points are left, etc
function updatePointsLeftDisplay(talentPtsStr){

	$(talentVars.pointsSpent)[0].innerHTML = talentVars.pts;
	$(talentVars.pointsLeft)[0].innerHTML = talentVars.maxPts - talentVars.pts;
	$(talentVars.reqLevel)[0].innerHTML = (talentVars.pts == 0) ? 10 : talentVars.pts + 9;

	$(talentVars.talentPtsStr).attr("href","talent-calc.php?cid=" + whichClass + "&tal=" + talentPtsStr);
}


//locks talents
function lockTalents(){
	lock = true;
	document.getElementById('calcInfo').style.display = 'none';
	document.getElementById('reloadButton').innerHTML = 'Export build';
	//document.getElementById('reloadButton').className = 'awesomeButton awesomeButton-exportBuild';

	document.getElementById('reloadButton').parentNode.parentNode.href = 'javascript:void(0)';
    divs = document.getElementsByTagName('a');
    for(i=0;i<divs.length;i++) {
    	if(divs[i].className == 'subtleResetButton') divs[i].style.display = 'none';
    }

}

//disable right-click
function handler(event) {
	event = event || window.event;
	if (event.stopPropagation) { event.stopPropagation(); }
	event.cancelBubble = true;
	return false;
}