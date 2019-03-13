//
function CheckAllx(my,fm){
	var form = $("form[name='"+fm+"']");
	var checok = my.attr('checked')?true:false;
		$("input[name='id']").attr('checked',checok);	
}
//提示信息
function Problem(text){
	alert(text);
}
function AnymetMask(p){
    $(window.parent.document).find("#metMask").remove();
    if(p==1){
	    var h =$("body").height();
	    $(window.parent.document).find("#metright div.metbox").append("<div id='metMask'></div>");
		$("#metMask").height(h);
	}
}
//累加
function allid(ary,all){
	var value = '';
	    ary.each(function(){
		    if($(this).attr("checked"))value += $(this).val()+',';
		});
		all.val(value);
}
//表单验证
function  Atoform(F,type){

    var k = F.size();

	var tn;
for(var i=0;i<k;i++){
    //email
	var e = F.eq(i).find("input.email");
	if(e.size()>0){
	    var x = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;
	    var ok= x.test(e.val()); 		
	    tn= !ok?user_msg['js44']:''; 
		if(tn!=''){
		    e.focus();
			break;
		}
    }
	//namenonull
	var namenul= F.eq(i).find("input.namenonull");
	if(namenul.size()>0){
	    namenul.each(function(){
		if(!$(this).is(":hidden")){
		var tit= user_msg['js51'];
			tn=$(this).val()==''?tit:'';
			if(tn!=''){
			    $(this).focus();
				return false;
			}
		}
		});
		if(tn!='')break;
	}
	//foldernonull
	var foldernul= F.eq(i).find("input.foldernonull");
	if(foldernul.size()>0){
	    foldernul.each(function(){
		if(!$(this).is(":hidden")){
		var tit= user_msg['js52'];
			tn=$(this).val()==''?tit:'';
			if(tn!=''){
			    $(this).focus();
				return false;
			}
		}
		});
		if(tn!='')break;
	}
	//nonull
	var nul= F.eq(i).find("input.nonull,textarea.nonull");
	
	if(nul.size()>0){
	    nul.each(function(){
		if(!$(this).is(":hidden")){
		var tit= type==1?'':$(this).parent("td").parent("tr").find("td:eq(0)").text();
			tn=$(this).val()==''?tit + user_msg['js41']:'';
			if(tn!=''){
			    $(this).focus();
				return false;
			}
		}
		});
		if(tn!='')break;
	}
	//langmarks
	var lank= F.eq(i).find("input[name='langmark']");
	   if(lank.size()>0){
	    var tit= lank.parent("td").parent("tr").find("td:eq(0)").text();
	        for(var i=0;i<langmarks.length;i++){
				tn=lank.val() == langmarks[i]?tit + user_msg['js46']:'';
				if(tn!=''){
				    lank.focus();
					break;
				}
			}
	   }
	//copylang
	var copylang = F.eq(i).find("select[name='copylang']");
		if(copylang.size()>0){
			tn=copylang.val()==''?user_msg['js36']:'';
			if(tn!=''){
				    copylang.focus();
					break;
			}
		}
	//copyclass1
	var copyclass1 = F.eq(i).find("select[name='copyclass1']");
		if(copyclass1.size()>0 && copyclass1.find('option').size()>1){
			tn=copyclass1.val()==''?user_msg['js37']:'';
			if(tn!=''){
				    copyclass1.focus();
					break;
			}
		}else if(copylang.size()>0){
			tn=copyclass1.val()==''?user_msg['js50']:'';
			if(tn!=''){
				    copylang.focus();
					break;
			}
		}
	//copyclass2
	var copyclass2 = F.eq(i).find("select[name='copyclass2']");
		if(copyclass2.size()>0 && copyclass2.find('option').size()>1){
			tn=copyclass2.val()==''?user_msg['js38']:'';
			if(tn!=''){
				    copyclass2.focus();
					break;
			}
		}
	//copyclass3
	var copyclass3 = F.eq(i).find("select[name='copyclass3']");
		if(copyclass3.size()>0 && copyclass3.find('option').size()>1){
			tn=copyclass3.val()==''?user_msg['js39']:'';
			if(tn!=''){
				    copyclass3.focus();
					break;
			}
		}
	//select
	var noselect = F.eq(i).find("select.noselect");
		if(noselect.size()>0){
			noselect.each(function(){
			var tit= type==1?'':$(this).parent("td").parent("tr").find("td:eq(0)").text();
				tn=$(this).val()==0?tit + user_msg['js41']:($(this).val()==''?tit + user_msg['js41']:'');
				if(tn!=''){
					$(this).focus();
					return false;
				}
			});
		}
}
    return tn;
}
//提交后返回窗口再提交
function SmitMeturn(data,firtext){
    var data = data.split('$');
	    if(confirm(firtext)){
	    var url = data[1]; 
            setTimeout(function(){AjaxSmit(url,'');},time);
		}else{
		    AnymetMask(2);
		    location.href=data[0];
		    Problem(user_msg['js42']); 
		}
}

function Smitse(M,fn){
var Ato = Atoform(fn);
    if(Ato){
		Problem(Ato);
		return false;
	}else{
		//AnymetMask(1);
		return true;
	}
}
//单语言提交
function Smit(M,fn,type){
var fom = $("form[name='"+fn+"']");
var Ato = Atoform(fom);
    if(Ato){
		Problem(Ato);
		return false;
	}else{
		//AnymetMask(1);
		return true;
	}
}
//链接提交
function linkSmit(my,type){
	//AnymetMask(1);
var tp = type!=1?1:confirm(user_msg['js7'])?1:AnymetMask(2);
	if(tp==1){
		return true;
	}
	return false;
}
//保存修改
function met_modify(my,form,type){
    var form = $("form[name='"+form+"']");
	var id = $("input[name='id']");
	var all = $("input[name='allid']");
	    allid(id,all);
	var aller = all.val();
	    if(aller==''){
		    Problem(user_msg['js23']);
		}else{
			var Ato = Atoform(form,1);
			if(Ato && type == 'editor'){
				Problem(Ato);
			}else{
				var df = type?(type=='editor'?1:(confirm(user_msg['js7'])?1:0)):1;
				if(df==1){
					//AnymetMask(1);
					if(type)$("input[name='action']").val(type);
					form.submit();
				}
			}
		}
	return false;
}
//国旗图标
function metflag(my,lang){
    if(my.next("#flag").length>0){
	    if($("#flag").is(':hidden'))$("#flag").show();
		else
		$("#flag").hide();
	}else{
		var offset = my.offset();
        my.after("<div id='flag' style='left:"+(offset.left+30)+"px;top:"+offset.top+"px;'><div id='andlaod'>"+user_msg['js48']+"</div><div style='margin-top:3px; padding-left:5px;'><iframe ID='UploadFiles' src='../include/upload_photo.php?returnid=langflag&flash=flash&lang="+lang+"' frameborder='0' scrolling='no' style='width:190px; overflow:hidden;'></iframe></div></div>");
	var url = "lang.php?action=flag&lang="+lang;
	var data = "";
        $.ajax({
    url:    url, 
    type:   "POST",
    data:   data, 
    success: function(data){
	    $("#flag").find('#andlaod').remove();
	    $("#flag").prepend(data);
		$("#flag").find("img").click(function(){
		    var ts = $(this).attr("src").split("/");
			var p = ts.length-1;
			var src = ts[p];
		    $("input[name='langflag']").val(src);
			$("#flag").hide();
		});
        }
        }); 
	}
}
//添加
function addsave(met,i){
	met.after('<span id="loadtxt">'+user_msg['js48']+'</span>');
	var url = met.attr('href');
	var dom = $("tr.mouse");
	var at = dom.length>0?dom.eq(dom.length-1):$('#list-top');
	var lp = $('.newlist')?$('.newlist').length:0; 
    $.ajax({
    url : url, 
    type: "POST",
    data: 'lp='+lp, 
    success: function(data){
		metaddtr(at,data,i);
		$('#loadtxt').remove();
    }
    });
	return false;
}
//栏目展开、栏目添加
function oncolumn(my,id,imgurl,tp){
	var comnn = $('tr.columnz_'+id);
	if(comnn){
		if(comnn.is(':hidden')){
			if(!tp){
			comnn.show();
			my.addClass('columnimgon');
			my.attr('src',imgurl+'/columnnox.gif');
			}
		}else{
			comnn.hide();
			my.removeClass('columnimgon');
			my.attr('src',imgurl+'/columnx.gif');
			comnn.each(function(){
				var idy = $(this).find("input[type='checkbox']").val();
				var myy = $(this).find("img.columnimg");
				if(myy)oncolumn(myy,idy,imgurl,1);
			});
		}
	}
}
function imgnumfu(){
	$("input[name='imgnum']").val(function(){return parseInt($(this).val())-1});
}
function adddisplayimg(my){
	$('#loadtxt').html('<img src=\"'+metimgurl+'loadings.gif\" style=\"position:relative; top:4px;\" />'+user_msg['js48']);
	var url = my.attr('href');
	var lp = $('.newlist')?$('.newlist').length:0;
	var dom = $("tr.newlist");
	var at = dom.length>0?dom.eq(dom.length-1):$('#list-top');
    $.ajax({
    url : url, 
    type: "POST",
    data: 'lp='+lp, 
    success: function(data){
		metaddtr(at,data,0);
		$('#loadtxt').empty();
		$("input[name='imgnum']").val(function(){return parseInt($(this).val())+1});
    }
    });
	return false;
}
function addcolumn(my,id,tp,imgurl){
	$('#loadtxt').html('<img src=\"'+metimgurl+'loadings.gif\" style=\"position:relative; top:4px;\" />'+user_msg['js48']);
	var h;
	var url = my.attr('href');
	var trcom = my.parent('td').parent('tr');
	if(id)var comnn = $('tr.columnz_'+id);
	var lp = $('.newlist')?$('.newlist').length:0; 
    $.ajax({
    url : url, 
    type: "POST",
    data: 'lp='+lp, 
    success: function(data){
		if(comnn && comnn.length>0){
			var cnum = comnn.length - 1;
			if(tp==2){
				var idy  = comnn.eq(cnum).find("input[type='checkbox']").val();
				var numd = $('tr.columnz_'+idy);
				if(numd.length>0){
					var dnum = numd.length - 1;
					h = numd.eq(dnum);
				}else{
					h = comnn.eq(cnum);
				}
			}else{
				h = comnn.eq(cnum);
			}
			var nexta = my.prev().prev();
			if(comnn.is(':hidden'))oncolumn(nexta,id,imgurl);
		}else{
			h = trcom;
			if(id==''){
				var he = $('tr.column_1').length - 1;
				var hi = $('tr.column_1').eq(he).find("input[type='checkbox']").val();
				var hn = $('tr.columnz_'+hi);
				if(hn.length>0){
					var hm  = hn.length - 1;
					var hmn = hn.eq(hm).find("input[type='checkbox']").val();
					var hnn = $('tr.columnz_'+hmn);
					if(hnn.length>0){var hmm  = hnn.length - 1;h = hnn.eq(hm);}
					else{h = hn.eq(hm);}
				}else{
					h = $('tr.column_1').eq(he);
					if(he<0)h = $('#list-top');
				}
			}
		}
		metaddtr(h,data,1);
		$('#loadtxt').empty();
    }
    });
	return false;
}
function delettr(my){
	my.parent('td').parent('tr').remove();
}
function metaddtr(h,t,i){
	h.after(t);
	var l = i!=1?i:1;
	h.next('tr').find("input[type='text']").eq(l).focus();
}
function flashow(my,fx,fy){
	var url  = my.attr('href');
	var lodf = $('#lodfalsh');
	var fxm  = fx!=''?parseInt($("input[name='"+fx+"']").val()) + 5:200; 
	var fym  = fy!=''?parseInt($("input[name='"+fy+"']").val()) + 51:400;
	if(!fx){
		lodf.load(url);	
		lodf.css({
			'position':'absolute',
			'right':'150px',
			'top':'50px',
			'z-index':'999'
		});
	}else{
	lodf.attr('src',url);
	lodf.css({
			'position':'absolute',
			'left':'50px',
			'top':'50px',
			'width':fxm+'px',
			'height':fym+'px',
			'z-index':'999',
			'background':'#fff'
		});
	}
	lodf.show();
	return false;
}
/////////////////////////////////////////////////////////////////////////////////////////////
//focus
function metfocus(intext){
        intext.focus(function(){
		    $(this).next("span.tips").css("color","#f00");
		    $(this).addClass('metfocus');
		});
        intext.focusout(function(){
		    $(this).next("span.tips").css("color","");
		    $(this).removeClass('metfocus');
		});
}
//tips
function tipsbox(my){
       var xp = my.parent("td").next("td").find(".tips-text");
	   if(xp.css("display")=="none"){xp.show();$(".tips-text").not(xp).hide();}else{xp.hide();}
}
function titletipsbox(my){
       var xp = my.parent("td").parent("tr").next("tr").find("td.title-tips");
	   if(xp.css("display")=="none"){xp.show();$(".tips-text").not(xp).hide();}else{xp.hide();}
}
//提交表单
function handle_form(name){
  var fname = "form[name='"+name+"']";
  $(fname).submit();
  return false;
}
//展开编辑器
function onfckeditor(my,id){
    my.hide();
	$("#"+id).show();
}
//关闭提示 
function Problemclose(smmm){
    var blem = $(window.parent.document).find("#Problem");
	    blem.empty();
		//clearTimeout(smm);
}
//////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
//radio color
    var radios = $("input[type='radio'],input[type='checkbox']");
	if(radios)radios.change(function(){
		radios.not($(this)).next("label").removeClass("red");
		$(this).next("label").addClass("red");
	});
//checke tr click
    var trd = $("tr.click td");
	if(trd)trd.click(function(){ 
	    var check = $(this).parent('tr.click').find("input[type='checkbox']");
		if($(this).find("input").length==0 && $(this).find("a").length==0)check.attr("checked",check.attr("checked")?false:true);
	});
	var inputeditor = $("tr.click input[type='text'],tr.click select");
	if(inputeditor){
		inputeditor.focus(function(){
			var check = $(this).parent('td').parent('tr.click').find("input[type='checkbox']");
			check.attr("checked",true);
		});
	}
//tr mouse
    var tr = $("tr.mouse");
	if(tr)tr.live('hover',function(tm){ 
		if(tm.type=='mouseover')$(this).addClass("ontr");
		if(tm.type=='mouseout')$(this).removeClass("ontr");
	});
//tips
    var titletips = $("td.title a.tips");	
	if(titletips)titletips.click(function(){titletipsbox($(this));});
    var tips = $("td.text a.tips");	
	if(tips)tips.click(function(){tipsbox($(this));});   
//inputps
    var inputps = $("input[type='text'],input[type='password'],textarea.textarea");
	if(inputps)metfocus(inputps);
//模板效果图预览
var imga = $("a.showimga");
    if(imga)imga.hover(
	    function(){
		    if($(this).next("div").length<1)$(this).after("<div class='showimg'><img src='"+$(this).attr('href')+"' width='280' height='300' /></div>");
		    var img = $(this).next("div");
			var offset = $(this).offset();
			var bodybt = 450 - offset.top;
			var tops = 0;
                if(bodybt<300)tops = bodybt-300;			
			img.css({
			    "position":"absolute",
				"left":offset.left+28,
				"top":offset.top+tops
			});
			img.removeClass("none");
		},
		function(){
		    var img = $(this).next("div");
			img.addClass("none");
		}
	);
//编辑器左边隐藏
var lefthide = $("div.left-hiden");
	if(lefthide)lefthide.click(function(){ 
	    var mdt = $(this).parent().parent('td');
		var ydt = mdt.prev('td');
		if(ydt.css("display")=="none"){
		ydt.show();
		mdt.attr("colspan","2");
		$(this).removeClass("left-hiden-hover");
		}else{
		ydt.hide();
		mdt.attr("colspan","3");
		$(this).addClass("left-hiden-hover");
		}
	});	
});
//栏目配置选中时自动选中其所有子集栏目
function list_all(my,type){
	var y = my.parent('td').parent('tr');
	var e = type==1?'tr.column_1':'tr.column_2';
	var q = y.nextUntil(e);
	var p = my.attr('checked')?true:false;
		if(q.size()>0)q.each(function(){
			var t = $(this).find('#id');
				t.attr('checked',p);
			if(type==1){
				$(this).nextUntil('tr.column_2').p;
			}
		});
}
//
