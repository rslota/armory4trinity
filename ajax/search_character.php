<?php

header ("content-type: text/xml");

$_FPREFIX = '../';
include('../init.php');
$_SEARCH = new search_character($_GET['name'],$_GET['lvl_down'],$_GET['lvl_up'],$_GET['guildid'],$_GET['class'],(int)$_GET['page']);
$_SEARCH->set_sort($_GET['sort_by'],(int)$_GET['sort_asc']);
$_SEARCH->Realm = ((int)$_GET['RealmID'])?(int)$_GET['RealmID']:-1;
$data = $_SEARCH->start();

$oc = count($data)-$_SEARCH->per_page;
echo '<?xml version="1.0" encoding="utf-8"?>
<characters>
<overcount>'.$oc.'</overcount>'."\n";
echo '<count>'.$_SEARCH->count.'</count>'."\n";
for($i=0;$i<count($data) && $i<3*$_SEARCH->per_page;$i++) {
  if($data[$i]['honor']>1000000000) $data[$i]['honor']=0;
  $temp = $data[$i];
  echo '<character>'."\n";
  foreach($temp as $key => $value) {
    if($value=='') $value=' ';
	echo '<'.$key.'>'.$value.'</'.$key.'>'."\n";
  }
  echo '<alliance>'.character::getAlliance($data[$i]['race']).'</alliance>'."\n".'</character>'."\n";
}
echo '</characters>'."\n";

?>