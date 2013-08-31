<?php
exit;
set_time_limit(999999999);
$race = array(0=> 1,2,3,4,5,6,7,8,10,11);
$class = array(0=> 1,2,3,4,5,6,7,8,9,11);
$level = array(0=>'-default','-70','-80','');

for($i=0;$i<2;$i++)
foreach($level as $key => $level_v)
   foreach($race as $key => $race_v)
		foreach($class as $key => $class_v) {
			$url = 'portraits/wow'.$level_v.'/'.$i.'-'.$race_v.'-'.$class_v.'.gif';
			if(file_exists($url)) continue;
			$img = @imagecreatefromgif('http://www.wowarmory.com/images/'.$url);
			//if(!$img) exit;
			if($img) imagegif($img, $url);

			echo $url."\n";
		}



?>