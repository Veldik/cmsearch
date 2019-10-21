<!DOCTYPE html>
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
?>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>CMSearch | <?php echo $player->getPlayerCraftMania("nick"); ?></title>
    <link rel="shortcut icon" href="<?php echo $player->getPlayerSkins("avatar"); ?>">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
    <header>
    </header>
    <article>
        <h1>
            Informace o hráči: <?php echo $player->getPlayerCraftMania("nick"); ?>
        </h1>
        <img src="<?php echo $player->getPlayerSkins("full");?>">
        <img src="<?php echo $player->getPlayerDiscord("avatar");?>">
    </article>
    <footer>
    </footer>
</body>
</html>