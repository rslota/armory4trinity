<?php

header ("content-type: text/xml");

$_FPREFIX = '../';
include('../init.php');
$_SEARCH = new search_item(nameToDB($_GET['name']),(int)$_GET['page']);
if(isset($_GET['ItemClass'])) $_SEARCH->ItemClass = (int)$_GET['ItemClass'];
if(isset($_GET['ItemSubClass'])) $_SEARCH->ItemSubClass = (int)$_GET['ItemSubClass'];
$data = $_SEARCH->start();

$oc = count($data)-$_SEARCH->per_page;
echo '<?xml version="1.0" encoding="utf-8"?>
<items>
<overcount>'.$oc.'</overcount>'."\n";
echo '<count>'.$_SEARCH->count.'</count>'."\n";
for($i=0;$i<count($data) && $i<$_SEARCH->per_page;$i++) {
  $temp = $data[$i];
  echo '<item>'."\n";
  foreach($temp as $key => $value) {
    if($value=='') $value=' ';
	echo '<'.$key.'>'.$value.'</'.$key.'>'."\n";
  }
  echo '<category>'.system::htmlcode($ItemClass[$temp['class']]).'</category>'."\n";
  echo '<subcategory>'.system::htmlcode($ItemSubClass[$temp['class']][$temp['subclass']]).'</subcategory>'."\n";
  echo '</item>'."\n";
}
echo '</items>'."\n";

?>