<?php
if($_GET['name']) {
	if(!(int)$_GET['name']) {
		$data = $mysql->getRows("SELECT guildid,name FROM `guild` where name = '?1'",$_GET['name'],'char');
		foreach($data as $guild) {
			if($_GET['name'] == $guild['name']) {
				$_GET['name'] = $guild['guildid'];
				break;
			}
		}
	}
}
$guild = guild((int)$_GET['name']);

if($guild->id==-1) $_SYSTEM->error('Guild not found!');

$tp->assign('guild',$guild->name);
$tp->assign('guildid',$guild->id);
$tp->assign('gm_id',$guild->leader_id);
$tp->assign('gm',$guild->leader);
$tp->assign('faction',$guild->faction ? $_LANGUAGE->text['horde'] : $_LANGUAGE->text['alliance']);
$tp->assign('faction2',$guild->faction ?'horde' : 'alliance');
$tp->assign('alliance',$guild->faction);
$tp->assign('members',$guild->members);

$tp->assign('realm',$guild->realm);
$tp->assign('realmid',$guild->realmID);
if(!$guild->faction) {
	$races = '<option value="1">Human</option><option value="3">Dwarf</option><option value="4">Night Elf</option><option value="7">Gnome</option><option value="1">Draenei</option>';
}else {
	$races = '<option value="2">Orc</option><option value="5">Undead</option><option value="10">Blood Elf</option><option value="6">Tauren</option><option value="8">Troll</option>';
}
$tp->assign('races',$races);
foreach($guild->ranks as $rname) {
	$ranks.= '<option value="'.$rname.'">'.$rname.'</option>';
}
$tp->assign('ranks',$ranks);




?>