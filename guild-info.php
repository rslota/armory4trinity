<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('guild-info');
$tabs = new template();
$tabs->add('guild-global-tabs');
if($_GET['characterName']) {
	$tabs->assign('name',$_GET['characterName']);
	$tabs->assign('mode','&characterName='.$_GET['characterName']);
}else {
	$tabs->assign('charactertabdisplay',' style="display:none;"');
	$tabs->assign('mode','');
}
$tp->assign('tabs','<script type="text/javascript">characterTab = \'guild\';characterSubTab=\'roster\';</script>'.$tabs->output);

include('sections/guild.php');


$c->assign('content',$tp->output);
$c->assign('rep','');
$c->display();
$_SYSTEM->printFooter();
?>
