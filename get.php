<?php
class Player
{
    public $searchednick;

    public function __construct($searchednick)
    {
        // Vytvoření globální proměné hledaný nick
        global $searchednick;
        // Definování globální proměné hledaný nick
        $this->searchednick = $searchednick;
    }

    // Přidání pomlček do Mojang UUID
    private function format_uuid($uuid)
    {
        return substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);
    }

    public function getPlayer()
    {
        // Přidání globálních proměných
        global $nick;
        global $mojangplayeruuid;
        global $origo;
        // Ověření zda má hráč origo mc
        $mojangplayerurl = "https://api.mojang.com/users/profiles/minecraft/$this->searchednick";
        $mojangplayerjson = file_get_contents($mojangplayerurl);
        $mojangplayerdata = json_decode($mojangplayerjson);
        $mojangplayernick = $mojangplayerdata->name;
        $mojangplayeruuid = $this->format_uuid($mojangplayerdata->id);

        $cmplayerurl =  "https://api.craftmania.cz/player/$mojangplayernick";
        $cmplayerjson = file_get_contents($cmplayerurl);
        $cmplayerdata =  json_decode($cmplayerjson);
        $cmplayeruuid =  $cmplayerdata->data->uuid;

        // Detekce origo účtu
        if ($mojangplayeruuid == $cmplayeruuid) {
            $origo = TRUE;
            $nick = $mojangplayernick;
        } else {
            $origo = FALSE;
            $nick = $this->searchednick;
        }
    }

    // Generace url skinů z visage.surgeplay.com
    public function getPlayerSkins($skintype)
    {
        // Přidání globální proměné Mojang uuid
        global $mojangplayeruuid;
        // Když nemá Mojang skin přidá warez skin, pokud má Mojang skin odebere pomlčky z uuid
        if (isset($mojangplayeruuid)){
            $skinuuid = str_replace("-","",$mojangplayeruuid);
        } else {
            // Přidání nickům, které nemají Mojang skin Steve
            $skinuuid = "cecea4da3bc941f9a9109e7be63e1295";
        }
        // Rozdělení skintype
        if ($skintype == "face" || $skintype == "avatar"){
            return "https://visage.surgeplay.com/face/128/$skinuuid";
        }
        if ($skintype == "head"){
            return "https://visage.surgeplay.com/head/256/$skinuuid";
        }
        if ($skintype == "bust"){
            return "https://visage.surgeplay.com/bust/512/$skinuuid";
        }
        if ($skintype == "full"){
            return "https://visage.surgeplay.com/full/512/$skinuuid";
        }
    }

}
?>