
const player = videojs('video', {
    autoplay: false,
    controls: true,
    playbackRates: [0.5, 1, 1.5, 2],
    plugins: {
        hotkeys: {}
    },
    html5: {
        hls: {
        overrideNative: true,
        enableLowInitialPlaylist:true
        }
    },
    flash:{
        hls:{
            enableLowInitialPlaylist:true
        }
    },
    inactivityTimeout:0,
    preload:"auto",
});

var qLevels = [];

player.qualityLevels().on('addqualitylevel', function(event) {
    var quality = event.qualityLevel;
    console.log(quality);

    if (quality.height != undefined && $.inArray(quality.height, qLevels) === -1)
    {
        quality.enabled = true;

        qLevels.push(quality.height);

        if (!$('.quality_ul').length)
        {
            var h = '<div class="quality_setting vjs-menu-button vjs-menu-button-popup vjs-control vjs-button">' +
                    '<button class="vjs-menu-button vjs-menu-button-popup vjs-button" type="button" aria-live="polite" aria-disabled="false" title="Quality" aria-haspopup="true" aria-expanded="false">' +
                    '<span aria-hidden="true" class="vjs-icon-cog"></span>' +
                    '<span class="vjs-control-text">Quality</span></button>' +
                    '<div class="vjs-menu"><ul class="quality_ul vjs-menu-content" role="menu"></ul></div></div>';

            $(".vjs-fullscreen-control").before(h);
        } else {
            $('.quality_ul').empty();
        }

        qLevels.sort();
        qLevels.reverse();

        var j = 0;

        $.each(qLevels, function(i, val) {
            $(".quality_ul").append('<li class="vjs-menu-item" tabindex="' + i + '" role="menuitemcheckbox" aria-live="polite" aria-disabled="false" aria-checked="false" bitrate="' + val +
                                    '"><span class="vjs-menu-item-text">' + val + 'p</span></li>');

            j = i;
        });

        $(".quality_ul").append('<li class="vjs-menu-item vjs-selected" tabindex="' + (j + 1) + '" role="menuitemcheckbox" aria-live="polite" aria-disabled="false" aria-checked="true" bitrate="auto">' +
                                '<span class="vjs-menu-item-text">Auto</span></li>');
    }
});

$("body").on("click", ".quality_ul li", function() {
    $(".quality_ul li").removeClass("vjs-selected");
    $(".quality_ul li").prop("aria-checked", "false");

    $(this).addClass("vjs-selected");
    $(this).prop("aria-checked", "true");

    var val = $(this).attr("bitrate");

    var qualityLevels = player.qualityLevels();

    for (var i = 0; i < qualityLevels.length; i++)
    {
        qualityLevels[i].enabled = (val == "auto" || (val != "auto" && qualityLevels[i].height == val));
    }
});

        // player.qualityPickerPlugin();



//log view count
var viewLogged = false

player.on('timeupdate', function () {
    var percentagePlayed = Math.ceil(player.currentTime() / player.duration() * 100)

    if (percentagePlayed > 10 && !viewLogged) {
        axios.put('/videos/' + window.CURRENT_VIDEO)

        viewLogged = true
    }
})
