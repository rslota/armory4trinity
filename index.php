<?php
require_once('init.php');
$c->add('home');

$c->assign('menu',$menu->output);

$c->assign('menu'.$_PAGE,'menu_selected');
$_LANGUAGE->translate($c); // To wipe out. Soon...
$c->display();
$_SYSTEM->printFooter();

?>