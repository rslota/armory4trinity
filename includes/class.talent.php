<?php 
class talent {

  function makeAllTrees($classId) {
  	$className = str_replace(' ','', character::classToString($classId));
  	for($i=0;$i<3;$i++) {
  		$TreeData = self::getTreeData($classId, $i);
  		$TreeData['nameESC'] = str_replace(array(' ',"'"),'', $TreeData['name']);
  		$output .= '<div class="talentTree" id="'.$className.$TreeData['nameESC'].'_tree" style="margin-right: 0px; background-image: url(\'images/talents/bg/'.$className.$TreeData['nameESC'].'.jpg\')">';
  		$output .= self::makeTree($className, $TreeData);
  		$output .= '<a class="subtleResetButton" href="javascript:void(0)" onclick="resetTalents(\''.$className.$TreeData['nameESC'].'_tree\', true);"><span>Reset</span></a>
									<div class="talentTreeInfo" style="">
									<span id="treeName_'.$className.$TreeData['nameESC'].'_tree" style="font-weight: bold;">'.$TreeData['name'].'</span> &nbsp;<span id="treespent_'.$className.$TreeData['nameESC'].'_tree">0</span>
									</div>
									</div>';
  	}
  	return $output;
  }
  
  function makeTree($className,$treeData) {
  	global $mysql;
  	$talents = $mysql->getRows("select * from talent where ref_tab = ?1 order by row,col", $treeData['id'], 'armory');
  	$crrTier = -1;
  	$open = 0;
  	foreach($talents as $talent) {
  		// Add new tier
  		if($talent['row']!=$crrTier) {
  			if($crrTier != -1) $output .= '</div>';
  			$crrTier = $talent['row']; 
  			$output .= '<div class="tier" id="'.$className.$TreeData['nameESC'].'_tier'.$crrTier.'">';
  			$open++;
  		}
  		// Get max rank
  		$maxRank = 1;
  		while($talent['rank'.$maxRank]) $maxRank++; $maxRank--;
  		
  		// Get spell data
  		for($i=1;$i<=$maxRank;$i++) $rankData[$i] = getSpell($talent['rank'.$i]);
  		$talentName = str_replace(array(' ',"'"),'', $rankData[1]['SpellName']);
  		// Get icon
  		$icon = $mysql->getRow("select name from spellicon where id = ?1", $rankData[1]['SpellIconID'], 'armory');
  		
  		if($req=$mysql->getRow("select rank1 from talent where id = ?1", $talent['req_talent'])) {
  			$req = getSpell($req['rank1']);
  			$req = str_replace(array(' ',"'"),'', $req['SpellName']);
  		}
  		
  		$output .= '<div class="talent staticTip col'.$talent['col'].'" id="'.$talentName.'_iconHolder" style="background-image:url(\'images/icon43/'.$icon['name'].'.gif\');">';
  		$output .= '<div class="talentHolder tier'.($talent['row']+1).' '.($req?'requires t_'.$req:'').' disabled" id="'.$talentName.'" onmousedown="addTalent(event, \''.$talentName.'\');" onmouseover="makeTalentTooltip(\''.$talentName.'\');">';
  		for($i=1;$i<=$maxRank;$i++) $output .= '<span id="rank'.($i).'_'.$talentName.'" style="display: none">'.spellReplace($rankData[$i]).'</span>';
  		$output .= '<div class="iconhighlight"></div>
				<span id="'.$talentName.'_name" style="display: none;">'.$rankData[1]['SpellName'].'</span><span id="'.$talentName.'_icon" style="display: none;">'.$icon['name'].'</span>
				<div class="rankCtr">
				<span id="count_'.$talentName.'">0</span><span>/</span><span id="total_'.$talentName.'">'.$maxRank.'</span>
				</div>
				</div>
				</div>';
  	}
  	$output.='</div>';
    while($open<=10) {
    	$output .= '<div class="tier" id="'.$className.$TreeData['nameESC'].'_tier'.$open.'">.</div>';
    	$open++;
    }
  	
  	return $output;
  }
  
  function getTreeData($classId,$treeId) {
  	global $mysql;
  	return $mysql->getRow("select name,id from talenttab where refmask_chrclasses = ?1 and tab_number = ?2", pow(2,($classId-1)), $treeId, 'armory');
  }
}
?>