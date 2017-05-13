/**
 * Created by michelB on 12/05/2017.
 */

/*
 Créer un évènement se déclenchant lors du clic sur une ligne d'un tableau présentant des vidéos
 */

$('#btnLive').click(function () {

    console.log($('#btnLive span').attr('id'));

    //$('#live-meeting').css('display', 'block').css('opacity', '1').css('background', 'rgba(0,0,0,0.7)');

    player.loadVideoById({'videoId': $('#btnLive span').attr('id')});

});

$('#button').click(function () {

    $('#live-meeting').css('display', 'none');
    player.stopVideo();
})


// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '75%',
        width: '100%',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });

}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {

    event.target.setLoop(true);
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.

function onPlayerStateChange(event) {

    if (event.data == YT.PlayerState.ENDED) {

        player.seekTo(0, true);
    }

}

function stopVideo() {

    player.stopVideo();
}

function pauseVideo() {

    player.pauseVideo();
}



