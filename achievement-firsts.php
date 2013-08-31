<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);


	$r = $mysql->getRows("select * from achievement where name like 'Realm First!%'",'armory');
	if(!$r) exit;
	foreach($r as $row) {
		$iconIDs.=$row['iconId'].',';
		$achiIDs.=$row['id'].',';
	}
	$icons_r = $mysql->getRows("select * from spellicon where id IN (?1-1)",$iconIDs,'armory');
	foreach($icons_r as $icon) {
		$icons[$icon['id']] = strtolower(str_replace(' ','',$icon['name']));
	}
	$char = $mysql->getRows("select character_achievement.*,characters.name,characters.race,characters.class,?2 as level,?3 as gender,?4 as guildid from character_achievement,characters where achievement IN (?1-1) and characters.guid=character_achievement.guid order by character_achievement.date desc",																																			$achiIDs,SQL_template(CHAR_LEVEL_OFFSET),CHAR_GENDER_OFFSET,SQL_template(CHAR_GUILD_OFFSET),'char');
	if($char)foreach($char as $val) {
		foreach($val as $key => $value) $info[$val['achievement']][$key] = $value;
		if($info[$val['achievement']]['guild']) {
			$g = $mysql->getRow("select name from guid where id = ?1",$info[$val['achievement']]['guild'],'char');
			$info[$val['achievement']]['guild'] = $g['name'];
		}
	}
	$count=$done=0;
	foreach($r as $row) {
		if(!$info[$row['id']]['guid']) continue;
		$inf = $info[$row['id']];
		$achi.='<div class="firsts_achievement firsts_closed" onclick="toggle_first(this)"><div class="expand_btn"></div>
<div class="firsts_icon" style="background-image:url(&quot;images/icon/'.$icons[$row['iconId']].'.jpg&quot;)">
<img class="p" src="images/achievements/fst_iconframe.png"></div>
<h3>'.$row['name'].'</h3>
<div class="firsts_tshadow">
<div class="firsts_desc">'.$row['description'].'</div>
<div class="briefchars">By <a onclick="parent.location = this.href;return false;" href="character-sheet.php?Realm='.$_SYSTEM->Realms[$_SYSTEM->Realm].'&name='.$inf['name'].'">'.$inf['name'].'</a></div>
<div class="allchars single">
'.($inf['guild']?'<a class="gld" href="guild-info.php?Realm='.$_SYSTEM->Realms[$_SYSTEM->Realm].'name='.$inf['guild'].'">&lt;'.$inf['guild'].'&gt;</a>':'').'&nbsp;<a href="character-sheet.php?Realm='.$_SYSTEM->Realms[$_SYSTEM->Realm].'&name='.$inf['name'].'">'.$inf['name'].'</a><img src="images/icons/race/'.$inf['race'].'-'.$inf['gender'].'.gif"><img align="absmiddle" src="images/icons/class/'.$inf['class'].'.gif" ></div>
<div class="firsts_timedate"><b class="timestamp-firsts">'.date("d-m-Y H:i",$inf['date']).'</b></div><br clear="all"></div></div>';
	}
// Realmlist
if(count($_SYSTEM->Realms)>1) {
	foreach($_SYSTEM->Realms as $realm) $realmlist.='<a href="achievement-firsts.php?Realm='.$realm.'">'.$realm.'</a>, ';
}

$c->assign('content','<style media="screen, projection" type="text/css">@import "css/character/achievements.css";</style><div class="info-header hdr_achvfirsts"><h1>Achievement Firsts</h1><h2>'.$_SYSTEM->Realms[$_SYSTEM->Realm].'<span style="font-size:11px;"> '.($realmlist?'(Realms: '.substr($realmlist,0,-2).')':'').'</span></h2></div><div class="achieve-firsts"><div class="firsts_top"><div class="closed" id="realmnav"></div><div class="firsts_btm">
<div class="firsts_l"><div class="firsts_r">'.$achi.'</div></div></div></div></div></div></div></div></div></div></div>');

$c->display();
$_SYSTEM->printFooter();
?>