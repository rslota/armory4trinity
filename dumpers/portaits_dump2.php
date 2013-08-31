<?php
exit;
$dir='new';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
			if($file=='.' || $file=='..' || file_exists('small/'.$file)) continue;
            $img = imagecreatefrompng('new/'.$file);
			imagecopyresized($img2,$img,0,0,0,0,38,38,56,56);
			imagepng($img2,'new/small/'.$file);
			exit;
        }
        closedir($dh);
    }
}

?>