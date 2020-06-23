<?php
echo '
<header>
    <div class="header">
        <input type="text" placeholder="Najít hráče..." id="nick_search" onkeypress="if(event.key == \'Enter\') {find_player()}">
        <input type="button" value="🔍" onClick="find_player()"/>
    </div>
</header>
';
