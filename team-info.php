<?php


require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('team-info');

$r = $mysql->getRow("select arena_team.*,arena_team_stats.* from arena_team,arena_team_stats where arena_team_stats.arenateamid = arena_team.arenateamid and name = '?1' and type = ?2",$_GET['name'],(int)$_GET['type'],'char');
if(!$r) $_SYSTEM->error("Arena Team not found.");

$tp->assign('name',$r['name']);
$tp->assign('type',$r['type']);


$rank = getArenaRank($r['arenateamid']);
$place = getPlace($rank[1]);


$tp->assign('rank',$rank[0]);
$tp->assign('place',$place);
$tp->assign('rank_border',$rank[2]);
$tp->assign('wg',$r['games']);
$tp->assign('ww',$r['wins']);
$tp->assign('wl',$r['games']-$r['wins']);
$tp->assign('wp',$r['games']?round($r['wins']/$r['games']*100):0);
$tp->assign('wr',$r['rating']);
$tp->assign('sg',$r['played']);
$tp->assign('sw',$r['wins2']);
$tp->assign('sl',$r['played']-$r['wins2']);
$tp->assign('sp',$r['played']?round($r['wins2']/$r['played']*100):0);

$icon=getSmallArenaIcon($r);
$tp->assign('icon',$icon);

$m = $mysql->getRows("select arena_team_member.*,characters.name,characters.race,characters.class,?3 as level,?4 as gender,guild.name as gname from arena_team_member inner join characters on arena_team_member.guid= characters.guid left join guild on guild.guildid = ?2 where arena_team_member.arenateamid = ?1",$r['arenateamid'],SQL_template(CHAR_GUILD_OFFSET),SQL_template(CHAR_LEVEL_OFFSET),CHAR_GENDER_OFFSET,'char');
if($m) {
	foreach($m as $member) {
		$team_faction = character::getAlliance($member['race']);
		$table.='<tr><td><a href="character-sheet.php?Realm={$realm}&name='.$member['name'].'">'.$member['name'].'</a></td>';
		$table .= '<td>'.($member['gname']?'<a href="guild-info.php?Realm={$realm}&name='.$member['gname'].'">'.$member['gname'].'</a>':'None').'</td>';
		$table .= '<td><img class="staticTip" onmouseover="setTipText(\''.character::raceToString($member['race']).'\');" src="images/icons/race/'.$member['race'].'-'.$member['gender'].'.gif">&nbsp;<img class="staticTip" onmouseover="setTipText(\''.character::classToString($member['class']).'\');" src="images/icons/class/'.$member['class'].'.gif"></td>';
		$table .= '<td class="rightNum">'.$member['played_season'].'</td><td class="rightNum" style="color: #678705;">'.$member['wons_season'].'</td><td class="rightNum" style="color: #9A1401;">'.($member['played_season']-$member['wons_season']).'</td><td class="rightNum">'.($member['played_season']?round($member['wons_season']/$member['played_season']*100):0).'%</td><td class="rightNum">'.$member['personal_rating'].'</td></tr>';
	}
}else{
	$table = '<tr><td colspan="8">No members</td></tr>';
}
$tp->assign('table',$table);
$tp->assign('faction',$team_faction);
$tp->assign('realm',$_SYSTEM->Realms[$_SYSTEM->Realm]);
$c->assign('content',$tp->output);

$c->display();
$_SYSTEM->printFooter();


?>