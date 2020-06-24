function find_player() {
    var searchednick = document.getElementById("nick_search");
    var nick = searchednick.value;
    var link = "http://" + window.location.hostname + "/player/" + nick;
    console.log(link);
    window.location.assign(link);
}
