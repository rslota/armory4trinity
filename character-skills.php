<?php

require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('character-empty');
$tabs = new template();
$tabs->add('character-global-tabs');
$tp->assign('tabs','<script type="text/javascript">characterTab = \'character\';characterSubTab=\'skills\';</script>'.$tabs->output);

include('sections/character.php');


foreach($character->skills as $key => $value) {
	if(!count($value['data'])) continue;
	$skills.= "<div class=\"inner-cont\">
	<table class=\"iht\">
	<tr>
	<td class=\"ihl\"><span class=\"skill-".strtolower(str_replace(' ','',$value['category_name']))."\">
	<p>".$value['category_name']."</p>
	</span></td><td class=\"ihrc\"></td>
	</tr>
	</table>
	<table>
	<tr>
	<td class=\"il\"></td><td class=\"ibg\">
	<div class=\"profile-wrapper\">";
	foreach($value['data'] as $value2) {
		$skills.= "<div class=\"rep".(($value2[2]+$value2[3])?'7':'3')."\">
		<div class=\"rep-lbg\">
		<div class=\"rep-lr\">
		<div class=\"rep-ll\">
		<ul>
		<li class=\"faction-name\">
		<a href=\"#\" ".($value2[4]?"onMouseOut=\"tooltip_hide();\" onMouseOver=\"tooltip('".addslashes(str_replace("\"","'",$value2[4]))."');\"":'').">".$value2[1]."</a>
		</li>
		<li class=\"faction-bar\">
		<a class=\"rep-data\">".(($value2[2]+$value2[3])?"{$value2[2]}/{$value2[3]}":'')."</a>
		<div class=\"bar-color\" style=\" width: ".(($value2[2]+$value2[3])?(100*$value2[2]/$value2[3]):'100')."%\"></div>
		</li>
		</ul>
		</div>
		</div>
		</div>
		</div>";
	}
	$skills.="</div>
	</td><td class=\"ir\"></td>
	</tr>
	<tr>
	<td class=\"ibl\"></td><td class=\"ib\"></td><td class=\"ibr\"></td>
	</tr>
	</table>
	</div>";

}
$tp->assign('rep',$skills);
$c->assign('content',$tp->output);

$c->display();
$_SYSTEM->printFooter();

?>