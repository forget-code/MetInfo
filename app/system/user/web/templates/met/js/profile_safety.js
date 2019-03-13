define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	require('pub/bootstrap/validator/entrance');
	
	$('.safety-modal-pass form').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
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
	
	/*邮箱绑定与修改*/
	$(".emailedit").click(function(){
		var my = $(this);
		my.addClass("loading");
		$.ajax({
		   type: "POST",
		   url: $(this).data("mailedit"),
		   success: function(msg){
				require.async('pub/bootstrap/modal/alert',function(event){
					event.malert(msg);
					my.removeClass("loading");
				});
		   }
		});
	});
	$('.safety-modal-emailadd form').bootstrapValidator();
	$(".emailadd").click(function(){
		$(".safety-modal-emailadd").modal('show');
	});
	
	/*手机绑定与修改*/
	$('.safety-modal-teladd form').bootstrapValidator();
	$(".teladd").click(function(){
		$(".safety-modal-teladd").modal('show');
	});
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
	$(".safety-modal-teladd button.phone_code").click(function(){
		var my = $(this),tel = $(".safety-modal-teladd input[name='tel']");
		if(tel.val()==''||!/^1[0-9]{10}$/.test(tel.val())){
			require.async('pub/bootstrap/modal/alert',function(event){
				event.malert(tel.data('phone-message'));
			});
		}else{
			$.ajax({
			   type: "POST",
			   url: $(this).data("url")+'&tel='+tel.val(),
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
	$('.safety-modal-teledit form').bootstrapValidator().on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
			$.ajax({
			   type: "POST",
			   url: $form.attr('action'),
			   data:$form.serialize(),
			   success: function(msg){
					if(msg == 'SUCCESS'){
						require.async('pub/bootstrap/modal/alert',function(event){
							event.malert('验证成功！');
						});
						$(".safety-modal-teledit").modal('hide');
						$(".safety-modal-teladd").modal('show');
					}else{
						require.async('pub/bootstrap/modal/alert',function(event){
							event.malert(msg);
						});
					}
			   }
			});
    });
	$(".teledit").click(function(){
		$(".safety-modal-teledit").modal('show');
	});
	$(".safety-modal-teledit button.phone_code").click(function(){
		var my = $(this);
		$.ajax({
		   type: "POST",
		   url: $(this).data("url"),
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
	});
	
});