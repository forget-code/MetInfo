//define(function(require, exports, module) {
function metboard() {
    $('#metboard').remove();
    $('body').append('<div id="metboard"></div>');
    $('#metboard').height($(window).height());
    $('#metboard').css({
        'opacity': 0.1,
        'position': 'absolute',
        'left': '0px',
        'top': '0px',
        'z-index': 99,
        'width': '100%',
        'background': '#000'
    });
}

function divshow(dom) {
    var dom = $('#' + dom);
    metboard();
    var pinx = (820 - 600) / 2;
    var piny = ($(window).height() - dom.height()) / 3;
    if (piny < 0) piny = 0;
    if (pinx < 0) pinx = 0;
    dom.css('left', pinx + 'px');
    dom.css('top', piny + 'px');
    dom.show();
}

function closediv(dom) {
    $('#metboard').remove();
    $('#' + dom).hide();
}

function okonlineqq(type) {
    var hz = type == 'msn' || type == 'skype' ? '.gif': '.jpg';
    $('#met' + type + 'img').attr('src', '../public/images/' + type + '/' + type + '_' + $("input[name='met_" + type + "_type']:checked").val() + hz);
    type = 'online_box_' + type;
    closediv(type);
    ifreme_methei();
}


function onlineposition(onlineid, lng) {
    $('#onlineleft' + lng).hide();
    $('#onlineright' + lng).hide();
    if (onlineid < 2) {
        $('#onlineleft' + lng).show();
    } else if (onlineid != 3) {
        $('#onlineright' + lng).show();
    } else {
        $('#onlineleft' + lng).hide();
        $('#onlineright' + lng).hide();
    }
}

//表单数据回显
window.onload=function(){
    $(".ftype_checkbox input[type='checkbox']").each(function(){
        if($(this).attr('data')!=false){
            $(this).attr('checked', 'checked');
        }
    });

    var type = $("input[name='met_online_type']").attr('data-checked');
    var type_name = $("input[name='met_online_type']");
    type_name.each(function(i){
        //console.log($(this)[0]);
        if($(this).attr("value") == type && $(this).attr("value")!=0){
            $("cc").html($(this).next().html());
        }
    })

    $("input[name='met_online_type']").change(function(){
        if($(this).attr("value")!=0){
            console.log($(this).attr("value"))
            $("cc").html($(this).next().html());
        }
    })

}




//});



