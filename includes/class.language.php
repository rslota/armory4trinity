<?php
class language {
   public $text;
   public $lang;
   
   function __construct($lang) {
	    file_exists('languages/'.$lang.'.lng') ? $this->lang = $lang : $this->lang=false;  
		$this->get_set();
   }
   
   private function get_set() {
	   global $config;
	   $this->text = array();
	   if($this->lang===false) return false;
	   $langs=explode(";;\n",file_get_contents('languages/'.$this->lang.'.lng'));
	   for($i=0;$i<count($langs);$i++) {
		 $tmp=explode(' ==>> ',$langs[$i]);
		 $this->text[$tmp[0]]=trim($tmp[1]); 
		 $this->text[strtoupper($tmp[0])]=trim($tmp[1]);
		 
	   }
   }
   
   function translate($template) {
	  preg_match_all("/{\\\$LG([^}]+)}/",
      $template->output,$out, PREG_SET_ORDER);
	  
      for($i=0;$i<count($out);$i++) {
		$template->assign('LG'.$out[$i][1],$this->text[ $out[$i][1] ]);
	  }
   }
   function translateJS($template) {
	  foreach($this->text as $key => $value) {
		if(!preg_match('#^[a-z]+$#',$key)) continue;
		$st .= "LG['{$key}'] = \"{$value}\"; ";  
	  }
		$template->assign('transJS',$st);
   }
}

?>