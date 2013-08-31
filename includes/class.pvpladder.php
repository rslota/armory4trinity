<?php
class pvpladder {
	public $ArenaType;
	public $ArenaTeams = array();
	public $Types;
	public $lastupdate;
	
	function __construct() {
		$this->load_arenateams();
		$this->lastupdate = time();
	}
	
	function load_arenateams() {
		global $config,$mysql;
		$this->Types = array(2,3,5);
		foreach($this->Types as $t) {
			$this->ArenaTeams[$t]=array();
		   $r[$t] = $mysql->getRows("select arena_team.arenateamid, arena_team.name, arena_team.type, arena_team.captainguid, characters.race from arena_team inner join characters on arena_team.captainguid = characters.guid where type = ?1 limit 50",$t,'char');
		    
		   if(!$r[$t]) continue;
		   foreach($r[$t] as $i => $row) {
			$arenalist .= $row['arenateamid'].',';
			foreach($row as $key => $value) {
				if($key=='race') {
					$this->ArenaTeams[$t][$i]['faction'] = character::getAlliance($value);
				}else
					$this->ArenaTeams[$t][$i][$key] = $value;
			}
		   }
		}
		$this->load_arena_members($arenalist);
		$this->load_arena_stats($arenalist);
		$this->arena_sort();
	}
	
	function arena_sort() {
		foreach($this->Types as $t) {
			for($i=0;$i<count($this->ArenaTeams[$t]);$i++) {
				for($j=0;$j<count($this->ArenaTeams[$t])-1;$j++) {
					if($this->ArenaTeams[$t][$j]['rating']<$this->ArenaTeams[$t][$j+1]['rating']) {
						$tmp = $this->ArenaTeams[$t][$j];
						$this->ArenaTeams[$t][$j]=$this->ArenaTeams[$t][$j+1];
						$this->ArenaTeams[$t][$j+1] = $tmp;
					}
				}
			}
		}
	}
	
	function load_arena_members($arenalist) {
		global $config,$mysql,$SQL;
		$r = $mysql->getRows("select arena_team_member.*, characters.race,characters.name,characters.class, ?3 as level, ?4 as gender
							 from ?1.arena_team_member inner join ?1.characters on arena_team_member.guid = characters.guid
							 where arenateamid IN (?2-1)",
							 $config['charDB'],$arenalist,SQL_template(CHAR_LEVEL_OFFSET),CHAR_GENDER_OFFSET);
		if(!$r) return;
		foreach($this->Types as $t) {
			foreach($this->ArenaTeams[$t] as $key => $value) {
				$this->ArenaTeams[$t][$key]['members'] = array();
				foreach($r as $row) {
					if($row['arenateamid'] == $this->ArenaTeams[$t][$key]['arenateamid']) 
						array_push($this->ArenaTeams[$t][$key]['members'],$row);
				}
			}
		}
	}
	
	function load_arena_stats($arenalist) {
		global $config,$mysql;
		$r = $mysql->getRows("select * from ?1.arena_team_stats where arenateamid IN (?2-1)",$config['charDB'],$arenalist);
		foreach($this->Types as $t) {
			foreach($this->ArenaTeams[$t] as $key => $value) {
				foreach($r as $row) {
					if($row['arenateamid'] == $this->ArenaTeams[$t][$key]['arenateamid']) {
						foreach($row as $k => $v) {
							$this->ArenaTeams[$t][$key][$k] = $v;
						}
					}
						
				}
			}
		}
	}
}

?>