<?php
if($_GET['name']) {
	if(!(int)$_GET['name']) {
		$data = $mysql->getRow("select guid from characters where name  = '?1'",$_GET['name'],'char');
		$_GET['name'] = (int)$data['guid'];
	}
}
$character = character((int)$_GET['name']);

$tp->assign('guid',$character->guid);
$tp->assign('name',$character->name);
$tp->assign('guid',$character->guid);
$tp->assign('level',$character->level);
$tp->assign('portrait_type',$character->level==80?'-80':($character->level>=70?'-70':($character->level>=60?'':'-default')));
$tp->assign('faction_name',$character->getAlliance()?'horde':'alliance');
$race = character::raceToString($character->race);
$tp->assign('race',$race);
if(strtolower($race) == 'undead') $race = 'scourge';
$tp->assign('race3D',strtolower(str_replace(' ','',$race)));
$tp->assign('class',$character->classToString($character->class));
$tp->assign('gender_nr',$character->gender);
$tp->assign('gender3D',($character->gender?'female':'male'));
$tp->assign('race_nr',$character->race);
$tp->assign('class_nr',$character->class);
$tp->assign('guild', $character->guild_id ? '<a class="charGuildName" href="guild-info.php?Realm={$realm}&name='.$character->guild.'&characterName='.$character->name.'">'.$character->guild.'</a>' : '');
$tp->assign('guildname', $character->guild);
$tp->assign('guildtabdisplay',$character->guild_id ?'':'style="display:none;"');
$tp->assign('arenatabdisplay',$character->arena_team[2]['name']||$character->arena_team[3]['name']||$character->arena_team[5]['name'] ?'':'style="display:none;"');
$tp->assign('guild_name', $character->guild_id ? $character->guild : 'None');
$tp->assign('guild_rank', $character->guild_rank ? $character->guild_rank : 'Unknown');
$tp->assign('realm',$character->realm);
$tp->assign('achievementLock', $config['mangos_version']?'':'display:none');

foreach($character->items as $key => $value) {
	if($value) {
		$itemlist .= $value.',';
	}
}
$r= $mysql->getRows("select displayid,InventoryType from item_template where entry in (?1-1)",$itemlist,'world') or die(mysql_error());
$itemlist = '';
if($r) foreach($r as $row) {
		if($empty[$row['InventoryType']] && $row['InventoryType']==13) $row['InventoryType'] = 23;
		$empty[$row['InventoryType']] = true;
		if(!in_array($row['InventoryType'],array(2,11,12,28))) $itemlist .= $row['InventoryType'].','.$row['displayid'].',';
	}
$tp->assign('jsitemlist',substr($itemlist,0,-1));
$tp->assign('items3D',substr($itemlist,0,-1));

$achi ='';
$bcat = $mysql->getRows("SELECT * FROM `achievement_category` WHERE `parent` = '-1' AND `id` <> 1 ORDER BY `sortOrder`",'armory');
	$points=0;
	foreach($bcat as $cat) {
		$done=0;
		$cc = $mysql->getRows("select id from achievement_category where parent = ?1 ",$cat['id'],'armory');
		$ct = $cat['id'].',';

		if($cc)
			foreach($cc as $val)
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
		$buff.= '<div class="achList">
<span>'.$done.'/'.$total.'</span>'.$cat['name'].'</div>';

	}
	$achi .= '<div class="achieve-bar" style="text-align:center;">
<div class="progressTxt">&nbsp;&nbsp;Overall Progress&nbsp;'.$done_g.'/'.$all.'</div>
<b style="width: '.($done_g/$all*100).'%;"></b>
</div>'.$buff;
$tp->assign('achievements',$achi);
$tp->assign('achievement_points',$points);

?>