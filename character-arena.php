<?php

require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('character-empty');
$tabs = new template();
$tabs->add('character-global-tabs');
$tp->assign('tabs','<script type="text/javascript">characterTab = \'character\';characterSubTab=\'arena\';</script>'.$tabs->output);

include('sections/character.php');

$types = array(2,3,5);

foreach($types as $type) {
	$mems = array();
	$members_list = '';
	if(!$character->arena_team[$type]['name']) continue;
	$team = $mysql->getRow("select arena_team.*,arena_team_stats.*
					from arena_team,arena_team_stats
					where arena_team.arenateamid = arena_team_stats.arenateamid and arena_team.name = '?1'",$character->arena_team[$type]['name'],'char');
	$rank = getArenaRank($character->arena_team[$type]['arenateamid']);
	$place = getPlace($rank[1]);
	$members = $mysql->getRows("select arena_team_member.*,characters.name,characters.race from arena_team_member,characters where arena_team_member.arenateamid = ?1 and characters.guid = arena_team_member.guid",$team['arenateamid'],'char');
	if(!$members) continue;
	foreach($members as $mem) {
		if($mems[$mem['name']]) continue;
		$mems[$mem['name']] = true;
		$team_faction = character::getAlliance($mem['race']);
		$members_list .= '<a href="character-sheet.php?Realm='.$character->realm.'&name='.$mem['name'].'">'.$mem['name'].'</a>, ';
		if($mem['name']==$character->name) $me = $mem;
	}

	$out.='<blockquote style="clear:both"><b class="iarenateams"><h2>'.$type.'v'.$type.' Arena Team</h2></b></blockquote>
<div class="arenareport-header-single"><div class="arenareport-moldingleft-s"><div class="reldiv"><div class="arenareport-moldingleft-s-flash"><div id="teamicon2" style="display:block;padding:2px;"><img src='.getSmallArenaIcon($team).' border="0" width="71" height="71"></div></div><div class="arenareport-moldingleft-name"><div class="reldiv">
<div class="teamnameshadow">'.$team['name'].'<span style="font-family:Arial, Helvetica, sans-serif;">
                            &lt;'.$type.'v'.$type.'&gt;
                            </span>
</div>
<div class="teamnamehighlight">
<a class="teamnamehighlight" href="team-info.php?Realm='.$character->realm.'&name='.$team['name'].'&type='.$team['type'].'">'.$team['name'].'<span style="font-family:Arial, Helvetica, sans-serif; display: inline;">
                            &lt;'.$type.'v'.$type.'&gt;
                            </span></a>
</div>
</div>
</div>
<div class="arenareport-moldingleft-info">
<div style="float: left;">
<div class="reldiv">
<div style="position: absolute; top:-1px;">
<div class="team-members">Team Members:
'.substr($members_list,0,-2).'</div></div></div></div></div></div></div></div>
<div class="arena-badge-container" style="float: right; margin-top: 20px;">
<div class="arenaTeam-badge" style="margin: 0 auto; float: none; padding: 1px;">
<div class="teamSide'.$team_faction.'"></div>
<div class="teamRank">
<span>Last Week\'s</span>
<p>Rank</p>
<p class="position">'.$place.'</p>
</div>
<div class="rank-num" id="arenarank2" style="padding-top: 5px;">
<div id="arenarank2" style="display:none;"></div>
</div>
<div class="arenaBadge-icon" style="background-image:url(images/icons/badges/arena/arena-'.$rank[0].'.jpg);">
<img class="p" src="images/badge-border-arena-'.$rank[2].'.gif"></div>
</div>
<a class="standing-link" href="team-info.php?Realm='.$character->realm.'&type='.$type.'&name='.$team['name'].'"><img src="images/pixel.gif"></a>
</div>
<div class="filterTitle">Statistics</div>
<div class="stats-container" style="margin-bottom: 10px;">
<div class="arenaTeam-data">
<div class="innerData">
<table>
<tr class="team-header">
<td></td><td align="center" width="25%"><span>Games</span></td><td align="center" width="25%"><span>Win - Loss</span></td><td align="center" width="25%"><span>Win %</span></td><td align="center" width="25%"><span>Rating</span></td>
</tr><tr class="hl"><td><p>'.$type.'v'.$type.' Team Stats</p></td><td align="center"><p>'.$team['games'].'</p>
</td><td align="center">
<p>'.$team['wins'].' - '.($team['games']-$team['wins']).'</p></td><td align="center"><p>'.(!$team['games']?0:round($team['wins']/$team['games']*100)).'%</p></td><td align="center">
<p class="rating">'.$team['rating'].'</p></td></tr><tr><td>
<p>'.$character->name.'\'s  Stats:</p></td><td align="center"><p>'.$me['played_season'].'</p></td><td align="center"><p>'.$me['wons_season'].' - '.($me['played_season']-$me['wons_season']).'</p></td><td align="center"><p>'.(!$me['played_season']?0:round($me['wons_season']/$me['played_season']*100)).'%</p></td><td align="center"><p class="rating">'.$me['personal_rating'].'</p></td></tr></table></div></div></div>';
}

$tp->assign('rep',$out);
$c->assign('content',$tp->output);

$c->display();
$_SYSTEM->printFooter();

?>