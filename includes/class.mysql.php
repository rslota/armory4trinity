<?php
class mysql {
	public $QueryCount;
	public $Query;
	public $Timer;
	public $Config;
	private $Connection = array();
	function __construct() {
		global $config;
		$this->Config['armory']['host'] = $config['armory_DB_host'];
		$this->Config['armory']['port'] = $config['armory_DB_port'];
		$this->Config['armory']['user'] = $config['armory_DB_user'];
		$this->Config['armory']['passwd'] = $config['armory_DB_passwd'];
		$this->Config['armory']['name'] = $config['armory_DB_name'];

		$this->Config['world']['host'] = $config['world_DB_host'];
		$this->Config['world']['port'] = $config['world_DB_port'];
		$this->Config['world']['user'] = $config['world_DB_user'];
		$this->Config['world']['passwd'] = $config['world_DB_passwd'];
		$this->Config['world']['name'] = $config['world_DB_name'];

		$this->Config['realm']['host'] = $config['realm_DB_host'];
		$this->Config['realm']['port'] = $config['realm_DB_port'];
		$this->Config['realm']['user'] = $config['realm_DB_user'];
		$this->Config['realm']['passwd'] = $config['realm_DB_passwd'];
		$this->Config['realm']['name'] = $config['realm_DB_name'];

		if(!$this->Connect('realm'))
			die("Cannot connect to realm database");
		if(!$this->Connect('armory'))
			die("Cannot connect to armory database");
		if(!$this->Connect('world'))
			die("Cannot connect to world database");
		$this->QueryCount=0;
	}

	function Connect($type,$rID=-1) {
	  global $_SYSTEM;
	  if(strpos($type,'char_')!==false) {
		  $rID = explode('char_',$type);
		  $rID = (int)$rID[1];
		  $type='char';
	  }
	  if(!in_array($type,array('realm','world','char','armory'))) {
		 return;
	  }


	  if($type=='char') {
		  if(!$this->Config['char'][$rID]) {
				$rID = $_SYSTEM->Realm;
		  }
		  if($this->Connection = @mysql_connect($this->Config[$type][$rID]['host'].':'.$this->Config[$type][$rID]['port'],
						$this->Config[$type][$rID]['user'],$this->Config[$type][$rID]['passwd'])) {
			 if(@mysql_select_db($this->Config[$type][$rID]['name'],$this->Connection)) return true;
			 else return false;
		  }else return false;
	  }
	  else {

		  if($this->Connection = @mysql_connect($this->Config[$type]['host'].':'.$this->Config[$type]['port'],
							$this->Config[$type]['user'],$this->Config[$type]['passwd'])) {
			 if(@mysql_select_db($this->Config[$type]['name'],$this->Connection)) return true;
			 else return false;
		   }else return false;
	  }
   }


   function getRow($query) {
	  $this->Connect(func_get_arg(func_num_args()-1));
	  $query.=" ";
	  preg_match_all('#\?([0-9]+[^0-9])#s',$query,$matches, PREG_SET_ORDER);
	  foreach($matches as $match) {
		$val = func_get_arg(substr($match[1],0,-1));
		
		$query = str_replace('?'.$match[1],$val.substr($match[1],-1),$query);
	  }
	  $this->QueryCount++;
	  $this->Query = $query;
	  $start = microtime(true);
	  if(!($res = @mysql_query($query." ",$this->Connection))) return false;
	  $this->Timer = microtime(true)-$start;
	  if(!@mysql_num_rows($res)) return 0;
	  return @mysql_fetch_assoc($res);
   }

   function query($query) {
	  $this->Connect(func_get_arg(func_num_args()-1));
	  $query.=" ";
	  preg_match_all('#\?([0-9]+[^0-9])#s',$query,$matches, PREG_SET_ORDER);
	  foreach($matches as $match) {
		$val = func_get_arg(substr($match[1],0,-1));
		$query = str_replace('?'.$match[1],$val.substr($match[1],-1),$query);
	  }
	  $this->QueryCount++;
	  $this->Query = $query;
	  $start = microtime(true);
	  if(!($res = @mysql_query($query,$this->Connection))) return false;
	  $this->Timer = microtime(true)-$start;
	  return $res;
   }

   function getRows($query) {
	  $this->Connect(func_get_arg(func_num_args()-1));
	  $query.=" ";
	  preg_match_all('#\?([0-9]+[^0-9])#s',$query,$matches, PREG_SET_ORDER);
	  foreach($matches as $match) {
		$val = func_get_arg(substr($match[1],0,-1));
		$query = str_replace('?'.$match[1],$val.substr($match[1],-1),$query);
	  }
	   $this->QueryCount++;
	   $this->Query = $query;
	   $start = microtime(true);
	  if(!($res = @mysql_query($query,$this->Connection))) return false;
	  $this->Timer = microtime(true)-$start;
	  if(!@mysql_num_rows($res)) return 0;

	  $tab = array();
	  while($r = mysql_fetch_assoc($res)) {
		  $tab[] = $r;
	  }
	  return $tab;
   }
}

?>