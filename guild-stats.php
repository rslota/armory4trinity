<?php
require('init.php');
$c->add('main');
$c->assign('menu',$menu->output);
$tp = new template();
$tp->add('guild-stats');
$tabs = new template();
$tabs->add('guild-global-tabs');
if($_GET['characterName']) {
	$tabs->assign('name',$_GET['characterName']);
	$tabs->assign('mode','&characterName='.$_GET['characterName']);
}else {
	$tabs->assign('charactertabdisplay',' style="display:none;"');
	$tabs->assign('mode','');
}
$tp->assign('tabs','<script type="text/javascript">characterTab = \'guild\';characterSubTab=\'stats\';</script>'.$tabs->output);

include('sections/guild.php');

foreach($guild->membersList as $member) {
	$list .='<script type="text/javascript">	
			theRace	 = '.$member['race'].';
			theClass	= '.$member['class'].';
			theLevel	= '.$member['level'].';
			theGender	= '.$member['gender'].';	
			completeArray[x]=[theRace, theClass, theLevel, theGender];
			x++;
			
			if (theFaction == 0){
				if (theRace== 1 || theRace== 3 || theRace== 4 || theRace== 7 || theRace== 11) {
					thisRaceArray = allianceRaceArray;
					theFaction	  = "a";
				}else {
					thisRaceArray = hordeRaceArray;
					theFaction	  = "h";
				}
			
				raceMax = 0;
				
				var raLength = thisRaceArray.length;
				
				for(i = 0; i < raLength; i++) {
					newRaceMax = thisRaceArray[i][1];
					if (raceMax < newRaceMax){
						raceMax=newRaceMax;
					}
				}		
			}
		
		</script><script src="js/guild/guild-stats.js"></script>';
}

$tp->assign('members_list',$list);


$c->assign('content',$tp->output);
$c->display();
$_SYSTEM->printFooter();

?>
