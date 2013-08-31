<?php
exit;
include('init.php');
$file=file_get_contents('SpellItemEnchantment.dbc.csv');
$file=explode("\n",$file);
$i=0;
foreach($file as $row) {
	$r=explode(',',$row);
	$r[14]=str_replace('"','',$r[14]);
	if(mysql_query("insert into `{$config['armoryDB']}`.itemenchant () values ('$r[0]','{$r[14]}')")) $counter++;
}
echo $counter;
?>