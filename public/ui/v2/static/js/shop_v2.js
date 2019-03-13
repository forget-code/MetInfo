// 商城公共
window.is_login=$('.met-head-user-column').length,
    $topcart=$("#topcart-body");
$(function(){
    // 右上角购物车
    if($topcart.length){
        loadTopcart();
        // 删除商品
        $topcart.on('click','.topcart-remove',function(e){
            e.preventDefault();
            $(this).parents('.list-group-item').append('<div class="p-y-15 vertical-align text-xs-center cart-loader"><div class="loader vertical-align-middle loader-default"></div></div>').find('.media').hide();
            $.ajax({
                url:$(this).attr('href'),
                type:'POST',
                dataType:'json',
                success:function(data){
                    if(data.error){
                        $topcart.find('.cart-loader').remove();
                        $topcart.find('.media').show();
                        alertify.error(data.error);
                    }else if(data.success){
                        setTimeout(function(){
                            alertify.success(data.success);
                            var $topcart_dropdown=$topcart.parents('.scrollable');
                            if($topcart.find('.list-group-item').length>1) $topcart.find('.cart-loader').parents('.list-group-item').remove();
                            loadTopcart('new');
                            $topcart_dropdown.asScrollable('update');
                            $topcart_dropdown.asScrollable('unStyle');
                        },300)
                    }
                }
            });
        });
    }
    $('.topcart-btn').click(function() {
        if(!$topcart.is(':visible')) $topcart.parent('.scrollable-container').height('');
    });
});
// 右上角购物车
function loadTopcart(d){
    if(!d) $topcart.html('<div class="h-100 vertical-align text-xs-center cart-loader"><div class="loader vertical-align-middle loader-default"></div></div>');
    $.loadCartJson(function(json){
        var html = '',num=0;
        $.each(json, function(i, item){
            item.shopmax = item.purchase>0?item.purchase:item.stock;
            item.img=item.img.replace(M['weburl'],'');
            item.img=M['navurl']+'include/thumb.php?dir='+item.img+'&x=40&y=40';
            html += '<div class="list-group-item" role="menuitem">'+
                        '<div class="media">'+
                            '<div class="media-left p-r-10">'+
                                '<a class="avatar text-middle" target="_blank" href="'+item.url+'">'+
                                    '<img class="img-responsive" src="'+item.img+'" alt="">'+
                                '</a>'+
                            '</div>'+
                            '<div class="media-body">'+
                                '<div class="pull-xs-right text-xs-right">'+
                                    '<span>'+item.price_str+' x '+item.amount+'</span>'+
                                    '<p><a href="'+delurl+'&id='+item.id+'" class="topcart-remove"><i class="icon wb-trash" aria-hidden="true"></i></a></p>'+
                                '</div>'+
                                '<h6 class="media-heading font-weight-unset">'+
                                    '<a target="_blank" href="'+item.url+'">'+
                                        item.name+
                                    '</a>'+
                                '</h6>'+
                                '<p>'+item.para_str+'</p>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
            num++;
        })
        if(html==''){
            html='<div class="h-100 text-xs-center vertical-align"><div class="vertical-align-middle">'+SHOPLANG.app_shop_emptycart+'</div></div>';
            $('.dropdown-menu-footer').hide();
        }else{
            $('.dropdown-menu-footer').show();
            topcartTotal(json);
        }
        $('.topcart-goodnum').html(num).removeAttr('hidden');
        if(d&&!num || !d) $topcart.html(html);
    },d);
}
// 购物车价格
function topcartTotal(json){
    $.ajax({
        url: totalurl,
        type: "GET",
        cache: false,
        dataType: "jsonp",
        success: function(data) {
            if(data.message == 'ok'){
                $('.topcart-total').html(data.price.goods.total_str);
            }
        }
    });
}
$.extend({
    // 购物车数据
    loadCartJson:function(func,d){
        $.ajax({
            url: jsonurl,
            type: 'POST',
            dataType:'json',
            success: function(json) {
                func(json);
            }
        });
    }
});
$(function(){
    // 产品详情页
    if($(".shop-product-intro").length){
        $('[data-plugin="touchSpin"]').TouchSpin();// 数量调整
        // 立即购买 && 加入购物车
        $(document).on('click', '.product-buynow,.product-tocart', function(e) {
            e.preventDefault();
            var f = true;
            $(".selectpara-list").each(function(){
                if($('.selectpara.btn-danger',this).length==0) f=false;
            });
            if(f){
                var paraval_str = encodeURIComponent(shopParaVal()).replace('*','u002A'),
                    url = $(this).attr('href')+'|'+paraval_str+'&num='+$("#buynum").val();
                location = url;
                // var paraval_str = encodeURIComponent(shopParaVal()).replace('*','u002A'),
                //  url = $(this).attr('href')+'|'+paraval_str;
                // $.ajax({
                //  url: $(this).attr('href'),
                //  type: 'POST',
                //  dataType: 'json',
                //  data: {pid:$(this).data('pid'),para:paravalStr,num:$("#buynum").val()},
                //  success:function(result){
                //      console.log(result);
                //      result.status=parseInt(result.status);
                //      // if(result.status){
                //      //  location=result.url;
                //      // }else if(result.status<0){
                //      //  location=result.url;
                //      // }else{
                //      //  alertify.theme('bootstrap').okBtn(SHOPLANG.app_shop_ok).alert(result.msg,function(){
                //      //      location=result.url;
                //      //  });
                //      // }
                //  }
                // })
            }else{
                alertify.error(SHOPLANG.app_shop_choosepara);
            }
        });
        // 选择选项
        $('.selectpara').click(function(){
            $(this).toggleClass('btn-danger').siblings().removeClass('btn-danger');
            stockPrice();// 计算价格
        });
    }
});
// 获取选项
function shopParaVal(){
    var str='';
    $('.selectpara.btn-danger').each(function(index){
        if(index>0) str+=',';
        str+=$(this).data('val');
    });
    return str;
}
// 计算价格、库存不足时禁止加入购物车、规格图片切换
function stockPrice(){
    var str=shopParaVal(),
        $stock_num=$('#stock-num'),
        $touchspin=$('[data-plugin="touchSpin"]');
    $('.product-tocart,.product-buynow').removeClass('disabled btn-dark');
    $('.stock-no').hide();
    $.each(stockjson,function(i,item){
        if(item.valuelist==str){
            var stock_max=item.stock;
            // 计算价格
            $("#price").html(parseFloat(item.price).toFixed(2));
            $stock_num.html(item.stock);
            if(item.stock>$touchspin.data('max')) stock_max=$touchspin.data('max');
            $touchspin.trigger("touchspin.updatesettings",{min:1,max:stock_max});
            // 库存不足时禁止加入购物车
            if(item.stock==0){
                $touchspin.val(0);
                $touchspin.trigger("touchspin.updatesettings",{min:0});
                $('.product-tocart,.product-buynow').addClass('disabled btn-dark');
                var $stock_no='<span class="red-600 stock-no">'+SHOPLANG.app_shop_lowstocks_min+'</span>';
                if($('.stock-no').length){
                    $('.stock-no').show();
                }else if($('.stock-purchase').length){
                    $('.stock-purchase').append($stock_no);
                }else{
                    $('#buynum').parents('.input-group').parent().after($stock_no);
                }
            }
        }else if(!str){
            $stock_num.html($stock_num.data('stock'));
        }
    });
}