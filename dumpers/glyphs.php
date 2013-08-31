<?php
exit;
$_FPREFIX = '../';
set_time_limit(0);
exit;
include('../init.php');
$file = file_get_contents('GlyphProperties.dbc.CSV');
$lines = explode("\n",$file);

foreach($lines as $row) {
	$dane = explode(',',$row);
	$mysql->query("insert into glyphs () values(?1,?2,?3,?4)",$dane[0],$dane[1],$dane[2],$dane[3],'armory');
}
?>