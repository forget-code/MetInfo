var validlang = lang=='cn'?'zh_CN':'';
var weixinvld;
$(document).ready(function() {
	
	$('#pay-balance').formValidation({
		locale:validlang,
		framework: "bootstrap",
		icon: {
            valid: 'icon wb-check',
            invalid: 'icon wb-close',
            validating: 'icon wb-loop'
        }
	})
	.on('success.form.fv', function(e, data) {
		e.preventDefault();
		var $form    = $(e.target),
			formData = new FormData(),
			params   = $form.serializeArray();
		$.each(params, function(i, val) {
			formData.append(val.name, val.value);
		});
		$.ajax({
			url: $form.attr('action'),
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType:'json',
			success: function(result) {
				if(result.error){
					alertify.error(result.error);
				}else if(result.success){
					alertify.success(lang_paidok);
					window.location.href = result.success;
				}
			}
		});
	});
	
	$(document).on('click', '.pay-online-recharge', function(e) {
		var price = $("input[name='price']").val();
		if(price){
			var self = $(this);	
			self.attr('href', 'javascript:;');
			var url = self.attr('data-url')+'&price='+price;
			$.ajax({
				url: url,
				type: 'POST',
				dataType:'json',
				success: function(data) {
				alert(data.success);
					if(data.error){
						//alert(data.error);
					}else if(data.success){
						self.attr('href', data.success);
					}
				}
			});
		
		}else{
			alert("请输入充值金额！");
		}
	});
	
	$(document).on('click', '.payment-weixin', function(e) {
		e.preventDefault();
		if($(this).attr('href') != 'javascript:;'){
			$("#payment-weixin-modal .modal-body").html('<div class="height-100 vertical-align text-center order-loader"><div class="loader vertical-align-middle loader-default"></div></div>');
			$("#payment-weixin-modal").modal('show');
			var url = $(this).data('check_url');
				$.ajax({
					url: $(this).attr('href'),
					type: 'POST',
					dataType:'json',
					success: function(data) {
						if(data.code_url){
							$("#payment-weixin-modal .modal-body").html('<img src="'+data.code_url+'&size=8" class="img-responsive">');
							weixinvld = setInterval(function () { weixinvid(url); },3000);
						}else{
							alertify.error('支付接口错误，请联系网站管理员');
							$("#payment-weixin-modal").modal('hide');
						}
					}
				});
			}
	})
	/*
	$('#payment-weixin-modal').on('hidden.bs.modal', function (e) {
		window.clearInterval(weixinvld);
	})
	*/
	$(document).on('click', '.payment-weixin-h5', function(e) {
		e.preventDefault();
		if($(this).attr('href') != 'javascript:;'){
			//$("#payment-weixin-h5-modal .modal-body").html();
			$("#payment-weixin-h5-modal").modal('show');
			var url = $(this).data('check_url');
			
			weixinvld = setInterval(function () { weixinvid(url); },3000);
			$.ajax({
				url: $(this).attr('href'),
				type: 'GET',
				dataType:'json',
				success: function(data) {
					$("#payment-weixin-h5-modal").modal('hide');
					if(data.Address&&data.Parameters){				
						window.wxh5Address = jQuery.parseJSON(data.Address);
						window.wxh5Parameters = jQuery.parseJSON(data.Parameters);
						if (typeof WeixinJSBridge == "undefined") {
							if (document.addEventListener) {
								document.addEventListener('WeixinJSBridgeReady', editAddress, false)
							} else if (document.attachEvent) {
								document.attachEvent('WeixinJSBridgeReady', editAddress);
								document.attachEvent('onWeixinJSBridgeReady', editAddress)
							}
						} else {
							editAddress()
						}
						callpay();
					}else{
						alertify.error('支付接口错误，请联系网站管理员');
					}
				}
			});
		}
	});
	
	
	// refresh_interface();

	window.setInterval("refresh_interface()",1000*60*5); 

});
/*vid*/
function weixinvid(url){
	$.ajax({
		url: url,
		type: 'POST',
		dataType:'json',
		success: function(data) {
			if(data.trade_state=='SUCCESS'){
				alertify.success(lang_paidok);
				window.location.href = paidokurl;
			}
		}
	});
}
/*微信应用内支付*/
function jsApiCall() {
	WeixinJSBridge.invoke('getBrandWCPayRequest', window.wxh5Parameters, function(res) {
		//WeixinJSBridge.log(res.err_msg);
		//alert(res.err_code + res.err_desc + res.err_msg);
		if(res.err_msg == "get_brand_wcpay_request：ok" ) {

		} 
		$("#payment-weixin-h5-modal").modal('hide');
	})
}
function callpay() {
	if (typeof WeixinJSBridge == "undefined") {
		if (document.addEventListener) {
			document.addEventListener('WeixinJSBridgeReady', jsApiCall, false)
		} else if (document.attachEvent) {
			document.attachEvent('WeixinJSBridgeReady', jsApiCall);
			document.attachEvent('onWeixinJSBridgeReady', jsApiCall)
		}
	} else {
		jsApiCall()
	}
}
//获取共享地址
function editAddress() {
	WeixinJSBridge.invoke('editAddress', window.wxh5Address, function(res) {
		var value1 = res.proviceFirstStageName;
		var value2 = res.addressCitySecondStageName;
		var value3 = res.addressCountiesThirdStageName;
		var value4 = res.addressDetailInfo;
		var tel = res.telNumber;
		//alert(value1 + value2 + value3 + value4 + ":" + tel)
	})
}
/*--------*/

// 支付方式列表页面处理支付链接
// function refresh_interface(){
// 	$(".pay-online").each(function(){
// 		var self = $(this);
// 		self.attr('href', 'javascript:;');
// 		var url = self.attr('data-url');
// 		$.ajax({
// 			url: url,
// 			type: 'POST',
// 			dataType:'json',
// 			success: function(data) {
// 				if(data.error){
// 					alert(data.error);
// 				}else if(data.success){
// 					self.attr('href', data.success);
// 				}
// 			}
// 		});
// 	});
// }