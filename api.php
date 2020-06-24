<?php
// Slouží k vytahování dat, v tom že jeden request vrátí pouze požadované věci bez ostatníchblbostí :herold:
// Použití: /variable/nick
// Variable se určí podle proměnné z get.php
// Cenim, že to čteš
$var = $_GET["var"];
// Nezobrazování errorů, stejně tady žádné nejsou
ini_set("display_errors", 0);
// Přidání get.php
require_once('get.php');
// Proměná z URL
$searchednick = $_GET["nick"];
// Přidání classy
$player = new Player($searchednick);
$time = new Time();
// Zavolání funkce
$player->getPlayer();
$player->getPlayerCraftManiaCheck();
/*
Neni potreba .htaccess to stejne tam nepustí
if (!$var){
  echo "cau tohle je nejaka stranka, kde bude popis toho ze tohle proste vezme z cm api a vypise jenom ty data";
} elseif (!$nick){
  echo "jj tohle podobne jak prvni errorovka ale jenom ze chybi nick :)";
};*/
echo $player->getPlayerCraftMania($var);
?>
