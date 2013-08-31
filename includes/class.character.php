<?php
class character {

  public $lastupdate;

  public $guid;
  public $name;
  public $race;
  public $class;
  public $gender;
  public $level;
  public $guild_id,$guild,$guild_rank;
  public $played;
  public $items;
  public $realm;
  public $gold;
  public $honor;
  public $hk;
  public $items_names;
  public $arenapoints,$arena_team=array();

  public $item_tooltips;
  public $item_instance;

  public $prof_1;
  public $prof_2;
  public $skills;
  public $talentCount = array(array(0,0,0),array(0,0,0)), $talentSpec, $talentLink, $talentInfo = array(), $activeSpec = 0, $specCount = 1;

  public $achievement = array(),$achievement_progress = array();
  public $Glyphs = array(array(),array());

  public $data;

  public $stats; // No i mamy sobie statystyki. Ale jakie...?
  /* strength_bonus, agility_bonus, stamina_bonus, intellect_bonus, spirit_bonus, strength_base, agility_base, stamina_base, intellect_base, spirit_base, armor_bonus, armor_base, defence_rating, dodge, parry, block, holy_res, fire_res, frost_res, shadow_res, nature_res, arcane_res, melee_damage_min, melee_damage_max, melee_damage_min_off, melee_damage_max_off, melee_speed, melee_speed_off, melee_ap_base, melee_ap_bonus, meele_hit_rating, meele_crit_rating, melee_crit, melee_crit_off, ranged_damage_min, ranged_damage_max, ranged_speed, ranged_ap_base, ranged_ap_bonus, ranged_hit_rating, ranged_crit_rating, ranged_crit, spell_bonus_holy, spell_bonus_fire, spell_bonus_nature, spell_bonus_frost, spell_bonus_shadow, spell_bonus_arcane, spell_bonus, spell_bonus_healing, spell_hit_rating, spell_crit_rating, spell_crit_holy, spell_crit_fire, spell_crit_nature, spell_crit_frost, spell_crit_shadow, spell_crit_arcane, spell_crit */ // Takie :)

  public $online;

  function __construct($guid) {
	  global $config,$SQL,$mysql,$_SYSTEM;
	  $this->guid=-1;

	  $r = $mysql->getRow("SELECT characters.*,?1 as gender,guild.name as guild
	  FROM `characters` left join guild_member on characters.guid = guild_member.guid
	  left join guild on guild.guildid = guild_member.guildid WHERE characters.guid = ?2",CHAR_GENDER_OFFSET,$guid,SQL_template(CHAR_GUILD_OFFSET),SQL_template(CHAR_GUILD_OFFSET+1),'char');
	  if($r===0) $_SYSTEM->error('Character not found!');
	  else if($r===false) $_SYSTEM->error('SQL query error! Check character database structure.');
	  // Ustawienie bazowych informacji
	  $this->guid = $guid;
	  $this->name = $r['name'];
	  $this->class = $r['class'];
	  $this->race = $r['race'];
	  $this->online = $r['online'];
	  $this->gender = $r['gender'];
	  $this->guild_id = $r['guildid'];
	  $this->guild = $r['guild'];
	  $this->activeSpec = (int)$r['activespec'];
	  $this->specCount = $r['speccount'];
	  $this->data = explode(' ', $r['data']);
	  $this->honor = $r['totalHonorPoints'];
	  $this->hk = $r['totalKills'];
	  $this->arenapoints = $r['arenaPoints'];
	  $this->gold = $this->data[MONEY_OFFSET];
	  $this->level = $this->data[CHAR_LEVEL_OFFSET];
	  $t_time = $r['totaltime'];
  	  $t_days = (int)($t_time/86400);
      $t_time = $t_time - ($t_days*86400);
      $t_hours = (int)($t_time/3600);
  	  $t_time = $t_time - ($t_hours*3600);
  	  $t_min = (int)($t_time/60);
	  $this->played[0] = $t_days;
	  $this->played[1] = $t_hours;
	  $this->played[2] = $t_min;
	  $this->realm = $_SYSTEM->Realms[$_SYSTEM->Realm];
	  $this->guild_id = $this->data[CHAR_GUILD_ID_OFFSET];

	  $this->stats = $this->read_stats();

	  $this->read_skills();

	  $this->sort_skills();

	  if($config['mangos_version']!==0) $this->load_glyphs();

	  $this->load_arena_info();

	  $this->read_items();

	  $this->load_reputation();

	  $this->load_tooltips();

	  $this->load_talents();

	  if($config['mangos_version']!==0) $this->load_achievements();

	  $this->lastupdate = time();

	  return true;
  }

  function load_glyphs() {
	  	global $mysql;
	  	for($spcN=0;$spcN<2;$spcN++) {
	  		$ids='';
		  	$glyphs = $mysql->getRow("select * from character_glyphs where guid = ?1 and spec = ?2",$this->guid,$spcN,'char');
			for($i=1;$i<=6;$i++) {
				$ids .= $glyphs['glyph'.$i].',';
			}
			$r = $mysql->getRows("select glyphs.type as gtype,glyphs.id as glyphid, spell.* from glyphs,spell where glyphs.spellid = spell.id and glyphs.id in (?1-1)",$ids,'armory');
			if(!$r) return;

			foreach($r as $row) {
				$this->Glyphs[$spcN][$row['glyphid']]['name'] = $row['SpellName'];
				$this->Glyphs[$spcN][$row['glyphid']]['desc'] = spellReplace($row);
				$this->Glyphs[$spcN][$row['glyphid']]['type'] = $row['gtype'];
			}
		}
  }

  function load_arena_info() {
		  global $mysql;
		  $r = $mysql->getRows("select arena_team_member.personal_rating as rating, arena_team.* from arena_team,arena_team_member where arena_team.arenateamid=arena_team_member.arenateamid and arena_team_member.guid = ?1",$this->guid,'char');
		  if(!$r) return;
		  foreach($r as $row) {
			  	foreach($row as $key => $col)
				   $this->arena_team[$row['type']][$key]=$col;
		  }

  }

  function load_achievements() {
	  global $mysql,$config;
	  $r = $mysql->getRows("select * from character_achievement where guid = ?1",$this->guid,'char');
	  if(!$r) return;
	  foreach($r as $row) {
		  $this->achievement[$row['achievement']] = $row['date'];
	  }
	  $r = $mysql->getRows("select * from character_achievement_progress where guid = ?1",$this->guid,'char');
	  foreach($r as $row) {
		  $this->achievement_progress[$row['criteria']]['date'] = $row['date'];
		  $this->achievement_progress[$row['criteria']]['counter'] = $row['counter'];
	  }

  }

  function load_talent_info($list,$base) {
	  global $mysql,$config;
	  $d = $mysql->getRows("SELECT * FROM `spell` WHERE `id` IN (?1-1)",$list,'armory');
	  if(!$d) return;
	  foreach($d as $spell) {
		  $this->talentInfo[$base[$spell['id']][1]]['description'] = spellReplace($spell);
		  $this->talentInfo[$base[$spell['id']][1]]['name'] = $spell['SpellName'];
		  $this->talentInfo[$base[$spell['id']][1]]['id'] = $spell['id'];
		  $this->talentInfo[$base[$spell['id']][1]]['sBase'] = $base[$spell['id']][0];
	  }
  }

  function load_talents() {
		global $mysql,$config;
		$this->talentSpec[0]['name'] = 'untalented';
		$this->talentSpec[0]['nr'] = false;
		$this->talentSpec[1]['name'] = 'untalented';
		$this->talentSpec[1]['nr'] = false;
		$max = array(0,0);
		$specs = $mysql->getRows("SELECT id,name FROM `talenttab` WHERE `refmask_chrclasses` = '?1' order by tab_number",
							 pow(2,($this->class-1)),'armory');
		for($spcN=0;$spcN<2;$spcN++) {
		$talentLink = '';
		if($config['mangos_version']!==0) 
			$spells = $mysql->getRows("SELECT `spell`,`spec` FROM `character_talent` WHERE `guid` = '?1' AND `spec` = ?2",
									  $this->guid,$spcN,'char');
		else {
			if($spcN==0) {
				$spells = $mysql->getRows("SELECT `spell`, '0' as `spec` FROM `character_spell` WHERE `guid` = '?1'",
									  $this->guid,'char');
			}
		}
		for($i=0; $i<3; $i++) {
			$c=0;
			$spec = $specs[$i];
			$talents = $mysql->getRows("SELECT rank1, rank2, rank3, rank4, rank5 FROM `talent` WHERE `ref_tab` = '?1' order by row,col",
										   $spec['id'],'armory');
			foreach($talents as $key => $value) {
				$ids .= $value['rank1'].',';
			}
			if($spells)
			foreach($spells as $k => $v) {
				$spell_ids.=$v['spell'].',';
			}
			$r = $mysql->getRows("SELECT id,SpellName FROM `spell` WHERE `id` IN (?1-1)",$ids.$spell_ids,'armory');
	
			foreach($r as $row) {
				$SpellNames.="'".addslashes($row['SpellName']).'\',';
				$NameToId[arrayName($row['SpellName'])] = $row['id'];
			}
			$r = $mysql->getRows("SELECT id,SpellName,Rank FROM `spell` WHERE Rank LIKE 'Rank %' and `SpellName` IN (?1)", substr($SpellNames,0,-1),'armory');
			//die($mysql->Query);
	  		if($r) {
	  			foreach($r as $row) {
					$Ranks[$NameToId[arrayName($row['SpellName'])]][3] = $row['SpellName'];
					if($row['Rank']=='Rank 1') $Ranks[$NameToId[arrayName($row['SpellName'])]][0] = $row['id'];
					else {
						$row['Rank'] = explode(' ',$row['Rank']);
						$row['Rank'] = $row['Rank'][1];
						if($row['Rank']>$Ranks[$NameToId[arrayName($row['SpellName'])]][2]) {
							$Ranks[$NameToId[arrayName($row['SpellName'])]][2] = $row['Rank'];
							$Ranks[$NameToId[arrayName($row['SpellName'])]][1] = $row['id'];
						}
					}
				}
			}
			if($spells) {
	
				foreach($talents as $key => $value) {
					$add='0';
					$c=0;
					$rank_1 = $Ranks[$value['rank1']][1];
					$crr = $value['rank1'];
					foreach($spells as $k => $v) {
						if(in_array($v['spell'],$value)) {
							switch(array_search($v['spell'], $value)) {
								case "rank1": $c = 1;$add='1'; break;
								case "rank2": $c = 2;$add='2'; break;
								case "rank3": $c = 3;$add='3'; break;
								case "rank4": $c = 4;$add='4'; break;
								case "rank5": $c = 5;$add='5'; break;
							}
							$crr = $value['rank'.$add];
						}else if(in_array($Ranks[$v['spell']][0],$value)) {
							$c = 1;$add='1';
							$crr=$v['spell'];
							$rank_1 = $Ranks[$v['spell']][1];
						}
					}
					$talentList .= $crr.','; 
					$baseList[$crr] = array($rank_1,$value['rank1']); // Potrzebujemy tablice ID pierwszych rankow.
					$talentLink.=$add;
					$this->talentCount[$spcN][$i] += $c;
	
				}
			}
	
				if($this->talentCount[$spcN][$i]>$max[$spcN]) {
					$this->talentSpec[$spcN]['name'] = $spec['name'];
					$this->talentSpec[$spcN]['nr'] = $i+1;
					$max[$spcN] = $this->talentCount[$spcN][$i];
				}
		}
		$this->talentLink[$spcN] = $talentLink;
		$tb = $this->talentCount[$spcN];
		$max = array_keys($tb, max($tb));
		$tb[$max[0]] = -1;
		$secMax = array_keys($tb, max($tb));
		if($this->talentCount[$spcN][$secMax[0]]>0 && $this->talentCount[$spcN][$max[0]]/$this->talentCount[$spcN][$secMax[0]]<1.4) {
			$this->talentSpec[$spcN]['name'] = 'Hybrid';
			$this->talentSpec[$spcN]['nr'] = -1;
		}
		}
		//$this->load_talent_info($talentList, $baseList);  This info is now generated in class.talent.php
  }

  function sort_skills() {
	  global $mysql,$config;
	  $new_skills = array();
	  $cat = $mysql->getRows("select * from `skilllinecategory` order by `display_order`",'armory');
	  foreach($cat as $c) {
		  $new_skills[$c['id']]['category_name'] = $c['name'];
		  $new_skills[$c['id']]['data'] = array();
	  }
	  // Zbieramy idiki
	  foreach($this->skills as $value)
		  $id_list.=$value[0].',';
	  $skill_data = $mysql->getRows("select * from `skillline` where id in(?1-1)",$id_list,'armory');
	  foreach($this->skills as $value) {
		  foreach($skill_data as $skill)
		  	if($skill['id']==$value[0]) $data = $skill;// Malo wydajne ale krotkie. Lepiej wpieprzc do tablicy ale mi sie nie chce...
		  if($data['ref_category'] == 7 || $data['ref_category'] == 8 || $data['ref_category'] == 10) $value[2] = $value[3] = 0;
	  	  array_push($new_skills[$data['ref_category']]['data'], array($value[0], $data['name'], $value[2], $value[3], $data['description']));
	  }
	  $this->skills = $new_skills;
  }

  function load_reputation() {
	  global $mysql,$config;
	    // Na poczatek kilka definicji
		$faction_ihl = array(
			1118 => "classic",
			469 => "alliance",
			891 => "allianceforces",
			1037 => "classic",
			67 => "horde",
			892 => "hordeforces",
			1052 => "classic",
			936 => "shattrathcity",
			1117 => "classic",
			169 => "steamwheedlecartel",
			980 => "outland",
			1097 => "classic",
			0 => "zother"
		);
	    $reputation_rank = array(
			0 => "Hated",
			1 => "Hostile",
			2 => "Unfriendly",
			3 => "Neutral",
			4 => "Friendly",
			5 => "Honored",
			6 => "Revered",
			7 => "Exalted"
		);
		$reputation_rank_length = array(36000, 3000, 3000, 3000, 6000, 12000, 21000, 999);
		$reputation_cap    =  42999;
		$reputation_bottom = -42000;
		$MIN_REPUTATION_RANK = 0;
		$MAX_REPUTATION_RANK = 8;

		// Wczytajmy i ustawmy nazwy bazowych frakcji
	    foreach($faction_ihl as $key => $faction) $fc_list.=$key.',';
		$fc = $mysql->getRows("SELECT id,name FROM `faction` WHERE `id` IN (?1-1)", $fc_list,'armory');
		foreach($fc as $f) $faction_name[$f['id']] = $f['name'];
		$fc_list='';
		foreach($faction_ihl as $key => $value) {
			$this->reputation[$key]['faction'] = $value;
			$this->reputation[$key]['name'] = $faction_name[$key];
		}



	  // Wczytujemy informacje o reputacji
	  $rep = $mysql->getRows("SELECT `faction`, `standing` FROM `character_reputation` WHERE `guid` ='?1' AND (`flags` & 1 = 1)", $this->guid,'char'); // Rep bohatera
	  if($rep) foreach($rep as $faction) $fc_list.=$faction['faction'].',';
	  $fc = $mysql->getRows("SELECT * FROM `faction` WHERE `id` IN (?1-1)", $fc_list,'armory'); // Informacje o frakcjach

	  if($rep) foreach($rep as $faction) {
		$stan = $faction['standing'];
		foreach($fc as $f)
		   if($f['id']==$faction['faction']) $fc_data = $f;
		 for ($i = 0; $i < 4; $i++){
			if ($fc_data["base_ref_chrraces_".$i] & (1 << ($this->race-1))) {
				$stan += $fc_data["base_modifier_".$i];
				break;
			}
		 }
		 $rep_rank = $MIN_REPUTATION_RANK;
		 $rep = 0;
		 $limit = $reputation_cap;
		 // Wyznaczamy range oraz reputacje w tej randze
		 for($i = $MAX_REPUTATION_RANK-1; $i >= $MIN_REPUTATION_RANK; --$i) {
			$limit -= $reputation_rank_length[$i];
			if($stan >= $limit) {
				$rep_rank = $i;
				$rep = $stan - $limit;
				break;
			}
		}
		// Zapisywanie danych
		$rep_rank_name = $reputation_rank[$rep_rank];
		$rep_cap = $reputation_rank_length[$rep_rank];
		$data['rank'] = $rep_rank;
		$data['description'] = $fc_data['description'];
		$data['name'] = $fc_data['name'];
		$data['rank_name'] = $rep_rank_name;
		$data['rep'] = $rep;
		$data['rep_cap'] = $rep_cap;

		$this->reputation[$fc_data["ref_faction_parent"]]['data'][] = $data; 
	}


  }

  function load_tooltips() {
	global $SQL,$EQ_SLOT;
	$tooltip = new tooltip($this->items,$this->item_instance,$this->guid,$this->data);
	for($i=0;$i<19;$i++) {
		$tooltip->transform($i);
		$this->item_tooltips[$i] = $tooltip->output;
	}

  }

  function read_items() {
	  global $SQL,$mysql,$config;
	  //die($this->data[HEAD_EQU_0_OFFSET]);
	  $r = $mysql->getRows("select * from `character_inventory` where `guid` = ?1 and `slot` < 18 and bag = 0",
						   $this->guid,'char');
	  foreach($r as $row) {
	  	  $this->items[$row['slot']] = $row['item_template'];
		  $this->item_instance[$row['slot']] = $row['item'];
	  }
	  foreach($this->items as $key => $value) {
		//$this->items_names[$key] = $this->get_item_name($value);
	  }
  }

  function get_item_name($id) {
	     global $config,$mysql;
	     $r = $mysql->getRow("select name from `item_template` where entry = ?1",$id,'armory');
		 return $r['name'];
  }

  function get_item_icon($slot,$id=0) {
	 global $config,$_SYSTEM,$_DOMAIN,$mysql;
	 if($id==0) $id = $this->items[$slot];
	 if($id) {
		 $r = $mysql->getRow("SELECT `itemicon` FROM `itemicon` WHERE itemnumber = ?1",
											$id,'armory');
			 if(!$r || !$r['itemicon'] || !file_exists('images/icons/64x64/'.strtolower(basename($r['itemicon'])).'.jpg') || trim(basename($r['itemicon']))=='') {
				 //('images/icon/'.str_replace('.png','',strtolower(basename($r['itemicon']))).'.jpg');
			     if($_SYSTEM->update_icon_db($id))
				    return character::get_item_icon(0,$id);
           else return $_DOMAIN.'images/icon/'.strtolower(basename($r['itemicon'])).'.jpg'; // Aktualizacja nie udana :(
			 }else return $_DOMAIN.'images/icon/'.strtolower(basename($r['itemicon'])).'.jpg';
			 		//return 'http://wow.allakhazam.com/images/icons/'.$r['itemicon'];
	 }
	 return false;
  }

  function read_skills() {
	global $_LANGUAGE, $SQL;
	$prof_1_array = array();
    $prof_2_array = array();
    $skill_array = array();

    $skill_rank_array = array(
	  75 => 'Apprentice',
	  150 => 'Journeyman',
	  225 => 'Expert',
	  300 => 'Artisan',
	  375 => 'Master',
	  450 => 'Grand Master'
	);

    for($i = SKILL_INFO_OFFSET; $i <= SKILL_INFO_OFFSET+384 ; $i+=3){
       if(($this->data[$i]) && ($this->get_skill_name($this->data[$i] & 0x0000FFFF ))){
           $temp = unpack("S", pack("L", $this->data[$i+1]));
           $skill = ($this->data[$i] & 0x0000FFFF); // Maska 0x0000FFFF skróci liczbe do "usint32"

		if( $skill == 185 || $skill == 129 || $skill == 356) {
		  $max = ($temp[1] <= 75) ? 75 : (($temp[1] <= 150) ? 150 : (($temp[1] <= 225) ? 225 : (($temp[1] <= 300) ? 300 : (($temp[1] <= 375) ? 375 : (($temp[1] <= 450) ? 450 : 0)))));
		  array_push($skill_array , array($skill, $this->get_skill_name($skill), $temp[1],$max));
		}else if( $skill == 171 || $skill == 182 || $skill == 186 ||
         $skill == 197 || $skill == 202 || $skill == 333 ||
         $skill == 393 || $skill == 755 || $skill == 164 ||
         $skill == 165 || $skill == 773) {
			$max = ($temp[1] <= 75) ? 75 : (($temp[1] <= 150) ? 150 : (($temp[1] <= 225) ? 225 : (($temp[1] <= 300) ? 300 : (($temp[1] <= 375) ? 375 : (($temp[1] <= 450) ? 450 : 0)))));
			if($skill == 333 && $this->race == 10) { $temp[1]+=10; $max+=10; } // Krwawe elfy +10 enchanting
			array_push($prof_1_array , array($skill, $this->get_skill_name($skill), $temp[1],$max));
		}else{

      		array_push($skill_array , array($skill, '', $temp[1]>$this->level*5?$this->level*5:$temp[1], $skill==762?$temp[1]:$this->level*5));
    	}
      }
    }
	// Zapisywanie
    $this->prof_1 = $prof_1_array;
    $this->prof_2 = $prof_2_array;
    $this->skills = $skill_array;
  }

  function getGold($g=-1) {
		global $_DOMAIN;
		$_DOMAIN = str_replace('ajax/','',$_DOMAIN);
		if($g==-1) $g=$this->gold;
		// Palowo ale skutecznie...
		$gold = floor($g/10000);
		if($gold>0) $ret .= $gold.' <img alt="" src="'.$_DOMAIN.'images/money-gold.gif"> ';
		$gold = $g-($gold*10000);
		$silver = floor($gold/100);
		if($silver>0 || $ret!='') $ret .= $silver.' <img alt="" src="'.$_DOMAIN.'images/money-silver.gif"> ';
		$copper = $gold - $silver*100;
		$ret .= $copper.' <img alt="" src="'.$_DOMAIN.'images/money-copper.gif">';
		return $ret;
  }

  function read_stats() {
	  global $SQL;
	  // Statysyki glówne
	  $stats['strength_bonus'] = $this->cstat($this->data[STRENGTH_POS_OFFSET]) - $this->cstat($this->data[STRENGTH_NEG_OFFSET]);
	  $stats['agility_bonus'] = $this->cstat($this->data[AGILITY_POS_OFFSET]) - $this->cstat($this->data[AGILITY_NEG_OFFSET]);
	  $stats['stamina_bonus'] = $this->cstat($this->data[STAMINA_POS_OFFSET]) - $this->cstat($this->data[STAMINA_NEG_OFFSET]);
	  $stats['intellect_bonus'] = $this->cstat($this->data[INTELLECT_POS_OFFSET]) - $this->cstat($this->data[INTELLECT_NEG_OFFSET]);
	  $stats['spirit_bonus'] = $this->cstat($this->data[SPIRIT_POS_OFFSET]) - $this->cstat($this->data[SPIRIT_NEG_OFFSET]);

	  $stats['strength_base'] = $this->data[STRENGTH_BASE_OFFSET] - $stats['strength_bonus'];
	  $stats['agility_base'] = $this->data[AGILITY_BASE_OFFSET] - $stats['agility_bonus'];
	  $stats['stamina_base'] = $this->data[STAMINA_BASE_OFFSET] - $stats['stamina_bonus'];
	  $stats['intellect_base'] = $this->data[INTELLECT_BASE_OFFSET] - $stats['intellect_bonus'];
	  $stats['spirit_base'] = $this->data[SPIRIT_BASE_OFFSET] - $stats['spirit_bonus'];
	  $stats['mana_mod_intellect'] = ($stats['intellect_bonus']+$stats['intellect_base']-20 >=0 ? ($stats['intellect_bonus']+$stats['intellect_base']-20)*15 : 0) + ($stats['intellect_bonus']+$stats['intellect_base']>=20 ? 20 : $stats['intellect_bonus']+$stats['intellect_base']);

	  // Obrona
	  $stats['armor_bonus'] =  $this->cstat($this->data[ARMOR_POS_OFFSET]) -  $this->cstat($this->data[ARMOR_NEG_OFFSET]);
	  $stats['armor_base'] = $this->data[ARMOR_BASE_OFFSET] - $stats['armor_bonus'];
	  $stats['armor_mod'] =2*($stats['agility_base']+$stats['agility_bonus']);
	  $stats['defence_rating'] = (int)$this->data[DEFENCE_RATING_OFFSET]; // Cosik nie dziala? :(
	  $stats['dodge'] = round($this->cstat($this->data[DODGE_OFFSET]),2);
	  $stats['parry'] = round($this->cstat($this->data[PARRY_OFFSET]),2);
	  $stats['block'] = round($this->cstat($this->data[BLOCK_OFFSET]),2);

	  $stats['armor_mod_proc'] = round($this->level < 60 ? (($stats['armor_bonus']+$stats['armor_base'])/(($stats['armor_bonus']+$stats['armor_base']) + 400 + 85 * $this->level)) : (($stats['armor_bonus']+$stats['armor_base']) / (($stats['armor_bonus']+$stats['armor_base']) + 400 + 85 * ($this->level + 4.5 * ($this->level - 59)))),4);
	  $stats['armor_mod_proc'] = round(($stats['armor_mod_proc'] > 0.75 ? 0.75 : $stats['armor_mod_proc'])*100);

	  $stats['health_mod_stamina'] = 10*($stats['stamina_bonus']+$stats['stamina_base']);

	  // Odpornosci
	  $stats['holy_res'] = $this->data[HOLY_RES_OFFSET];
	  $stats['fire_res'] = $this->data[FIRE_RES_OFFSET];
	  $stats['frost_res'] = $this->data[FROST_RES_OFFSET];
	  $stats['shadow_res'] = $this->data[SHADOW_RES_OFFSET];
	  $stats['nature_res'] = $this->data[NATURE_RES_OFFSET];
	  $stats['arcane_res'] = $this->data[ARCANE_RES_OFFSET];

	  // Melee
	  $stats['melee_damage_min'] = $this->cstat($this->data[MELEE_DAMAGE_MIN_OFFSET],0,-1); //Floor
	  $stats['melee_damage_max'] = $this->cstat($this->data[MELEE_DAMAGE_MAX_OFFSET],0,1); //Ceil
	  $stats['melee_damage_min_off'] = $this->cstat($this->data[MELEE_DAMAGE_MIN_OFF_OFFSET]);
	  $stats['melee_damage_max_off'] = $this->cstat($this->data[MELEE_DAMAGE_MAX_OFF_OFFSET]);
	  $stats['melee_speed'] = round($this->cstat($this->data[MELEE_SPEED_OFFSET])/1000,2);
	  $stats['melee_speed_off'] = round($this->cstat($this->data[MELEE_SPEED_OFF_OFFSET])/1000,2);
	  $stats['melee_ap_base'] = $this->data[MELEE_AP_OFFSET];
	  $stats['melee_ap_bonus'] = $this->data[MELEE_AP_MOD_OFFSET];
	  $stats['melee_ap_mod'] = in_array($this->class,array(1,2,6,11)) ? 2*($stats['strength_base']+$stats['strength_bonus']) : ($stats['strength_base']+$stats['strength_bonus']);
	  $stats['melee_ap_mod_agility'] = in_array($this->class,array(3,4,7)) ? ($stats['agility_base']+$stats['agility_bonus']) : 0;

	  $stats['melee_dps'] = round(($stats['melee_damage_min']+$stats['melee_damage_max'])/2/($stats['melee_speed']?$stats['melee_speed']:1),2);
	  $stats['melee_dps_off'] = round(($stats['melee_damage_min_off']+$stats['melee_damage_max_off'])/2/(!$stats['melee_speed_off']?1:$stats['melee_speed_off']),2);

	  $stats['melee_dps_mod'] = round(($stats['melee_ap_bonus']+$stats['melee_ap_base'])/14,1);

	  $stats['melee_hit_rating'] = $this->data[MELEE_HIT_RATING_OFFSET];
	  $stats['melee_crit_rating'] = $this->data[MELEE_CRIT_RATING_OFFSET];
	  $stats['melee_crit'] = round($this->cstat($this->data[MELEE_CRIT_OFFSET],2),2);
	  $stats['melee_crit_off'] = round($this->cstat($this->data[MELEE_CRIT_OFF_OFFSET],2),2);
	  $stats['melee_expertise'] = $this->data[MELEE_EXPERTISE_OFFSET];
	  $stats['melee_expertise_off'] = $this->data[MELEE_EXPERTISE_OFF_OFFSET];
	  $stats['melee_expertise_proc'] = $this->data[MELEE_EXPERTISE_OFFSET]*0.25;
	  $stats['melee_expertise_proc_off'] = $this->data[MELEE_EXPERTISE_OFF_OFFSET]*0.25;
	  $stats['melee_haste_rating'] = $this->data[MELEE_HASTE_OFFSET];

	  // Ranged
	  $stats['ranged_damage_min'] = $this->cstat($this->data[RANGED_DAMAGE_MIN_OFFSET],0,-1);//Floor
	  $stats['ranged_damage_max'] = $this->cstat($this->data[RANGED_DAMAGE_MAX_OFFSET],0,1);//Ceil
	  $stats['ranged_speed'] = round($this->cstat($this->data[RANGED_SPEED_OFFSET])/1000,2);
	  $stats['ranged_ap_base'] = $this->data[RANGED_AP_OFFSET];
	  $stats['ranged_ap_bonus'] = $this->data[RANGED_AP_MOD_OFFSET];
	  $stats['ranged_hit_rating'] = $this->data[RANGED_HIT_RATING_OFFSET];
	  $stats['ranged_crit_rating'] = $this->data[RANGED_CRIT_RATING_OFFSET];
	  $stats['ranged_crit'] = round($this->cstat($this->data[RANGED_CRIT_OFFSET],2),2);
	  $stats['ranged_dps'] = round(($stats['ranged_damage_min']+$stats['ranged_damage_max'])/2/($stats['ranged_speed']?$stats['ranged_speed']:1),2);
	  $stats['ranged_dps_mod'] = round(($stats['ranged_ap_bonus']+$stats['ranged_ap_base'])/14,1);
	  $stats['ranged_haste_rating'] = $this->data[RANGED_HASTE_OFFSET];

	  // Spell
	  $stats['spell_bonus_holy'] = $this->data[SPELL_BONUS_HOLY_OFFSET];
	  $stats['spell_bonus_fire'] = $this->data[SPELL_BONUS_FIRE_OFFSET];
	  $stats['spell_bonus_nature'] = $this->data[SPELL_BONUS_NATURE_OFFSET];
	  $stats['spell_bonus_frost'] = $this->data[SPELL_BONUS_FROST_OFFSET];
	  $stats['spell_bonus_shadow'] = $this->data[SPELL_BONUS_SHADOW_OFFSET];
	  $stats['spell_bonus_arcane'] = $this->data[SPELL_BONUS_ARCANE_OFFSET];
	  $stats['spell_haste_rating'] = $this->data[SPELL_HASTE_OFFSET];
	  $stats['spell_bonus'] = 99999999999999;
	  foreach($stats as $key => $value)
		if(strpos($key,'spell_bonus_')!==FALSE && $value<$stats['spell_bonus']) $stats['spell_bonus'] = $value;
	  $stats['spell_bonus_healing'] = $this->data[SPELL_BONUS_HEALING_OFFSET];
	  $stats['spell_hit_rating'] = $this->data[SPELL_HIT_RATING_OFFSET];
	  $stats['spell_crit_rating'] = $this->data[SPELL_CRIT_RATING_OFFSET];
	  $stats['spell_crit_holy'] = round($this->cstat($this->data[SPELL_CRIT_HOLY_OFFSET],2),2);
	  $stats['spell_crit_fire'] = round($this->cstat($this->data[SPELL_CRIT_FIRE_OFFSET],2),2);
	  $stats['spell_crit_nature'] = round($this->cstat($this->data[SPELL_CRIT_NATURE_OFFSET],2),2);
	  $stats['spell_crit_frost'] = round($this->cstat($this->data[SPELL_CRIT_FROST_OFFSET],2),2);
	  $stats['spell_crit_shadow'] = round($this->cstat($this->data[SPELL_CRIT_SHADOW_OFFSET],2),2);
	  $stats['spell_crit_arcane'] = round($this->cstat($this->data[SPELL_CRIT_ARCANE_OFFSET],2),2);
	  $stats['spell_crit'] = 99999999999999;
	  foreach($stats as $key => $value)
		if(strpos($key,'spell_crit_')!==FALSE && $value<$stats['spell_crit']) $stats['spell_crit'] = $value;
	  $stats['mana_regen'] = $this->cstat( $this->data[MANA_REGEN_OFFSET] )*5;


	  $stats['max_health'] = $this->data[MAX_HEALTH_OFFSET];
	  $stats['max_mana'] = $this->data[MAX_MANA_OFFSET];
	  $stats['max_rage'] = $this->data[MAX_RAGE_OFFSET] = 0;
	  $stats['max_energy'] = $this->data[MAX_ENERGY_OFFSET] = 100;
	  $stats['max_focus'] = $this->data[MAX_FOCUS_OFFSET];
	  
	  $stats['defense'] = $this->data[DEFENSE_OFFSET];
	  $stats['resilience'] = $this->data[RESILIENCE_OFFSET];

	  $this->class==1 ? $stats['max_power'] = $stats['max_rage'] : ($this->class==4 || $this->class==6 ? $stats['max_power'] = $stats['max_energy'] : $stats['max_power'] = $stats['max_mana']);
	  return $stats;
  }

  function getPowerType() {
	  if($this->class==1) return 'Rage';
	  elseif($this->class==4) return 'Energy';
	  elseif($this->class==6) return 'Runic';
	  else return 'Mana';
  }

  function getAlliance($race=-1) {
	  if($race==-1) $race = $this->race;
	  if(in_array($race,array(1,3,4,7,11))) return 0;
	  return 1;
  }

  function cstat($stat,$r=0,$u=0) {
	$tmp = unpack("f", pack("L",$stat));
	if($u==0) return round($tmp[1],$r);
	else if($u==-1) return floor($tmp[1]);
	else return ceil($tmp[1]);
   }

  function raceToString($race) {
	switch ($race) {
	    case 1: $rOut='Human';
		 break;
		 case 2: $rOut='Orc';
		 break;
		 case 3: $rOut='Dwarf';
		 break;
		 case 4: $rOut='Night Elf';
		 break;
		 case 5: $rOut='Undead';
		 break;
		 case 6: $rOut='Tauren';
		 break;
		 case 7: $rOut='Gnome';
		 break;
		 case 8: $rOut='Troll';
		 break;
		 case 10: $rOut='Blood Elf';
		 break;
		 case 11: $rOut='Draenei';
		 break;
    }
   return $rOut;
   }

	function classToString($class) {
		switch ($class) {
			case 1: $rOut='Warrior';
			 break;
			 case 2: $rOut='Paladin';
			 break;
			 case 3: $rOut='Hunter';
			 break;
			 case 4: $rOut='Rogue';
			 break;
			 case 5: $rOut='Priest';
			 break;
			 case 6: $rOut='Death Knight';
			 break;
			 case 7: $rOut='Shaman';
			 break;
			 case 8: $rOut='Mage';
			 break;
			 case 9: $rOut='Warlock';
			 break;
			 case 11: $rOut='Druid';
			 break;
	 }
	 return $rOut;
	}

	function get_skill_name($id) {
		global $mysql;
		$skill_data = $mysql->getRow("select * from `skillline` where id =?1",$id,'armory');
		return $skill_data['name'];
	}

	function debug() {
	   echo 'GUID -> '.$this->guid.'<br>';
	   echo 'NAME -> '.$this->name.'<br>';
	   echo 'LEVEL -> '.$this->level.'<br>';
	   echo 'RACE -> '.$this->raceToString($this->race).' ('.$this->race.')<br>';
	   echo 'CLASS -> '.$this->classToString($this->class).' ('.$this->class.')<br>';
	   echo 'GENDER -> '.$this->gender.'<br>';

	   echo 'PLAYED -> '.$this->played[0].' '.$this->played[1].' '.$this->played[2].'<br>';

	   echo 'GUILD_ID -> '.$this->guild_id.'<br>';
	   //echo 'DATA -> '.print_r($this->data).'<br>';
	   echo '<hr><br>';
	   echo 'STATS -> <br>';
	   foreach($this->stats as $key => $value) {
		  echo $key.' -> '.$value.'<br>';
	   }
	   echo '<hr><br>';
	   echo 'PRIMARY PROFS -> <br>';
	   foreach($this->prof_1 as $value) {
		 echo '     - ID: '.$value[0].', NAME: '.$value[1].' SKILL: '.$value[2].' / '.$value[3].'<br>';
	   }
	   echo '<hr><br>';
	   echo 'SECONDARY PROFS -> <br>';
	   foreach($this->prof_2 as $value) {
		 echo '     - ID: '.$value[0].', NAME: '.$value[1].' SKILL: '.$value[2].' / '.$value[3].'<br>';
	   }
	   echo '<hr><br>';
	   echo 'SKILLS -> <br>';
	   foreach($this->skills as $value) {
		 echo '     - ID: '.$value[0].', NAME: '.$value[1].' SKILL: '.$value[2].' / '.$value[3].'<br>';
	   }

	}
}

?>