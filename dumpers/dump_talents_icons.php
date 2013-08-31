<?php
exit;
set_time_limit(0);
$class = array('warrior','paladin','hunter','rogue','priest','deathknight','shaman','mage','warlock','druid');
foreach($class as $c) {
	for($i=1;$i<4;$i++) {
	   $img  = imagecreatefromjpeg('http://static.wowhead.com/images/talent/classes/backgrounds/'.$c.'_'.$i.'.jpg');
	   imagejpeg($img,'bg/'.$c.'_'.$i.'.jpg');
	}
	for($i=1;$i<4;$i++) {
	   $img  = imagecreatefromjpeg('http://static.wowhead.com/images/talent/classes/icons/'.$c.'_'.$i.'.jpg');
	   imagejpeg($img,$c.'_'.$i.'.jpg');
	}
}

?>