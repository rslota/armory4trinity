<?php
exit;
$_FPREFIX = '../';
set_time_limit(0);
//exit;
include('../init.php');
$file = file_get_contents('SpellIcon.dbc.CSV');
$lines = explode("\n",$file);

foreach($lines as $row) {
	$dane = explode(',',$row);
	//var_dump($dane);
	$mysql->query("insert into spellicon () values(?1,'?2')",
	$dane[0],strtolower(basename(addslashes(str_replace('"','',$dane[1])))),'armory');
	echo $mysql->Query.'<br>';
}
?>