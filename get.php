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

        $cmplayerurl = "https://api.craftmania.cz/player/$mojangplayernick";
        $cmplayerjson = file_get_contents($cmplayerurl);
        $cmplayerdata = json_decode($cmplayerjson);
        $cmplayeruuid = $cmplayerdata->data->uuid;

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

    // Zjišťování zda má hráč cape
    public function getPlayerCape($capetype)
    {
        global $nick;
        global $mojangplayeruuid;
        // Zjišťování zda má člověk Optifine cape
        if ($capetype == "optifine") {
            if (@getimagesize("http://s.optifine.net/capes/$nick.png")) {
                return 1;
            } else {
                return 0;
            }
        }
        // Zjišťování zda má člověk Labymode cape
        if ($capetype == "labymod") {
            if (@getimagesize("http://capes.labymod.net/capes/$mojangplayeruuid")) {
                return 1;
            } else {
                return 0;
            }
        }
        // Zjišťování zda má člověk Mojang cape, nepoužívá se, kvůli limitům Mojang api
        if ($capetype == "mojang") {
            $mojangplayeruuidwithoutbrackets = str_replace("-", "", $mojangplayeruuid);
            $mojangskinhashurl = "https://sessionserver.mojang.com/session/minecraft/profile/$mojangplayeruuidwithoutbrackets";
            $mojangskinhashjson = file_get_contents($mojangskinhashurl);
            $mojangskinhashdata = json_decode($mojangskinhashjson);
            $mojangskinhashvalue = $mojangskinhashdata->properties[0]->value;
            $mojangskinjson = base64_decode($mojangskinhashvalue);
            $mojangskincape = $mojangskinjson->textures->CAPE->url;
            if (isset($mojangskincape)) {
                return 1;
            }
        }
    }
    public function getPlayerCraftMania($datatype){
        global $nick;
        global $craftmaniaerror;
        $craftmaniaplayerurl = "https://api.craftmania.cz/player/$nick";
        $craftmaniaplayerjson = file_get_contents($craftmaniaplayerurl);
        $craftmaniaplayerdata = json_decode($craftmaniaplayerjson);
        $craftmaniastatus = $craftmaniaplayerdata->status;
        $cmplayerdata =  $craftmaniaplayerdata->data;
        // Řešení, když hráč nebyl na CM, nebo zadal špatně nick
        if ($craftmaniastatus != "200") {
            $craftmaniaerror = 1;
        }
        if ($datatype == "id"){
            return $cmplayerdata->id;
        }
        if ($datatype == "discriminator"){
            return $cmplayerdata->discriminator;
        }
        if ($datatype == "nick"){
            return $cmplayerdata->nick;
        }
        if ($datatype == "uuid"){
            return $cmplayerdata->uuid;
        }
        if ($datatype == "web_group"){
            return $cmplayerdata->web_group;
        }
        if ($datatype == "registred"){
            return $cmplayerdata->registred;
        }
        if ($datatype == "last_online"){
            return $cmplayerdata->last_online;
        }
        if ($datatype == "last_server"){
            return $cmplayerdata->last_server;
        }
        if ($datatype == "is_online"){
            return $cmplayerdata->is_online;
        }
        if ($datatype == "played_time"){
            return $cmplayerdata->played_time;
        }
        // Nesprávná, kvůlí používání ViaVersion
        if ($datatype == "mc_version"){
            return $cmplayerdata->mc_version;
        }
        //Ekonomika
        $cmplayereconomydata = $cmplayerdata->economy;
        if ($datatype == "cc" || $datatype == "craftcoins"){
            return $cmplayereconomydata->craftcoins;
        }
        if ($datatype == "ct" || $datatype == "crafttokens"){
            return $cmplayereconomydata->crafttokens;
        }
        if ($datatype == "vt" || $datatype == "votetokens"){
            return $cmplayereconomydata->votetokens;
        }
        if ($datatype == "karma"){
            return $cmplayereconomydata->karma;
        }
        if ($datatype == "aapoint" || $datatype == "aachpoints" || $datatype == "achievement_points"){
            return $cmplayereconomydata->achievement_points;
        }
        //Ranked
        $cmplayerrankeddata = $cmplayerdata->ranked;
        if ($datatype == "global_level" || $datatype == "level"){
            return $cmplayerrankeddata->global_level;
        }
        if ($datatype == "survival_level"){
            return $cmplayerrankeddata->survival_level;
        }
        if ($datatype == "survival_experience" || $datatype == "survival_xp"){
            return $cmplayerrankeddata->survival_experience;
        }
        if ($datatype == "skyblock_level"){
            return $cmplayerrankeddata->skyblock_level;
        }
        if ($datatype == "skyblock_experience" || $datatype == "skyblock_xp"){
            return $cmplayerrankeddata->skyblock_experience;
        }
        if ($datatype == "creative_level"){
            return $cmplayerrankeddata->creative_level;
        }
        if ($datatype == "creative_experience" || $datatype == "creative_xp"){
            return $cmplayerrankeddata->creative_experience;
        }
        if ($datatype == "vanilla_level"){
            return $cmplayerrankeddata->vanilla_level;
        }
        if ($datatype == "vanilla_experience" || $datatype == "vanilla_xp"){
            return $cmplayerrankeddata->vanilla_experience;
        }
        if ($datatype == "prison_level"){
            return $cmplayerrankeddata->prison_level;
        }
        if ($datatype == "prison_experience" || $datatype == "prison_xp"){
            return $cmplayerrankeddata->prison_experience;
        }
        if ($datatype == "skycloud_level"){
            return $cmplayerrankeddata->skycloud_level;
        }
        if ($datatype == "skycloud_experience" || $datatype == "skycloud_xp"){
            return $cmplayerrankeddata->skycloud_experience;
        }
        //Votes
        $cmplayervotesdata = $cmplayerdata->votes;
        if ($datatype == "votes_total"){
            return $cmplayervotesdata->total;
        }
        if ($datatype == "votes_month"){
            return $cmplayervotesdata->month;
        }
        if ($datatype == "votes_week"){
            return $cmplayervotesdata->week;
        }
        if ($datatype == "last_vote"){
            return $cmplayervotesdata->last_vote;
        }
        //Social
        $cmplayersocialdata = $cmplayerdata->social;
        if ($datatype == "social_status"){
            return $cmplayersocialdata->status;
        }
        if ($datatype == "facebook"){
            return $cmplayersocialdata->facebook;
        }
        if ($datatype == "twitter"){
            return $cmplayersocialdata->twitter;
        }
        if ($datatype == "twitch"){
            return $cmplayersocialdata->twitch;
        }
        if ($datatype == "steam"){
            return $cmplayersocialdata->steam;
        }
        if ($datatype == "youtube"){
            return $cmplayersocialdata->youtube;
        }
        if ($datatype == "web"){
            return $cmplayersocialdata->web;
        }
        if ($datatype == "discord_id"){
            return $cmplayerdata->discord->id;
        }

    }
}
?>