define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	require('pub/bootstrap/validator/entrance');
	$('.register_index form').bootstrapValidator();
	/*
	$('.register_index form').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			username: { 
				validators: {
					stringLength: {
						min: 2,
						max: 30
					}
				}
			},
			password: {
				validators: {
					stringLength: {
						min: 6,
						max: 30
					}
				}
			}
		}
	});
	*/
	
	/*获取短信验证码*/
	var $phone = $("button.phone_code");
	if($phone.length){
		var wait=90;
		function time(o) {
			if (wait == 0) {
				o.attr("disabled",false);           
				o.find('span.badge').html('');
				wait = 90;
			} else {
				o.find('span.badge').html(wait);
				wait--;
				setTimeout(function() {
					time(o);
				},
				1000)
			}
		}
		$phone.click(function(){
			var my = $(this),tel = $("input[name='username']");
			if(tel.val()==''||!/^1[0-9]{10}$/.test(tel.val())){
				require.async('pub/bootstrap/modal/alert',function(event){
					event.malert(tel.data('phone-message'));
				});
			}else{
				$.ajax({
				   type: "POST",
				   url: $(this).data("url")+'&phone='+tel.val(),
				   success: function(msg){
						if(msg == 'SUCCESS'){
							my.attr('disabled',true);
							my.html(my.data('retxt') + ' <span class="badge"></span>');
							time(my);
						}else{
							require.async('pub/bootstrap/modal/alert',function(event){
								event.malert(msg);
							});
						}
				   }
				});
			}
		});
	}
	
	require('pub/examples/formin');
		
});