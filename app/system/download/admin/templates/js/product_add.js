define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');
	
	// $("button[type='submit']").click(function(){
	// 	if(!$("select[name='class']").val()){
	// 		common.metalert({html:'请选择所属栏目'});
	// 		return false;
	// 	}
	// 	$("input[name='class']").val($("select[name='class']").val());
	// });
	$("button[data-next]").click(function(){
		var next = $(this).data("next");
		$("a[aria-controls='"+next+"']").click();
	});
	
	function classpara(value,type,dom){
		if(value){
			var listbox = $(".paralistbox");
			value = value.toString();
			//alert(value);
			if(value.indexOf(',')!=-1){
				value = value.split(',');
				value = value[0];
			}
			
			var class1='';
			var class2='';
			var class3='';
			 class1=$("select[name='class1']").val();
			 class2=$("select[name='class2']").val();
			 class3=$("select[name='class3']").val();
			 	  // alert(class1);
			// });
			 // $("select[name='class2']").change(function(){
			 // 	   class2=$(this).val();
			 // 	    // alert(class2);
			 // });
			 // $("select[name='class3']").change(function(){
			 // 	 class3=$(this).val();
			 // 	    //alert(class3);
			 // });
			 // var class1=1;
			 //  var class2=$("select[name='class2']").attr('data-checked');
			 //   var class3=$("select[name='class3']").attr('data-checked');
			 // alert(class11);
			 //  alert(class12);
			 //   alert(class13);
			if(value!=listbox.data("class")||type==1){
				listbox.data("class",value);
				$.ajax({
				   type: "POST",
				   url: listbox.data('paralist')+'&class1='+class1+'&class2='+class2+'&class3='+class3,
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
	var selectclass = $("select[name*='class']");
	selectclass.change(function(){
		classpara($(this).val());
	});
	var value = selectclass.eq(0).data('checked').toString();
	if(value){
		if(value.indexOf(',')>=0){
			value = value.split(',');
			for(var i=0;i<value.length;i++){
				selectclass.find("option[value='"+value[i]+"']").attr("selected",true);
			}
		}else{
			selectclass.eq(0).val(value);
		}
		classpara(value,1);

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