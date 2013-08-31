<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('honor-ranking');
if(!in_array($_GET['type'],array('hk','honor'))) $_SYSTEM->error("Invalid ranking type.");


$r = $mysql->getRows("select characters.name,characters.race,characters.class,?2 as gender,?1 as hh,guild.name as gname,?4 as level from characters left join guild on guild.guildid = ?3 where ?1 < 2000000000 order by ?1 desc limit ?5",
($_GET['type']=='hk'?SQL_template(CHAR_HK_OFFSET):SQL_template(CHAR_HONOR_OFFSET)),CHAR_GENDER_OFFSET,SQL_template(CHAR_GUILD_OFFSET),SQL_template(CHAR_LEVEL_OFFSET),$config['ladder_rows_limit'],'char');
if($r) {
	$i=1;
	foreach($r as $row) {
		$row['faction'] = character::getAlliance($row['race']);
		$table .='<tr onMouseOver="zoomInArenaIcon(this)" onMouseOut="zoomOutArenaIcon(this)"><td class="rightNum" style="font-weight: bold;">'.($i++).'</td><td>
		<a href="character-sheet.php?Realm={$realm}&name='.$row['name'].'">'.$row['name'].'</a></td><td style="white-space: nowrap">'.$row['level'].'</td><td class="centNum"><img src="images/icons/race/'.$row['race'].'-'.$row['gender'].'.gif" > <img src="images/icons/class/'.$row['class'].'.gif" ></td><td class="centNum"><img class="" src="images/icons/faction/icon-'.$row['faction'].'.gif" ></td><td style="font-weight: bold; color: #678705;">'.($row['gname']?'<a href="guild-info.php?Realm={$realm}&name='.$row['gname'].'">'.$row['gname'].'</a>':'None').'</td><td class="rightNum" style="font-weight: bold;">'.$row['hh'].'</td>
</tr>';
	}
}else {
	$table = '<tr><td colspan="7">No results</td></tr>';
}
$tp->assign('table',$table);

$tp->assign('realm',$_SYSTEM->Realms[$_SYSTEM->Realm]);
if(count($_SYSTEM->Realms)>1) {
	foreach($_SYSTEM->Realms as $r) {
		$realmlist .= '<a href="honor-ranking.php?Realm='.$r.'&type='.$_GET['type'].'">'.$r.'</a>, ';
	}
}
$tp->assign('realmlist',$realmlist?'(Realms: '.substr($realmlist,0,-2).')':'');
$tp->assign('type',$_GET['type']=='hk'?'HK':'Honor');
$c->assign('content',$tp->output.'<script type="text/javascript">document.getElementById(\'char'.$_GET['type'].'\').className="selected-tab";</script>');

$c->display();
$_SYSTEM->printFooter();
?>