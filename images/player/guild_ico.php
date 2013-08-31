<?php
header("Content-type: image/png");
$backid = $_GET['back'];
$emblemid = $_GET['emblem'];
$emblemc  = $_GET['ecolor'];
$borderid = $_GET['border'];
$borderc  = $_GET['bcolor'];

$back   = imagecreatefrompng(sprintf("guilds/background_%02d.png",$backid));
$border = imagecreatefrompng(sprintf("guilds/border_%02d_%02d.png",$borderid, $borderc));
$emblem = imagecreatefrompng(sprintf("guilds/emblem_%02d_%02d.png",$emblemid, $emblemc));

imagecopy($back,$border,0,0,0,0,64,96);
imagecopy($back,$emblem,0,32,0,0,64,64);

$temp = imagecreatetruecolor(96, 96);
imagealphablending($temp, false);
imagesavealpha($temp, true);

imagecopyresampled($temp,$back,0,0,0,0,48,96,64,96);
imagecopyresampled($temp,$back,48,0,63,0,48,96,-64,96);

imagepng($temp);

imagedestroy($back);
imagedestroy($border);
imagedestroy($emblem);
imagedestroy($temp);

?>