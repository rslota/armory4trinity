<?php

require_once($_FPREFIX.'config.php');
@session_start();
/* Ładowanie klas */
if($dr = opendir($_FPREFIX.'includes')) {
    while (false !== ($file = readdir($dr))) {
	    if($file=='.' || $file=='..' || strpos($file,'.php')!=(strlen($file)-4) || strpos($file,'.php')===false || !is_file($_FPREFIX.'includes/'.$file)) continue;
        require_once($_FPREFIX.'includes/'.$file);
	}
    closedir($dr);
}

switch($_GET['set_lang']) {
	case 'pl': setcookie('language','pl',time()+60*60*24*30); header('Location: '.$_DOMAIN); exit;
	case 'en': setcookie('language','en',time()+60*60*24*30); header('Location: '.$_DOMAIN); exit;
	default: break;
}
if( ($_COOKIE['language']=='en' || $_COOKIE['language']=='pl') && $config['language_change'])
   $config['language'] = $_COOKIE['language'];

/* Tworzenie obiektów */
$_SYSTEM = new system;
$mysql = new mysql;
$_SYSTEM->postConfig();
$_LANGUAGE = new language($config['language']);

foreach($_GET as $key => $value)
   $_GET[$key] = $_SYSTEM->escape($value);


$c = new template();
$c->add('headers');
$c->assign('searchQuery',$_GET['searchQuery']);
$c->assign('title','The World of Warcraft Armory');
$_LANGUAGE->translateJS($c);

$menu = system::makeMenu();

?>