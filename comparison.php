<?php
$urlnick = "https://api.mojang.com/users/profiles/minecraft/". $_GET['nick1'];
$datanick = json_decode(file_get_contents($urlnick), true);

$warurl = "https://api.craftmania.cz/player/". $datanick["name"];
$wardata = json_decode(file_get_contents($warurl), true);
$waruuid = $wardata["data"]["uuid"];
$uuid = $datanick["id"];
       if (str_replace("-","",$waruuid) == $uuid){
          $nick = $datanick["name"];            //origo
       } else {
       $nick = $_GET['nick1'];   //warez
       }


       $urlnick1 = "https://api.mojang.com/users/profiles/minecraft/". $_GET['nick2'];
       $datanick1 = json_decode(file_get_contents($urlnick1), true);

       $warurl1 = "https://api.craftmania.cz/player/". $datanick1["name"];
       $wardata1 = json_decode(file_get_contents($warurl1), true);
       $waruuid1 = $wardata1["data"]["uuid"];
       $uuid1 = $datanick1["id"];
              if (str_replace("-","",$waruuid1) == $uuid1){
                 $nick1 = $datanick1["name"];            //origo
              } else {
              $nick1 = $_GET['nick2'];   //warez
              }
            if (strlen($nick) == 0){
              $nick = $_GET['nick1'];
              $skin = 'https://visage.surgeplay.com/full/128/8667ba71b85a4004af54457a9734eed7';
            } else{
              $skin = 'https://visage.surgeplay.com/full/128/'. $uuid;
            }
            if (strlen($nick1) == 0){
              $nick1 = $_GET['nick2'];
              $skin1 = 'https://visage.surgeplay.com/full/128/8667ba71b85a4004af54457a9734eed7';
            } else{
              $skin1 = 'https://visage.surgeplay.com/full/128/'. $uuid1;
            }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Porovnávání | <?php echo $nick ?> & <?php echo $nick1 ?></title>
  <link rel="stylesheet" type="text/css" href="https://velda.xyz/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#2575DC">
  <meta name="description" content="Porovnávání hráču na serveru CraftMania.">
  <meta property="og:image" content="<?php echo $ogimage ?>">
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
  max-width: 300px;
  height: auto;
  }
  td, th {
  text-align: center;
  padding-left: 4px;
  padding-right: 4px;
}
  </style>
</head>
<body>
  <article>
    <center>
      <form method="get" action="/cm/comparison.php">
        <input type="text" name="nick1" placeholder="Nick1" value="<?php echo $nick?>">
        <input type="text" name="nick2" placeholder="Nick2" value="<?php echo $nick1?>"> <input type="submit" value="Porovnat!">
      </form>
      <h1>Porovnávání hráčů: <?php echo $nick.' a '.$nick1 ?></h1><?php
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
      $url1 = "https://api.craftmania.cz/player/". $nick1;
      $data1 = json_decode(file_get_contents($url1), true);
      $apinick1 = $data1["data"]["nick"];
      $apiuuid1 = $data1["data"]["uuid"];
      $time1 = $data1["data"]["played_time"];
      $apiregister1 = $data1["data"]["registred"];
      $register1 = $apiregister1 / 1000;
      $cc1 = $data1["data"]["economy"]["craftcoins"];
      $ct1 = $data1["data"]["economy"]["crafttokens"];
      $vt1 = $data1["data"]["economy"]["votetokens"];
      $all1 = $data1["data"]["votes"]["total"];
      $month1 = $data1["data"]["votes"]["month"];
      $week1 = $data1["data"]["votes"]["week"];
      $lastvote1 = $data1["data"]["votes"]["last_vote"];
      $online1 = $data1["data"]["is_online"];
      $onlinedate1 = $data1["data"]["last_online"];
      $last_server1 = $data1["data"]["last_server"];
      $level1 = $data1["data"]["ranked"]["level"];
      $xp1 = $data1["data"]["ranked"]["experience"];
       ?>
       <table>
  <tr>
    <th><a href="https://velda.xyz/cm/search.php?nick=<?php echo $nick?>"><?php echo $nick?></a></th>
    <th>Nicky</th>
    <th><a href="https://velda.xyz/cm/search.php?nick=<?php echo $nick1?>"><?php echo $nick1?></a></th>
  </tr>
  <tr>
    <th><a href="https://velda.xyz/cm/search.php?nick=<?php echo $nick?>"><img src="<?php echo $skin?>"></a></th>
    <th></th>
    <th><a href="https://velda.xyz/cm/search.php?nick=<?php echo $nick1?>"><img src="<?php echo $skin1?>"></a></th>
  </tr>
  <tr>
    <td><?php
    if (str_replace("-","",$apiuuid) == $uuid){
      $original = 'Není warezák!';
    } else {
      $original = 'Je warezák!';
    }
    echo $original;
    ?></td>
    <td>Warez/Origo</td>
    <td><?php
    if (str_replace("-","",$apiuuid1) == $uuid1){
      $original1 = 'Není warezák!';
    } else {
      $original1 = 'Je warezák!';
    }
    echo $original1;
    ?></td>
  </tr>
  <tr>
    <td><?php echo round($time / 60)  ?> hodin</td>
    <td>Nahraný čas</td>
    <td><?php echo round($time1 / 60)  ?> hodin</td>
  </tr>
  <tr>
    <td><?php echo date('d.m.Y', $register); ?></td>
    <td>Registrace</td>
    <td><?php echo date('d.m.Y', $register1); ?></td>
  </tr>
  <tr>
    <td><?php echo $level." (".$xp."XP)"?></td>
    <td>Level</td>
    <td><?php echo $level1." (".$xp1."XP)"?></td>
  </tr>
  <tr>
    <td><?php echo $cc ?></td>
    <td>Craftcoins</td>
    <td><?php echo $cc1 ?></td>
  </tr>
  <tr>
    <td><?php echo $ct ?></td>
    <td>Crafttokens</td>
    <td><?php echo $ct1 ?></td>
  </tr>
  <tr>
    <td><?php echo $vt ?></td>
    <td>Votetokens</td>
    <td><?php echo $vt1 ?></td>
  </tr>
  <tr>
    <td><?php echo $all ?></td>
    <td>Celkem hlasů</td>
    <td><?php echo $all1 ?></td>
  </tr>
  <tr>
    <td><?php echo $month ?></td>
    <td>Hlasů za měsíc</td>
    <td><?php echo $month1 ?></td>
  </tr>
  <tr>
    <td><?php echo $week ?></td>
    <td>Hlasů za týden</td>
    <td><?php echo $week1 ?></td>
  </tr>
</table>
    </center>
  </article>
  <footer>
    <br>
    <br>
    Vytvořil <a href="https://velda.xyz/cm/search.php?nick=Velda_"><b>Velda</b></a>
  </footer>
</body>
</html>
