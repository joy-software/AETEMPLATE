function onYouTubeIframeAPIReady(){player=new YT.Player("player",{height:"50%",width:"50%",events:{onReady:onPlayerReady,onStateChange:onPlayerStateChange}})}function onPlayerReady(e){e.target.setLoop(!0)}function onPlayerStateChange(e){e.data==YT.PlayerState.ENDED&&player.seekTo(0,!0)}function stopVideo(){player.stopVideo()}function pauseVideo(){player.pauseVideo()}$("tr.clickable").click(function(){$("#ConfirmAction").css("display","block").css("opacity","1").css("background","rgba(0,0,0,0.7)"),player.loadVideoById({videoId:$(this).attr("id")})}),$("#button").click(function(){$("#ConfirmAction").css("display","none"),player.stopVideo()});var tag=document.createElement("script");tag.src="https://www.youtube.com/iframe_api";var firstScriptTag=document.getElementsByTagName("script")[0];firstScriptTag.parentNode.insertBefore(tag,firstScriptTag);var player;