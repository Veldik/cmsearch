<?php
include("./analytics.php");
include("./header.php");
$text = "Titulní strana bude již brzy.";
echo $text;
?>
<script type="text/javascript">
    function find_player() {
        var searchednick = document.getElementById("nick_search");
        var nick = searchednick.value;
        var link = "./player/" + nick;
        window.location = link;
    }
</script>
<input type="text" placeholder="Najít hráče..." id="nick_search">
<input type="button" value="🔍" onClick="find_player()"/>
