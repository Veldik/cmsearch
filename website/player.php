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
$player->getPlayerCraftManiaCheck();
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
        <div class="main">
            <img src="<?php echo $player->getPlayerSkins("full");?>">
            <h1>
                Informace o hráči: <span style="color:orange"><?php echo $player->getPlayerCraftMania("nick"); ?></span>
            </h1>
            <h2>
                Sociální sítě:
            </h2>
            <?php
            if($player->getPlayerCraftMania("social_status") != "0"){
                echo "<p>Status: <b>" .$player->getPlayerCraftMania("social_status")."</b></p>";
            }
            if($player->getPlayerCraftMania("facebook") != "0"){
                echo "<p>Facebook: <a href='https://facebook.com/".$player->getPlayerCraftMania("facebook")."'>".$player->getPlayerCraftMania("facebook")."</a></p>";
            }
            if($player->getPlayerCraftMania("twitter") != "0"){
                echo "<p>Twitter: <a href='https://twitter.com/".$player->getPlayerCraftMania("twitter")."'>".$player->getPlayerCraftMania("twitter")."</a></p>";
            }
            if($player->getPlayerCraftMania("twitch") != "0"){
                echo "<p>Twitch: <a href='https://twitch.tv/".$player->getPlayerCraftMania("twitch")."'>".$player->getPlayerCraftMania("twitch")."</a></p>";
            }
            if($player->getPlayerCraftMania("steam") != "0"){
                echo "<p>Steam: <a href='https://steamcommunity.com/id/".$player->getPlayerCraftMania("steam")."'>".$player->getPlayerCraftMania("steam")."</a></p>";
            }
            if($player->getPlayerCraftMania("youtube") != "0"){
                echo "<p>YouTube: <a href='https://youtube.com/".$player->getPlayerCraftMania("youtube")."'>".$player->getPlayerCraftMania("youtube")."</a></p>";
            }
            if($player->getPlayerCraftMania("web") != "0"){
                echo "<p>Web: <a href='".$player->getPlayerCraftMania("web")."'>".$player->getPlayerCraftMania("web")."</a></p>";
            }
            if($player->getPlayerDiscord("id") != "0"){
                echo "<p>Discord: <b>".$player->getPlayerDiscord("fullname")."</b></p>";
            }
            ?>

        </div>
    </article>
    <footer>
    </footer>
</body>
</html>