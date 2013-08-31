<?php
$_FPREFIX = '../';
include('../init.php');

if($config['mangos_version']==0) exit;

$character = character($_GET['guid']);
$cat = (int)$_GET['cat'];
if(!$cat) $cat=130;

function getStatisticsList($cat) {
	global $character,$mysql;
	$r = $mysql->getRows("select * from achievement where categoryId = ?1 AND (factionFlag = ?2 OR factionFlag = '-1') order by OrderInCategory",$cat,$character->getAlliance(),'armory');
	if(!$r) exit;
	foreach($r as $row) {
		$achi[$row['id']]['ref'] = ($row['refAchievement']?$row['refAchievement']:$row['id']);
		$crit .= $achi[$row['id']]['ref'].',';
		$achi[$row['id']]['date']=$character->achievement[$row['id']];
		$achi[$row['id']]['progress'] = $character->achievement_progress;
		$achi[$row['id']]['name']=$row['name'];
		$achi[$row['id']]['sort']=$row['OrderInCategory'];
		$achi[$row['id']]['criteria'] = array();
		$achi[$row['id']]['show'] = 1;
		$achi[$row['id']]['parent'] = $row['unk1'];
	}
	$r = $mysql->getRows("select * from achievement_criteria where referredAchievement  IN (?1-1)",$crit,'armory');
	foreach($achi as $key=>$a) {
		foreach($r as $row) {
			if($row['referredAchievement']==$a['ref']) {
				array_push($achi[$key]['criteria'],$row);
			}
		}
	}
	$r = $mysql->getRow("select name from achievement_category where id = ?1",$cat,'armory');
	echo '<div class="cat_header">'.$r['name'].'</div>';
	foreach($achi as $achi_id=>$a) {
		$i++;$pr=0;
		if(count($a['criteria'])==1)
			foreach($a['criteria'] as $crit) {
				$pr = $a['progress'][$crit['id']]['counter']?$a['progress'][$crit['id']]['counter']:'--';
			}
		else {
			foreach($a['criteria'] as $crit) {
				if(!$crit['name'] && $a['progress'][$crit['id']]['counter']>=$crit['value']) $pr++;
				else if($crit['name'] && $cat != 147 ) $pr+=$a['progress'][$crit['id']]['counter'];
				else if($crit['name'] && $a['progress'][$crit['id']]['counter']>=$crit['value']) $pr = $crit['name'];
			}
		}
		if(in_array($achi_id,array(328,753,326,333,919,334,921,1146,1147,1148,331,332,1150))) $pr = character::getGold($pr);
		echo '<div class="stat_row '.($i%2?'zebra':'').'"><div style="float: right;"> '.$pr.'</div>'.$a['name'].'</div>';
	}
}
getStatisticsList($cat);
$r=$mysql->getRows("select id from achievement_category where parent = ?1",$cat,'armory');
if(!$r) exit;
foreach($r as $row) {
	getStatisticsList($row['id']);
}

?>