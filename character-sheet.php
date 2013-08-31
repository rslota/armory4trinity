<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('character-sheet');
$tabs = new template();
$tabs->add('character-global-tabs');
$tp->assign('tabs','<script type="text/javascript">characterTab = \'character\';characterSubTab=\'sheet\';</script>'.$tabs->output);

include('sections/character.php');



$tp->assign('lastupdate',$_SYSTEM->lastupdate?date("d-m-Y",$_SYSTEM->lastupdate):'Unknown');
$tp->assign('honor',$character->honor);
$tp->assign('hk',$character->hk);
$tp->assign('arenapoints',$character->arenapoints);
$tp->assign('power_type_l',strtolower($character->getPowerType()));
$tp->assign('power_type',$character->getPowerType());
foreach($character->stats as $key => $value) {
	if(((float)$value)==0) $value = 0;
	$tp->assign($key ,$value);
}

// Talenty
// var_dump($character->talentCount);exit;
for($i=0;$i<3;$i++) {
	$tp->assign('talentCount0_'.$i,$character->talentCount[0][$i]);
}
for($i=0;$i<3;$i++) {
	$tp->assign('talentCount1_'.$i,$character->talentCount[1][$i]);
}
$tp->assign('talentSpec0',$character->talentSpec[0]['name']);
$tp->assign('talentSpec1',$character->talentSpec[1]['name']);
$src = $character->talentSpec[0]['nr'] ? ($character->talentSpec[0]['nr']==-1?$_DOMAIN.'images/icons/class/talents/hybrid.gif':$_DOMAIN.'images/icons/class/'.$character->class.'/talents/'.$character->talentSpec[0]['nr'].'.png') : $_DOMAIN.'images/icons/class/talents/untalented.gif';
$tp->assign('talentIconSrc0',$src);
$src = $character->talentSpec[1]['nr'] ? ($character->talentSpec[1]['nr']==-1?$_DOMAIN.'images/icons/class/talents/hybrid.gif':$_DOMAIN.'images/icons/class/'.$character->class.'/talents/'.$character->talentSpec[1]['nr'].'.png') : $_DOMAIN.'images/icons/class/talents/untalented.gif';
$tp->assign('talentIconSrc1',$src);

$tp->assign('talentPreHtml0',($character->activeSpec?'<div class="spec-wrapper disabledSpec">':'<div class="spec-wrapper">
<div class="activeSpecTxt">Active</div>'));

$tp->assign('talentPreHtml1',(!$character->activeSpec?'<div class="spec-wrapper disabledSpec">':'<div class="spec-wrapper">
<div class="activeSpecTxt">Active</div>'));

// Profesje
$i=2;
foreach($character->prof_1 as $prof) {
	$primary .= '<div class="prof1" style="background:url(\''.$_DOMAIN.'images/icons/professions/'.strtolower($prof[1]).'-sm.gif\') 0 50% no-repeat;"><div class="bar-container staticTip" onmouseover="setTipText(\''.$prof[1].'\')">';
	$width = (int)(($prof[2]*100)/$prof[3]);
	$primary .= '<b style="width: '.$width.'%"><span style="position:absolute;">'.$prof[2].' / '.$prof[3].'</span></b></div>
</div>';
	$i--;
	if($i<=0) break;
}
while($i--) {
	$primary .= '<div class="prof1" style="background:url(\''.$_DOMAIN.'images/icons/professions/none.gif\') 0 50% no-repeat;"><div class="bar-container staticTip" onmouseover="setTipText(\'None\')">';
	$primary .= '<b style="width: 0%"><span style="position:absolute;">N/A</span></b></div>
</div>';
}
$tp->assign('profs',$primary);


// Achievements


// Items

$left = array(0,1,2,14,4,18,3,8);
foreach($left as $i) {
	$leftItems .= '<div class="gearItem" style="
					background-image: url(\''.$character->get_item_icon($i).'\')">
<a class="staticTip gearFrame" onmouseover="setTipText(\''.$_SYSTEM->htmlcode($character->item_tooltips[$i]).'\')" href="javascript:void(0)">
<div class="upgradeBox"></div>
</a>
<div class="fly-horz">
<a class="upgrd" href="item-info.php?i='.$character->items[$i].'" target="_blank">More info</a>
</div>
</div>';
}
$tp->assign('leftItems',$leftItems);
$right = array(9,5,6,7,10,11,12,13);
foreach($right as $i) {
	$rightItems .= '<div id="itemID_'.$character->items[$i].'" class="gearItem" style="
					background-image: url(\''.$character->get_item_icon($i).'\')">
<a class="staticTip gearFrame" onmouseover="setTipText(\''.$_SYSTEM->htmlcode($character->item_tooltips[$i]).'\')" href="javascript:void(0)">
<div class="upgradeBox"></div>
</a>
<div class="fly-horz">
<a class="upgrd" href="item-info.php?i='.$character->items[$i].'" target="_blank">More info</a>
</div>
</div>';
}
$tp->assign('rightItems',$rightItems);

$bottom = array(15,16,17);
foreach($bottom as $i) {
	$bottomItems .= '<div class="gearItem" style="
					background-image: url(\''.$character->get_item_icon($i).'\')">
<a class="staticTip gearFrame" onmouseover="setTipText(\''.$_SYSTEM->htmlcode($character->item_tooltips[$i]).'\')" href="javascript:void(0)">
<div class="upgradeBox"></div>
</a>
<div class="fly-horz">
<a class="upgrd" href="item-info.php?i='.$character->items[$i].'" target="_blank">More info</a>
</div>
</div>';
}
$tp->assign('bottomItems',$bottomItems);

// Arena
$types = array(2,3,5);
foreach($types as $type) {
	if($character->arena_team[$type]['name']) {
		$rank = getArenaRank($character->arena_team[$type]['arenateamid']);
		$at .= '<li><div class="arenacontainer"><h4>'.$type.'v'.$type.'</h4><em><span>Rating: '.$character->arena_team[$type]['rating'].'</span></em><div class="icon" style="background-image: url(\'images/icons/badges/arena/arena-'.$rank[0].'.jpg\');">
<img border="0" src="images/badge-border-pvp-'.$rank[2].'.gif"><div class="rank-num" id="arenarank'.$type.'_'.$type.'">
<div class="teamRank"> <br>
<p class="position">'.getPlace($rank[1]).'</p>
</div></div></div></div></li>';
		$at2 .= '<li><div><em><span><b><a href="team-info.php?Realm='.$_SYSTEM->Realms[$_SYSTEM->Realm].'&name='.$character->arena_team[$type]['name'].'&type='.$type.'">'.$character->arena_team[$type]['name'].'</a></b><br>Personal Rating: '.$character->arena_team[$type]['rating'].'<br></span></em></div></li>';
	}else {
		$at .= '<li><div class="arena-team-faded"><h4>'.$type.'v'.$type.'</h4><em><span>No Arena Team</span></em></div></li>';
		$at2 .= '<li><div><em><span></span></em></div></li>';
	}
}
$tp->assign('arenacontent',$at);
$tp->assign('arenacontent2',$at2);


$c->assign('content',$tp->output);
$c->display();
$_SYSTEM->printFooter();
?>