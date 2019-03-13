function changes(th){
    location.href = th.val();	
}
//Point Navigation
function clicknav(nav,lang,id){
    var li = 0;
	    if(lang instanceof jQuery)li=2;
    var next = new Array();
        next[0] = $("#leftnav ul,#leftnav div.post");
        next[1] = nav;
		for(var k=0;k<2;k++){
		    next[k].each(function(i){
		        var th = $(this);
		        if(i==id){
			        if(k==0){
					    var la = th.find("li a");
					    var url = la.eq(li).attr("href");
						if(lang instanceof jQuery)url=lang.attr("href");
						la.removeClass("on");
					    th.show();
						if(url){
						    $("#content div.iframe").append(loadingimg);
							$('#loading').height($('#main').height());
							la.eq(li).addClass("on");
						    $("#main").attr("src",url);
						}else{ 
						    $("#main").attr("src","site/sysadmin.php?lang="+lang); 
						}
				    }
			        if(k==1)th.addClass("onnav");
			    }else{
			        if(k==0){
					    var la = th.find("li a");
					    th.hide();
						la.removeClass("on");
					}
			        if(k==1)th.removeClass("onnav");
			    }
			});
		}
}
function clickula(ula,id){
    ula.each(function(i){
	    var th  = $(this);
	    if(i==id){
			th.addClass("on");
		}else{
		    th.removeClass("on");
		}
	});
}
function dldown(dom,dd,p){
    dd.each(function(i){
	    if(i==p){
		    var ft = $(this).is(":hidden");
		    if(ft){
			    $(this).show();
				dom.addClass("on");
			}else{
			    $(this).hide();
				dom.removeClass("on");
			}
		}else{
		    $(this).hide();
		}
	});
}
//metinfo
function metclse(my,imgurl){
    $("#metleft").toggleClass("none");
    $("#metright").toggleClass("metclse");
	$('#metright .metbox').toggleClass("metclse");
	var src = $("#metleft").is(".none")?imgurl+"botton/show.gif":imgurl+"botton/hide.gif";
	my.attr("src",src);
}

//sitemp
function sitemp(url){
	if($('#sitemap').html()==''){
		$.ajax({
		url : url, 
		type: "POST",
		data: '', 
		success: function(data){
			$('#sitemap').empty();
			$('#sitemap').append(data);
		}
		});
	}
	if($('#sitemap').is(':hidden')){
	$('#sitemap').show();
	}else{
	$('#sitemap').hide();
	}
}
function drag(C){
	var dx, dy, moveout;
	var T = C;
	T.bind("selectstart", function(){
		return false;
	});            
	T.mousedown(function(e){
		dx = e.clientX - parseInt(C.css("left"));
		dy = e.clientY - parseInt(C.css("top"));
		C.mousemove(move).mouseout(out);
		T.mouseup(up);
	});
	function move(e){
		moveout = false;
		if (e.clientX - dx < 0) {
			l = 0;
		}
		else 
			if (e.clientX - dx > $(window).width() - C.width()) {
				l = $(window).width() - C.width();
			}
			else {
				l = e.clientX - dx
			}
		C.css({
			left: l,
			top: e.clientY - dy
		});              
	}
	function out(e){
		moveout = true;
		setTimeout(function(){
			checkout(e);
		}, 100);
	}
	function up(e){
		C.unbind("mousemove", move).unbind("mouseout", out);
		T.unbind("mouseup", up);
	}
	function checkout(e){
		moveout && up(e);
	}
}
function targetload(my,loadingimg){var url = my.attr('href'); $("#content div.iframe").append(loadingimg);$('#loading').height($('#main').height()); $("#main").attr("src",url);}
//Tied Navigation
    var nav = $("#topnav a");
	    nav.each(function(i){ var dom = $(this);dom.click(function(){ clicknav(nav,lang,i);});});	
//侧栏点击效果
	var ula = $("#leftnav ul a");
	    ula.each(function(i){ var dom = $(this);dom.click(function(){ clickula(ula,i);});});
//内容管理展开
	var dt = $("#leftnav div.post dt");
	var dd = $("#leftnav div.post dd");
	    dt.each(function(i){var dom = $(this);dom.click(function(){ dldown(dom,dd,i);});});
    var dta = dt.find("a");
        dta.focus(function(){ this.blur(); });
/////
    $("#content div.iframe").append(loadingimg);
	$('#loading').height($('#main').height());
    $("#leftnav li a,#leftnav dd a").click(function(){
		if($(this).attr("target")!='_blank')targetload($(this),loadingimg);
	});
	$("#leftnav li a,#leftnav dd a").bind('focus',function(){if(this.blur)this.blur();});
    $("#main").load(function(){ $("#content div").remove("#loading");}); 
	$("#sitemap a").live('click', function() {
		if(!$(this).attr("target")){
			var dtt = $(this).parent().parent();
			if(dtt.attr("tagName")=='DL'){
				dtt = dtt.parent().parent();
			}
			if(dtt.attr("tagName")=='DD'){
				var dtm = dtt;
				dtt = dtt.parent().parent().parent();
			}
			var ik = dtt.index();
			clicknav($('#topnav a'),lang,ik);
			var dta = $("#leftnav ul a");
			var ic = $("#sitemap div.nav li::not(.ddcs) a").index(this);
			clickula(dta,ic);
			if(dtm && dtm.attr("tagName")=='DD'){
				var dom = $("#leftnav div.post dt");
				var dtp = $("#leftnav div.post dd");
				var im  = $("#sitemap dd").index(dtm);
				dldown(dom,dtp,im);
			}
			targetload($(this),loadingimg);
			return false;
		}
    });
    var sitemap = $('#sitemap');
    if(sitemap){
		drag(sitemap);
		sitemap.find('dl').live('hover',function(tm){	
			if(tm.type=='mouseover'){
				$(this).find('dd').show();
				$(this).find('dd').css('left',$(this).width());
			}
			if(tm.type=='mouseout')$(this).find('dd').hide();
		});
	}