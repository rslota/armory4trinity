<?php
exit;
$_FPREFIX = '../';
set_time_limit(0);
//exit;
include('../init.php');
$file = file_get_contents('Achievement_Criteria.dbc.CSV');
$lines = explode("\n",$file);

foreach($lines as $row) {
	$dane = explode(',',$row);
	//var_dump($dane);
	$mysql->query("insert into achievement_criteria () values(?1?,?2?,?3?,?4?,?5?,'?6?',?7?,?8?,?9?,'?10?',?11?,?12?,?13?,?14?,?15?)",
	$dane[0],(int)$dane[1],(int)$dane[2],$dane[3],$dane[4],$dane[5],$dane[6],$dane[7],$dane[8],addslashes(str_replace('"','',$dane[9])),$dane[26],$dane[27],$dane[28],$dane[29],$dane[30],'armory');
	echo mysql_error().'<br>';
}
?>