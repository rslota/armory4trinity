<?php
header("Content-Type: image/png");
$width = 550;
$height = 35;
$img = imagecreatetruecolor($width, $height);
$font_size = 18;
$font_color = imagecolorallocate( $img , 72, 67, 45 );
$font_shadow_color = imagecolorallocate( $img , 0, 0, 0 );
$font_file = "fonts/frizqt.ttf";
$background = imagecolorallocate( $img , 229 , 197 , 102 );
imagefilledrectangle( $img , 0 , 0 , $width , $height , $background);
$string = addslashes( $_GET["text"] );
imagettftext($img , $font_size , 0 , 1 , 25 , $font_shadow_color , $font_file , $string );
imagettftext($img , $font_size , 0 , 0 , 24 , $font_color , $font_file , $string );
imagecolortransparent($img, $background );
imagepng($img);
imagedestroy($img);

?>