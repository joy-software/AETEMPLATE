/**
 * Created by michelB on 12/05/2017.
 */

/*
 Créer un évènement se déclenchant lors du clic sur une ligne d'un tableau présentant des vidéos
 */

/*$('#btnLive').click(function () {

    window.open('https://www.youtube.com/watch?v=' + $('#btnLive span').attr('id'));
});*/



$('#btnLive').click(function () {

    console.log($('#btnLive span').attr('id'));

    player.loadVideoById({'videoId': $('#btnLive span').attr('id')});

});

$('#button').click(function () {

    $('#live-meeting').css('display', 'none');
    player.stopVideo();
})


var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


var player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '65%',
        width: '100%',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });

}


function onPlayerReady(event) {

    event.target.setLoop(true);
}

function onPlayerStateChange(event) {

    if (event.data == YT.PlayerState.ENDED) {

        player.seekTo(0, true);
    }

}



//# sourceMappingURL=view_meeting.js.map
