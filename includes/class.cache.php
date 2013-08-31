<?php

class cache {
	public $type;
	public $guid;
	public $expire; 
	
	public $object;

	function __construct($type,$id) {
	   global $config;
	   if(!$this->test()) return false;
	   if(!$config['cache_status']) return false;
	   $this->type = $type;
	   $this->guid = (int)$id;
	   $this->expire = $config['cache_expire'];
	   $this->object = $this->start();
	   return true;
	}
	
	function start() {
		global $_SYSTEM;
	    if($this->type=='character') {
			$file = 'cache/'.'char_'.$_SYSTEM->Realm.'_'.$this->guid.'.cache';
			if(!file_exists($file) || !($content = file_get_contents($file))) {
				$character = new character($this->guid);
				$this->update($character);
				return $character;
			}
			$character = unserialize($content);
			if($character->lastupdate+$this->expire<time()) {
				$character = new character($this->guid);
				$this->update($character);
				return $character;
			}
			return $character;
		}else if($this->type=='guild') {
			$file = 'cache/'.'guild_'.$_SYSTEM->Realm.'_'.$this->guid.'.cache';
			if(!file_exists($file) || !($content = file_get_contents($file))) {
				$guild = new guild($this->guid);
				$this->update($guild);
				return $guild;
			}
			$guild = unserialize($content);
			if($guild->lastupdate+$this->expire<time()) {
				$guild = new guild($this->guid);
				$this->update($guild);
				return $guild;
			}
			return $guild;
		}else if($this->type=='pvp') {
			$file = 'cache/'.'pvp_'.$_SYSTEM->Realm.'.cache';
			if(!file_exists($file) || !($content = file_get_contents($file))) {
				$pvp = new pvpladder();
				$this->update($pvp);
				return $pvp;
			}
			$pvp = unserialize($content);
			if($pvp->lastupdate+$this->expire<time()) {
				$pvp = new pvpladder();
				$this->update($pvp);
				return $pvp;
			}
			return $pvp;
		}
	}
	
	function update($object) {
		global $_SYSTEM;
		if($this->type=='character') {
			$file = 'cache/'.'char_'.$_SYSTEM->Realm.'_'.$this->guid.'.cache';
			@file_put_contents($file,serialize($object));
		}else if($this->type=='guild') {
			$file = 'cache/'.'guild_'.$_SYSTEM->Realm.'_'.$this->guid.'.cache';
			@file_put_contents($file,serialize($object));
		}else if($this->type=='pvp') {
			$file = 'cache/'.'pvp_'.$_SYSTEM->Realm.'.cache';
			@file_put_contents($file,serialize($object));
		}
	}
	
	function test() {
		global $_SYSTEM;
		if(!is_dir('cache')) {
			system::log('Cache __construct() FAILD! Cache directoty does not exist.');
			return false;
		}
		if(!@file_put_contents('cache/test.cache','NULL')) {
			system::log('Cache __construct() FAILD! Cannot access to cache directoty.');
			return false;
		}
		return true;
	}

}