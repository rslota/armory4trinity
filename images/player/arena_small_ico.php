<?php
 $type     = intval(@$_REQUEST['type']);
 $bground  = intval(@$_REQUEST['back']);
 $emblemid = intval(@$_REQUEST['emblem']);
 $ecolor   = intval(@$_REQUEST['ecolor']);
 $borderid = intval(@$_REQUEST['border']);
 $bcolor   = intval(@$_REQUEST['bcolor']);

 header("Content-type: image/png");

 $emblem = imagecreatefrompng("arenateam/PVP-Banner-Emblem-".$emblemid.".png");
 for ($x=0;$x<128;$x++)
 for ($y=0;$y<128;$y++)
 {
     $color_img = imagecolorat($emblem, $x, $y);
     $res = ($color_img & 0xFF000000) | $ecolor;
     imagesetpixel($emblem, $x, $y, $res);
 }
 imagesavealpha($emblem, true);

 $back = imagecreatetruecolor(128, 128);
 imagefill($back,0,0,$bground);
 imagecopy($back,$emblem,0,0,0,0,128,128);

 imagepng($back);

 imagedestroy($back);
 imagedestroy($emblem);
?>