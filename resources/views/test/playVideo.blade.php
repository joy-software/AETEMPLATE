<!DOCTYPE html>
<html>
<body>
<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
<div id="player"></div>

<script>
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
            height: '360',
            width: '640',
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });

    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.cuePlaylist(['OZBl97Ps5NE'], 0, 0, 'small');
        event.target.setLoop(true);
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {

        if (event.data == YT.PlayerState.ENDED) {


            //setTime(0);
            setTimeout(pauseVideo, 1000);

        }

        done = true;
    }
    function stopVideo() {
        player.stopVideo();
    }
    function pauseVideo() {
        player.pauseVideo();
    }
</script>
</body>
</html>