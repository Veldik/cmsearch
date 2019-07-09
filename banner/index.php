<head>
  <meta charset="UTF-8">
  <title>Vytváření bannerů!</title>
  <link rel="stylesheet" type="text/css" href="https://velda.xyz/css/main.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#2575DC">
  <meta name="description" content="Nástroj pro vytváření bannerů.">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="/js/main.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
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
input[type="radio"]{
    color:#f2f2f2;
    font-size:14px;
    display:inline-block;
    width:19px;
    height:19px;
    margin: -2px 3px 0 0;
    vertical-align:middle;
    background:url(check_radio_sheet.png) -38px top no-repeat;
    cursor:pointer;
}
  </style>
</head>
<article>
  <center>
    <h1>
       Pokud máte nápad na banner, pošlete mi ho do zpráv na discord: <b>Velda#9217</b>
    </h1>
    <form target="_blank" method="GET" action="/cm/banner/big/index.php">
      <h1>Generace velkého banneru:</h1><br>
      <input type="text" name="nick" placeholder="Nick" value="<?php echo $_GET['nick'];?>"><br>
      <input type="radio" name="theme" value="1" checked> Creative<br>
      <input type="radio" name="theme" value="2"> Survival<br>
      <input type="radio" name="theme" value="3"> Skyblock<br>
      <input type="radio" name="theme" value="4"> Rastyho styl<br>
      <input type="radio" name="theme" value="5"> Cave<br>
      <input type="radio" name="theme" value="6"> Natural track<br>
      <input type="radio" name="theme" value="7"> Village<br>
      <input type="radio" name="theme" value="8"> JANEVIMJAKTOPOPSAT<br>
      <input type="submit" value="Generovat!">
    </form>
    <form target="_blank" method="GET" action="/cm/banner/permsticker/index.php">
      <h1>Generace velkého banneru na permsticker:</h1><br>
      <input type="text" name="nick" placeholder="Nick" value="<?php echo $_GET['nick'];?>"><br>
      <input type="radio" name="theme" value="1" checked> Creative<br>
      <input type="radio" name="theme" value="2"> Survival<br>
      <input type="radio" name="theme" value="3"> Skyblock<br>
      <input type="radio" name="theme" value="4"> Rastyho styl<br>
      <input type="radio" name="theme" value="5"> Cave<br>
      <input type="radio" name="theme" value="6"> Natural track<br>
      <input type="radio" name="theme" value="7"> Village<br>
      <input type="radio" name="theme" value="8"> JANEVIMJAKTOPOPSAT<br>
      <input type="submit" value="Generovat!">
    </form>
  </center>
</article>
<footer>
  <br><br>
  Vytvořil <a href="https://velda.xyz/cm/search.php?nick=Velda_"><b>Velda</b></a>
</footer>
