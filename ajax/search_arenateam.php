<?php

header ("content-type: text/xml");

$_FPREFIX = '../';
include('../init.php');
$_SEARCH = new search_arenateam($_GET['name'],(int)$_GET['page']);
$data = $_SEARCH->start();

$oc = count($data)-$_SEARCH->per_page;
echo '<?xml version="1.0" encoding="utf-8"?>
<arenateams>
<overcount>'.$oc.'</overcount>'."\n";
echo '<count>'.$_SEARCH->count.'</count>'."\n";
for($i=0;$i<count($data) && $i<3*$_SEARCH->per_page;$i++) {
  $temp = $data[$i];
  echo '<arenateam>'."\n";
  foreach($temp as $key => $value) {
	echo '<'.$key.'>'.$value.'</'.$key.'>'."\n";  
  }
 echo '</arenateam>'."\n";	
}
echo '</arenateams>'."\n";

?>