define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');
	
	$("button[type='submit']").click(function(){
		if(!$("select[name='class']").val()){
			common.metalert({html:'请选择所属栏目'});
			return false;
		}
		$("input[name='class']").val($("select[name='class']").val());
	});
	$("button[data-next]").click(function(){
		var next = $(this).data("next");
		$("a[aria-controls='"+next+"']").click();
	});
	
	function classpara(value,type,dom){
		if(value){
			var listbox = $(".paralistbox");
			value = value.toString();
			if(value.indexOf(',')!=-1){
				value = value.split(',');
				value = value[0];
			}
			if(value!=listbox.data("class")||type==1){
				listbox.data("class",value);
				$.ajax({
				   type: "POST",
				   url: listbox.data('paralist')+'&class='+value,
				   success: function(msg){
						listbox.html(msg);
						common.AssemblyLoad($(".paralistbox"));
						common.defaultoption($(".paralistbox"));
						if(dom){
							dom.removeClass('met-laoding').css("font-size","");
						}
				   }
				});
			}
		}
	}
	var selectclass = $("select[name='class']");
	selectclass.change(function(){
		classpara($(this).val());
	});
	var value = selectclass.data('value');
	if(value){
		if(value.indexOf(',')!=-1){
			value = value.split(',');
			for(var i=0;i<value.length;i++){
				selectclass.find("option[value='"+value[i]+"']").attr("selected",true);
			}
		}else{
			selectclass.val(value);
		}
		classpara(selectclass.val());
	}
	
	$(".refresh_para").click(function(){
		if(selectclass.val())$(this).addClass('met-laoding');
		classpara(selectclass.val(),1,$(this));
	});
	
	$("input[name='addtype']").change(function(){
		if($(this).val()==2){
			$("input[name='addtime']").focus();
		}
	});
	
});