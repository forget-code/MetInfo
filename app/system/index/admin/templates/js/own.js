define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var langtxt = ownlangtxt;

	if($(".index_box").length>0){
		$(".index_stat_table table tr").hover(function(){
			$(this).addClass("met_hover");
		},function(){
			$(this).removeClass('met_hover');
		});

		function metgetdata(d,url){
			var url = d.attr("data-newslisturl");
			d.html('<ul><li>Loading...</li></ul>');
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'jsonp',
				jsonp: 'jsoncallback',
				success: function(data) {
					d.empty();
					d.append(data.msg);
				}
			});
		}

		$(document).ready(function(){
			/*推荐应用*/
			$.ajax({
				type: "GET",
				dataType: "jsonp",
				url: apppath + 'n=platform&c=platform&a=dotable_applist_json&type=dlist',
				success: function(json) {
					var html='',adu=apppath.split('index.php'),imgsrc='',price='';
					$.each(json, function(i, item){
						if(i<6){
							price  = item.price_html;
							imgsrc = item.icon;
							var media = $(".index_hotapp .media").eq(i);
							media.find(".media-left a").html('<img src="'+imgsrc+'" class="media-object" width="80">');
							media.find(".media-heading").html(item.appname+'<span class="text-danger"></span>');
							media.find("a").attr('href',adminurl+'n=appstore&c=appstore&a=doappdetail&type=app&no='+item.no+'&anyid=65');
							media.find(".media-body p").html(item.info);
						}
					});
				}
			});
			metgetdata($('#newslist'));

			var bdUrl = $(".bdsharebuttonbox").attr("data-bdUrl"),
				bdText = $(".bdsharebuttonbox").attr("data-bdText"),
				bdPic = $(".bdsharebuttonbox").attr("data-bdPic"),
				bdCustomStyle = $(".bdsharebuttonbox").attr("data-bdCustomStyle");
			window._bd_share_config={
				"common":{
					"bdUrl":bdUrl,
					"bdSnsKey":{},
					"bdText":bdText,
					"bdMini":"2",
					"bdMiniList":false,
					"bdPic":bdPic,
					"bdStyle":"2",
					"bdSize":"16"
				},
				"share":[{
					// bdCustomStyle: 'asdas'
				}]
			};
			with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='//bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
			setTimeout(function(){
				$('.bds_more i').click(function(event) {
					$(this).parent('a').click();
				});
			},500)
		})
	}

    //提示更改后台目录名称
    var adflag = $('#adpath').attr('data');
    if(adflag == 1) {
        $('#adpath').css("display","block");
    }
    $("#adpath button[data-dismiss='modal']").each(function(){
        //console.log($(this));
        $(this).click(function(){
            $('#adpath').css("display","none");
        })
    })

    $('#to_change').click(function(){
        location.href = ($(this).attr('data'));
        //location.href = ('http://www.baidu.com');

    });
    $('#no_prompt').click(function(){
        $('#adpath').css("display","none");
        var url = $(this).attr('data');
        $.ajax({
            type: "POST",
            dataType: "test",
            url: url ,
            data:{met_safe_prompt:'1'},
            success: function(data) {
                console.log(data)
            }
        });
    });
});