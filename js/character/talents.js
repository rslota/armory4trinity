function initCharTalents(){

	var currUrl = location.href;

	if(currUrl.indexOf("group=") != -1){
		var group = currUrl.substr(currUrl.indexOf("group=") + 6,1);
		if(group == "1" || group == "2"){
			$("#group_" + group + "_link").trigger("click");
		}
	}
}

function switchTalentSpec(active, group, talStr){
	//new talents
	applyTalents(talStr);


	$("#group_1").removeClass("selectedSet");
	$("#group_2").removeClass("selectedSet");
	$("#group_" + group).addClass("selectedSet");

	//switch glyphs
	$("#glyphSet_1").hide();
	$("#glyphSet_2").hide();
	$("#glyphSet_" + group).show();

}

function switchSpec(spec) {  talentString = (spec?talentStr_1:talentStr_0);
  applyTalents(talentString);
  document.getElementById("glyphSet_1").style.display = "none";
  document.getElementById("glyphSet_0").style.display = "none";
  document.getElementById("group_0").className = "";
  document.getElementById("group_1").className = "";

  document.getElementById("group_"+spec).className = "selectedSet";
  document.getElementById("glyphSet_"+spec).style.display = "block";
}

function makeGlyphTooltip(name, type, effect){

	var tipstr = "<strong>"+name+"</strong><br />";
	tipstr += "<span style='color: #73c7f3'>"+type+"</span><br />";
	tipstr += ""+effect+"";

	setTipText(tipstr);

}