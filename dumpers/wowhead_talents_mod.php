<?php
exit;
$class = array('warrior','paladin','rogue','priest','shaman','mage','warlock','deathknight','hunter','druid');
foreach($class as $c) {
	$get ='';
	if(filesize($c.'.tpl')>60000 && filesize($c.'.tpl')<80000) continue;
	echo filesize($c.'.tpl').'<br>';
	
	$get = file_get_contents($c.'.tpl');
	$get = explode('</em></p></div></div></div>',$get);
	$get = $get[0].'</em></p></div></div></div>';
	$get = explode('<div class="talentcalc talentcalc-default" id="tc-itself"><div class="talentcalc-sidebar-anchor"></div>',$get);
	$get = '<div class="talentcalc talentcalc-default" id="tc-itself"><div class="talentcalc-sidebar-anchor"></div>'.$get[1];
	$get = str_replace('-84px','0px',$get);
	$get = str_replace('http://static.wowhead.com/images/talent/classes/icons/','{$DOMAIN}images/talents/',$get);
	$get = str_replace('http://static.wowhead.com/images/talent/classes/backgrounds/','{$DOMAIN}images/talents/bg/',$get);
	$get = str_replace('<a href="javascript:;"></a>','',$get);
	$get = str_replace('visibility: visible;" class','visibility: hidden;" class',$get);
	$get = str_replace('0px;','-36px;',$get);
	$get = str_replace('jpg?85);"></ins>','jpg?85); background-position: 0pt -36px;"></ins>',$get);
	
	$get = explode('<span> (0)</span>',$get);
	if(count($get)==4)
	  $get = $get[0].'<span> ({$tl0})</span>'.$get[1].'<span> ({$tl1})</span>'.$get[2].'<span> ({$tl2})</span>'.$get[3];
	 else $get=$get[0];
	//var_dump(strpos($get,'<strong></strong><var></var><em></em></p></div></div></div>'));exit;
	if(strpos($get,'<strong></strong><var></var><em></em></p></div></div></div>')!==false) {
		$anchors = explode('<div style="" class="talentcalc-lower">',$get);
		$end = explode('<strong></strong><var></var><em></em></p></div></div></div>',$anchors[1]);
		$anchors = '<div style="" class="talentcalc-lower">'.$end[0].'<strong></strong><var></var><em></em></p></div>';
		$get = explode($anchors,$get);
		$get = $get[0].$get[1];
		$get = str_replace('<div class="talentcalc-sidebar-anchor"></div>','<div class="talentcalc-sidebar-anchor">'.$anchors.'</div>',$get);
	}
	
	file_put_contents($c.'_new.tpl',$get);
}
?>