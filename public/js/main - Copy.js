/// Initializations

var pid, allowActions = 1, flash = 0, attempts, allowProcessing = 0, progressor, defaultSolution = "html",
    sessionID = randomString(), fileID, uploadCarousel, maxQueue = 20, uploader, progress = 0,
    resizeTimeout, winWidth, visibleFiles = 4, zf = 1, clearingPreview = 0, ito, sto, canPlay,
    songDuration, player, playerData, pos, slider, tmo, wasPaused, range, bMode, spinner,
    origin = window.location.href;

$(document).ready(function() {
    updateSize();
    $(window).bind("resize", updateSize);
    $(window).bind("orientationchange", updateSize);

    $("#pick-files").button({icons: { "primary" : "ui-icon-folder-open" }});
    $("#reset-all").button({icons: { "primary" : "ui-icon-close" }});
    $("#carousel-prev").button({"icons" : { "primary" : "ui-icon-triangle-1-w" }, "text" : false});
    $("#carousel-next").button({"icons" : { "primary" : "ui-icon-triangle-1-e" }, "text" : false});

    initUploader();

    $("#reset-all").click(function(e) {
        this.blur();
        $(this).trigger("mouseout");
        clearPreview(1);
        for (var i = 0; i < uploader.files.length; i++) {
            uploadCarousel.xCarousel("removeItem", "#" + uploader.files[i].id);
        }
        uploader.splice();
        uploader.refresh();
        sessionID = randomString();
        uploader.settings.url = origin + "upload";
        e.preventDefault();
    });

    updateButtons();

    $.fx.speeds._default = 100;

    contentProgress("start", text["status_loading"]);
    getSample();
});

function initUploader() {
    var settings = {
        "runtimes" : "html5,flash",
        "browse_button" : "pick-files",
        "container" : "upload-buttons-wrapper",
        "url" : origin + "upload",
        "flash_swf_url" : origin + "common/js/plupload2/js/Moxie.swf",
        "filters" : {
            "prevent_duplicates" : true,
            "max_file_size" : sizeLimit
        },
        "multipart" : true,
        "dragdrop" : true,
        "drop_element" : "container"
    };
    uploader = new plupload.Uploader(settings);

    uploader.bind('Init', function(up, params) {
        if (params.runtime == 'html5') $("#carousel").append('<div id="plupload_drop">' + text["js_dropfiles"] + '</div>');

        up.bind("BeforeUpload", function (up, file) {
            if (up.settings.multipart_params) $.extend(up.settings.multipart_params, {"id" : file.id});
            else up.settings.multipart_params = {"id" : file.id};
        });

        up.bind("FilesAdded", function(up, files) {
		    var delCounter = 0;
            while (up.files.length > maxQueue) {
                up.removeFile(up.files[maxQueue]);
                delCounter++;
            }
            $("#plupload_drop").hide(0);
            var addCounter = files.length - delCounter;;
            if (typeof(uploadCarousel) == "object") {
                $.each(files, function(i, file) {
                    if (addCounter <= 0 || file.status != 1) return;
                    uploadCarousel.xCarousel("addItem", fileBlock(file));
                    addCounter--;
                });
            } else {
                $.each(files, function(i, file) {
                    if (addCounter <= 0 || file.status != 1) return;
                    $("#filelist").append(fileBlock(file));
                    addCounter--;
                });
                uploadCarousel = $("#carousel").xCarousel({
                    "btnPrev" : "#carousel-prev",
                    "btnNext" : "#carousel-next",
                    "visible" : visibleFiles,
                    "updateButtons" : updateButtons
                });
            }
            updateList();
            up.refresh();
            up.start();
        });

        up.bind("UploadProgress", function(up, file) {
            $("#" + file.id + " div.plupload_file_status").html(file.percent + "% " + text["js_of"] + " " + plupload.formatSize(file.size).toUpperCase());
            $("#" + file.id + " div.plupload_file_progress_bar").css("width", file.percent + "%");
            handleStatus(file);
            if (settings.multiple_queues && up.total.uploaded + up.total.failed == up.files.length) {
                $(".plupload_start").addClass("plupload_disabled");
            }
        });

        up.bind("Error", function(up, err) {
            var file = err.file, message;
            if (file) {
                message = err.message;
                if (err.details) message += " (" + err.details + ")";
                if (err.code == plupload.FILE_SIZE_ERROR) x_prettyError(text["js_toobig"] + ": " + file.name);
                if (err.code == plupload.FILE_EXTENSION_ERROR) x_prettyError(text["js_wrongtype"] + ": " + supportedFormats + ".");
                file.hint = message;
                $("#" + file.id).attr("class", "plupload_failed").find("a").css("display", "block").attr("title", message);
            }
            up.refresh();
        });

        up.bind("FileUploaded", function(up, file, response) {
            var res = eval(jQuery.parseJSON(response.response));
            if (res === null) return;
            if (res.audio) {
                $("#" + file.id + " .plupload_file_status").remove();
                $("#" + file.id + " .plupload_file_progress_bar").remove();
                $("#" + file.id + " .plupload_thumb").css({
                    "background-image" : "url(" + res.audio.thumb_url + ")",
                    "background-repeat" : "no-repeat",
                    "background-position" : "center",
                    "cursor" : "pointer",
                    "background-color" : "transparent"
                });
                $("#" + file.id + " .plupload_thumb").click(function(e) {
                    initPanel(file.id);
                    e.preventDefault();
                });
                $("#" + file.id + " .plupload_thumb").mouseenter(function() {
                    $("#" + file.id + " .plupload_file_wrapper").addClass("ui-state-active");
                }).mouseleave(function() {
                    $("#" + file.id + " .plupload_file_wrapper").removeClass("ui-state-active");
                });
                if (! fileID) initPanel(file.id);
            } else {
                up.trigger("Error", { "file" : file, "message" : res.error.message || text["js_error"] });
            }
        });

        up.bind("UploadFile", function(up, file) {
            $("#" + file.id).addClass("plupload_current_file");
        });

        up.bind("StateChanged", function() {
            if (up.state === plupload.STARTED) {
                $("li.plupload_delete a").hide("fade");
            } else {
                updateList();
            }
        });

        up.bind("QueueChanged", updateList);
    });

    uploader.init();
}

function initPanel(fid) {
    if (! allowActions) return;
    clearPreview();
    $(".plupload_filelist li .plupload_file_wrapper").removeClass("ui-button-inverse");
    $("#" + fid + " .plupload_file_wrapper").addClass("ui-button-inverse");
    $("#content-wrapper").show(0);
    contentProgress("start", text["status_processing"]);
    fileID = fid;
    getPanel(fileID);
}

function initGUI(isDisabled) {
    $("#player-spinner-min").spinner({
        step: 0.1,
        numberFormat: "n",
        min: 0,
        max: songDuration,
        create: function(event, ui) {
            spinner.min = $("#player-spinner-min");
        },
        change: function(event, ui) {
            if (typeof(event["handleObj"]) == "object" && event.handleObj.type == "blur") {
                if ($(this).spinner("isValid")) {
                    var value = round($(this).spinner("value"));
                    if (value != range.min) {
                        slider.range.slider("values", [value, range.max]);
                        slideRange([value, range.max], 1);
                        spinner.max.spinner("option", "min", value);
                    }
                }
            }
        },
        spin: function(event, ui) {
            slider.range.slider("values", [ui.value, range.max]);
            slideRange([ui.value, range.max], 1);
            spinner.max.spinner("option", "min", ui.value);
            setTimeout(function() { spinner.min.blur(); }, 1000);
        }
    });
    $("#player-spinner-max").spinner({
        step: 0.1,
        numberFormat: "n",
        min: 0,
        max: songDuration,
        create: function(event, ui) {
            spinner.max = $("#player-spinner-max");
        },
        change: function(event, ui) {
            if (typeof(event["handleObj"]) == "object" && event.handleObj.type == "blur") {
                if ($(this).spinner("isValid")) {
                    var value = round($(this).spinner("value"));
                    if (value != range.max) {
                        slider.range.slider("values", [range.min, value]);
                        slideRange([range.min, value], 1);
                        spinner.min.spinner("option", "max", value);
                    }
                }
            }
        },
        spin: function(event, ui) {
            slider.range.slider("values", [range.min, ui.value]);
            slideRange([range.min, ui.value], 1);
            spinner.min.spinner("option", "max", ui.value);
            setTimeout(function() { spinner.max.blur(); }, 1000);
        }
    });
    $("#player-spinner-min, #player-spinner-max").keypress(function (event) {
        if (event.keyCode == 9 || event.keyCode == 13) {
            event.preventDefault();
            $(this).blur();
        }
    });
    $("#player-play").button({
        text: false,
        icons: { primary: "ui-icon-play" }
    }).click(function() {
        if (bMode.play) {
            $(this).button("option", { icons: { primary: "ui-icon-pause" } });
            bMode.play = 0;
            $(this).parent().parent().find(".text").html(text["panel_pause"]);
            if (pos >= range.max) player.jPlayer("play", range.min);
            else player.jPlayer("play");
        } else {
            $(this).button("option", { icons: { primary: "ui-icon-play" } });
            bMode.play = 1;
            $(this).parent().parent().find(".text").html(text["panel_play"]);
            player.jPlayer("pause");
        }
        $(this).blur();
    });
    $("#player-stop").button({
        text: false,
        icons: { primary: "ui-icon-stop" }
    }).click(function() {
        movePlayHead(player, range.min, "pause");
        $(this).blur();
        $("#player-play").button("option", { icons: { primary: "ui-icon-play" } });
        $("#player-play").parent().parent().find(".text").html(text["panel_play"]);
        bMode.play = 1;
    });
    $("#player-repeat").button({
        text: false,
        icons: { primary: "ui-icon-refresh" },
        create: function() {
            if ($("label[for='player-repeat']").hasClass("ui-state-active")) bMode.repeat = 1;
        }
    }).click(function() {
        if (bMode.repeat) bMode.repeat = 0;
        else bMode.repeat = 1;
        $(this).blur();
    });
    $("#player-volume").slider({
        animate: false,
        max: 1,
        range: "min",
        step: 0.01,
        value: $.jPlayer.prototype.options.volume,
        slide: function(event, ui) {
            player.jPlayer("option", "muted", false);
            player.jPlayer("option", "volume", ui.value);
        },
        create: function(event, ui) {
            slider.volume = $("#player-volume");
        },
        stop: function(event, ui) {
            slider.volume.find(".ui-slider-handle").blur();
        }
    });
    $("#player-progress").slider({
        animate: false,
        max: songDuration,
        range: "min",
        step: 0.1,
        value: 0,
        slide: function(event, ui) {
            var outOfRange = 0;
            var current = round(ui.value);
            if (ui.value < range.min) { outOfRange = 1; current = range.min; }
            else if (ui.value > range.max) { outOfRange = 1; current = range.max; }
            movePlayHead(player, current, "noslide");
            if (outOfRange) return false;
        },
        create: function(event, ui) {
            slider.progress = $("#player-progress");
        },
        start: function() {
            wasPaused = playerData.status.paused;
            if (! wasPaused) player.jPlayer("pause");
        },
        stop: function() {
            if (! wasPaused) player.jPlayer("play");
            slider.progress.find(".ui-slider-handle").blur();
        }
    });
    $("#player-range").slider({
        animate: false,
        max: songDuration,
        range: true,
        step: 0.1,
        values : [0, songDuration],
        slide: function(event, ui) {
            slideRange(ui.values);
        },
        create: function(event, ui) {
            slider.range = $("#player-range");
            spinner.min.spinner("value", 0);
            spinner.max.spinner("value", songDuration);
        },
        start: function() {
            wasPaused = playerData.status.paused;
            if (! wasPaused) player.jPlayer("pause");
        },
        stop: function() {
            if (! wasPaused) player.jPlayer("play");
            slider.range.find(".ui-slider-handle").blur();
        }
    });
    $("#player-format").buttonset();
    $("#player-cut").button({
        icons: { primary: "ui-icon-scissors" },
        disabled: isDisabled
    }).click(function() {
        $(this).blur().trigger("mouseout");
        $("#player-stop").trigger("click");
        if ((range.min == 0 && range.max == songDuration) || range.min == range.max) {
            x_prettyError(text["js_range"]);
            return;
        }
        contentProgress("start", text["status_cutting"]);
        getSection();
    });
}

function initPlayer(audio, isDisabled) {
    player = $("#player");
    
    var pSettings = {
        preload: "auto",
        ready: function (event) {
            clearTimeout(ito);
            canPlay = 0;
            contentProgress("status", text["status_loading"]);
            if (event.jPlayer.status.noVolume) $("#player-gui").addClass("no-volume");
            $(this).jPlayer("setMedia", {
                oga: audio.ogg_url,
                mp3: audio.mp3_url
            });
        },
        timeupdate: function(event) {
            if (typeof(range.min) !== "number" || typeof(range.max) !== "number") return;
            var current = round(event.jPlayer.status.currentTime);
            if (event.jPlayer.status.currentTime > range.max) {
                pos = range.min;
                if (bMode.repeat == 1) {
                    movePlayHead(player, pos);
                } else {
                    player.jPlayer("pause");
                    $("#player-stop").trigger("click");
                }
                return;
            } else if (event.jPlayer.status.currentTime > range.max - 0.33) {
                clearTimeout(sto);
                sto = setTimeout(function() {
                    pos = range.min;
                    if (bMode.repeat == 1) {
                        movePlayHead(player, pos);
                    } else {
                        player.jPlayer("pause");
                        $("#player-stop").trigger("click");
                    }
                }, Math.floor(1000 * (range.max - event.jPlayer.status.currentTime)) - 10);
            }
            
            if (current !== pos && ! playerData.status.paused) slider.progress.slider("value", current);
            pos = current;
        },
        canplaythrough: function(event) { initAudio(event, audio, isDisabled); },
        ended: function(event) {
            $("#player-stop").trigger("click");
        },
        supplied: "oga, mp3",
        cssSelectorAncestor: "#player-container",
        wmode: "window",
        solution: defaultSolution,
        swfPath: "/common/swf"
    };

    ito = setTimeout(function() {
        defaultSolution = "html";
        if (typeof(player) == "object") try { player.jPlayer("destroy") } catch(e) {};
        pSettings.solution = defaultSolution;
        player.jPlayer(pSettings);
        playerData = player.data("jPlayer");
    }, 2000);

    player.jPlayer(pSettings);
    playerData = player.data("jPlayer");
}

function initAudio(event, audio, isDisabled) {
    if (canPlay == 1) return;
    canPlay = 1;
    if (event.jPlayer.status.duration > 0) {
        songDuration = round(event.jPlayer.status.duration);
    } else {
        if (event.jPlayer.status.format.oga) songDuration = round(audio.ogg_duration);
        if (event.jPlayer.status.format.mp3) songDuration = round(audio.mp3_duration);
    }
    range.min = 0;
    range.max = songDuration;
    initGUI(isDisabled);
    drawRuler();
    contentProgress("stop");
}

/// Communications

function getPanel() {
    x_ajax({
        "req" : {
            "url"       : "drawUpload",
            "type"      : "GET",
            "dataType"  : "json"
        },

        "onData" : function (data) {
            songDuration = 0;
            pos = 0;
            wasPaused = 0;
            slider = {"progress" : null, "range" : null, "volume" : null};
            range = {"min" : null, "max" : null};
            bMode = {"play" : 1, "repeat" : 0};
            spinner = {"min" : null, "max" : null};
            $("#content").html(data.html);
            initPlayer(data.audio)
        },

        "onError" : function () {
            clearPreview();
        },

        "onFail" : function () {
            clearPreview();
        },
        
        "attempts" : 10
    });
}

function getSample() {
    x_ajax({
        "req" : {
            "url"       : url+"/sample",
            "type"      : "GET",
            "dataType"  : "json"
        },

        "onData" : function (data) {
            songDuration = 0;
            pos = 0;
            wasPaused = 0;
            slider = {"progress" : null, "range" : null, "volume" : null};
            range = {"min" : null, "max" : null};
            bMode = {"play" : 1, "repeat" : 0};
            spinner = {"min" : null, "max" : null};
            $("#content").html(data.html);
            initPlayer(data.audio, true);
            $("#content-wrapper").show(0);
        },

        "onError" : function () {
            contentProgress("stop");
            clearPreview();
        },

        "onFail" : function () {
            contentProgress("stop");
            clearPreview();
        },
        
        "silent" : 1,
        
        "attempts" : 3
    });
}

function getSection() {
    x_ajax({
        "req" : {
            "url"       : "section/" + sessionID + "/" + fileID,
            "type"      : "GET",
            "data"      : { "format" : $("input[name=format]:checked").val(), "start" : range.min, "end" : range.max },
            "dataType"  : "json",
        },

        "onData" : function (data) {
            contentProgress("stop");
            var audio = data.audio;
            if (dlMode == 1) {
                downloadURI("download/" + audio.sid + "/" + audio.fid + "/" + audio.result + "?rnd=" + Math.random(), audio.result);
            } else {
                $(".ui-dialog").remove();
                $("<div />")
                    .html('<iframe id="resultPlayer" src="' + "result/" + sessionID + "/" + fileID + "?rnd=" + Math.random() + '" frameborder="0" marginwidth="0" marginheight="0" width="100%" height="100%" scrolling="no" style="overflow: hidden" allowfullscreen></iframe>')
                    .dialog({
                        title : text["result_title"],
                        modal: true,
                        resizable: false,
                        draggable: false,
                        width: 750,
                        height: $("body").hasClass("adb") ? 220 : 300,
                        dialogClass: "result-window",
                        position: { "my" : "center", "at" : "center", "of" : window },
                        beforeClose: function() {
                            try {
                                document.getElementById("resultPlayer").contentWindow.onClose();
                            } catch (e) {
                            }
                        }
                    });
            }
        },

        "onError" : function () {
            contentProgress("stop");
        },

        "onFail" : function () {
            contentProgress("stop");
        },
        
        "attempts" : 10
    });
}

/// Functions

function updateButtons() {
    $("#carousel-prev, #carousel-next, #pick-files, #reset-all").each(function() {
        if ($(this).hasClass("disabled") || $(this).hasClass("plupload_disabled")) {
            try { $(this).button("disable"); } finally {}
        } else {
            try { $(this).button("enable"); } finally {}
        }
    });
    if (typeof(uploader) == "object") {
        if ($("#pick-files").hasClass("plupload_disabled")) uploader.trigger("DisableBrowse", true);
        else uploader.trigger("DisableBrowse", false);
    }
}

function prettyPolicy() {
    $(".pretty-policy").remove();
    $.get("/policy", function(text) {
        $("<div />", {
            "class"     : "pretty-policy"
        }).html(text).dialog({
            "width"     : "80%",
            "modal"     : false,
            "resizable" : false,
            "title"     : "Privacy Policy",
            "position"  : { "my" : "center", "at" : "center", "of" : window }
        });
    });
}

function updateCarousel() {
    var w = $("#carousel-wrapper").width() - 54;
    $("#container").css({ "width" : w + "px", "left" : 27 + "px" });
    if (Math.floor(w / 200) !== visibleFiles) {
        visibleFiles = Math.floor(w / 200);
        if (typeof(uploadCarousel) == "object") uploadCarousel.xCarousel("setVisible", visibleFiles);
    }
    winWidth = $(window).width();
}

function updateDialog() {
    $(".ui-dialog-content").dialog("option", "position", { "my" : "center", "at" : "center", "of" : window });
}

function fileBlock(file) {
    var shortName;
    if (file.name.length > 25) shortName = file.name.slice(0, 18) + "&hellip;" + file.name.slice("-" + 5);
    else shortName = file.name;
    return '<li id="' + file.id + '" class=" plupload_file">' +
        '<div class="plupload_file_wrapper ui-widget ui-state-default ui-corner-all">' +
        '<div class="plupload_file_action"><div class="plupload_file_icon ui-icon"></div></div>' +
        '<div class="plupload_file_name"><span title="' + file.name + '">' + shortName + '</span></div>' +
        '<div class="plupload_thumb_wrapper">' +
        '<div class="plupload_file_status">' + file.percent + '% of ' + plupload.formatSize(file.size).toUpperCase() + '</div>' +
        '<div class="plupload_file_progress_bar" style="width:' + file.percent + '%;"></div>' +
        '<div class="plupload_thumb"></div></div>' +
        '</div>' +
    '</li>';
}

function handleStatus(file, image) {
    var actionClass, iconClass;
    if (file.status == plupload.DONE) { actionClass = "plupload_done"; iconClass="ui-icon-circle-close"; }
    if (file.status == plupload.FAILED) { actionClass = "plupload_failed"; iconClass="ui-icon-alert"; }
    if (file.status == plupload.QUEUED) { actionClass = "plupload_delete"; iconClass="ui-icon-circle-minus"; }
    if (file.status == plupload.UPLOADING) { actionClass = "plupload_uploading"; iconClass="ui-icon-circle-arrow-n"; }
    $("#" + file.id).removeClass("plupload_done plupload_failed plupload_delete plupload_uploading").addClass(actionClass);
    $("#" + file.id + " .plupload_file_icon").removeClass("ui-icon-circle-close ui-icon-alert ui-icon-circle-minus ui-icon-circle-arrow-n").addClass(iconClass);
    if (file.hint) $("#" + file.id + " .plupload_file_icon").attr("title", file.hint);
}

function updateList() {
    $.each(uploader.files, function(i, file) {
        handleStatus(file);
        $("#" + file.id + ".plupload_delete div.plupload_file_icon").click(function(e) {
            if ($("#" + file.id + " .plupload_file_wrapper").hasClass("ui-button-inverse")) clearPreview(1);
            uploadCarousel.xCarousel("removeItem", "#" + file.id);
            uploader.removeFile(file);
            e.preventDefault();
        });
    });
    $("#pick-files").toggleClass("plupload_disabled", uploader.files.length >= maxQueue);
    $("#reset-all").toggleClass("plupload_disabled", uploader.files.length <= 0);
    if (uploader.files.length == 0) $("#plupload_drop").show(0);
    updateButtons();
}

function clearPreview(hide) {
    if (clearingPreview == 1) return;
    clearingPreview = 1;
    if (typeof(player) == "object") try { player.jPlayer("destroy") } catch(e) {};
    player = null;
    if (hide) {
        $("#content-wrapper").hide(0, function() { $("#content").html(""); });
        fileID = undefined;
    }
    clearingPreview = 0;
    progress = 0;
}

function updateSize() {
    if (winWidth !== $(window).width()) {
        winWidth = $(window).width();
        updateCarousel();
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            updateCarousel();
            updateDialog();
        }, 100);
    }
}

function slideRange(values, nospin) {
    var current = round(playerData.status.currentTime);
    values[0] = round(values[0]);
    values[1] = round(values[1]);
    if (values[0] != range.min || current < values[0]) {
        movePlayHead(player, values[0]);
    } else if (current >= values[1]) {
        if (bMode.repeat == 1) movePlayHead(player, range.min);
        else $("#player-stop").trigger("click");
    }
    range.min = values[0];
    range.max = values[1];
    if (! nospin) {
        setTimeout(function() {
            spinner.min.spinner("value", range.min).spinner("option", "max", range.max);
            spinner.max.spinner("value", range.max).spinner("option", "min", range.min);
        }, 0);
    }
    if (range.min == range.max) $("#player-stop").trigger("click");
}

function movePlayHead(p, t, c) {
    if (p.data("jPlayer").status.paused || c == "pause") p.jPlayer("pause", t);
    else p.jPlayer("play", t);
    if (c != "noslide") slider.progress.slider("value", t);
}

function round(num) {
    return Math.round(num * 10) / 10;
}

function drawRuler() {
    var num = Math.floor(songDuration / 10), prc = 100 / (songDuration / 10), list = $('<ul class="ruler">'), i;
    for (i=0; i<num; i++) {
        list.append($("<li>"));
    }
    $("#player-range").append(list).append($('<div class="ruler-line">'));
    $(".ruler li").css("width", prc + "%");
}

function contentProgress(command, status) {
    var opts = { lines: 13, length: 13, width: 4, radius: 13, corners: 1, rotate: 0, direction: 1,
    color: '#8D8D8D', speed: 1, trail: 60, shadow: false, hwaccel: true, className: 'spinner',
    zIndex: 2e9, top: '35%', left: '50%' };
    if (command == "start") {
        $("#content-progress").fadeIn(100);
        if (typeof progressor === "object") progressor.spin(document.getElementById("content-progress"));
        else progressor = new Spinner(opts).spin(document.getElementById("content-progress"));
    } else if (command == "stop") {
        $("#content-progress").fadeOut(100, function() {
            if (typeof progressor === "object") progressor.stop();
            $("#content-progress-status").html("");
        });
    }
    if (command == "start" || command == "status") $("#content-progress-status").html(status);
}

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
