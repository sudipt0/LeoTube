
const player = videojs('video', {
    autoplay: false,
    controls: true,
    playbackRates: [0.5, 1, 1.5, 2],
    plugins: {
        hotkeys: {}
    },
    html5: {
        hls: {
        overrideNative: true
        }
    }
});



var viewLogged = false

player.on('timeupdate', function () {
    var percentagePlayed = Math.ceil(player.currentTime() / player.duration() * 100)

    if (percentagePlayed > 10 && !viewLogged) {
        axios.put('/videos/' + window.CURRENT_VIDEO)

        viewLogged = true
    }
})
