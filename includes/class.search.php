<?php
class search {
	public $searchQuery;
	public $ItemClass = -1;
	public $ItemSubClass = -1;

	function __construct($searchQuery='') {
		$this->searchQuery = $searchQuery;
	}

	function getNumRows() {
		global $mysql,$_SYSTEM;
		$count = array(0,0,0);
		foreach($_SYSTEM->Realms as $rID => $rName) {
			$res = $mysql->query("select count(*) from characters where name like '%?1%'",$this->searchQuery,'char_'.$rID);
			if($res) $count[0]+=mysql_result($res,0);
			$res = $mysql->query("select count(*) from guild where name like '%?1%'",$this->searchQuery,'char_'.$rID);
			if($res) $count[1]+=mysql_result($res,0);
			$res = $mysql->query("select count(*) from arena_team where name like '%?1%'",$this->searchQuery,'char_'.$rID);
			if($res) $count[2]+=mysql_result($res,0);

		}
		$res = $mysql->query("select count(*) from item_template where name like '%?1%' ".($this->ItemClass!=-1?'and class = '.$this->ItemClass:'')." ".($this->ItemSubClass!=-1?'and subclass = '.$this->ItemSubClass:''),$this->searchQuery,'world');
		if($res) $count[3]+=mysql_result($res,0);
		return $count;
	}

}
class search_character {
	public $per_page;
	public $order;

	public $guid;
	public $name;
	public $lvl_down;
	public $lvl_up;
	public $race;
	public $class;
	public $guild;

	public $page;
	public $Realm;

	private $result;
	public $count = 0;

	function __construct($name='',$lvl_down=1,$lvl_up=80,$guild=0,$class=0,$page=0,$gender=-1,$guid=-1) {
		if($lvl_up>80) $lvl_up=80;
		if($lvl_down>80) $lvl_down=80;
		if($lvl_up<1) $lvl_up=1;
		if($lvl_down<1) $lvl_down=1;

		if($guid>0) $this->guid = (int)$guid;

		$this->name = $name;
		$this->lvl_down = $lvl_down;
		$this->lvl_up = $lvl_up;
		$this->race = $race;
		$this->guild = $guild;
		$this->class = $class;
		$this->Realm = -1;
		$this->page=$page;

		$this->per_page = 300;
	}

	function set_sort($sort_by,$sort_asc=0) {
		switch($sort_by) {
	       case 'level': $mysql_sort.="ORDER BY `level`";
			 break;
		   case 'name': $mysql_sort.="ORDER BY `name`";
			 break;
		   case 'class': $mysql_sort.="ORDER BY `class`";
		     break;
		   case 'race': $mysql_sort.="ORDER BY `race`";
			 break;
		   case 'guild': $mysql_sort.="ORDER BY ".SQL_template(CHAR_GUILD_OFFSET);
			 break;
		   case 'honor': $mysql_sort.="ORDER BY `totalHonorPoints`";
			 break;
		   case 'hk': $mysql_sort.="ORDER BY `totalHonorKills`";
			 break;
		   case 'online': $mysql_sort.="ORDER BY `online`";
			 break;
		   default: $mysql_sort='';
	   }
	   if($mysql_sort!='') {
		   switch ($sort_asc) {
			    case 1: $mysql_sort.=" DESC";
				 break;
				case 0: $mysql_sort.=" ASC";
				 break;
				 default: $mysql_sort.='';
	   		 }
	   }
	   $this->order=$mysql_sort;
	}

	function start() {
		global $mysql,$_SYSTEM;

		$WHERE = "WHERE ";
		if($this->guild>0) $WHERE .= 'guild_member.guildid = '.$this->guild.' AND ';
		if($this->guid>0) $WHERE .= 'characters.guid = '.$this->guid.' AND ';
		if($this->class!=0) $WHERE .= 'characters.class = '.$this->class.' AND ';
		if($this->name!='') $WHERE .= 'characters.name LIKE \'%'.$this->name.'%\' AND ';
		$WHERE .= '1=1';
		$il=$this->per_page;
		$st=$this->per_page*$this->page;
		$LIMIT = 'LIMIT '.$st.', '.$il;
		$data = array();
		$i=0;
		foreach($_SYSTEM->Realms as $rID => $rName) {
			if($this->Realm !=-1 && $rID!=$this->Realm) continue;
			$d = $mysql->getRows("SELECT characters.name,characters.race,characters.class,characters.guid,characters.online,
				guild_rank.rname,guild_rank.rid,?1 AS level,guild_member.guildid AS guildid,totalHonorPoints as honor,totalKills as hk,?3 as gender,guild.name as guild
                FROM `characters` left join guild_member on characters.guid = guild_member.guid
                left join guild on guild.guildid = guild_member.guildid
                left join `guild_rank` on guild_member.rank = guild_rank.rid and guild_member.guildid = guild_rank.guildid
				{$WHERE} {$this->order} {$LIMIT}",SQL_template(CHAR_LEVEL_OFFSET),SQL_template(CHAR_GUILD_OFFSET),CHAR_GENDER_OFFSET,SQL_template(CHAR_GUILD_OFFSET+1),'char_'.$rID);
			if(!$d) continue;
			$c = $mysql->query("select count(*) from characters left join guild_member on characters.guid = guild_member.guid
                left join guild on guild.guildid = guild_member.guildid
                left join `guild_rank` on guild_member.rank = guild_rank.rid and guild_member.guildid = guild_rank.guildid {$WHERE}",'char_'.$rID);
			$this->count += mysql_result($c,0);

			foreach($d as $char) {
				foreach($char as $key=>$value)
					$data[$i][$key] = $value;

				if($data[$i]['guildid']==0) {
					$data[$i]['guild'] = ' None';
					$data[$i]['guildid'] = 0;

				}else if($data[$i]['rid']=='') {
					//$v = $mysql->getRow("select rname from guild_rank where rid = '1' and guildid = ?1",$this->guild,'char_'.$rID);
					$data[$i]['rname'] = 'Guild Master';
					$data[$i]['rid'] = '0';

				}
				$data[$i]['race_string'] = character::raceToString($data[$i]['race']);
				$data[$i]['class_string'] = character::classToString($data[$i]['class']);
				if($data[$i]['honor']>2000000000) $data[$i]['honor']=0;
				$data[$i]['realm']=$rName;
				$i++;
			}
		}
		return $data;
	}

}




class search_guild {
	public $per_page;
	public $order, $order_asc;

	public $guid;
	public $name;

	public $page;
	public $Realm = -1;

	private $result;
	public $count = 0;

	function __construct($name='',$page=0) {
		if($guid>0) $this->guid = (int)$guid;

		$this->name = $name;
		$this->page=$page;

		$this->per_page = 300;
	}

	function set_sort($sort_by,$sort_asc=0) {
	   $this->order_asc=$sort_asc;
	   $this->order=$sort_by;
	}

	function start() {
		global $config,$SQL,$mysql,$_SYSTEM;
		$WHERE = 'WHERE ';
		if($this->name!='') $WHERE .= 'guild.name LIKE \'%'.$this->name.'%\' AND ';
		$WHERE .= '1=1';
		$il=$this->per_page;
		$st=$this->per_page*$this->page;
		$LIMIT = 'LIMIT '.$st.', '.$il;
		$data = array();
		$i=0;
		foreach($_SYSTEM->Realms as $rID => $rName) {
			if($this->Realm !=-1 && $rID!=$this->Realm) continue;
			$d = $mysql->getRows("SELECT guild.guildid as id,guild.name,guild.leaderguid,characters.race,characters.name as leader,characters.guid as leader_guid
                FROM `guild` inner join `characters` on guild.leaderguid = characters.guid
				{$WHERE}
                {$LIMIT}",'char_'.$rID);
			if(!$d) continue;
			$this->count += mysql_result($mysql->query("SELECT count(*) FROM `guild` {$WHERE}",'char_'.$rID),0) or $this->count = 0;
			foreach($d as $r) {
				foreach($r as $key => $value)
			     	$data[$i][$key] = $value;
				$ids .= $data[$i]['id'].',';
				$data[$i]['members'] = 0;
				$pos[$data[$i]['id']] = $i;
				$data[$i]['realm']=$rName;
				$data[$i]['faction'] = character::getAlliance($data[$i]['race']);
				$i++;
			}
			if($r = $mysql->getRows("select * from `guild_member` where guildid in (?1-1)",
							$ids,'char_'.$rID))
			foreach($r as $row) {
				$data[$pos[$row['guildid']]]['members']++;
			}

		}
		return $data;
	}

}
class search_arenateam {
	public $per_page;
	public $order, $order_asc;

	public $guid;
	public $name;

	public $page;

	private $result;
	public $count = 0;

	function __construct($name='',$page=0) {
		if($guid>0) $this->guid = (int)$guid;

		$this->name = $name;
		$this->page=$page;

		$this->per_page = 300;
	}

	function set_sort($sort_by,$sort_asc=0) {
	   $this->order_asc=$sort_asc;
	   $this->order=$sort_by;
	}

	function start() {
		global $config,$SQL,$mysql,$_SYSTEM;
		$WHERE = 'WHERE ';
		if($this->name!='') $WHERE .= 'arena_team.name LIKE \'%'.$this->name.'%\' AND ';
		$WHERE .= '1=1';
		$il=$this->per_page;
		$st=$this->per_page*$this->page;
		$LIMIT = 'LIMIT '.$st.', '.$il;
		$data = array();
		$i=0;
		foreach($_SYSTEM->Realms as $rID => $rName) {
			$d = $mysql->getRows("SELECT arena_team.arenateamid as id,arena_team.name,arena_team.type,arena_team_stats.rating,characters.race FROM `arena_team`,`characters`,`arena_team_stats`
				{$WHERE} AND arena_team.arenateamid = arena_team_stats.arenateamid AND arena_team.captainguid = characters.guid
                {$LIMIT}",'char_'.$rID);
			if(!$d) continue;
			$this->count += mysql_result($mysql->query("SELECT count(*) FROM `arena_team` {$WHERE}",'char_'.$rID),0) or $this->count = 0;
			foreach($d as $r) {
				foreach($r as $key => $value)
			     	$data[$i][$key] = $value;
				$data[$i]['realm']=$rName;
				$data[$i]['faction'] = character::getAlliance($data[$i]['race']);
				$i++;
			}

		}
		return $data;
	}

}
class search_item {
	public $per_page;
	public $name;
    public $ItemClass = -1;
	public $ItemSubClass = -1;
	public $page;

	private $result;
	public $count = 0;

	function __construct($name='',$page=0) {
		$this->name = $name;
		$this->page=$page;

		$this->per_page = 200;
	}
	function start() {
		global $config,$SQL,$mysql,$_SYSTEM;
		$il=$this->per_page;
		$st=$this->per_page*$this->page;
		$LIMIT = 'LIMIT '.$st.', '.$il;
		$data = array();

		$d = $mysql->getRows("SELECT name,displayid,ItemLevel,entry,Flags,RequiredLevel,class,subclass,Quality FROM `item_template` WHERE name LIKE '%?1%'
		".($this->ItemClass!=-1?'and class = '.$this->ItemClass:'')." ".($this->ItemSubClass!=-1?'and subclass = '.$this->ItemSubClass:'')." ORDER BY ItemLevel DESC {$LIMIT}",$this->name,'world');
		$this->count = mysql_result($mysql->query("SELECT count(*) FROM `item_template` WHERE name LIKE '%".$this->name."%' ".($this->ItemClass!=-1?'and class = '.$this->ItemClass:'')." ".($this->ItemSubClass!=-1?'and subclass = '.$this->ItemSubClass:''),'world'),0) or $this->count = 0;

        if(!$d) return;
        foreach($d as $dat) {
        	$ids.=$dat['entry'].',';
        }
        $c = $mysql->getRows("select itemnumber,itemicon,itemhtml from itemicon where itemnumber in (?1-1)",$ids,'armory');
        if($c)
	        foreach($c as $icon) {
	         	$icons[$icon['itemnumber']] = $icon;
	        }

        foreach($d as $key=>$dat) {
       		$icons[$dat['entry']] = validate_icon($icons[$dat['entry']],$dat['entry']);
        	$d[$key]['icon'] = $icons[$dat['entry']]['itemicon'];
        	$d[$key]['tooltip'] = system::htmlcode($icons[$dat['entry']]['itemhtml']);
        }
        $quest = $mysql->getRows("SELECT `SrcItemId` as id FROM `quest_template` WHERE `SrcItemId` IN (?1-1)",$ids,'world');
        $vendor = $mysql->getRows("SELECT `item` as id FROM `npc_vendor` WHERE `item` IN (?1-1)",$ids,'world');
        $chest = $mysql->getRows("SELECT `gameobject_loot_template`.`item` as id FROM `gameobject_loot_template`,`gameobject_template` WHERE gameobject_template.entry = gameobject_loot_template.entry `item`  IN (?1-1)",$ids,'world');
        $drop =  $mysql->getRows("SELECT `item` as id FROM `creature_loot_template` WHERE `item` IN (?1-1)",$ids,'world');
        $quest_rew = $mysql->getRows("SELECT RewChoiceItemId1,RewChoiceItemId2,RewChoiceItemId3,RewChoiceItemId4,RewChoiceItemId5,RewChoiceItemId6,
        RewItemId1,RewItemId2,RewItemId3,RewItemId4
        FROM `quest_template` WHERE `RewChoiceItemId1`IN (?1-1) OR `RewChoiceItemId2`IN (?1-1)
	OR `RewChoiceItemId3`IN (?1-1) OR `RewChoiceItemId4`IN (?1-1) OR `RewChoiceItemId5`IN (?1-1) OR `RewChoiceItemId6`IN (?1-1)
	OR `RewItemId1`IN (?1-1) OR `RewItemId2`IN (?1-1) OR `RewItemId3`IN (?1-1) OR `RewItemId4`IN (?1-1)",$ids,'world');

        foreach($d as $key=>$dat) {
        	$id = $dat['entry'];$d[$key]['source']='';
        	if($quest) foreach($quest as $q) if(in_array($id,$q)) {$d[$key]['source'] .= 'Quest Item, ';break;}
        	if($vendor) foreach($vendor as $q)
        		if(in_array($id,$q)) {
        			if($dat['Flags'] & 32768 == 32768) {$d[$key]['source'] .= 'PVP Reward, ';break;}
        			else {$d[$key]['source'] .= 'Vendor, ';break;}
        		}
         	if($chest) foreach($chest as $q) if(in_array($id,$q)) {$d[$key]['source'] .= 'Chest Drop, ';break;}
         	if($drop) foreach($drop as $q) if(in_array($id,$q)) {$d[$key]['source'] .= 'Drop, ';break;}
         	if($quest_rew) foreach($quest_rew as $q) if(in_array($id,$q)) {$d[$key]['source'] .= 'Quest Reward, ';break;}
         	if(!$d[$key]['source']) $d[$key]['source']='Created, ';
         	$d[$key]['source'] = substr($d[$key]['source'],0,-2);
        }
        $data = $d;
		return $data;
	}

}

?>