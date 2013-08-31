<?php

require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('calc-tabs');
$tp->assign('DKLock', $config['mangos_version']?'':'display:none');
$tp->assign('talentdisplay','');
if($_GET['cid']) {
	$_GET['class'] = str_replace(' ','',character::classToString($_GET['cid']));
}else{
	$_GET['cid']=0;
	while($_GET['class'] != str_replace(' ','',character::classToString($_GET['cid'])) && $_GET['cid']<20) $_GET['cid']++;
}
if($_GET['cid']>15) $_GET['cid']=0;
$_GET['class'] = str_replace(' ','',character::classToString($_GET['cid']));
$_GET['class']=strtolower($_GET['class']);
if(!in_array($_GET['class'],array('deathknight','druid','mage','paladin','priest','hunter','shaman','rogue','warlock','warrior'))) 
	$_GET['class']='deathknight';
	
$tp->add('talent-calc-global');
$tp->assign('talstr',$_GET['tal']);
$tp->assign('classId',$_GET['cid']);
$tp->assign('TBCLower', $config['mangos_version']?'0':'10');
$tp->assign('treeStr',talent::makeAllTrees($_GET['cid']));

$c->assign('content',$tp->output.'<script type="text/javascript">document.getElementById("talenttab").className="selected-tab";
			document.getElementById("'.$_GET['class'].'").className="selected-subTab"</script>');

$c->display();
$_SYSTEM->printFooter();


?>