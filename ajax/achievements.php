<?php
$_FPREFIX = '../';
include('../init.php');

if($config['mangos_version']==0) exit;

$character = character($_GET['guid']);
$cat = (int)$_GET['cat'];
if($cat) {
	$r = $mysql->getRows("select * from achievement where categoryId = ?1 AND (factionFlag = ?2 OR factionFlag = '-1') order by OrderInCategory",$cat,($character->getAlliance()+1)%2,'armory');
	if(!$r) exit;
	foreach($r as $row) {
		$iconIDs.=$row['iconId'].',';
	}
	$icons_r = $mysql->getRows("select * from spellicon where id IN (?1-1)",$iconIDs,'armory');
	if($icons_r)
	foreach($icons_r as $icon) {
		$icons[$icon['id']] = strtolower(str_replace(' ','',$icon['name']));
	}
	$count=$done=0;
	foreach($r as $row) {

		$achi[$row['id']]['ref'] = ($row['refAchievement']?$row['refAchievement']:$row['id']);
		$crit .= $achi[$row['id']]['ref'].',';
		$achi[$row['id']]['date']=$character->achievement[$row['id']];
		$achi[$row['id']]['progress'] = $character->achievement_progress;
		$achi[$row['id']]['points']=$row['points'];
		$achi[$row['id']]['name']=$row['name'];
		$achi[$row['id']]['description']=$row['description'];
		$achi[$row['id']]['reward']=$row['unk2'];
		$achi[$row['id']]['icon']=$icons[$row['iconId']];
		$achi[$row['id']]['sort']=$row['OrderInCategory'];
		$achi[$row['id']]['criteria'] = array();
		$achi[$row['id']]['show'] = 1;
		$achi[$row['id']]['parent'] = $row['unk1'];

		$count++;
		if($achi[$row['id']]['date']) $done++;
	}
	$r = $mysql->getRows("select * from achievement_criteria where referredAchievement  IN (?1-1)",$crit,'armory');
	foreach($achi as $key=>$a) {
		if($r)
		foreach($r as $row) {
			if($row['referredAchievement']==$a['ref']) {
				array_push($achi[$key]['criteria'],$row);
			}
		}
		if($a['parent'] && $a['date']) {
			$achi[$a['parent']]['show'] = 0;
			$achi[$key]['criteria'] = array_merge($achi[$a['parent']]['criteria'],$achi[$key]['criteria']);
		}else if($a['parent'] && !$a['date']){
			//$achi[$key]['show'] = 0;
		}
	}
	function cmp($a,$b) {
		if($a['date']==$b['date']) {
			if($a['sort']>$b['sort']) return 1;
			else return -1;
		}
		if($a['date']>$b['date']) return -1;
		else return 1;
	}
	usort($achi,'cmp');
	echo '<div class="spacer">.</div> <div class="progress-bar-start'.($done?'-a':'').'"></div><div class="ach_bar"><div class="bar" style="width: '.($done/$count*100).'%;"></div><div class="pr">'.$done.' / '.$count.'</div></div><div class="progress-bar-end'.($done==$count?'-a':'').'"></div><br style="clear: both;">';
	foreach($achi as $achi_id=>$a) {
		$i=0;
	    if(!$a['show']) continue;
		echo '<div onclick="AchReq('.$achi_id.',this);" class="ach_'.($a['date']?'c':'').'show"><div class="icon-frame"><img src="'.str_replace('ajax/','',$_DOMAIN).'images/icon/'.$a['icon'].'.jpg" class="ach_icon"></div><div class="ach_'.($a['date']?'c':'').'point">'.$a['points'].'</div><div class="ach_title">'.$a['name'].'</div><div class="ach_desc">'.$a['description'].'</div><div id="ach_req_'.$achi_id.'" class="ach_req"><ul>';
		if(count($a['criteria'])==1) {
			foreach($a['criteria'] as $crit) {
				if($crit['completionFlag']&2) continue;
				if(!$a['progress'][$crit['id']]['counter']) $a['progress'][$crit['id']]['counter']=0;
				echo '</ul>';
				$width = ($a['progress'][$crit['id']]['counter']/$crit['value']*100);
				if($width>100)$width=100;
				echo '<div class="ach_bar" style=" width:100%;"><div class="bar" style="width: '.$width.'%;"></div><div class="pr">'.(in_array($crit['id'],array(3506,3507,3510,3511,3512))?(character::getGold($a['progress'][$crit['id']]['counter'])):($a['progress'][$crit['id']]['counter'].' / '.$crit['value'])).'</div></div>';
			}

		}else{
			foreach($a['criteria'] as $crit) {
				if($crit['completionFlag']&2) continue;
				echo '<li style="width:48%; float: '.($i%2?'right':'left').';" class="'.($a['progress'][$crit['id']]['counter']>=$crit['value']?'done':'').'">'.$crit['name'].'</li>';
				$i++;
			}
			echo '</ul>';
		}
		echo '<br clear="all"></div><div class="ach_date">'.($a['date']?date("d-m-Y H:i",$a['date']):'').'</div>'.($a['reward']?'<div class="ach_reward">'.$a['reward'].'</div>':'').'</div>';
	}
}else{
	$bcat = $mysql->getRows("SELECT * FROM `achievement_category` WHERE `parent` = '-1' AND `id` <> 1 ORDER BY `sortOrder`",'armory');
	$points=0;
	foreach($bcat as $cat) {
		$done=0;
		$c = $mysql->getRows("select id from achievement_category where parent = ?1 ",$cat['id'],'armory');
		$ct = $cat['id'].',';

		if($c)
			foreach($c as $val)
				$ct .= $val['id'].',';
		$counter = $mysql->getRows("select id,points from achievement where categoryId IN (?1-1) AND (factionFlag = ?2 OR factionFlag = '-1') order by OrderInCategory",$ct,$character->getAlliance(),'armory');

		$total=count($counter);
		$all+=$total;
		foreach($character->achievement as $key=>$value) {
			foreach($counter as $val) {
				if($key==$val['id']) {$done++;$points+=$val['points'];break;}
			}
		}
		$done_g+=$done;
		$width = ($done/$total*100);
		if($width>100) $width=100;
		$buff.= '<div class="ach_stat">'.$cat['name'].'<div class="ach_bar2"><div class="bar" style="width: '.$width.'%;"></div><div class="pr">'.$done.' / '.$total.'</div></div></div>';

	}
	echo '<div class="spacer">.</div> <div class="progress-bar-start'.($done_g?'-a':'').'"></div><div class="ach_bar"><div class="bar" style="width: '.($done_g/$all*100).'%;"></div><div class="pr">'.$done_g.' / '.$all.' ('.$points.' points)</div></div><div class="progress-bar-end'.($done_g==$all?'-a':'').'"></div><br><div class="ach_s_list">'.$buff;
	echo '</div>';


}
?>