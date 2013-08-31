<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('item-info');

$itemData = $mysql->getRow("select * from item_template where entry = '?1'",(int)$_GET['i'],'world');
if(!$itemData) $_SYSTEM->error("Item not found!");
$itemIcon = $mysql->getRow("select * from itemicon where itemnumber = ?1",$itemData['entry'],'armory');
$itemIcon = validate_icon($itemIcon,$itemData['entry']);
$tp->assign('itemicon',$itemIcon['itemicon']);
$tp->assign('itemhtml',$itemIcon['itemhtml']);

$tp->assign('itemcost',$itemData['BuyPrice']?'<span>Cost:</span><br>'.character::getGold($itemData['BuyPrice']):'');
$tp->assign('sellfor',$itemData['SellPrice']?'<span>Sells for:</span><br>'.character::getGold($itemData['SellPrice']):'');
if($itemData['DisenchantID'] && $itemData['RequiredDisenchantSkill']>-1) {
	$width = $itemData['RequiredDisenchantSkill']/450*100;
	$reqEnch = '<span>Disenchantable: </span><div class="skill-bar">
				<b style="width: '.$width.'%;"></b>
				<img class="staticTip" src="images/icons/icon-disenchant-sm.gif" onmouseover="setTipText(\'Requires <strong>'.$itemData['RequiredDisenchantSkill'].'</strong> Enchanting to disenchant\');">
				<strong class="staticTip" onmouseover="setTipText(\'Requires <strong>'.$itemData['RequiredDisenchantSkill'].'</strong> Enchanting to disenchant\');">'.$itemData['RequiredDisenchantSkill'].'</strong></div>';
}
$tp->assign('reqenchanting',$reqEnch);
$tp->assign('itemlevel',$itemData['ItemLevel'].($itemData['RequiredLevel']>0?' (<span class="subClass">Req. '.$itemData['RequiredLevel'].'</span>)':''));


// Drop
$drop =  $mysql->getRows("SELECT creature_template.name,creature_template.entry,creature_template.minlevel,creature_template.maxlevel,creature_loot_template.ChanceOrQuestChance
FROM `creature_template`,`creature_loot_template`
WHERE creature_template.entry = creature_loot_template.entry and creature_loot_template.item = ?1 order by creature_loot_template.ChanceOrQuestChance desc limit 20",$itemData['entry'],'world');
if($drop) {
	$dropTP = '<div class="rel-tab"><p class="rel-drop"/><h3>Dropped by:</h3></div>
	<div class="data" style="clear: both;">
	<table class="data-table"><tbody><tr class="masthead"><td><a class="noLink">Name</a></td><td align="center"><a class="noLink">Level</a></td><td align="center"><a class="noLink">Location</a></td><td align="center"><a class="noLink">Drop Chance</a></td></tr>';
	foreach($drop as $mob) {
		$dropTP .= '<tr><td><strong>'.$mob['name'].'</strong></td><td class="centeralign">'.($mob['minlevel']==$mob['maxlevel']?$mob['minlevel']:$mob['minlevel'].'-'.$mob['maxlevel']).'</td>
		<td>';
		$mapsQ = $mysql->getRows("select map,position_x as x, position_y as y from creature where id = ?1",$mob['entry'],'world');
		$maps=array();
		if($mapsQ) {
			foreach($mapsQ as $creature) {
				$zoneID = getZone($creature['map'],$creature['x'],$creature['y']);
				if($zoneID===false) $zoneID = $creature['map'];
				$maps[$zoneID]++;
			}
			$ct=0;
			foreach($maps as $id=>$map) {
				$ct++;
				if($ct>6) break;
				$dropTP .= getZoneName($id).'('.$map.'), ';
			}
			if($ct)$dropTP=substr($dropTP,0,-2);
		}
		$dropTP .= '</td><td class="centeralign">'.round($mob['ChanceOrQuestChance'],2).'%</td></tr>';
	}
	$dropTP .= '</tbody></table></div>';
}
$tp->assign('drop',$dropTP);

// Chest Drop
$dropTP='';
$drop =  $mysql->getRows("SELECT gameobject_template.name,gameobject_template.entry,gameobject_loot_template.ChanceOrQuestChance
FROM `gameobject_template`,`gameobject_loot_template`
WHERE gameobject_template.entry = gameobject_loot_template.entry and gameobject_loot_template.item = ?1 order by gameobject_loot_template.ChanceOrQuestChance desc limit 20",$itemData['entry'],'world');
if($drop) {
	$dropTP = '<div class="rel-tab"><p class="rel-drop"/><h3>Contained in:</h3></div>
	<div class="data" style="clear: both;">
	<table class="data-table"><tbody><tr class="masthead"><td><a class="noLink">Name</a></td><td align="center"><a class="noLink">Location</a></td><td align="center"><a class="noLink">Drop Chance</a></td></tr>';
	foreach($drop as $mob) {
		$dropTP .= '<tr><td><strong>'.$mob['name'].'</strong></td>
		<td>';
		$mapsQ = $mysql->getRows("select map,position_x as x, position_y as y from gameobject where id = ?1",$mob['entry'],'world');
		$maps=array();
		if($mapsQ) {
			foreach($mapsQ as $creature) {
				$zoneID = getZone($creature['map'],$creature['x'],$creature['y']);
				$maps[$zoneID]++;
			}
			$ct=0;
			foreach($maps as $id=>$map) {
				$ct++;
				if($ct>6) break;
				$dropTP .= getZoneName($id).'('.$map.'), ';
			}
			$dropTP=substr($dropTP,0,-2);
		}
		$dropTP .= '</td><td class="centeralign">'.round($mob['ChanceOrQuestChance'],2).'%</td></tr>';
	}
	$dropTP .= '</tbody></table></div>';
}
$tp->assign('chestdrop',$dropTP);

// Vendor
$vendor =  $mysql->getRows("SELECT creature_template.name,creature_template.entry,creature_template.minlevel,creature_template.maxlevel
FROM `creature_template`,`npc_vendor`
WHERE creature_template.entry = npc_vendor.entry and npc_vendor.item = ?1 limit 20",$itemData['entry'],'world');
if($vendor) {
	$vendorTP = '<div class="rel-tab"><p class="rel-drop"/><h3>Sold by:</h3></div>
	<div class="data" style="clear: both;">
	<table class="data-table"><tbody><tr class="masthead"><td><a class="noLink">Name</a></td><td align="center"><a class="noLink">Level</a></td><td align="center"><a class="noLink">Location</a></td></tr>';
	foreach($vendor as $mob) {
		$vendorTP .= '<tr><td><strong>'.$mob['name'].'</strong></td><td class="centeralign">'.($mob['minlevel']==$mob['maxlevel']?$mob['minlevel']:$mob['minlevel'].'-'.$mob['maxlevel']).'</td>
		<td>';
		$mapsQ = $mysql->getRows("select map,position_x as x, position_y as y from creature where id = ?1",$mob['entry'],'world');
		$maps=array();
		if($mapsQ) {
			foreach($mapsQ as $creature) {
				$zoneID = getZone($creature['map'],$creature['x'],$creature['y']);
				$maps[$zoneID]++;
			}
			$ct=0;
			foreach($maps as $id=>$map) {
				$ct++;
				if($ct>6) break;
				$vendorTP .= getZoneName($id).', ';
			}
			$vendorTP=substr($vendorTP,0,-2);
		}
		$vendorTP .= '</td></tr>';
	}
	$vendorTP .= '</tbody></table></div>';
}
$tp->assign('vendor',$vendorTP);

// Reward
$reward =  $mysql->getRows("SELECT Title, QuestLevel,MinLevel,ZoneOrSort
        FROM `quest_template` WHERE `RewChoiceItemId1` = ?1 OR `RewChoiceItemId2` = ?1
	OR `RewChoiceItemId3` = ?1 OR `RewChoiceItemId4` = ?1 OR `RewChoiceItemId5` = ?1 OR `RewChoiceItemId6` = ?1
	OR `RewItemId1` = ?1 OR `RewItemId2` = ?1 OR `RewItemId3` = ?1 OR `RewItemId4` = ?1 limit 20",$itemData['entry'],'world');
if($reward) {
	$rewardTP = '<div class="rel-tab"><p class="rel-reward"/><h3>Reward from:</h3></div>
	<div class="data" style="clear: both;">
	<table class="data-table"><tbody><tr class="masthead"><td><a class="noLink">Title</a></td><td align="center"><a class="noLink">Level</a></td><td align="center"><a class="noLink">Location</a></td></tr>';
	foreach($reward as $mob) {
		$rewardTP .= '<tr><td><strong>'.$mob['Title'].'</strong></td><td class="centeralign">'.$mob['QuestLevel'].($mob['MinLevel']>0?' (<span class="subClass">Req. '.$mob['MinLevel'].'</span>)':'').'</td>
		<td>'.getZoneName($mob['ZoneOrSort']);

		$rewardTP .= '</td></tr>';
	}
	$rewardTP .= '</tbody></table></div>';
}
$tp->assign('reward',$rewardTP);


// Disenchant
if($itemData['DisenchantID']) {
	$de =  $mysql->getRows("SELECT item_template.name,item_template.entry,item_template.Quality,disenchant_loot_template.item,disenchant_loot_template.ChanceOrQuestChance,disenchant_loot_template.mincountOrRef,disenchant_loot_template.maxcount
	        FROM `disenchant_loot_template`,`item_template`
	        WHERE disenchant_loot_template.item = item_template.entry and disenchant_loot_template.entry = ?1 limit 20",$itemData['DisenchantID'],'world');
	if($de) {
		$deTP = '<div class="rel-tab"><p class="rel-de"/><h3>Disenchants into:</h3></div>
		<div class="data" style="clear: both;"  id="big-results">
		<table class="data-table"><thead><tr class="masthead"><td><a class="noLink">Name</a></td><td align="center"><a class="noLink">Drop Chance</a></td><td align="center"><a class="noLink">Count</a></td></tr></thead><tbody>';
		foreach($de as $mob) $ids.=$mob['entry'].',';
		$cc = $mysql->getRows("select itemnumber,itemicon,itemhtml from itemicon where itemnumber in (?1-1)",$ids,'armory');
        if($cc)
	        foreach($cc as $icon) {
	         	$icons[$icon['itemnumber']] = $icon;
	        }
		foreach($de as $mob) {
			$icons[$mob['entry']] = validate_icon($icons[$mob['entry']],$mob['entry']);
			$deTP .= '<tr><td><strong><a onMouseOver="setTipText(\''.system::htmlcode($icons[$mob['entry']]['itemhtml']).'\')" href="item-info.php?i='.$mob['entry'].'" class="staticTip rarity'.$mob['Quality'].'">
			<img align="middle" border="0" height="48" alt="" src="images/icon48/'.$icons[$mob['entry']]['itemicon'].'.png"> '.$mob['name'].'</a></strong></td><td class="centeralign">'.round($mob['ChanceOrQuestChance'],2).'%</td>
			<td>'.($mob['mincountOrRef']==$mob['maxcount']?$mob['maxcount']:$mob['mincountOrRef'].'-'.$mob['maxcount']).'</td></tr>';
		}
		$deTP .= '</tbody></table></div>';
	}
}
$tp->assign('de',$deTP);

$c->assign('content',$tp->output);
$c->display();
$_SYSTEM->printFooter();

?>
