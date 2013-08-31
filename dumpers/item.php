<?php
exit;
set_time_limit(0);
$_DOMAIN = str_replace('dumpers/','',$_DOMAIN);
$_FPREFIX = '../';
include('../init.php');
if(!$_GET['stat']) $_GET['stat'] = $argv[1];
 $r=$mysql->getRow("select entry from `item_template` LIMIT {$_GET['stat']}, 1",'world');
 $r2=$mysql->getRow("select itemicon from `itemicon` where itemnumber = ?1",$r['entry'],'armory');
 if(trim($r2['itemicon'])=='') {
	 echo 'ID: '.$r['entry'];
	 if($r['entry']) $_SYSTEM->update_icon_db($r['entry'],true);
 }else echo 'Skipped';
 $_GET['stat']++;
 echo '<META HTTP-EQUIV=Refresh CONTENT="0;url=item.php?stat='.$_GET['stat'].'">';
?>