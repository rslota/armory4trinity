<?php
class template {
   private $templates_dir;
   public $output;
   function __construct($dir='') {
	   global $config;
	   $dir=='' ? $dir = $config['templates_dir'] : $dir = $dir;
	   is_dir($dir) ? $this->templates_dir = $dir : 0;
	   return true;
   }
   
   private function open_file($file) {
	  is_readable($this->templates_dir.$file) ? $ret = file_get_contents($this->templates_dir.$file) : $ret = 0;
	  return $ret;
   }
   
   function add($file) {
	  global $_DOMAIN;
	  $this->output .= $this->open_file($file.'.tpl');
	  $this->assign('DOMAIN',$_DOMAIN);
	  
   }
   
   function assign($from,$to) {
	  return $this->output = str_replace('{$'.$from.'}', $to, $this->output);   
   }
   
   function display() {
	  echo $this->output;
   }
   
   function get() {
	 return $this->output;   
   }
   
   function clean() { 
     $this->output='';
   }
}
?>