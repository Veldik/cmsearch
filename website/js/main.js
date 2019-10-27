function find_player() {
    var searchednick = document.getElementById("nick_search");
    var nick = searchednick.value;
    // Jsem línej kokot a nebude to odkazovat na umístění lokální, ale prostě na můj server, kde to poběží, budu tě velice cenit, když to fixneš!
    var link = "https://cm.velda.xyz/player/" + nick;
    window.location = link;
}
