<?php
// Nezobrazování errorů, stejně tady žádné nejsou
// ini_set("display_errors", 0);
// Přidání get.php
require_once('get.php');
// Proměná z URL
$searchednick = $_GET["nick"];
// Přidání classy
$player = new Player($searchednick);
// Zavolání funkce
$player->getPlayer();
echo $player->getPlayerCraftMania("level");
?>
<br>
<img src="<?php echo $player->getPlayerSkins("full"); ?>">
