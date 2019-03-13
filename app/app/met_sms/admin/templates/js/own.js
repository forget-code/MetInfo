define(function (require, exports, module) {

	var $ = require('jquery');
	var common = require('common');

    $(function () { $("[data-toggle='tooltip']").tooltip(); });

	function buy(package) {
		$.ajax({
			url: recharge_url,
			type: 'POST',
			dataType: 'json',
			data: {package: package},
		})
		.done(function(res) {
			if(res.status == 1){
				alert(res.data)
				window.location.href=index_url
			}else{
				alert(res.msg)
			}
		})
	}

	$(document).on('click','.metwindow',function(event){
		event.preventDefault();
		var package = $(this).attr('data-type');
		common.metalert({
			html:$('#mywindow').html(),
			type:'confirm',
			LeftTxt:'确认',
			RighTtxt:'取消',
			callback:function(buer){ 
				if(buer){
					buy(package)
				}else{
					
				}
			}
		});
	})


	$(document).on('click','.sms_submit',function(){
		$('form').submit(function(event) {
			return false;
		});
		$(this).attr('disabled','disabled');
		var sms_content = $("textarea[name=sms_content]").val();
		var sms_phone = $("textarea[name=sms_phone]").val();
		$.ajax({
			url: send_url,
			type: 'POST',
			dataType: 'json',
			data: {sms_phone: sms_phone, sms_content:sms_content},
		})
		.done(function(res) {
			$('.sms_submit').removeAttr('disabled');
			if(res.status == 0){
				$('.sms_msg').html(res.msg)
			}else{
				$('.sms_msg').html(res.data)
			}
		})
	});
	
	$("textarea[name=sms_content]").keyup(function(event) {
		var content = $(this).val();
		var leng = content.length;
		count_str($(this),content)
		if(leng > 500){
			alert('短信内容不能超过500')
			count_str($(this),content)
		}
	});

	$("textarea[name=sms_phone]").keyup(function(event) {
		var content = $(this).val();
		var phones = content.split("\n");
		$(".phone_count").text(phones.length)
		if(phones.length > 800){
			alert('号码不能超过800个')
			var con = phones.slice(0,800);
			$(this).val(con.join("\n"))
			$('.phone_count').text(con.length)
		}
	});


});

function count_str(e,con){
	var content = con.substr(0,500);
	e.val(content)
	var leng = content.length;
	$('.str_now').text(leng+'/66');
	var count = Math.ceil(leng/66);
	$('.str_count').text(count)
}



