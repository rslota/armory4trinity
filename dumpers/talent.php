<?php
$_FPREFIX = '../';
set_time_limit(0);
exit;
include('../init.php');
$file = file_get_contents('Talent.dbc.CSV');
$lines = explode("\n",$file);

foreach($lines as $row) {
	$dane = explode(',',$row);
	//var_dump($dane);
	$mysql->query("insert into talent () values(?1,?2,?3,?4,?5,?6,?7,?8,?9,?10)",
	$dane[0],$dane[1],$dane[2],$dane[3],$dane[4],$dane[5],$dane[6],$dane[7],$dane[8],$dane[13],'armory');
	echo mysql_error().'<br>';
}
?>