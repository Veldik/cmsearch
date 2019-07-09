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
button{
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
.tooltip2 {
  position: relative;
  display: inline-block;
}

.tooltip2 .tooltiptext2 {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  margin-bottom: -30px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip2 .tooltiptext2::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip2:hover .tooltiptext2 {
  visibility: visible;
  opacity: 1;
}
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  margin-bottom: -30px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
.permsticker {
max-width: 400px;
width: 100%;
height: auto;
}
/*
.Row
{
    display: table;
    width: 100%; Optional
    table-layout: fixed; Optional
}
.Column
{
    display: table-cell;
}
*/
  </style>
  <script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");

  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Zkopírováno!";
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Zkopíruj si to kliknutím!";
}




function myFunction2() {

  var copyText2 = document.getElementById("myInput2");
  copyText2.select();

  document.execCommand("copy");

  var tooltip2 = document.getElementById("myTooltip2");
  tooltip2.innerHTML = "Zkopírováno!";
}

function outFunc2() {
  var tooltip2 = document.getElementById("myTooltip2");
  tooltip2.innerHTML = "Zkopíruj si to kliknutím!";
}
</script>
</head>
<article>
  <center>
    <?php
    $theme = $_GET['theme'];
    $nick = $_GET['nick'];
    ?>
    <h1>
      Vygenerované bannery:
    </h1><br>
<div class="Row">
  <div class="Column">
    <h2>
      Part 1:
    </h2>
    <img class="permsticker" alt="<?php echo $nick?>_1"src="https://velda.xyz/cm/banner/permsticker/big/?nick=<?php echo $nick?>&theme=<?php echo $theme?>&part=1">
    <br>
    <input type="text" value="/permsticker <?php echo $nick?>_1 https://velda.xyz/cm/banner/permsticker/big/?nick=<?php echo $nick?>&theme=<?php echo $theme?>&part=1" id="myInput">
    <div class="tooltip">
    <button onclick="myFunction()" onmouseout="outFunc()">
      <span class="tooltiptext" id="myTooltip">Zkopíruj si to kliknutím!</span>
      Kopírovat příkaz!
      </button>
    </div>
  </div>
  <div class="Column">
    <h2>
      Part 2:
    </h2>
    <img class="permsticker" alt="<?php echo $nick?>_2"src="https://velda.xyz/cm/banner/permsticker/big/?nick=<?php echo $nick?>&theme=<?php echo $theme?>&part=2">
    <br>
    <input type="text" value="/permsticker <?php echo $nick?>_2 https://velda.xyz/cm/banner/permsticker/big/?nick=<?php echo $nick?>&theme=<?php echo $theme?>&part=2" id="myInput2">
    <div class="tooltip2">
    <button onclick="myFunction2()" onmouseout="outFunc2()">
      <span class="tooltiptext2" id="myTooltip2">Zkopíruj si to kliknutím!</span>
      Kopírovat příkaz!
      </button>
    </div>
  </div>
</div>


  </center>
</article>
<footer>
  <br><br>
  Vytvořil <a href="https://velda.xyz/cm/search.php?nick=Velda_"><b>Velda</b></a>
</footer>
