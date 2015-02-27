<?php

$dir = dirname(__FILE__);

$expires = 60 * 60 * 24 * 7;
header("Cache-Control: public, max-age=" . $expires);
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
header('Content-Type: application/javascript');

//readfile($dir . '/jquery.cycle2.carousel.min.js');
readfile($dir . '/jquery.cycle2.flip.min.js');

if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'msie') !== false)
{
	readfile($dir . '/jquery.cycle2.ie-fade.min.js');
}

readfile($dir . '/jquery.cycle2.scrollVert.min.js');
readfile($dir . '/jquery.cycle2.shuffle.min.js');
readfile($dir . '/jquery.cycle2.tile.min.js');