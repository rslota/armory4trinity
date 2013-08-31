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

 $back = imagecreatefrompng("arenateam/PVP-Banner-".$type.".png");
 for ($x=0;$x<128;$x++)
 for ($y=0;$y<256;$y++)
 {
     $color_img = imagecolorat($back, $x, $y);
     if (($color_img>>24) == 0 && ($color_img&0xFF) > 32)
     {
      $res = ($color_img & 0xFF000000) | $bground;
      imagesetpixel($back, $x, $y, $res);
     }
 }
 imagesavealpha($back, true);

 $border = imagecreatefrompng("arenateam/PVP-Banner-".$type."-Border-".$borderid.".png");
 for ($x=0;$x<128;$x++)
 for ($y=0;$y<256;$y++)
 {
     $color_img = imagecolorat($border, $x, $y);
     $res = ($color_img & 0xFF000000) | $bcolor;
     imagesetpixel($border, $x, $y, $res);
 }
 imagesavealpha($border, true);

 imagecopy($back,$border,0,0,0,0,128,256);
 imagecopyresized($back,$emblem,10,32,0,0,80,80,128,128);

 imagepng($back);

 imagedestroy($back);
 imagedestroy($border);
 imagedestroy($emblem);
?>