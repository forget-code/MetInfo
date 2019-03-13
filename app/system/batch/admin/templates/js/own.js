define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
    var url = $("form").attr('action');
    //lert(url);

    $("#class1select").change(function(){
        var $class1 = $(this).val();
        var $class2opt = $("#class2select");
        $class2opt.html("<option value=''>{$_M[word][modClass2]}</option>");
            $.ajax({
             url: url+'&a=do_get_class2'+'&id='+$class1,
             type: 'POST',
             data: '',
             success: function(result) {
                     if(result){
                         $class2opt.append(result);
                         var $class3opt = $("#class3select");
                         $class3opt.html("<option value=''>{$_M[word][modClass3]}</option>");
                     }else{
                         $class2opt.html("<option value=''>{$_M[word][modClass2]}</option>");
                         var $class3opt = $("#class3select");
                         $class3opt.html("<option value=''>{$_M[word][modClass3]}</option>");
                     }
                 }
             });
        })


    $("#class2select").change(function(){
        var $class1 = $(this).val();
        var $class3opt = $("#class3select");
        $class3opt.html("<option value=''>{$_M[word][modClass3]}</option>");
        $.ajax({
            url: url+'&a=do_get_class3'+'&id='+$class1,
            dataType: 'POST',
            data: '',
            success: function(result) {
                if(result){
                    $class3opt.append(result);
                }else{
                    $class3opt.html("<option value=''>{$_M[word][modClass3]}</option>");

                }
            }
        });
    })

    //添加水印
    $("#submit1").click(function(){
        var class1 = $('#class1select').val();
        var class2 = $('#class2select').val();
        var class3 = $('#class3select').val();
        $.ajax({
            url: url+'&a=dowatermark',
            type: 'POST',
            dataType: 'json',
            data: {class1:class1,class2:class2,claas3:class3,type:'addwm'},
            success: function(result) {
                if(result.code==0){
                    $("#quantity").css('display','');
                    $("#quantity span").html("{$_M[word][batch_descript1_v6]}" + result.message + "{$_M[word][records]}");
                }else{
                    $("#quantity").css('display','');
                    $("#quantity span").html("{$_M['word']['please_select']");
                }
            }
        });

    })

    //去除水印
    $("#submit2").click(function(){
        var class1 = $('#class1select').val();
        var class2 = $('#class2select').val();
        var class3 = $('#class3select').val();
        $.ajax({
            url: url+'&a=dowatermark',
            type: 'POST',
            dataType: 'json',
            data: {class1:class1,class2:class2,claas3:class3,type:'delwm'},
            success: function(result) {
                if(result.code==0){
                    $("#quantity").css('display','');
                    $("#quantity span").html("{$_M['word']['batch_descript1_v6']}" + result.message + "{$_M[word][records]}");
                }else{
                    $("#quantity").css('display','');
                    $("#quantity span").html("{$_M['word']['please_select']");
                }
            }
        });
    })


    //生产缩略图  没用了
    $("#addthumb").click(function(){

        var class1 = $('#class1select').val();
        var class2 = $('#class2select').val();
        var class3 = $('#class3select').val();
        $.ajax({
            url: url+'&a=dowatermark',
            type: 'POST',
            dataType: 'json',
            data: {class1:class1,class2:class2,claas3:class3,type:'addthumb'},
            success: function(result) {
                if(result.code==0){
                    $("#quantity").css('display','');
                    $("#quantity span").html("{$_M[word][batch_descript3_v6]}" + result.message + "{$_M[word][records]}");
                }else{
                    $("#quantity").css('display','');
                    $("#quantity span").html("{$_M['word']['please_select']");
                }
            }
        });
    })





});