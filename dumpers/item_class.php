<?php
exit;
$_FPREFIX = '../';
set_time_limit(0);
include('../init.php');
$file = file_get_contents('ItemSubClass.dbc.CSV');
$lines = explode("\n",$file);

foreach($lines as $row) {
	$dane = explode(',',$row);
	if($dane[27]=='""') $dane[27]=$dane[10];
	echo '$ItemSubClass['.$dane[0].']['.$dane[1].'] = '.$dane[27].';'."\n";
}
?>