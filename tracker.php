<?php
error_reporting(E_ERROR);
$ip = $_GET['ip'];
$port = $_GET['port'];
$json = json_decode(file_get_contents('http://'.$ip.':'.$port.'/status/'), true);
header('Content-Type: image/png');
$im = @imagecreatefrompng('tshock_status_background.png');
$font = 'visitor1.ttf';
$red = imagecolorallocate($im, 0xFF, 0, 0);
$grey = imagecolorallocate($im, 128, 128, 128);
if ($json['status'] == '200')
{
    imagettftext($im, 20, 0, 11, 26, $grey, $font, $json['name']);
    imagettftext($im, 20, 0, 10, 25, $black, $font, $json['name']);
    imagettftext($im, 15, 0, 11, 41, $grey, $font, 'IP: '.$ip);
    imagettftext($im, 15, 0, 10, 40, $black, $font, 'IP: '.$ip);
    imagettftext($im, 15, 0, 11, 61, $grey, $font, 'Port: '.$json['port']);
    imagettftext($im, 15, 0, 10, 60, $black, $font, 'Port: '.$json['port']);
    imagettftext($im, 15, 0, 11, 81, $grey, $font, 'Players: '.$json['playercount']);
    imagettftext($im, 15, 0, 10, 80, $black, $font, 'Players: '.$json['playercount']);
}
else
{
    imagettftext($im, 15, 0, 11, 21, $grey, $font, 'IP:'.$ip.':'.$port);
    imagettftext($im, 15, 0, 10, 20, $black, $font, 'IP:'.$ip.':'.$port);
    imagettftext($im, 78, 0, 10, 90, $red, $font, 'offline');
}
imagepng($im);
imagedestroy($im);
?>