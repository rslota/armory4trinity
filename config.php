<?php
                                // DATABASE SETUP //
// Armory Database settings
$config['armory_DB_user']='user'; // User name for armory database
$config['armory_DB_passwd']='passwd'; // Password for armory database
$config['armory_DB_host']='host'; // Host of armory database
$config['armory_DB_port']=3306; // Port of armory database
$config['armory_DB_name']='armory'; // Name of armory database

// World Database settings
$config['world_DB_user']='user'; // User name for main world database
$config['world_DB_passwd']='passwd'; // Password for main world database
$config['world_DB_host']='host'; // Host of  main world database
$config['world_DB_port']=3306; // Port of main world database
$config['world_DB_name']='trinity_world'; // Name of main world database

// Realm Database settings
$config['realm_DB_user']='user'; // User name for realm database
$config['realm_DB_passwd']='passwd'; // Password for realm database
$config['realm_DB_host']='host'; // Host of  realm database
$config['realm_DB_port']=3306; // Port of realm database
$config['realm_DB_name']='trinity_realmd'; // Name of realm database


                              // REALMLIST SETUP //

// Realm list - ID,'Host',Port,'user','passwd','DBname',isDeafultRealm(true or false)

$config['realms'][] = array(1, 'host',3306,'user','passwd','trinity_char',true);
//$config['realms'][] = array(2, 'host',3306,'user','passwd','trinity_char3',false);


                                          // SCRIPT SETTINGS //
$config['server_name'] = 'Test Server'; // You can setup links in tamplets/menu.tpl (search for 'Link1').
$config['server_link'] = 'Test Server';
$config['icon_updater'] = 0;
$config['language_change'] = false; /* !LANGUAGE CHANGE IS NOT LONGER SUPPORTED! true - language changing mode on, false - use default language !PL LANGUAGE FILE IS NOT COMPLATE! (languages/pl.lng) */
$config['language'] = 'en'; /* default language */
$config['cache_status'] = false; // true - use cache system (recommended)
$config['cache_expire'] = 60*60*12; // cache update time in seconds
$config['ladder_rows_limit'] = 50;
$config['mangos_version'] = 2; // 2 - 3.1.3, 1 - 3.0.9, 0 - 2.4.3 !WARRNING: For v. 3.0.9 and 3.1.3 without dual-spec, you have to downgrade this script to revision 220.

// Engine defines

$_DOMAIN = str_replace('ajax/','','http://'.$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']));
$config['templates_dir'] = 'templates/';

?>