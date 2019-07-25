<?php
$part = $_GET['part'];
$theme = $_GET['theme'];
$nick = $_GET['nick'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://velda.xyz/cm/banner/big/index.php?nick='.$nick.'&theme='.$theme);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); 
$data = curl_exec($ch);
curl_close($ch);
$im = imagecreatefromstring($data);

// find the size of image
$size = min(imagesx($im), imagesy($im));

// Set the crop image size
if ($part == "2"){
  $x = "400";
};
$im2 = imagecrop($im, ['x' => $x, 'y' => 0, 'width' => 400, 'height' => 400]);
if ($im2 !== FALSE) {
    header("Content-type: image/png");
       imagepng($im2);
    imagedestroy($im2);
}
imagedestroy($im);
?>
