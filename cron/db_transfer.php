<?php
   /* CONFIG */
   $config['sourceCharDB']['host'] = '';
   $config['sourceCharDB']['user'] = '';
   $config['sourceCharDB']['passwd'] = '';
   $config['sourceCharDB']['port'] = 3306;
   $config['sourceCharDB']['name'] = '';

   $config['sourceRealmDB']['host'] = '';
   $config['sourceRealmDB']['user'] = '';
   $config['sourceRealmDB']['passwd'] = '';
   $config['sourceRealmDB']['port'] = 3306;
   $config['sourceRealmDB']['name'] = '';

   $config['sourceWorldDB']['host'] = '';
   $config['sourceWorldDB']['user'] = '';
   $config['sourceWorldDB']['passwd'] = '';
   $config['sourceWorldDB']['port'] = 3306;
   $config['sourceWorldDB']['name'] = '';

   $config['targetDB']['host'] = '';
   $config['targetDB']['user'] = '';
   $config['targetDB']['passwd'] = '';
   $config['targetDB']['port'] = 3306;
   $config['targetDB']['name'] = '';
   $config['targetWorldDB']['host'] = '';
   $config['targetWorldDB']['user'] = '';
   $config['targetWorldDB']['passwd'] = '';
   $config['targetWorldDB']['port'] = 3306;
   $config['targetWorldDB']['name'] = '';
   $errors = 0;
   /* END CONFIG */
   /* CONNECT */
   $TARGET = @mysql_connect($config['targetDB']['host'].':'.$config['targetDB']['port'],$config['targetDB']['user'],$config['targetDB']['passwd']);
   @mysql_select_db($config['targetDB']['name'],$TARGET);
   $TARGET_WORLD = @mysql_connect($config['targetWorldDB']['host'].':'.$config['targetWorldDB']['port'],$config['targetWorldDB']['user'],$config['targetWorldDB']['passwd']);
   @mysql_select_db($config['targetWorldDB']['name'],$TARGET_WORLD);
   $SOURCE = @mysql_connect($config['sourceCharDB']['host'].':'.$config['sourceCharDB']['port'],$config['sourceCharDB']['user'],$config['sourceCharDB']['passwd']);
   @mysql_select_db($config['sourceCharDB']['name'],$SOURCE);
   $SOURCE_REALM = @mysql_connect($config['sourceRealmDB']['host'].':'.$config['sourceRealmDB']['port'],$config['sourceRealmDB']['user'],$config['sourceRealmDB']['passwd']);
   @mysql_select_db($config['sourceReamDB']['name'],$SOURCE_REALM);
   $SOURCE_WORLD = @mysql_connect($config['sourceWorldDB']['host'].':'.$config['sourceWorldDB']['port'],$config['sourceWorldDB']['user'],$config['sourceWorldDB']['passwd']);
   @mysql_select_db($config['sourceWorldDB']['name'],$SOURCE_WORLD);
   if(!$TARGET || !$SOURCE) die("Cannot connect to mysql databse.\n");
   /* END CONNECT */
   /* FUNCTIONS */
   function transferTable($tableName,$guids=false,$guidField='guid',$world=false) {
   	  global $TARGET,$SOURCE,$SOURCE_WORLD,$TARGET_WORLD;
   	  $errors=0;
   	  echo "Transfering `{$tableName}` table.\n";
   	  $res = mysql_query("SELECT * FROM `{$tableName}`".($guids?'WHERE `'.$guidField.'` IN ('.$guids.')':''),$world?$SOURCE_WORLD:$SOURCE);
   	  if(!$res) die("Cannot read {$tableName} table. (".mysql_error().")\n");
   	  else "Loaded ".mysql_num_rows($res)." rows from {$tableName} table.\n";
   	  echo "Cleaning `{$tableName}` table ";
   	  if(mysql_query("DELETE FROM `{$tableName}`".($guids?'WHERE `'.$guidField.'` IN ('.$guids.')':''),$world?$TARGET_WORLD:$TARGET)) echo "- DONE\n";
   	  else die("- FAIL\n");
	   echo "Inserting data to `{$tableName}` table ";
	   while($r=mysql_fetch_assoc($res)) {
	   		$values='';
	   		foreach($r as $val) $values.="'".addslashes($val)."',";
	   		if(!mysql_query("INSERT INTO {$tableName} VALUES (".substr($values,0,-1).")",$TARGET)) {
	   			$errors++;
	   		}
	   }
	   echo "- DONE ($errors errors)\n";
	   $errors=0;
   }
   /* END FUNCTIONS */

   $res = mysql_query("SHOW TABLES",$TARGET);
   while($r = mysql_fetch_assoc($res)) {
   		if($r['Tables_in_'.$config['targetDB']['name']]=='armory_info') $found = true;
   }
   if(!$found) {
		 die("`armory_info` database not found.\n");
   }
   $res = mysql_query("SELECT * FROM `armory_info`",$TARGET);
   if(mysql_num_rows($res) $last_update = @mysql_fetch_assoc($res);
   $last_update = $last_update['characters_lastupdate'];

   /* GUILD TRANSFER */
   transferTable('guild');
   transferTable('guild_member');
   transferTable('guild_rank');
   /* END GUILD TRANSFER */
   /* ARENA TEAM TRANSFER */
   transferTable('arena_team');
   transferTable('arena_team_stats');
   transferTable('arena_team_member');
   /* END ARENA TEAM TRANSFER */
   /* WORLD DB TRANSFER */
   if($_GET['world']) {
   		transferTable('item_template',false,'guid',true);
   		transferTable('quest_template',false,'guid',true);
   		transferTable('npc_vendor',false,'guid',true);
   		transferTable('gameobject_loot_template',false,'guid',true);
   		transferTable('creature_loot_template',false,'guid',true);
   }
   /* END WORLD DB TRANSFER */
   /* CHARACTER TRANSFER */
   $res = mysql_query("SELECT `id` FROM `account` WHERE last_login > ".date("Y-m-d H:i:s",$last_update),$SOURCE_REALM);
   while($r=mysql_fetch_assoc($res)) $ids.=$r['id'].',';
   $res = mysql_query("SELECT `guid` FROM `characters` where `account` IN (".substr($ids,0,-1).") ",$SOURCE);
   if(mysql_num_rows($res)) {
	   while($r=mysql_fetch_assoc($res)) $guids.=$r['guid'].',';
	   $guids=substr($guids,0,-1);
	   transferTable('characters',$guids);
	   transferTable('character_spell',$guids);
	   transferTable('character_inventory',$guids);
	   transferTable('character_achievement',$guids);
	   transferTable('character_achievement_progress',$guids);
	   transferTable('character_reputation',$guids);
	   transferTable('character_talent',$guids);
	   transferTable('character_glyphs',$guids);
	   transferTable('item_instance',$guids,'owner_guid');
   }else echo "No characters to transfer.\n";
   /* END CHARACTER TRANSFER */

   mysql_query("DELETE FROM `armory_info` WHERE 1",$TARGET);
   mysql_query("UPDATE `armory_info` SET `characters_lastupdate` = ".time(),$TARGET);

   die("ALL DONE :)\n");
?>