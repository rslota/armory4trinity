<?php

header ("content-type: text/xml");

$_FPREFIX = '../';
include('../init.php');
$_SEARCH = new search_guild($_GET['name'],(int)$_GET['page']);
$data = $_SEARCH->start();

$oc = count($data)-$_SEARCH->per_page;
echo '<?xml version="1.0" encoding="utf-8"?>
<guilds>
<overcount>'.$oc.'</overcount>'."\n";
echo '<count>'.$_SEARCH->count.'</count>'."\n";
for($i=0;$i<count($data) && $i<3*$_SEARCH->per_page;$i++) {
  $temp = $data[$i];
  echo '<guild>'."\n";
  foreach($temp as $key => $value) {
	echo '<'.$key.'>'.$value.'</'.$key.'>'."\n";  
  }
 // echo '<faction>'.character::getAlliance($data[$i]['race']).'</faction>'."\n".'
 echo '</guild>'."\n";	
}
echo '</guilds>'."\n";

?>