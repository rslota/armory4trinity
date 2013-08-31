<?php

require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('character-empty');
$tabs = new template();
$tabs->add('character-global-tabs');
$tp->assign('tabs','<script type="text/javascript">characterTab = \'character\';characterSubTab=\'talents\';</script>'.$tabs->output);

include('sections/character.php');


$tp2 = new template();
//$tp2->add('talents/'.str_replace(' ','',strtolower($character->classToString($character->class))).'_'.($config['mangos_version']==0?'old':'new'));
$tp2->add('talent-calc-global');
$tp2->assign('classId',$character->guid);
$tp2->assign('TBCLower', $config['mangos_version']?'0':'10');
$tp2->assign('treeStr',talent::makeAllTrees($character->class));
$tp2->assign('talstr',$character->talentLink[$character->activeSpec]);
$script = '<script type="text/javascript">lockTalents();
var talentStr_0 = "'.$character->talentLink[0].'";
var talentStr_1 = "'.$character->talentLink[1].'";
</script>';

// Glyphs
for($spcN=0;$spcN<2 && $config['mangos_version']!==0;$spcN++) {
	$ct=$ct2=3;
	$gp1[$spcN] = $gp2[$spcN] = '';
	foreach($character->Glyphs[$spcN] as $glyph) {

		if($glyph['type']==0) {
			$ct--;
			$gp1[$spcN] .= '<div class="glyph major staticTip" onmouseover="makeGlyphTooltip(&quot;'.$glyph['name'].'&quot;,&quot;Major Glyph&quot;,&quot;'.$glyph['desc'].'&quot;)">
	<span><img class="majorGlyphIcon" src="images/talents/glyph-major-1.gif">'.$glyph['name'].'<div class="glyphTypeText">Major Glyph</div></span></div>';
		}else if($glyph['type']==1) {
			$ct2--;
			$gp2[$spcN] .= '<div class="glyph minor staticTip" onmouseover="makeGlyphTooltip(&quot;'.$glyph['name'].'&quot;,&quot;Minor Glyph&quot;,&quot;'.$glyph['desc'].'&quot;)">
	<span><img class="majorGlyphIcon" src="images/talents/glyph-minor-1.gif">'.$glyph['name'].'<div class="glyphTypeText">Minor Glyph</div></span></div>';
		}
	}
	while($ct--) {
		$gp1[$spcN] .= '<div class="glyph major staticTip emptyGlyph" onmouseover="setTipText(\'Empty Major Glyph\')">
	<span>Empty<div class="glyphTypeText">Major Glyph</div></span></div>';
	}
	while($ct2--) {
		$gp2[$spcN] .= '<div class="glyph minor staticTip emptyGlyph" onmouseover="setTipText(\'Empty Minor Glyph\')">
	<span>Empty<div class="glyphTypeText">Minor Glyph</div></span></div>';
	}
}
$src0 = $character->talentSpec[0]['nr'] ? ($character->talentSpec[0]['nr']==-1?$_DOMAIN.'images/icons/class/talents/hybrid.gif':$_DOMAIN.'images/icons/class/'.$character->class.'/talents/'.$character->talentSpec[0]['nr'].'.png') : $_DOMAIN.'images/icons/class/talents/untalented.gif';
$src1 = $character->talentSpec[1]['nr'] ? ($character->talentSpec[1]['nr']==-1?$_DOMAIN.'images/icons/class/talents/hybrid.gif':$_DOMAIN.'images/icons/class/'.$character->class.'/talents/'.$character->talentSpec[1]['nr'].'.png') : $_DOMAIN.'images/icons/class/talents/untalented.gif';

$talentSwitcherHTML = '<div class="talentSpecSwitchHolder" style="display:'.($character->specCount>1?'block':'none').'"><table class="talentSpecSwitch"><tbody><tr>
<td id="group_0" class=""><a class="'.($character->activeSpec?'inActiveTalents':'activeTalents').'" href="javascript:void(0)" id="group_0_link" onclick="switchSpec(0)"><div><img src="'.$src0.'" border="0">'.$character->talentSpec[0]['name'].'</div></a><div class="buildPointer"><!----></div></td>
<td id="group_1" class=""><a class="'.(!$character->activeSpec?'inActiveTalents':'activeTalents').'" href="javascript:void(0)" id="group_1_link" onclick="switchSpec(1)"><div><img src="'.$src1.'" border="0">'.$character->talentSpec[1]['name'].'</div></a><div class="buildPointer"><!----></div></td>
</tr></tbody></table></div>';

$glyphs = '<div id="talContainer" style=" background: none; height:auto;">
<div class="talentFrame" style=" background: none; height:50px !important;">
<div class="filterTitle" id="glyphsLabel" style="margin:0px;">Glyphs</div>
</div>
</div>
<div id="glyphHolder">
<div id="glyphSet_0">
'.$gp1[0].'
<div class="clear"></div>
'.$gp2[0].'
</div>
<div id="glyphSet_1">
'.$gp1[1].'
<div class="clear"></div>
'.$gp2[1].'
</div>
</div>
<div class="glyphHolderBottom"></div>';

if($config['mangos_version']==0) $glyphs='';

$tp->assign('rep',$talentSwitcherHTML.$tp2->output.$script.$glyphs.'<script type="text/javascript">switchSpec('.$character->activeSpec.');</script>');
$c->assign('content',$tp->output);

$c->display();
$_SYSTEM->printFooter();

?>