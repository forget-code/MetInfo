define(function(require, exports, module) {

	var common = require('common');
	
	function tologin() {
		window.location.href = own_name+'c=member&a=dologin';
	}

	function js_error(error) {
		var langtxt = ownlangtxt;
		switch(error){
			case 'error_code':
				return langtxt.please_again;
			break;
			case 'error_passpay':
				return langtxt.password_mistake;
			break;
			case 'error_code':
				return langtxt.please_again;
			break;
			default :
				return error;
			break;
		}
	}
	
	$(document).on('click',"input[name='submit']",function(){
		var datainfo = $("input[name='tlength']:checked").val(),
			user_key = $("input[name='user_key']").val(),
			nourl    = $("input[name='nourl']").val(),
			user_passpay = $("input[name='user_passpay']").val(),
			url = apppath+'n=platform&c=pay&a=dopayment';
		if(datainfo){
			if(user_passpay){
				if($("input[name='svcdesc']").attr("checked")){
					$.ajax({
						url: url,
						type: "GET",
						cache: false,
						data: 'buytype=svc&buyinfo=' + datainfo + '&user_key=' + user_key,
						dataType: "jsonp",
						success: function(data) {
							if(data.jsdo == 'pay'){
								common.metalert({html:'余额不足请先充值'});
							}else if(data.jsdo == 'buy'){
								url = apppath+'n=platform&c=pay&a=dobalance';
								$.ajax({
									url: url,
									type: "GET",
									cache: false,
									data: 'buytype=svc&buyinfo=' + datainfo + '&user_key=' + user_key + '&user_passpay=' + $("input[name='user_passpay']").val(),
									dataType: "jsonp",
									success: function(data) {
										if (data.error) {
											alert(js_error(data.error));
											if(data.error == 'error_code'){
												tologin(data);
											}
										} else {
											url = apppath+'n=platform&c=support&a=doadd';
											$.ajax({
												url: url,
												type: "GET",
												cache: false,
												data: 'ordernum=' + data.ordernum + '&user_key=' + user_key,
												dataType: "jsonp",
												success: function(data) {
													location.href = own_form+"a=doindex&btnok=1&turnovertext="+data.txt;
												}
											});
										}
									}
								});
								
							}else if(data.jsdo == 'error_code'){
								alert(js_error('error_code'));
								tologin();
							}else{
								alert(js_error(data.jsdo));
							}
						}
					});
				}else{
					common.metalert({html:'请查看技术支持服务范围与服务方式，并勾选对应选项。'});
				}	
			}else{
				common.metalert({html:'请输入登录密码！'});
			}
		}else{
			common.metalert({html:'请选择时长'});
		}
		return false;
	});
	
	if($("input[name='btnok']").val()==1){
		$('.supportbox').find(".dropdown-toggle").dropdown('toggle');
	}
	
});