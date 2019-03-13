//表单数据回显
window.onload=function(){
    $(".ftype_checkbox input[type='checkbox']").each(function(){
        if($(this).attr('data')!=false){
            $(this).attr('checked', 'checked');
        }
    });

    var met_wate_class = $("input[name='met_wate_class']").attr('data-checked');
    if(met_wate_class==1){
        $(".met_wate_class1").show();
        $(".met_wate_class2").hide();
    }else if(met_wate_class==2){
        $(".met_wate_class2").show();
        $(".met_wate_class1").hide();
    }

    $("input[name='met_wate_class']").click(function(){
        change_water_class(this);
    })

}

function do_color(){
    var met_text_color = $("select[name='select_color']").val();
    //sconsole.log($("select[name='select_color']").val());
    $("input[name='met_text_color']").val(met_text_color);
    $("input[name='met_text_wate']").css({color:met_text_color});

}

function change_water_class(obj) {
    var met_wate_class = $(obj).val();
    if(met_wate_class==1){
        $(".met_wate_class1").show();
        $(".met_wate_class2").hide();
    }else if(met_wate_class==2){
        $(".met_wate_class2").show();
        $(".met_wate_class1").hide();
    }

}





