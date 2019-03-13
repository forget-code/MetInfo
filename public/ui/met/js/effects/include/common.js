define(function(require, exports, module) {

	var $ = require('jquery');
	var data = $("meta[name='generator'][content*='M"+"e"+"t"+"I"+"n"+"f"+"o']"),DataVariable = data.data("variable"),DataStr=DataVariable.split("|"); 
	window.weburl = DataStr[0]; 
	window.lang = DataStr[1];
	window.classnow = DataStr[2];
	window.id = DataStr[3];
	window.met_module = DataStr[4];
	window.met_module = DataStr[4];
	window.MetpageType = classnow==10001?1:(id?3:2);/*1为首页，2为列表页，3为详情页*/
	window.jQuery = window.$ = $;
	
	//等高
	exports.metHeight = function(group){
		tallest=0;
		group.each(function(){
			thisHeight=$(this).height();
			if(thisHeight>tallest){
				tallest=thisHeight;
			}
		});
		group.height(tallest);	
	}

	//网页点击数
	exports.metHits = function(){
		var metPrinting = $(".metPrinting");//打印此页
		if(metPrinting.length>0){
			metPrinting.click(function(e){
				window.print();
				e.preventDefault();
				return false;
			});
		}
		var metClose = $(".metClose");//关闭此页
		if(metClose.length>0){
			metClose.click(function(){
				self.close();				
			});
		}
		var metClicks = $(".metClicks");//点击次数
		if(metClicks.length>0){
			var DataClicks = metClicks.data("metclicks");
			ClicksStr=DataClicks.split("|"); 
			var ClicksModule = ClicksStr[0],ClicksListnow = ClicksStr[1];
			var urlw = weburl+'include/hits.php?type='+ClicksModule+'&id='+ClicksListnow;
			$.ajax({
				type: "POST",
				url: urlw,
				dataType:"text",
				success: function(msg){
					var t = msg.split('"');
					metClicks.html(t[1]);
				}
			});
		}
	}
	
	//翻页样式
	exports.metPage = function(){

		var metPageT = $("#metPageT"),metPageV = metPageT.attr("value");
		metPageT.on("click",function(){$(this).select()});
		$("#metPageB").on("click",function(){mPage(metPageT,metPageV)});
		
		$(document).keydown(function(e){
			if(!e) var e = window.event;  
			if(e.keyCode == 13){mPage(metPageT,metPageV);}
		})
		
		function mPage(mett,metv){
			var metPageI = mett.attr("value"),metPageNums = parseInt(metPageI);
			if(metPageNums){
				var pageData = mett.data("pageurl");	
				PageStr=pageData.split("|");
				PageStr0=PageStr[0].split("."); 
				if(metPageNums<0){
					var pageUrl = weburl + PageStr0[0] + "/" +  PageStr[0] + "1" + PageStr[1];
					window.location.href = pageUrl;
				}else if(metPageNums>PageStr[2]){
					var pageUrl = weburl + PageStr0[0] + "/" +  PageStr[0] + PageStr[2] + PageStr[1];
					window.location.href = pageUrl;
				}else{
					var pageUrl = weburl + PageStr0[0] + "/" + PageStr[0] + metPageNums + PageStr[1];
					window.location.href = pageUrl;
				}
			}else{metPageT.attr("value",metv);}}
		
	}
	

	//导航平均宽度
	exports.metNav = function(navV1){

		navV1.find("li").hover(function () {$(this).addClass("hover");},function () {$(this).removeClass("hover");});
		
		if(document.all){
			mean(navV1);
		}
		
		function mean(nav){
			var navData = nav.data("nav");
			navStr=navData.split("|"); 

			var z=navStr[0],l=navStr[1],navnum=navStr[2];

			width=(z/navnum)-l+(l/navnum);
			
			var dwidth = new Array();
			var widthV = String(width);
			var w = widthV.indexOf(".");

			if(w>0){
				n = widthV.substring(0,w+2);
				s = n.split(".");
				f = parseInt(s[0]);
				k = parseFloat("0"+"."+s[1]);
				flo = k*navnum;
				len = String(flo).split(".");
				if(len[1]>4){k = Math.ceil(flo);}else{k = len[0];}
				
				for(var i=0;i<navnum;i++){
					m=k<1?f:f+1;
					dwidth[i]=m;
					k=k-1;
				}
			}else{
				for(i=0;i<navnum;i++){
					dwidth[i]=width;
				}
			}
			
			navV1.find("li[class!='line']").each(function(index){
				$(this).css({"width":dwidth[index]});
			})

			navV1.children().css("float","left");
			navV1.css("display","block");

		}
	
	}
	
	//产品、图片列表页平均宽度（兼容IE67）
	exports.metProduct = function(t,d){
		IeStr=d.split("|");
		var z=t.find("ul").width(),w=IeStr[0],l=IeStr[1]; 
		ProIe(z,w,l,t);
		function ProIe(z,w,l,t){
			if(z){
				num=t.find("a").length;
				l=l?l:Math.floor(z/w);
				if(l>num){l=Math.floor(z/w);}
				margin=((z/l)-w)/2;
				margin=margin<0?((z/(Math.floor(z/w)))-w)/2:margin;
				dwidth= new Array();
				var marginV = String(margin);
				var m = marginV.indexOf(".");
				
				if(m>0){
					n = marginV.substring(0,m+2);
					s = n.split(".");
					f = parseInt(s[0]);
					k = parseFloat("0"+"."+s[1]);
					flo = k*l;
					len = String(flo).split(".");
					if(len[1]>4){k = Math.ceil(flo);}else{k = len[0];}
					
					for(var i=0;i<l;i++){
						m=k<1?f:f+1;
						dwidth[i]=m;
						k=k-1;
					}
				}else{
					for(i=0;i<l;i++){
						dwidth[i]=margin;
					}
				}
			}
		}

		var cc=eval(dwidth.join('+'))*2+(w*l);
		if(cc>z){dwidth[0]=dwidth[0]-(cc-z);}
		
		t.find("li").each(function(){
			$(this).find("a").each(function(index){
				$(this).css({"margin-left":dwidth[index],"margin-right":dwidth[index],"float":"left"});
			});
		});
	}

	//产品详情页面选项卡
	exports.metProTab = function(t,b){	
	t.on("click", function(e){e.preventDefault();return false;});
	t.find("a").each(function(index){
		$(this).hover(
				function () {
					var h=$(this);
					times = setTimeout(function(){
						h.addClass("hover").siblings().removeClass("hover");
						b.find(".box").eq(index).css("display","block").siblings(".box").css("display","none");
						},200);
				},
				function () {
					clearTimeout(times);
				}
			);
		});
	}
	
	//banner样式二
	exports.metBanner2 = function(b){
		var data2=b.data("banner2");
		data2Str=data2.split("*"); 
		var swf_width=data2Str[0];
		var swf_height=data2Str[1];
		var files=data2Str[2];
		var links=data2Str[3];
		var texts='';
		var swfpath = weburl+'public/ui/met/js/effects/banner/flash02.swf';
		var AutoPlayTime=6; //间隔时间：单位是秒\n";
		var bannerHtml="<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' width='"+ swf_width +"' height='"+ swf_height +"'><param name='movie' value='"+swfpath+"'><param name='quality' value='high'><param name='menu' value='false'><param name=wmode value='opaque'><param name='FlashVars' value='bcastr_file="+files+"&bcastr_link="+links+"&bcastr_title="+texts+"&AutoPlayTime="+AutoPlayTime+"'><embed src='"+swfpath+"' wmode='opaque' FlashVars='bcastr_file="+files+"&bcastr_link="+links+"&bcastr_title="+texts+"&AutoPlayTime="+AutoPlayTime+"' menu='false' quality='high' width='"+ swf_width +"' height='"+ swf_height +"' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' /></object>"
		$(".banner2").append(bannerHtml);
	}
	


	
	
});