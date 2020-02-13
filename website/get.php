<?php
global $config;
$config = file_get_contents("config.json");
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

        $cmplayerurl = "https://api.craftmania.cz/player/$mojangplayernick";
        $cmplayerjson = file_get_contents($cmplayerurl);
        $cmplayerdata = json_decode($cmplayerjson);
        $cmplayeruuid = $cmplayerdata->data->uuid;

        // Detekce origo účtu
        if ($mojangplayeruuid == $cmplayeruuid){
            $origo = 1;
            $nick = $mojangplayernick;
        } else {
            $origo = 0;
            $nick = $this->searchednick;
        }
    }

    // Generace url skinů z visage.surgeplay.com
    public function getPlayerSkins($skintype)
    {
        // Přidání globální proměné Mojang uuid
        global $mojangplayeruuid;
        // Když nemá Mojang skin přidá warez skin, pokud má Mojang skin odebere pomlčky z uuid
        if ($mojangplayeruuid != "----"){
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
        if ($skintype == "skin" || $skintype == "rawskin"){
            return "https://visage.surgeplay.com/skin/512/$skinuuid";
        }
    }
    // Loadovani u origa historie jmén
    public function getPlayerNamesLoad(){
        global $mojangplayeruuid;
        global $mojangnamesjson;
        global $mojangnamesdata;
        global $origo;

        $mojangplayeruuidwithoutbrackets = str_replace("-", "", $mojangplayeruuid);

        if ($origo){
            $mojangnamesurl = "https://api.mojang.com/user/profiles/$mojangplayeruuidwithoutbrackets/names";
            $mojangnamesjson = file_get_contents($mojangnamesurl);
            $mojangnamesdata = json_decode($mojangnamesjson);
        }
    }
    // Zjišťování u origa historie jmén
    public function getPlayerNames($datatype, $id)
    {
        global $mojangnamesdata;
        global $mojangnamesjson;
        global $origo;

        if ($origo){
            if ($datatype == "number"){
                $mojangnamesnumber  = substr_count($mojangnamesjson, '{');
                return $mojangnamesnumber;
                //return $mojangnamesdata[0]->name;
            } elseif ($datatype == "name"){
                return $mojangnamesdata[$id]->name;
            } else {
              return 0;
            }
        } else {
            return 0;
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
    public function getPlayerCraftManiaCheck(){
        global $nick;
        global $cmplayerdata;
        global $craftmaniaerror;
        global $craftmaniastatus;
        $craftmaniaplayerurl = "https://api.craftmania.cz/player/$nick";
        $craftmaniaplayerjson = file_get_contents($craftmaniaplayerurl);
        $craftmaniaplayerdata = json_decode($craftmaniaplayerjson);
        $craftmaniastatus = $craftmaniaplayerdata->status;
        $cmplayerdata =  $craftmaniaplayerdata->data;
    }
    public function getPlayerCraftMania($datatype){
        global $craftmaniastatus;
        global $cmplayerdata;
        // Řešení, když hráč nebyl na CM, nebo zadal špatně nick
        if ($craftmaniastatus != "200") {
            $craftmaniaerror = 1;
            return 0;
        } else {
            if ($datatype == "id") {
                return $cmplayerdata->id;
            }
            if ($datatype == "discriminator") {
                return $cmplayerdata->discriminator;
            }
            if ($datatype == "nick") {
                return $cmplayerdata->nick;
            }
            if ($datatype == "uuid") {
                return $cmplayerdata->uuid;
            }
            if ($datatype == "registred") {
                return $cmplayerdata->registred;
            }
            if ($datatype == "last_online") {
                return $cmplayerdata->last_online;
            }
            if ($datatype == "last_server") {
                return $cmplayerdata->last_server;
            }
            if ($datatype == "is_online") {
                return $cmplayerdata->is_online;
            }
            if ($datatype == "played_time") {
                $timeplayed = $cmplayerdata->played_time/60;
                return $timeplayed;
            }
            // Nesprávná, kvůlí používání ViaVersion
            if ($datatype == "mc_version") {
                return $cmplayerdata->mc_version;
            }
            // Ekonomika
            $cmplayereconomydata = $cmplayerdata->economy;
            if ($datatype == "cc" || $datatype == "craftcoins") {
                return $cmplayereconomydata->craftcoins;
            }
            if ($datatype == "ct" || $datatype == "crafttokens") {
                return $cmplayereconomydata->crafttokens;
            }
            if ($datatype == "vt" || $datatype == "votetokens") {
                return $cmplayereconomydata->votetokens;
            }
            if ($datatype == "karma") {
                return $cmplayereconomydata->karma;
            }
            if ($datatype == "aapoints" || $datatype == "aachpoints" || $datatype == "achievement_points") {
                return $cmplayereconomydata->achievement_points;
            }
            //Ranked
            $cmplayerrankeddata = $cmplayerdata->ranked;
            if ($datatype == "global_level" || $datatype == "level") {
                return $cmplayerrankeddata->creative_level + $cmplayerrankeddata->vanilla_level;
                // Custom počítání globálního levelu protože ho api vrací špatně, až bude v api správně můžu smazat
                // return $cmplayerrankeddata->global_level;
            }
            if ($datatype == "survival_level") {
                return $cmplayerrankeddata->survival_level;
            }
            if ($datatype == "survival_experience" || $datatype == "survival_xp") {
                return $cmplayerrankeddata->survival_experience;
            }
            if ($datatype == "skyblock_level") {
                return $cmplayerrankeddata->skyblock_level;
            }
            if ($datatype == "skyblock_experience" || $datatype == "skyblock_xp") {
                return $cmplayerrankeddata->skyblock_experience;
            }
            if ($datatype == "creative_level") {
                return $cmplayerrankeddata->creative_level;
            }
            if ($datatype == "creative_experience" || $datatype == "creative_xp") {
                return $cmplayerrankeddata->creative_experience;
            }
            if ($datatype == "vanilla_level") {
                return $cmplayerrankeddata->vanilla_level;
            }
            if ($datatype == "vanilla_experience" || $datatype == "vanilla_xp") {
                return $cmplayerrankeddata->vanilla_experience;
            }
            if ($datatype == "prison_level") {
                return $cmplayerrankeddata->prison_level;
            }
            if ($datatype == "prison_experience" || $datatype == "prison_xp") {
                return $cmplayerrankeddata->prison_experience;
            }
            if ($datatype == "skycloud_level") {
                return $cmplayerrankeddata->skycloud_level;
            }
            if ($datatype == "skycloud_experience" || $datatype == "skycloud_xp") {
                return $cmplayerrankeddata->skycloud_experience;
            }
            // Votes
            $cmplayervotesdata = $cmplayerdata->votes;
            if ($datatype == "votes_total") {
                return $cmplayervotesdata->total;
            }
            if ($datatype == "votes_month") {
                return $cmplayervotesdata->month;
            }
            if ($datatype == "votes_week") {
                return $cmplayervotesdata->week;
            }
            if ($datatype == "last_vote") {
                return $cmplayervotesdata->last_vote;
            }
            // Social
            $cmplayersocialdata = $cmplayerdata->social;
            if ($datatype == "social_status") {
                if ($cmplayersocialdata->status == "Tento hráč nemá nastavený status...") {
                    return 0;
                } else {
                    return $cmplayersocialdata->status;
                }
            }
            if ($datatype == "facebook") {
                return $cmplayersocialdata->facebook;
            }
            if ($datatype == "twitter") {
                return $cmplayersocialdata->twitter;
            }
            if ($datatype == "twitch") {
                return $cmplayersocialdata->twitch;
            }
            if ($datatype == "steam") {
                return $cmplayersocialdata->steam;
            }
            if ($datatype == "youtube") {
                return $cmplayersocialdata->youtube;
            }
            if ($datatype == "web") {
                if ($cmplayersocialdata->web != "0") {
                    if (substr($cmplayersocialdata->web, 0, 4) != 'http' ){
                        $cmplayersocialweb = "http://" . $cmplayersocialdata->web;
                    } else {
                        $cmplayersocialweb = $cmplayersocialdata->web;
                    }
                    return $cmplayersocialweb;
                } else {
                    return 0;
                }
            }
            if ($datatype == "discord_id") {
                return $cmplayerdata->discord->id;
            }
            // VIP/RANKS
            $cmplayervipdata = $cmplayerdata->groups->vip;
            if ($datatype == "primary_vip") {
                if (isset($cmplayervipdata->primary)) {
                    return ucfirst($cmplayervipdata->primary);
                } else {
                  return "Hráč";
                }
            }
            
            if ($datatype == "primary_vip_color") {
                if ($this->getPlayerCraftMania("primary_vip") == "Owner") {
                    return "#00AAAA";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Admin" || $this->getPlayerCraftMania("primary_vip") == "Adminka") {
                    return "#FF5555";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Developer" || $this->getPlayerCraftMania("primary_vip") == "Developerka") {
                    return "#FFFF55";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Builder" || $this->getPlayerCraftMania("primary_vip") == "Builderka") {
                    return "#0000AA";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Helper" || $this->getPlayerCraftMania("primary_vip") == "Helperka") {
                    return "#00AA00";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Obsidian") {
                    return "#5555FF";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Emerald") {
                    return "#55FF55";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Diamond") {
                    return "#55FFFF";
                } elseif ($this->getPlayerCraftMania("primary_vip") == "Gold") {
                    return "#FFAA00";
                } else {
                    return "#AAAAAA";
                }
            }
        }
    }
    public function getPlayerDiscord($datatype)
    {
        global $config;
        $id = $this->getPlayerCraftMania("discord_id");
        if ($id == 0) {
            return 0;
        } else {
            $url = "https://discordapp.com/api/v6/users/$id";

            $configarray = json_decode($config);
            $bot_token = $configarray->discord->bot_token;
            $header = "Authorization: Bot $bot_token";
            $headers = array(
                'Content-type: application/json',
                $header,
            );

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $discordjsonresult = curl_exec($ch);
            $discorddataresult = json_decode($discordjsonresult);
            curl_close($ch);

            if ($datatype == "username" || $datatype == "nick" || $datatype == "name") {
                return $discorddataresult->username;
            }
            if ($datatype == "tag" || $datatype == "discriminator") {
                return "#".$discorddataresult->discriminator;
            }
            if ($datatype == "id") {
                return $discorddataresult->id;
            }
            if ($datatype == "avatar") {
                $discordavatarfile = $discorddataresult->avatar;
                if(substr($discorddataresult->avatar, 0, 2) == 'a_' ){
                    $discordavatarfile .='.gif';
                } else {
                    $discordavatarfile .= '.png';
                }
                $discordavatarurl = 'https://cdn.discordapp.com/avatars/'.$discorddataresult->id.'/'.$discordavatarfile;

                return $discordavatarurl;
            }
            if ($datatype == "fullname") {
                return $this->getPlayerDiscord("name") . $this->getPlayerDiscord("tag");
            }
        }
    }
}
class Leaderboard
{
    public function getCraftMania($datatype){
        $url = "https://api.craftmania.cz/economy/leaderboard/";
    }
}
class Time
{
    public function timeAgo($timestamp){
        $ago = time() - $timestamp / 1000;
        $seconds = round($ago);
        $minutes = round($seconds / 60);
        $hours = round($minutes / 60);
        $days = round($hours / 24);
        $weeks = round($days / 7);
        $months = round($weeks / 4.3);

        if ($timestamp == 0) {
            return 0;
        } elseif($seconds <= 60) {
            if ($seconds == 1) {
                return "sekundu zpět";
            } else if($seconds <= 4) {
                return $seconds . " sekundy zpět";
            } else {
                return $seconds . " sekund zpět";
            }
        } elseif($minutes <= 60) {
            if ($minutes == 1) {
                return "minutu zpět";
            } else if($minutes <= 4) {
                return $minutes . " minuty zpět";
            } else {
                return $minutes . " minut zpět";
            }
        } elseif($hours <= 24) {
            if ($hours == 1) {
                return "hodinu zpět";
            } else if($hours <= 4) {
                return $hours . " hodiny zpět";
            } else {
                return $hours . " hodin zpět";
            }
        } elseif($days <= 7) {
            if ($days == 1) {
                return "den zpět";
            } else if($days <= 4) {
                return $days . " dny zpět";
            } else {
                return $days . " dní zpět";
            }
        } elseif($weeks <= 4) {
            if ($weeks == 1) {
                return "týden zpět";
            } else {
                return $weeks . " týdny zpět";
            }
        } else {
            if ($months == 1) {
                return "měsíc zpět";
            } else if($months <= 4) {
                return $months . " měsíce zpět";
            } else {
                return $months . " měsíců zpět";
            }
        }
    }
    public function date($timestamp){
        return date('d.m.Y', $timestamp/1000);
    }
}
