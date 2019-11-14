var player = videojs('video', {
    html5: {
        hls: {
          overrideNative: true
        }
    }
})

var viewLogged = false

player.on('timeupdate', function () {
    var percentagePlayed = Math.ceil(player.currentTime() / player.duration() * 100)

    if (percentagePlayed > 5 && !viewLogged) {
        axios.put('/videos/' + window.CURRENT_VIDEO)

        viewLogged = true
    }
})