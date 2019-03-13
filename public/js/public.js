function ifie() {
    return document.all;
}

function SetHome(obj, vrl, info) {
    if (!ifie()) {
        alert(info);
    }
    try {
        obj.style.behavior = 'url(#default#homepage)';
        obj.setHomePage(vrl);
    } catch (e) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            } catch (e) {
                alert("Your Browser does not support");
            }
            var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
            prefs.setCharPref('browser.startup.homepage', vrl);
        }
    }
}

function addFavorite(info) {
    if (!ifie()) {
        alert(info);
    }
    var vDomainName = window.location.href;
    var description = document.title;
    try { //IE
        window.external.AddFavorite(vDomainName, description);
    } catch (e) { //FF
        window.sidebar.addPanel(description, vDomainName, "");
    }
}

function metHeight(group) {
    tallest = 0;
    group.each(function() {
        thisHeight = $(this).height();
        if (thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}

function metmessagesubmit(info3, info4) {
    if (document.myform.pname.value.length == 0) {
        alert(info3);
        document.myform.pname.focus();
        return false;
    }
    if (document.myform.info.value.length == 0) {
        alert(info4);
        document.myform.info.focus();
        return false;
    }
}

function addlinksubmit(info2, info3) {
    var webnamelength = document.myform.webname.value.replace(/(^\s*)|(\s*$)/g, '');
    var weburllength = document.myform.weburl.value.replace(/(^\s*)|(\s*$)/g, '');
    if (webnamelength == 0) {
        alert(info2);
        document.myform.webname.focus();
        return false;
    }
    if (weburllength == 0 || weburllength == 'http://') {
        alert(info3);
        document.myform.weburl.focus();
        return false;
    }
}

function textWrap(my) {
    var text = '',
        txt = my.text();
    txt = txt.split("");
    for (var i = 0; i < txt.length; i++) {
        text += txt[i] + '<br/>';
    }
    my.html(text);
}

function pressCaptcha(obj) {
    obj.value = obj.value.toUpperCase();
}

function ResumeError() {
    return true;
}
window.onerror = ResumeError;

$(document).ready(function() {
    var video = $(".metvideobox");
    if (video.length > 0) {
        $.extend({
            includePath: '',
            include: function(file) {
                var files = typeof file == "string" ? [file] : file;
                for (var i = 0; i < files.length; i++) {
                    var name = files[i].replace(/^\s|\s$/g, "");
                    var att = name.split('.');
                    var ext = att[att.length - 1].toLowerCase();
                    var isCSS = ext == "css";
                    var tag = isCSS ? "link" : "script";
                    var attr = isCSS ? " type='text/css' rel='stylesheet' " : " type='text/javascript' ";
                    var link = (isCSS ? "href" : "src") + "='" + $.includePath + name + "'";
                    if ($(tag + "[" + link + "]").length == 0) $("head").prepend("<" + tag + attr + link + "></" + tag + ">");
                }
            }
        });
        $.include('../public/ui/v1/js/effects/video-js/video-js.css');

        var videolist = $(".metvideobox");
        videolist.each(function() {
            var data = $(this).attr("data-metvideo");
            data = data.split("|");
            var width = data[0],
                height = data[1],
                poster = data[2],
                autoplay = data[3],
                src = data[4];
            var vhtml = '<div class="metvideobox"><video class="metvideo video-js vjs-default-skin" controls preload="none" width="' + width + '" height="' + height + '" poster="' + poster + '" data-setup=\'{\"autoplay\": ' + autoplay + '}\'>';
            vhtml += '<source src="' + src + '" type="video/mp4" />';
            vhtml += '</video></div>';
            $(this).after(vhtml);
            $(this).remove();
        });

        $.getScript("../public/ui/v1/js/effects/video-js/video_hack.js");

        // videojs.options.flash.swf = videpath+"public/ui/v1/js/effects/video-js/video-js.swf";

    }
})