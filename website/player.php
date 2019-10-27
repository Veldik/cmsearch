<!DOCTYPE html>
<?php
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
//global proměnné
global $origo;
?>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>CMSearch | <?php echo $player->getPlayerCraftMania("nick"); ?></title>
    <link rel="shortcut icon" href="<?php echo $player->getPlayerSkins("avatar"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#2575DC">
    <meta name="description" content="Základní informace o hráči <?php echo $player->getPlayerCraftMania("nick"); ?> ze serveru CraftManie.">
    <meta property="og:image" content="<?php echo $player->getPlayerSkins("head")?>">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script type="text/javascript" src="../js/main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("./analytics.php"); ?>
    <?php include("./header.php"); ?>
    <article class="player">
        <div class="main">
            <h1>
                Informace o hráči: <?php echo $player->getPlayerCraftMania("nick"); ?>
                <?php
                if ($player->getPlayerCraftMania("is_online")){
                    echo "<span style=\"color:lime;\" >(online)</span>";
                } else {
                    echo "<span style=\"color:red;\" >(offline)</span>";
                }
                ?>
            </h1>
            <img src="<?php echo $player->getPlayerSkins("full");?>">
            <div class="info">
                <h2>
                    Základní informace:
                </h2>
                <p>
                    <?php
                    if($origo){
                        echo "Hráč má originální Minecraft! <span style=\"color:lime;\" >✔</span>";
                    } else {
                        echo "Je warezák! <span style=\"color:red;\" >❌</span>";
                    }
                    ?><br>
                    Registrace: <b><?php echo $time->date($player->getPlayerCraftMania("registred"))?></b><br>
                    Naposledy online: <b><?php echo $time->timeAgo($player->getPlayerCraftMania("last_online"))?></b><br>
                    Nahraný čas: <b><?php echo round($player->getPlayerCraftMania("played_time"))?> hodin</b>
                </p>
            </div>
            <div class="info">
                <h2>
                    Ekonomika:
                </h2>
                <p>
                    CraftCoins: <b><?php echo $player->getPlayerCraftMania("craftcoins")?></b><br>
                    CraftTokens: <b><?php echo $player->getPlayerCraftMania("crafttokens")?></b><br>
                    VoteTokens: <b><?php echo $player->getPlayerCraftMania("votetokens")?></b><br>
                    Karma: <b><?php echo $player->getPlayerCraftMania("karma")?></b><br>
                    Achivement points: <b><?php echo $player->getPlayerCraftMania("aapoints")?></b><br>
                </p>
            </div>
            <div class="info">
                <h2>
                    Levely:
                </h2>
                <p>
                    Globální level: <b><?php echo $player->getPlayerCraftMania("level")?></b><br>
                    Survival level: <b><?php echo $player->getPlayerCraftMania("survival_level")?></b> <span class="xp">(<?php echo $player->getPlayerCraftMania("survival_xp")?>XP)</span><br>
                    SkyBlock level: <b><?php echo $player->getPlayerCraftMania("skyblock_level")?></b> <span class="xp">(<?php echo $player->getPlayerCraftMania("skyblock_xp")?>XP)</span><br>
                    Creative level: <b><?php echo $player->getPlayerCraftMania("creative_level")?></b> <span class="xp">(<?php echo $player->getPlayerCraftMania("creative_xp")?>XP)</span><br>
                    Vanilla level: <b><?php echo $player->getPlayerCraftMania("vanilla_level")?></b> <span class="xp">(<?php echo $player->getPlayerCraftMania("vanilla_xp")?>XP)</span><br>
                    Prison level: <b><?php echo $player->getPlayerCraftMania("prison_level")?></b> <span class="xp">(<?php echo $player->getPlayerCraftMania("prison_xp")?>XP)</span><br>
                    SkyCloud level: <b><?php echo $player->getPlayerCraftMania("skycloud_level")?></b> <span class="xp">(<?php echo $player->getPlayerCraftMania("skycloud_xp")?>XP)</span><br>
                </p>
            </div>
            <div class="info">
                <h2>
                    Hlasování:
                </h2>
                <p>
                    Celkem hlasů: <b><?php echo $player->getPlayerCraftMania("votes_total")?></b><br>
                    Měsíčně hlasů: <b><?php echo $player->getPlayerCraftMania("votes_month")?></b><br>
                    Týdenně hlasů: <b><?php echo $player->getPlayerCraftMania("votes_week")?></b><br>
                    Poslední hlas: <b><?php echo $time->timeAgo($player->getPlayerCraftMania("last_vote"))?></b><br>
                </p>
            </div>

            <?php
            if($player->getPlayerCraftMania("social_status") != "0" || $player->getPlayerCraftMania("facebook") != "0" || $player->getPlayerCraftMania("twitter") != "0" || $player->getPlayerCraftMania("twitch") != "0" || $player->getPlayerCraftMania("steam") != "0" || $player->getPlayerCraftMania("youtube") != "0" || $player->getPlayerCraftMania("web") != "0" || $player->getPlayerDiscord("id") != "0"){
                echo "<div class='info'><h2>Sociální sítě:</h2>";
            }
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
            if($player->getPlayerCraftMania("social_status") != "0" || $player->getPlayerCraftMania("facebook") != "0" || $player->getPlayerCraftMania("twitter") != "0" || $player->getPlayerCraftMania("twitch") != "0" || $player->getPlayerCraftMania("steam") != "0" || $player->getPlayerCraftMania("youtube") != "0" || $player->getPlayerCraftMania("web") != "0" || $player->getPlayerDiscord("id") != "0"){
                echo "</div>";
            }
            ?>

        </div>
    </article>
    <footer>
    </footer>
</body>
</html>
