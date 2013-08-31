<?php
$path = 'icons/64x64/';

if($_GET['icon']!='INV-Mount_Raven_54') $_GET['icon'] = str_replace('-',' ',$_GET['icon']);

$h_base=$w_base = 64;
$h_target=$w_target = (int)$_GET['size'];

function yiq($r,$g,$b) {
	return (($r*0.299)+($g*0.587)+($b*0.114));
}


function gray($base) {
	global $h_base,$w_base;
    $bwimage= imagecreate($w_base, $h_base);

	for ($c=0;$c<256;$c++){
		$palette[$c] = imagecolorallocate($bwimage,$c,$c,$c);
	}
    for ($y=0;$y<$h_base;$y++) {
		for ($x=0;$x<$w_base;$x++) {
			$rgb = imagecolorat($base,$x,$y);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			$gs = yiq($r,$g,$b);
			imagesetpixel($bwimage,$x,$y,$palette[$gs]);
		}
	}
	return $bwimage;
}

header('Content-type: image/png');

if(!file_exists($path.basename(strtolower($_GET['icon'])).'.jpg')) {
	$base = @imagecreatefromjpeg('http://www.wowarmory.com/wow-icons/_images/64x64/'.basename(strtolower($_GET['icon'])).'.jpg');
	if($base) @imagejpeg($base,$path.basename(strtolower($_GET['icon'])).'.jpg');
}else $base = imagecreatefromjpeg($path.basename(strtolower($_GET['icon'])).'.jpg');
if(!$base || !basename(strtolower($_GET['icon'])) || !file_exists($path.basename(strtolower($_GET['icon'])).'.jpg')) $base = imagecreatefromjpeg($path.'inv_misc_questionmark.jpg');
$target = imagecreatetruecolor($w_target,$h_target);
if($_GET['type']=='gray') $base = gray($base);
imagecopyresampled($target, $base, 0, 0, 0, 0, $w_target, $h_target, $w_base, $h_base);
imagepng($target);

?>