<?php
$urlnick = "https://api.mojang.com/users/profiles/minecraft/". $_GET['nick'];
$datanick = json_decode(file_get_contents($urlnick), true);

$warurl = "https://api.craftmania.cz/player/". $datanick["name"];
$wardata = json_decode(file_get_contents($warurl), true);
$waruuid = $wardata["data"]["uuid"];


$uuid = $datanick["id"];



       if (str_replace("-","",$waruuid) == $uuid){
          $nick = $datanick["name"];            //origo
       } else {
       $nick = $_GET['nick'];   //warez
       }



if (strlen($nick) == 0){
  $avatar = '<img src="https://visage.surgeplay.com/head/128/8667ba71b85a4004af54457a9734eed7">';
  $ogimage = 'https://visage.surgeplay.com/head/128/8667ba71b85a4004af54457a9734eed7';
  $nick = $_GET['nick'];
} else {
$avatar = '<img src="https://visage.surgeplay.com/head/128/'. $uuid .'">';
$ogimage = 'https://visage.surgeplay.com/head/128/'. $uuid;
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta name="generator" content="HTML Tidy for HTML5 for Windows version 5.6.0">
  <meta charset="UTF-8">
  <title>Informace | <?php echo $nick ?></title>
  <link rel="stylesheet" type="text/css" href="https://velda.xyz/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#2575DC">
  <meta name="description" content="Základní informace o hráči <?php echo $nick ?> ze serveru CraftManie.">
  <meta property="og:image" content="<?php echo $ogimage ?>">
  <link rel="shortcut icon" href="https://minotar.net/avatar/<?php echo $nick ?>/32.png"type="image/x-icon">
  <link rel="stylesheet" href=
  "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="/js/main.js"></script><!-- Global site tag (gtag.js) - Google Analytics -->

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-62697528-3"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-62697528-3');
  </script>
  <style>
    h1{
      padding-top:20px;
    }
    h2{
      font-size: 19px;
    }
    article{
      padding-bottom: 130px;
    }
    footer{
      position: fixed;
      width: 100%;
      bottom: 0px;
    }
    input[type=submit] {
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  background-color: #2575DC;
  color: #e0e0e0;
  }
    input[type=text] {
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: none;
  background-color: #2575DC;
  color: #e0e0e0;
  }
  ::placeholder {
  color: #a8a8a8;
  }
  .banner {
  max-width: 800px;
  width: 100%;
  height: auto;
  }
  </style>
</head>
<body>
  <article>
    <center>
      <form method="get" action="/cm/search.php">
        <input type="text" name="nick" placeholder="Nick"> <input type="submit" value="Vyhledat">
      </form>
      <h1>Informace o hráči: <?php echo $nick ?></h1><?php
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
      $lastvote = $data["data"]["votes"]["last_vote"];
      $online = $data["data"]["is_online"];
      $onlinedate = $data["data"]["last_online"];
      $last_server = $data["data"]["last_server"];
      $level = $data["data"]["ranked"]["level"];
      $xp = $data["data"]["ranked"]["experience"];
       ?><?php
       if (str_replace("-","",$apiuuid) == $uuid){
         $original = 'Má originální Minecraft!';
       } else {
         $original = 'Je warezák!';
       }
       echo $avatar
       ?>
      <h2>Základní informace:</h2><?php echo $original ?><br>
      Nahraný čas: <?php echo round($time / 60)  ?> hodin<br>
      Registrace: <?php echo date('d.m.Y', $register); ?><br>
      Level: <?php echo $level." (".$xp."XP)"?><br>
      <?php
       if ($last_server == survival)
       { $last_server_sklonovane = survivalu;}
       if ($last_server == skyblock)
       {$last_server_sklonovane = skyblocku;}
       if ($last_server == "creative")
       {$last_server_sklonovane = creativu;}
       if ($last_server == ohub)
       {$last_server_sklonovane = lobby;}
       if ($last_server == vanilla)
       {$last_server_sklonovane = vanille;}
       if ($last_server == lobby)
       {$last_server_sklonovane = lobby;}
       if ($last_server == lobby2)
       {$last_server_sklonovane = lobby;}
       if ($last_server == hub)
       {$last_server_sklonovane = lobby;}
       if($online == false) {
            echo "Je offline, naposledy byl online: " . date('d.m.Y H:i:s', $onlinedate/1000);;
        } else {
            echo "Je online na " . $last_server_sklonovane ."!";
        }
       ?><br>
      <br>
      <h2>Ekonomika:</h2>Craftcoins: <?php echo $cc ?><br>
      Crafttokens: <?php echo $ct ?><br>
      Votetokens: <?php echo $vt ?><br>
      <br>
      <a href="https://czech-craft.eu/vote?id=7113&user=<?php echo $nick?>"target="_blank">
      <h2>Hlasováni:</h2>
      </a>
      <?php
      if ($lastvote == 0){
      echo "Doposud nehlasoval!";
      } else{
      echo "Naposled hlasoval: ". date('d.m.Y H:i:s', $lastvote/1000);
      }
      ?><br>
      Celkem hlasů: <?php echo $all ?><br>
      Hlasů za měsíc: <?php echo $month ?><br>
      Hlasů za týden: <?php echo $week ?><br>
      <br>
      <a href="https://banlist.craftmania.cz/player.php?name=<?php echo $nick?>" target="_blank">
      <h2>Tresty (klikni zde)</h2></a><br>
      <h2>Porovnat s:<h2>
        <form method="get" action="/cm/comparison.php">
          <input type="text" name="nick1" placeholder="Nick1" value="<?php echo $nick?>">
          <input type="text" name="nick2" placeholder="Nick2" value="<?php echo $nick1?>"> <input type="submit" value="Porovnat!">
        </form>
      <h2>Banner:</h2>
      <a href="https://velda.xyz/cm/banner/index.php?nick=<?php echo $nick?>" target="_blank">
        <img class="banner" src='https://velda.xyz/cm/banner/big/index.php?nick=<?php echo $nick?>&theme=<?php
        $random = rand(1,8);
        if ($random == 5){
         $random = rand(1,8);
        } else {
            echo $random;
        };

        ?>'>
      </a>
      <?php
       if ($onlinedate == 0){
         echo '
         <script>
      window.location.href="https://velda.xyz/cm/error.php";
      </script>
      ';
      }
        ?>
    </center>
  </article>
  <footer>
    <br>
    <br>
    Vytvořil <a href="https://velda.xyz/cm/search.php?nick=Velda_"><b>Velda</b></a>
  </footer>
</body>
</html>
