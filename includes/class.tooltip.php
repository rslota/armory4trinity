<?php
class tooltip {
    public $html;
	public $id;
	public $owner_id;
	public $enchants;

	public $items;
	public $item_instance;
    public $items_data;
	public $tipCache;

    function __construct($items,$item_instance,$guid,$data) {
		global $_SYSTEM,$SQL,$EQ_SLOT,$mysql,$config;
		$this->owner_id = $guid;
		$this->items = $items;
		$this->item_instance = $item_instance;
		$this->get_tooltip($this->items); // Load small tip cache
		for($i=0;$i<19;$i++) {

			$this->html[$i] = $this->get_tooltip($this->items[$i]); // Download from cache or try update db and cache.
			if($this->item_instance[$i]) $item_list .= $this->item_instance[$i].',';
		}
		if($r = $mysql->getRows("select * from `item_instance` where owner_guid = ?1 and guid IN (?2-1)",
				$this->owner_id,$item_list,'char')) {
			foreach($r as $row) {
				$this->items_data[$row['guid']] = $row['data'];
			}
		}
    }
	function get_tooltip($id) {
	  global $_LANGUAGE,$config,$mysql,$_SYSTEM;
	  if($id==0) return 'Not equipped.';
	  if($this->tipCache[$id]) return $this->tipCache[$id];

	  if(is_array($id)) {
		  foreach($id as $row) $ids.=$row.',';
		  $r = $mysql->getRows("SELECT `itemhtml`,`itemnumber` FROM `itemicon` WHERE itemnumber IN (?1-1)",$ids,'armory');
		  foreach($r as $row) {
			$this->tipCache[$row['itemnumber']] = $row['itemhtml'];
		  }
		  return;
	  }

	  $r = $mysql->getRow("SELECT `itemhtml` FROM `itemicon` WHERE itemnumber = ?1",$id,'armory');
	  $html=$r['itemhtml'];
        if(((bool)$html)==false) {
			$_SYSTEM->update_icon_db($id);
			$r = $mysql->getRow("SELECT `itemhtml` FROM `itemicon` WHERE itemnumber = ?1",$id,'armory');
			$html=$r['itemhtml'];
		}
		if(!$html) $html = 'Unknown Item :(';
		return stripslashes($html);
	}


	function update_set($slot) {
    	$ct = 0;
		foreach($this->items as $id) {
			    preg_match_all('/><!--si[0-9]*[:]*'.$id.'[:]*[0-9]*-->/s', $this->html[$slot], $match, PREG_SET_ORDER);
				if(count($match)) $ct++;
	            $this->html[$slot] = preg_replace('/><!--si[0-9]*[:]*'.$id.'[:]*[0-9]*-->/s', ' class="q6">', $this->html[$slot]);
		}
		$match = NULL;
		preg_match_all('/>\(([0-9]+)\) Set:/s', $this->html[$slot], $match, PREG_SET_ORDER);
		foreach($match as $m) {
		   if($m[1]<=$ct) $this->html[$slot]=str_replace('>('.$m[1].') Set:',' class="q2">('.$m[1].') Set:',$this->html[$slot]);
		}
		$match = NULL;
		preg_match_all('# \(0/([0-9]+)\)</span>#s', $this->html[$slot], $match, PREG_SET_ORDER);
		$this->html[$slot]=str_replace(' (0/'.$match[0][1].')</span>',' ('.$ct.'/'.$match[0][1].')</span>',$this->html[$slot]);
    }

	function transform($slot) {
		global $mysql,$config;
		$this->id = $this->items[$slot];
		$item_data = explode(' ',$this->items_data[$this->item_instance[$slot]]);
	    if($r = $mysql->getRows("select * from `itemenchant` where `id` IN (?1,?2,?3,?4,?5)",
		      $item_data[22],$item_data[25],$item_data[28],$item_data[31],$item_data[34],'armory')) {
		   foreach($r as $row) {
			   $this->enchants[$row['id']] = $row['text'];
		   }
	    }

	   $this->update_set($slot);
	   $this->add_enchants($slot);
	   $this->add_gems($slot);
	   $this->set_random_enchant($slot);
	   $this->output = $this->html[$slot];
	}

	function add_enchants($slot) {
			global $config,$mysql;
			$tab = array(22,25);
			$item_data = explode(' ',$this->items_data[$this->item_instance[$slot]]);
			foreach($tab as $i) {
			    if($item_data[$i]>0) {
						  $out .= '<span class="q2">'.$this->enchants[$item_data[$i]].'</span><br>';
				}
			}
			$match = NULL;
		    preg_match_all('#Durability [0-9]+ / [0-9]+#s', $this->html[$slot], $match, PREG_SET_ORDER);
		    if(count($match)) $this->html[$slot]=str_replace($match[0][0],$out.$match[0][0],$this->html[$slot]);
			//if($out!='') die($out);
	}

	function add_gems($slot) {
		global $config,$mysql;
		$item_data = explode(' ',$this->items_data[$this->item_instance[$slot]]);
		preg_match_all('#q0">([a-zA-Z]+) Socket</span>#s',$this->html[$slot],$match, PREG_SET_ORDER);
		//if($pointer==368)die(print_r($match));
		$tab = array(28,31,34);
	    $b=0;   $f=false;
		foreach($tab as $i) {
			if($item_data[$i]>0) {
				$f = true;
		        $bonus = $this->enchants[$item_data[$i]];
				if($bonus=='') $bonus = 'Unknown Bonus :( ('.$item_data[$i].')';
			    $this->html[$slot] = str_replace($match[$b++][0],'q1"> '.$bonus.'</span>',$this->html[$slot]);
			}
		}
		// Bonus
		if($item_data[37]>0)
			$this->html[$slot] = str_replace('class="q0">Socket Bonus:','class="q2">Socket Bonus:',$this->html[$slot]);
	}

	function set_random_enchant($slot) {
		  global $config,$ItemRandomEnchantSuffix,$SQL,$mysql,$_SYSTEM;
		  $item_data = explode(' ',$this->items_data[$this->item_instance[$slot]]);
		  $c=0;
		  if(!$item_data[ITEM_FIELD_ENCHANTMENT_PROP_1_ID_OFFSET]) return;
		  $RD_PROP = uint32($item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID_OFFSET]);
		  if($RD_PROP > 1000 || $RD_PROP < 0) { // Wylapmy maly wyjatek
			  $_SYSTEM->log("Cannot calculate 'ITEM_FIELD_RANDOM_PROPERTIES_ID'. Item: {$this->item_instance[$slot]}, data: {$item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID_OFFSET]}, value: {$RD_PROP}");
			  return;
		  }

		  foreach($ItemRandomEnchantSuffix as $t) {
			  if(uint32($item_data[ITEM_FIELD_RANDOM_PROPERTIES_ID_OFFSET])==$t[0]) {
				  $surfix = $t[1];
				  break;
			  }
			  $c++;
		  }
		  preg_match_all('#<b class="[a-z]+[0-9]+">(.*)</b><br />#s',$this->html[$slot],$match, PREG_SET_ORDER);
		  $this->html[$slot] = str_replace($match[0][1],$match[0][1].' '.$surfix,$this->html[$slot]);
		  if($res = $mysql->getRows("select * from `itemenchant` where `id` IN (?1,?2,?3)",
				   $item_data[ITEM_FIELD_ENCHANTMENT_PROP_1_ID_OFFSET],
				   $item_data[ITEM_FIELD_ENCHANTMENT_PROP_2_ID_OFFSET],
				   $item_data[ITEM_FIELD_ENCHANTMENT_PROP_3_ID_OFFSET],'armory')) {
				  foreach($res as $r) {
					 if($r['text']) $bonus .= '<span class="q1">'.$r['text'].'</span><br>';

					 switch($r['id']) {
						case $item_data[ITEM_FIELD_ENCHANTMENT_PROP_1_ID_OFFSET]: $i = $ItemRandomEnchantSuffix[$c][7] * $item_data[ITEM_FIELD_SUFFIX_FACTOR_OFFSET]/10000;break;
						case $item_data[ITEM_FIELD_ENCHANTMENT_PROP_2_ID_OFFSET]: $i = $ItemRandomEnchantSuffix[$c][8] * $item_data[ITEM_FIELD_SUFFIX_FACTOR_OFFSET]/10000;break;
						case $item_data[ITEM_FIELD_ENCHANTMENT_PROP_3_ID_OFFSET]: $i = $ItemRandomEnchantSuffix[$c][9] * $item_data[ITEM_FIELD_SUFFIX_FACTOR_OFFSET]/10000;
					 }
					 $bonus = str_replace('$i',intval($i),$bonus);
				  }
		  }

		if($bonus)
		  $this->html[$slot] = str_replace('<span class="q2">&lt;Random enchantment&gt;</span><!--e--><!--ps--><br />',$bonus,$this->html[$slot]);
	}
}
?>