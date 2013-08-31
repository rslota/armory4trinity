<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);

$tp = new template();
$search = new search($_GET['searchQuery']);
if(isset($_GET['ItemClass'])) $search->ItemClass = (int)$_GET['ItemClass'];
if(isset($_GET['ItemSubClass'])) $search->ItemSubClass = (int)$_GET['ItemSubClass'];
$count = $search->getNumRows();
$sections = array('Characters','Guilds','Arena Teams','Items');

if($_GET['searchType']=='characters') $count[1]=$count[2]=$count[3]=0;
else if($_GET['searchType']=='guilds') $count[0]=$count[2]=$count[3]=0;
else if($_GET['searchType']=='arenateams') $count[1]=$count[0]=$count[3]=0;
else if($_GET['searchType']=='items') $count[1]=$count[0]=$count[2]=0;

$selected='selected-';
foreach($sections as $key => $sec) {
	if(!$count[$key]) continue;
	if(isset($selected)) $d = $key;
	$tabs .= '<script type="text/javascript">ItemClass='.$search->ItemClass.';ItemSubClass='.$search->ItemSubClass.';</script><div class="'.$selected.'tab" id="'.$key.'"><a href="javascript:selectSearchTab('.$key.')">'.$sec.'<span class="tab-count" style="display: inline;">('.$count[$key].')</span></a></div>';
	unset($selected);
}
if($tabs) {
	$tp->add('search');
	$tp->assign('tabs',$tabs);
	$tp->assign('selected',$d);
}else $tp->add('noresults');
$c->assign('content',$tp->output);
$c->display();
$_SYSTEM->printFooter();
?>