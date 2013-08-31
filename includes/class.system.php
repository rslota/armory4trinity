<?php
class system {

   public $server,$lastupdate;
   public $Realms = array();
   public $Realm;
   private $Requiremants,$arenaLadderCron;

   function __construct() {
	   global $mysql,$config,$_FPREFIX;
	   if($_GET['searchplugin']) {header('Content-type: text/xml');die($this->getOpenSearchPlugin());}
	   $this->Requiremants = new DomDocument;
	   $config_file = $_FPREFIX.'includes/requirements.xml';
	   if(!file_exists($config_file) || !is_readable($config_file))
	   	  $this->error("Cannot read <i>$config_file</i> file!",false);
	   $this->Requiremants ->load($config_file);

	   $this->checkSystem();

       //$u = $mysql->getRow("SELECT * FROM armory_info",'char');
       $this->lastupdate = $u['characters_lastupdate'];

	   $this->server = $config['server_name'];
	   $this->arenaLadderCron = 60*60*24*3;


   }
   
   function postConfig() {
    $this->checkDB();
    $this->loadRealms();
    $this->updateArenaLadder();
   }

   function loadRealms() {
		global $mysql,$config;
		if(!count($config['realms']))
			$this->error("No realms.",false);
		foreach($config['realms'] as $realm) {
			$realm_ids.=$realm[0].',';
		}
		$realms = $mysql->getRows('SELECT id,name from `realmlist` WHERE `id` IN (?1-1)',$realm_ids,'realm');
		if(!$realms) {die('Cannot load realmlist!');return;}
		foreach($realms as $realm) {
			$this->Realms[$realm['id']] = $realm['name'];
			foreach($config['realms'] as $val) {
				if($realm['id']==$val[0]) {
					$mysql->Config['char'][$realm['id']]['host'] = $val[1];
					$mysql->Config['char'][$realm['id']]['port'] = $val[2];
					$mysql->Config['char'][$realm['id']]['user'] = $val[3];
					$mysql->Config['char'][$realm['id']]['passwd'] = $val[4];
					$mysql->Config['char'][$realm['id']]['name'] = $val[5];
					$mysql->Config['char'][$realm['id']]['default'] = $val[6];
					break;
				}
			}

		}
		
		if(in_array($_GET['Realm'],$this->Realms))
			$this->Realm = array_search($_GET['Realm'],$this->Realms);
	   else
			foreach($mysql->Config['char'] as $key => $realm)
					if($realm['default']) $this->Realm = $key;
	   if(!$this->Realm)
			foreach($mysql->Config['char'] as $key => $realm) {
				$this->Realm = $key;break;
   		}
   }

   function checkDB() {
	   global $mysql,$config;
	   $doc = $this->Requiremants;
	   $r = $mysql->getRows('SHOW TABLES','armory');
	   if(!$r)  $this->error("No tables in armory DB!",false);
	   foreach($r as $row) {
			$tables[] =  $row['Tables_in_'.$mysql->Config['armory']['name']];
	   }
	   $doc = $this->Requiremants;
	   $tb = $doc->getElementsByTagName('database');
	   $tb = $tb->item(0)->getElementsByTagName('table');
	   foreach($tb as $table) {
		   $name = $table->getAttribute('name');
		   if(!in_array($name,$tables))
		   		$this->error("Table <i>$name</i> doesnt exists!",false);
	   }
   }

   function checkSystem() {
	   global $mysql,$config,$_FPREFIX,$_DOMAIN;

	   $doc = $this->Requiremants;
	   $php = $doc->getElementsByTagName('php');
	   $php = $php->item(0)->getAttribute('minversion');
	   if(version_compare(PHP_VERSION, $php)<0)
		   $this->error("PHP version is lower then <i>$php</i>.",false);

	   $ext = $doc->getElementsByTagName('packages');
	   $ext = $ext->item(0)->getElementsByTagName('package');
	   foreach($ext as $pac) {
			$p = $pac->getAttribute('name');
			if(!extension_loaded($p))
				$this->error("Extension <i>$p</i> is not loaded!",false);
	   }
	   
	   // Check for mod_rewrite
	   if(!$_GET['rewrite']) $this->error("Apache extension <i>mod_rewrite</i> is not loaded!",false);
   }

   function updateArenaLadder() {
      global $mysql;
      $res = $mysql->getRow("SELECT * FROM `armory_info`",'armory');
      if(!$res) {
          $this->log('Table `armory_info` does not exists or is not complete. (MySQL Error: ['.mysql_error().'])');
          return; 
      }
      if($res['arenaladder_lastupdate']+$this->arenaLadderCron < time()) {
          $mysql->query("delete from arena_ladder where 1");
          $types = array(2,3,5);
          foreach($this->Realms as $rID => $rName) {
          	foreach($types as $type) {
          		$r = $mysql->getRows("select arena_team.arenateamid as id
          				from arena_team,arena_team_stats
          				where arena_team.arenateamid = arena_team_stats.arenateamid and arena_team.type = ?1
          				order by arena_team_stats.rating desc",$type,'char_'.$rID);
          		if(!$r) continue;
          		foreach($r as $pos => $row) {
          				$mysql->query("insert into arena_ladder values (NULL,?1,?2,?3)",$row['id'],$rID,$pos+1,'armory');
          		}
          	}
          }
          $mysql->Query("UPDATE `armory_info` SET arenaladder_lastupdate = ?1",time(),'armory');
          $this->log("Arena Ladder update complete.",'system');
      }
   }

   public function escape($string,$all='') {
     //$string = mysql_escape_string($string);
     if(get_magic_quotes_gpc()) $string = stripslashes($string);
	 $string = mysql_real_escape_string($string);
     $search = array('@<script[^>]*?>.*?</script>@si',
		               '@<style[^>]*?>.*?</style>@siU',
		               '@<[\/\!]*?[^<>]*?>@si',
		               '@<![\s\S]*?--[ \t\n\r]*>@'
     );
     //$text = preg_replace($search, '', $string);
	 $text = strip_tags($string,$all);
     return $text;
  }

  function log($txt,$fname='error') {
  	global $_FPREFIX;
	  $file=$_FPREFIX.'logs/'.basename($fname).'.log';
	  @file_put_contents($file,@file_get_contents($file)."\n"."[".date("d-m-Y H:i")."] [".$_SERVER['REMOTE_ADDR']."] ".$txt);
  }
   
  function update_icon_db($id,$dump=false) {
	  global $config,$mysql,$_FPREFIX;
	  if(!$config['icon_updater']) return 0;
	  $doc = new DomDocument;
	  set_time_limit(10);
	  $this->log('Updating item icon '.$id,'system');
	  $doc->load('http://www.wowhead.com/?item='.$id.'&xml');
	  $v=$doc->getElementsByTagName('icon');
      foreach($v as $node) {
         $icon=$node->nodeValue;
      }
	  $v=$doc->getElementsByTagName('htmlTooltip');
	  foreach($v as $node) {
         $html=$node->nodeValue;
      }
      if(!$mysql->getRow("SELECT `itemicon` FROM `itemicon` WHERE itemnumber = ?1",$id,'armory')) {
		  if(!$mysql->query("INSERT INTO `itemicon` VALUES ('?2', 'null', '0', '?3', '?4', '0', '0', NULL);",
	  $config['armoryDB'],$id,addslashes($html),$icon)) {
			  $this->log('ICON UPDATER: '.$icon.' - insert to DB - FAILD ('.mysql_error().')');
			  return false;
		  }
	  }
	  if(!$mysql->query("UPDATE `itemicon` SET itemhtml = '?1',itemicon = '?2' WHERE itemnumber = ?3",
			addslashes($html),basename($icon),$id,'armory')) {
	   $this->log('ICON UPDATER: '.$id.' '.$icon.' update DB - FAILD');
	  }
	   $icon_src=$_FPREFIX."images/icons/64x64/".strtolower($icon).".jpg";
       if(!file_exists($icon_src)) {
      		if($res_img=@imagecreatefromjpeg('http://www.wowarmory.com/wow-icons/_images/64x64/'.strtolower($icon).'.jpg')){
			       if(!imagejpeg($res_img, $icon_src)) {
					  $this->log('ICON UPDATER: '.$icon.' - icon save - FAILD');
				      return false;
				   }
			 }else{
				$this->log('ICON UPDATER: '.'icon '.$icon.' download - FAILD');
			    return false;
			 }
		}
      return true;
  }


  function htmlcode($string) {
	$s = array('<','>','"',"'","\n\r","\n","\r","&nbsp;");
	$r = array('&#60;','&#62;','&#92;&#34;','&#92;&#39;','<br>','<br>','<br>',' ');
	return str_replace($s,$r,$string);
  }

  function error($text,$footer=true) {
	if(!$footer) die($text);
	$c = new template();
	$c->add('headers');
	$menu = system::makeMenu();
	$c->assign('title','The World of Warcraft Armory - Error');
	$c->add('main');
	$c->assign('menu',$menu->output);
	$tp = new template();
	$tp->add('error');
	$tp->assign('error',$text);
	$c->assign('content',$tp->output);
	$c->display();
	$this->printFooter();
	exit;
  }

  function printFooter() {
	  $tp = new template();
	  $tp->add('bottom');
	  $tp->assign('version',SCRIPT_VERSION);
	  $tp->display();
  }

  function makeMenu() {
  	global $config,$ItemClass,$ItemSubClass;
  	$menu = new template();
	$menu->add('menu');
	$menu->assign('DKLock', $config['mangos_version']?'':'display:none');
	$menu->assign('slink',$config['server_link']);
	$menu->assign('sname',$config['server_name']);
	$item_menu='<li><a href="search.php?searchType=items">Items</a><ul>';
	foreach($ItemClass as $cl=>$name) {
		$item_menu.='<li '.(count($ItemSubClass[$cl])>1?'class="fly"':'').'><a href="search.php?searchType=items&ItemClass='.$cl.'">'.$name.'</a>';
		if(count($ItemSubClass[$cl])>1) {
			$item_menu.='<ul>';
	        foreach($ItemSubClass[$cl] as $scl=>$sname) $item_menu.='<li><a href="search.php?searchType=items&ItemClass='.$cl.'&ItemSubClass='.$scl.'">'.$sname.'</a></li>';
			$item_menu.='</ul>';
		}
		$item_menu.='</li>';
  }
  $menu->assign('items',$item_menu.'</ul></li>');
  return $menu;
  }

  function getOpenSearchPlugin() {
	  global $_DOMAIN;
	  $tmp = '<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/"
                       xmlns:moz="http://www.mozilla.org/2006/browser/search/">
		<ShortName>'.$this->server.' Armory</ShortName>
		<Description>WoW Armory Search on '.$this->server.'</Description>
		<InputEncoding>UTF-8</InputEncoding>
		<Image width="16" height="16">data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAQAQAAAAAAAAAAAAAAAAAAAAAAAD%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAI%2BQkP9ib3j%2FV3WC%2F16AjP9tfoX%2FkZCR%2F%2F%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8AkZKT%2FzdYff8iZp%2F%2FKXSm%2FzSDrP9FoMH%2FWszv%2F27w%2F%2F90rq%2F%2Fl5eW%2F%2F%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8ANWqV%2FyBbkv8gWYv%2FGxkh%2Fx4DAf8bAQH%2FBAEB%2FwEBAf8XNzv%2Ff%2BDg%2F4Xx7%2F8zYo7%2F%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8AW4SQ%2FyVur%2F8nSmr%2FOxUB%2Fy4pOf8tJkn%2FMx8c%2FyISHv8VE0H%2FDBAt%2FwEBAv9In6n%2FXNf%2B%2F1Nve%2F%2F%2F%2F%2F8A%2F%2F%2F%2FADNeh%2F8dUXz%2FUCoT%2F2MiDP9Ah5j%2FSsP%2F%2Fw86X%2F8nXGf%2FSrb%2B%2FydUl%2F8CAQX%2FAgEL%2F0ekvv9Lgpf%2F%2F%2F%2F%2FAJufov8gZqj%2FQDMt%2F2xFMv9MGA7%2FOJ6o%2F0q6%2F%2F8gQn%2F%2FKo2D%2F1f%2F%2F%2F8rc8H%2FCAQG%2FwsKFv8aKj3%2FQJ3O%2F5KTlf9ugpb%2FI1aG%2F144JP9qRzr%2FOiQZ%2FzXU8f81mtf%2FM4O%2B%2FzKgxf9A2ez%2FOKjo%2Fw0BBf8SEhL%2FDxAa%2Fytpl%2F9hcoH%2FXHiU%2Fy1HaP9xRzH%2FaDwu%2FzM%2FOP8y3v%2F%2FH0ps%2FznD3P8yk9T%2FKYeF%2FzTO%2F%2F8pGyb%2FHxEH%2FxAND%2F8eSHD%2FV22B%2F1t7l%2F88VHD%2FkF9G%2F3U%2BLP9Dn5j%2FKcv%2F%2FyohNv9FyNT%2FK1mm%2FzJdWP804v%2F%2FLThX%2FzUYBv8WDgn%2FHUJo%2F1hug%2F9sh5v%2FOXKZ%2F61rTP94STX%2FStHS%2Fx9%2F1v80AQH%2FSaKs%2FzEycv88MRf%2FNeL%2F%2FydCb%2F87GwP%2FHhEF%2Fx5Idv9ndoj%2FlJyg%2FyaVyP%2BIVT7%2FiFc7%2F0DE5v8jVrj%2FUiMF%2F1dxhv8yMlr%2FOSUM%2Fzi79P8sN5T%2FKRIB%2FxsXEf8aTIf%2FjpCT%2F%2F%2F%2F%2FwA5mbj%2FUHqF%2F2Y8MP9G1P%2F%2FOFOR%2F4dTLv9wTET%2FOzAs%2F0UkFf9NtOf%2FZ5Hn%2Fx4MB%2F8cNFD%2FJ0Rt%2F%2F%2F%2F%2FwD%2F%2F%2F8AWnOF%2FzfE8P86cYH%2FkYV0%2F42DdP%2B6jHL%2FmnNd%2F4hgTv9WQTL%2FRGlf%2F0ZnXP8cM03%2FFEGE%2F1hndf%2F%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwBdsdb%2FW%2Bn6%2F6HOyv%2Foyq7%2F%2F8Wl%2F%2B%2Bif%2F%2FAfmD%2FfFA0%2F0onE%2F8rTnD%2FIWOk%2F16ewP%2F%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAI%2BVlv9wytD%2Fbez4%2F1vK2P99xcf%2FY6ev%2F0Ggt%2F87s%2BH%2FSY60%2F46Rlf%2F%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAJaam%2F9rlZ%2F%2FWJqn%2F1%2Beq%2F97naj%2FpKep%2F%2F%2F%2F%2FwD%2F%2F%2F8A%2F%2F%2F%2FAP%2F%2F%2FwD%2F%2F%2F8A%2BB8AAOAHAADAAwAAgAEAAIABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAAQAAgAEAAMADAADgBwAA%2BB8AAA%3D%3D</Image>
		<Url type="text/html" method="get" template="'.$_DOMAIN.'search.php?searchQuery={searchTerms}&#38;searchType=all">
		</Url>
		<SearchForm>'.$_DOMAIN.'index.php</SearchForm>
		</OpenSearchDescription>';
	return $tmp;
  }

}
?>