<?php
exit;
$_FPREFIX = '../';
set_time_limit(0);
//exit;
include('../init.php');
$file = file_get_contents('Achievement.dbc.CSV');
$lines = explode("\n",$file);

foreach($lines as $row) {
	$dane = explode(',',$row);
	var_dump($dane);
	if($dane[38]==14961 || $dane[38]==14962 || $dane[38]==14963) $dane[39]=10;
	$mysql->query("insert into achievement () values(?1?,?2?,?3?,?4?,'?5?','?6?',?7?,?8?,?9?,?10?,?11?,?12?,?13?,?14?)",
	$dane[0],(int)$dane[1],(int)$dane[2],$dane[3],addslashes(str_replace('"','',$dane[4])),addslashes(str_replace('"','',$dane[21])),$dane[38],$dane[39],$dane[40],$dane[41],$dane[42],$dane[43],$dane[60],$dane[61],'armory');
	echo $mysql->Query.'  <font color="red">'.$dane[42].'</font><br>';
}
?>