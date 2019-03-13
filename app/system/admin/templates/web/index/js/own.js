define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var langtxt = ownlangtxt;
	
	if($(".index_box").length>0){
		function chartwidth(){
			$(".index_stat canvas").attr("width",$(".index_stat_chart").width());
			require('tem/js/Chart.min');
			var cdm = document.getElementById("myChart");
			var ctx = cdm.getContext("2d");
			var myNewChart = new Chart(ctx).Line(jQuery.parseJSON(chartdata),{	datasetFill : false,bezierCurve : false});
		}
		$(document).ready(function(){ 
			chartwidth();
		});
		$(window).resize(function() {
			chartwidth();
		});

		$(".index_stat_table table tr").hover(function(){
			$(this).addClass("met_hover");
		},function(){
			$(this).removeClass('met_hover');
		});
		
		function metgetdata(d,url){
			var url = d.attr("data-newslisturl");
			d.html('Loading...');
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
						price  = item.price_html;
						imgsrc = item.icon;
						html+= '<li>';
						html+= '<dl><dt><a href="'+adminurl+'n=appstore&c=appstore&a=doappdetail&type=app&no='+item.no+'&anyid=65" title="'+item.appname+'"><img src="'+imgsrc+'"></a></dt>';
						html+= '<dd><h4><a href="'+adminurl+'n=appstore&c=appstore&a=doappdetail&type=app&no='+item.no+'&anyid=65" title="'+item.appname+'">'+item.appname+'</a></h4><h5>'+price+'</h5><h6>'+langtxt.installations+'&nbsp;' +item.download+'</h6></dd></dl></a></li>'; 
					}); 
					$(".index_hotapp ul").html(html);
					if(($(".index_hotapp li").width()-200)/2>0)$(".index_hotapp dl").css("margin-left",($(".index_hotapp li").width()-200)/2);
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
					bdCustomStyle: bdCustomStyle
				}]
			};
			with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
			
		})
	
	}
});