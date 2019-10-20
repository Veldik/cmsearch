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
        global $mojangplayeruuidwithoutbrackets;
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
        if ($mojangplayeruuid == $cmplayeruuid){
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
            $skinuuid = "8667ba71b85a4004af54457a9734eed7";
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

    //Zjišťování zda má hráč cape
    public function getPlayerCape($capetype)
    {
        global $nick;
        global $mojangplayeruuid;
        //Zjišťování zda má člověk Optifine cape
        if ($capetype == "optifine"){
            if(@getimagesize("http://s.optifine.net/capes/$nick.png")){
                return 1;
            } else {
                return 0;
            }
        }
        //Zjišťování zda má člověk Labymode cape
        if ($capetype == "labymod"){
            if (@getimagesize("http://capes.labymod.net/capes/$mojangplayeruuid")){
                return 1;
            } else {
                return 0;
            }
        }
        //Zjišťování zda má člověk Mojang cape, nepoužívá se, kvůli limitům Mojang api
        if ($capetype == "mojang"){
            $mojangplayeruuidwithoutbrackets = str_replace("-","",$mojangplayeruuid);
            $mojangskinhashurl = "https://sessionserver.mojang.com/session/minecraft/profile/$mojangplayeruuidwithoutbrackets";
            $mojangskinhashjson = file_get_contents($mojangskinhashurl);
            $mojangskinhashdata = json_decode($mojangskinhashjson);
            $mojangskinhashvalue = $mojangskinhashdata->properties[0]->value;
            $mojangskinjson = base64_decode($mojangskinhashvalue);
            $mojangskincape = $mojangskinjson->textures->CAPE->url;
            if (isset($mojangskincape)){
                return 1;
            }
        }

    }
}
?>