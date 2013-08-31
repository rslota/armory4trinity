<?php

require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('calc-tabs');
$tp->add('arena-calc');
$tp->assign('talentdisplay','style="display:none;"');
$c->assign('content',$tp->output.'<script type="text/javascript">document.getElementById("arenatab").className="selected-tab";</script>');

$c->display();
$_SYSTEM->printFooter();


?>