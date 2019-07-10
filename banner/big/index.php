<?php
$urlnick = "https://api.mojang.com/users/profiles/minecraft/". $_GET['nick'];
$datanick = json_decode(file_get_contents($urlnick), true);
$warurl = "https://api.craftmania.cz/player/". $datanick["name"];
$wardata = json_decode(file_get_contents($warurl), true);
$waruuid = $wardata["data"]["uuid"];
$uuid = $datanick["id"];
       if (str_replace("-","",$waruuid) == $uuid){
          $nick = $datanick["name"]; 
       } else {
       $nick = $_GET['nick']; 
     };
$theme = $_GET['theme'];
$themes = array("1", "2", "3", "4", "5","6","7","8","rsty");

if (in_array($theme, $themes, true)) {
}else{
    $theme = "1";
};
if (strlen($nick) == 0){
  $nick = $_GET['nick'];
  $skinuuid = "8667ba71b85a4004af54457a9734eed7";
} else {
  $skinuuid = $uuid;
}


$url = "https://api.craftmania.cz/player/". $nick;
$data = json_decode(file_get_contents($url), true);
$apinick = $data["data"]["nick"];
$apiuuid = $data["data"]["uuid"];
$time = $data["data"]["played_time"];
$apiregister = $data["data"]["registred"];
$register = $apiregister / 1000;
$cc = $data["data"]["economy"]["craftcoins"];
$ct = $data["data"]["economy"]["crafttokens"];
$vt = $data["data"]["economy"]["votetokens"];
$all = $data["data"]["votes"]["total"];
$month = $data["data"]["votes"]["month"];
$week = $data["data"]["votes"]["week"];
$online = $data["data"]["is_online"];
$onlinedate = $data["data"]["last_online"];
$last_server = $data["data"]["last_server"];
$level = $data["data"]["ranked"]["level"];
$xp = $data["data"]["ranked"]["experience"];
$status = $data["data"]["social"]["status"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://visage.surgeplay.com/full/304/'.str_replace("-","",$skinuuid));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); 
  $data = curl_exec($ch);
  curl_close($ch);
  $src = imagecreatefromstring($data);
        $logo = $src;
        imageflip($src,IMG_FLIP_HORIZONTAL);
       $rImg = ImageCreateFromJPEG("main".$theme.".jpg");

$cor = imagecolorallocate($rImg, 255, 255, 255);

if ($theme == "4"){
$hodin = "h.";
} else {
  $hodin = " hodin";
};
$font_file = './ubuntu.ttf';

imagefttext($rImg, 26, 0, 20, 50, $cor, $font_file, "Hráč: ".$nick);
imagefttext($rImg, 26, 0, 20, 85, $cor, $font_file, "Level: ".$level." (".$xp."XP)");
imagefttext($rImg, 26, 0, 20, 120, $cor, $font_file, "Hlasy: ".$all);
imagefttext($rImg, 26, 0, 20, 155, $cor, $font_file, "Craftcoins: ".$cc);
imagefttext($rImg, 26, 0, 20, 190, $cor, $font_file, "Crafttokens: ".$ct);
imagefttext($rImg, 26, 0, 20, 225, $cor, $font_file, "Votetokens: ".$vt);
imagefttext($rImg, 26, 0, 20, 260, $cor, $font_file, "Nahraný čas: ".round($time / 60).$hodin);
imagefttext($rImg, 26, 0, 20, 295, $cor, $font_file, "Registrace: ".date('d.m.Y', $register));
imagefttext($rImg, 13, 0, 20, 390, $cor, $font_file, "Vytvořeno pomocí velda.xyz/cm");
/*
if ($status == "0"){

}else
imagefttext($rImg, 26, 0, 20, 295, $cor, $font_file, "Status: ".$status);
*/
imagefttext($rImg, 40, 0, 20, 375, $cor, $font_file, "MC.CRAFTMANIA.CZ");
        imagecopymerge_alpha($rImg, $logo, 590, 60, 0, 0, 188, 304, 100);

        header('Content-Type: image/png');
        function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){

                $cut = imagecreatetruecolor($src_w, $src_h);
                imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
                imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
                imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
            }
header('Content-type: image/jpeg');
imagejpeg($rImg, null, 100);



?>
