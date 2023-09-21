<!DOCTYPE html>
<html lang="en">
<head>
    <title>Free Ringtone Maker - Success!</title>
    <meta charset="utf-8">
    <link href="{{asset('css/theme/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/flat.audio.css')}}" rel="stylesheet" type="text/css">
    
    <script type="text/javascript" src="{{asset('js/jquery-2.1.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.jplayer.min.js')}}"></script>
    <style>
        *, *:before, *:after {-moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;}
        html, body, div, span, applet, object, iframe, input, select, textarea, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a,
        abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small,
        strike, tt, var, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody,
        tfoot, thead, tr, th, td {margin:0; padding:0; border:0; outline:0; font-weight:inherit; font-style:inherit;
        font-size:100%; font-family:inherit; vertical-align:baseline; line-height: 1.25;}
        :focus {outline:0;outline-color:transparent;}
        ol, ul {list-style:none;}
        table {border-collapse:separate;border-spacing:0;}
        caption, th, td {text-align:left;font-weight:normal;}
        blockquote:before, blockquote:after, q:before, q:after {content:"";}
        blockquote, q {quotes:"" "";}
        .clear {clear:both;height:0;overflow:hidden;}
        html, body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 15px;
            background-color: #FFFFFF;
        }
        .responsive-wrapper {
            margin: 0 auto;
            width: 100%;
        }
        #button-wrapper {
            text-align: center;
        }
        #download-button {
            min-width: 130px;
        }
        #download-button .ui-button-text {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 19px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        p {
            text-align: center;
        }
        #jquery_jplayer_audio_1 {
            margin-top: 18px;
        }
        #button-wrapper {
            margin-top: 23px;
        }
        #jp_container_audio_1 {
            border-radius: 3px;
            overflow: hidden;
        }
        .ha-wrapper {
            margin-top: 23px;
            overflow: hidden;
        }
        .ha {
            width: 728px;
            height: 90px;
            margin: 0 auto;
        }
        @media only screen and (max-width: 720px) {
            .ha {
                width: 468px;
                height: 60px;
            }
        }
        @media only screen and (max-width: 480px) {
            .ha {
                width: 320px;
                height: 100px;
            }
        }
    </style>
    <script type="text/javascript">
        $(function() {
            $("#jquery_jplayer_audio_1").jPlayer({
                ready: function(event) {
                    $(this).jPlayer("setMedia", {
                        title: " - ",
                        mp3: "{{$fullFileUrl}}?t={{time()}}",
                    });
                },
                play: function() {
                    $(this).jPlayer("pauseOthers");
                },
                timeFormat: {
                    padMin: false
                },
                supplied: "oga,mp3",
                cssSelectorAncestor: "#jp_container_audio_1",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                remainingDuration: true,
                keyEnabled: true,
                keyBindings: {
                    loop: null,
                    muted: null,
                    volumeUp: null,
                    volumeDown: null
                },
                wmode: "window",
                solution: "html, flash",
                swfPath: "/common/swf/jquery.jplayer.swf",
            });
            /*{{url('')}}/download/{{base64_encode($fullFilePath)}}*/
            $("#download-button").button({ "icons" : { "primary" : "ui-icon-check" } }).click(function(e) {
                downloadURI("{{$fullFileUrl}}?t={{time()}}",'ringtone.{{$lastConvertFileType}}');
                this.blur();
                $(this).trigger("mouseout");
            });
        });
        function downloadURI(uri, name) {
            if (HTMLElement.prototype.click) {
                var link = document.createElement("a");
                link.download = name;
                link.href = uri;
                link.style.display = "none";
                document.body.appendChild(link);
                link.click();
                setTimeout(function() { link.remove(); }, 500);
            } else {
                window.location.href = uri;
            }
        }
        function onClose() {
            $("#jquery_jplayer_audio_1").jPlayer("stop");
        }
    </script>
</head>
<body style="overflow: hidden;">
    <div class="responsive-wrapper">
        <div id="jquery_jplayer_audio_1" class="jp-jplayer"></div>
        <div id="jp_container_audio_1" class="jp-flat-audio" role="application" aria-label="media player">
            <div class="jp-play-control jp-control">
                <button class="jp-play jp-button" role="button" aria-label="play" tabindex="0"></button>
            </div>
            <div class="jp-bar">
                <div class="jp-seek-bar jp-seek-bar-display"></div>
                <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                    <div class="jp-details"><span class="jp-title" aria-label="title"></span></div>
                    <div class="jp-timing"><span class="jp-duration" role="timer" aria-label="duration"></span></div>
                </div>
            </div>
        </div>

        <div id="button-wrapper">
            <button id="download-button">Download</button>
        </div>
    </div>
</body>
</html>
