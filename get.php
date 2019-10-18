<?php
class Player
{

    public $searchednick;

    public function __construct($searchednick)
    {
        $this->searchednick = $searchednick;
    }

    public function getPlayer()
    {
        $playerurl =  "https://api.craftmania.cz/player/$this->searchednick";
        $playerjson = file_get_contents($playerurl);
        $playerdata =  json_decode($playerjson);
        echo $playerdata->data->nick;
    }

}
?>