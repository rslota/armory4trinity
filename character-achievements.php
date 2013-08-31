<?php

require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('character-empty');
$tabs = new template();
$tabs->add('character-global-tabs');
$tp->assign('tabs','<script type="text/javascript">characterTab = \'character\';characterSubTab=\'achievements\';</script>'.$tabs->output);

include('sections/character.php');



$a .= '<table cellspacing="0" cellpadding="0" class="achievement"><tbody>
<tr><td id="a_category" class="a_cat"><div class="a_topcat"></div>';
$a .= '<div class=a_bodycat><a id=ach_0 href="javascript:void(0)" onclick=\'selectCat(0);\'>Summary</a></div>';;
$bcat = $mysql->getRows("SELECT * FROM `achievement_category` WHERE `parent` = '-1' AND `id` <> 1 ORDER BY `sortOrder`",'armory');
foreach ($bcat as $cat) {
    $a .= '<div class=a_bodycat>'.
	'<a id="ach_'.$cat['id'].'" href="javascript:void(0)" onclick="selectCat('.$cat['id'].');">'.$cat['name'].'</a>';
    $scat = $mysql->getRows("SELECT * FROM `achievement_category` WHERE `parent` = ?1 ORDER BY `sortOrder`",$cat['id'],'armory');
		if($scat)
		   foreach ($scat as $sub)
		     $a .= '<a id="ach_'.$sub['id'].'" class=sub href="javascript:void(0)" onclick="selectCat('.$sub['id'].');">'.$sub['name'].'</a>';
    $a .= '</div>';
  }
  $a .= '</div><div class=a_bottomcat></div></td>
<td class="a_data"><div class="a_topdata"></div><div id="a_data" class="a_bdydata"></div><div class="a_btmdata"></div></td></tr></tbody></table>
<script type="text/javascript">selectCat(0);</script>';

$tp->assign('achievements',$a);

$tp->assign('rep',$a);
$c->assign('content',$tp->output);

$c->display();
$_SYSTEM->printFooter();

?>