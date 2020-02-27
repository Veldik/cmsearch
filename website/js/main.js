function find_player() {
    var searchednick = document.getElementById("nick_search");
    var nick = searchednick.value;
    
    var url = window.location.href.toString().split("?")[0];

    if (url[url.length - 1] == "/") {
        url = url.slice(0, -1);
    }
    var array = url.split("/");
    var count = 0;
    for(var i = 0; i < array.length; ++i){
        if(typeof array[i] !== "undefined")
            count++;
    }
    if (array[(count - 2)] == "player" ) {
        array.splice((count - 1));
    } else if (array[(count - 1)] == "player") {
        array.splice((count - 1));
        array[count - 1] = "player";
    } else {
        array[count] = "player";
    }
    var link = array.join("/") + "/" + nick;

    window.location = link;
}
