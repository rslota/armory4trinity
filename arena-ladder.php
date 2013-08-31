<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('arena-ladder');
$_GET['type']=(int)$_GET['type'];
if(!in_array($_GET['type'],array(2,3,5))) $_SYSTEM->error("Invalid team type.");


$r = $mysql->getRows("select arena_team.*,arena_team_stats.*,characters.race from arena_team,arena_team_stats,characters where arena_team.arenateamid = arena_team_stats.arenateamid and characters.guid = arena_team.captainguid and arena_team.type = ?1 order by rating desc limit ?2",$_GET['type'],$config['ladder_rows_limit'],'char');
if($r) {
	$i=1;
	foreach($r as $row) {
		$row['faction'] = character::getAlliance($row['race']);
		$table .='<tr onMouseOver="zoomInArenaIcon(this)" onMouseOut="zoomOutArenaIcon(this)"><td class="rightNum" style="font-weight: bold;">'.($i++).'</td><td>
		<div style="float:left;"><img border="0" src="'.getSmallArenaIcon($row).'" width="20" height="20" alt="" style=" position: absolute;left:0px;top:4px;z-index:1;"> <a href="team-info.php?Realm={$realm}&name='.$row['name'].'&type='.$row['type'].'" style="margin-left:25px;margin-top:5px;position:absolute;">'.$row['name'].'</a></div></td><td style="white-space: nowrap">{$realm}</td><td class="centNum"><img class="" src="images/icons/faction/icon-'.$row['faction'].'.gif" ></td><td class="rightNum" style="font-weight: bold; color: #678705;">'.$row['wins2'].'</td><td class="rightNum" style="font-weight: bold; color: #9A1401;">'.($row['played']-$row['wins2']).'</td><td class="rightNum" style="font-weight: bold;">'.$row['rating'].'</td>
</tr>';
	}
}else {
$table = '<tr><td colspan="7">No results</td></tr>';
}
$tp->assign('table',$table);

$tp->assign('realm',$_SYSTEM->Realms[$_SYSTEM->Realm]);
if(count($_SYSTEM->Realms)>1) {
	foreach($_SYSTEM->Realms as $r) {
		$realmlist .= '<a href="arena-ladder.php?Realm='.$r.'&type='.$_GET['type'].'">'.$r.'</a>, ';
	}
}
$tp->assign('realmlist',$realmlist?'(Realms: '.substr($realmlist,0,-2).')':'');
$tp->assign('type',$_GET['type']);
$c->assign('content',$tp->output.'<script type="text/javascript">document.getElementById(\'arena'.$_GET['type'].'\').className="selected-tab";</script>');

$c->display();
$_SYSTEM->printFooter();
?>