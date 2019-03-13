// 访问统计
if (M["module"] && M["id"]) {
    var modulename = "";
    switch (M["module"]) {
        case 2:
            modulename = "news";
            break;
        case 3:
            modulename = "product";
            break;
        case 4:
            modulename = "download";
            break;
        case 5:
            modulename = "img";
            break
    }
    if (modulename != "") {
        $.ajax({
            type: "POST",
            url: M['navurl'] + "include/hits.php?type=" + modulename + "&id=" + M["id"] + "&metinfover=v2"
        })
    }
}
// 在线交流
var uidata_url = M['navurl'] + "include/interface/uidata.php?lang=" + M["lang"],
    h = window.location.href;
if (h.indexOf("preview=1") != -1) {
    uidata_url = uidata_url + "&theme_preview=1"
}
$.ajax({
    type: "POST",
    url: uidata_url,
    dataType: "json",
    success: function(msg) {
        var c = msg.config;
        // 在线交流
        if (c.met_online_type != 3) {
            $.include([M['navurl'] + "public/css/online.css",M['navurl']+"public/js/jquery-migrate-1.2.1.min.js"],function(){ // jquery-migrate：jQuery 应用迁移辅助插件
                var t, x, y;
                (function($) {
                    jQuery.fn.PositionFixed = function(options) {
                        var defaults = {
                            css: "",
                            x: 0,
                            y: 0
                        };
                        var o = jQuery.extend(defaults, options);
                        var isIe6 = false;
                        if ($.browser.msie && parseInt($.browser.version) == 6) {
                            isIe6 = true
                        }
                        var html = $("html");
                        if (isIe6 && html.css("backgroundAttachment") !== "fixed") {
                            html.css("backgroundAttachment", "fixed")
                        }
                        return this.each(function() {
                            var domThis = $(this)[0];
                            var objThis = $(this);
                            if (isIe6) {
                                var left = parseInt(o.x) - html.scrollLeft(),
                                    top = parseInt(o.y) - html.scrollTop();
                                objThis.css("position", "absolute");
                                domThis.style.setExpression("left", "eval((document.documentElement).scrollLeft + " + o.x + ') + "px"');
                                domThis.style.setExpression("top", "eval((document.documentElement).scrollTop + " + o.y + ') + "px"')
                            } else {
                                objThis.css("position", "fixed").css("top", o.y).css("left", o.x)
                            }
                        })
                    }
                })(jQuery);
                // 滚动方式
                var Floaters = {
                    delta: 0.08,
                    queue: null,
                    collection: {},
                    items: [],
                    addItem: function(Obj, left, top, ani) {
                        Obj.style["top"] = top + "px";
                        Obj.style["left"] = left + "px";
                        var newItem = {
                            object: Obj,
                            oLeft: left,
                            oTop: top
                        };
                        this.items[this.items.length] = newItem;
                        this.delta = ani ? ani : this.delta
                    },
                    sPlay: function() {
                        this.collection = this.items;
                        this.queue = setInterval(function() {
                            metplay()
                        }, 10)
                    }
                };
                function checkStandard() {
                    var scrollY;
                    if (document.documentElement && document.documentElement.scrollTop) {
                        scrollY = document.documentElement.scrollTop
                    } else {
                        if (document.body) {
                            scrollY = document.body.scrollTop
                        }
                    }
                    return scrollY
                }
                function metplay() {
                    var diffY = checkStandard();
                    for (var i in Floaters.collection) {
                        var obj = Floaters.collection[i].object;
                        var obj_y = Floaters.collection[i].oTop;
                        var total = diffY + obj_y;
                        if (obj.offsetTop != total) {
                            var oy = (total - obj.offsetTop) * Floaters.delta;
                            oy = (oy > 0 ? 1 : -1) * Math.ceil(Math.abs(oy));
                            obj.style["top"] = obj.offsetTop + oy + "px"
                        } else {
                            clearInterval(Floaters.queue);
                            Floaters.queue = setInterval(function() {
                                metplay()
                            }, 10)
                        }
                    }
                }
                //在线交流部分
                $.extend({
                    // 关闭弹窗
                    onlineclose:function(){
                        $("#onlinebox").hide();
                        return false
                    }
                })
                function olne_domx(type, onlinex) {
                    var maxr = document.body.offsetWidth - $("#onlinebox").width();
                    if (type > 1) {
                        onlinex = document.body.scrollWidth - $("#onlinebox").width() - onlinex
                    }
                    if (onlinex < 0) {
                        onlinex = 0
                    }
                    if (onlinex > maxr) {
                        onlinex = maxr;
                        if ($.browser.msie && parseInt($.browser.version) == 6) {
                            onlinex = maxr - 18
                        }
                    }
                    return onlinex
                }
                function olne_domx_op(type, onlinex) {
                    var zwd = document.documentElement.clientWidth;
                    var oboxw = $("#onlinebox").width();
                    oboxw = oboxw == 0 ? $("#onlinebox .onlinebox-conbox").width() : oboxw;
                    var maxr = zwd - oboxw;
                    if (type > 1) {
                        onlinex = zwd - oboxw - onlinex
                    }
                    if (onlinex < 0) {
                        onlinex = 0
                    }
                    if (onlinex > maxr) {
                        onlinex = maxr;
                        if ($.browser.msie && parseInt($.browser.version) == 6) {
                            onlinex = maxr - 18
                        }
                    }
                    return onlinex
                }
                function olne_dd_wd(d) {
                    var w = 0;
                    d.each(function() {
                        w = w > $(this).outerWidth(true) ? w : $(this).outerWidth(true)
                    });
                    return w
                }
                function olne_mouse_on(t, my, nex, type) {
                    if (t == 1) {
                        my.hide();
                        nex.show();
                        var dmk = $("div.onlinebox-conbox .online-tbox").size() ? $("div.onlinebox-conbox .online-tbox").outerWidth(true) : 0;
                        var dt = olne_dd_wd($("div.onlinebox-conbox dd"));
                        dt = dt > dmk ? dt : $("div.onlinebox-conbox .online-tbox").outerWidth(true);
                        if (dt <= 0) {
                            dt = 100
                        }
                        nex.css({
                            "width": dt + "px"
                        })
                    } else {
                        nex.css({
                            "position": "absolute",
                            "left": "0px"
                        });
                        nex.hide();
                        my.show()
                    }
                    olne_resize()
                }
                // 页面尺寸变化
                function olne_resize() {
                    mx = Number(olne_domx_op(t, x));
                    my = Number(y);
                    if (t > 0 && t < 3) {
                        var floatDivr = document.getElementById("onlinebox");
                        Floaters.addItem(floatDivr, mx, my);
                        Floaters.sPlay()
                    } else {
                        $("#onlinebox").PositionFixed({
                            x: mx,
                            y: my
                        })
                    }
                }
                function olne_mouse(dom, type) {
                    var nex = dom.next("div.onlinebox-conbox");
                    if ($(".onlinebox_2").size() > 0) {
                        dom.click(function() {
                            olne_mouse_on(1, $(this), nex, type)
                        })
                    } else {
                        dom.hover(function() {
                            olne_mouse_on(1, $(this), nex, type)
                        }, function() {})
                    }
                    $("#onlinebox .onlinebox-top").click(function() {
                        if (!nex.is(":hidden")) {
                            olne_mouse_on(0, dom, nex, type)
                        }
                    });
                    textWrap($(".onlinebox-showbox span"))
                }
                function textWrap(my) {
                    var text = "",
                        txt = my.text();
                    txt = txt.split("");
                    for (var i = 0; i < txt.length; i++) {
                        text += txt[i] + "<br/>"
                    }
                    my.html(text)
                }
                function olne_app(msg, type, mxq, myq) {
                    msg=msg.replace('return onlineclose()','return $.onlineclose()');
                    $("body").append(msg);
                    mx = Number(olne_domx_op(type, mxq));
                    my = Number(myq);
                    if (type > 0 && type < 3) {
                        var floatDivr = document.getElementById("onlinebox");
                        Floaters.addItem(floatDivr, mx, my);
                        Floaters.sPlay()
                    } else {
                        $("#onlinebox").PositionFixed({
                            x: mx,
                            y: my
                        })
                    }
                    $(window).resize(function() {
                        olne_resize()
                    });
                    $("#onlinebox").show();
                    if ($("div.onlinebox-showbox").size() > 0) {
                        olne_mouse($("div.onlinebox-showbox"), type)
                    }
                }
                $(function() {
                    var online_url = M['navurl'] + "include/online.php?lang=" + M["lang"];
                    $.ajax({
                        type: "POST",
                        url: online_url,
                        dataType: "json",
                        success: function(msg) {
                            t = msg.t, x = msg.x, y = msg.y;
                            if (t != 3) {
                                olne_app(msg.html, t, x, y)
                            }
                        }
                    })
                })
            });
        }
        // 站长统计
        if (c.met_stat == 1) {
            var navurl = M["classnow"] == 10001 ? "" : "../";
            var stat_d = M["classnow"] + "-" + M["id"] + "-" + M["lang"];
            var stat_url = M['navurl'] + "include/stat/stat.php?type=para&u=" + navurl + "&d=" + stat_d;
            $.getScript(stat_url)
        }
    }
});