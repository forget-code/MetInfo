$(function(){
	var $metjobcv=$("#met-job-cv");
	if($metjobcv.length){
		var $metjobcv_body=$metjobcv.find('.modal-body');
		// 招聘模块弹出表单
		$(document).on('click','.met-job-cvbtn',function(){
			if($metjobcv_body.find('.form-group').length){
				$metjobcv_body.find('input[name=jobid]').val($(this).data('jobid'));
			}else{
				$metjobcv_body.html('<div class="h-100 vertical-align text-xs-center cart-loader"><div class="loader vertical-align-middle loader-default"></div></div>');
				$.ajax({
					url:$(this).data('cvurl'),
					type:'POST',
					data:{jobid:$(this).data('jobid')},
					success:function(data){
						$metjobcv_body.html(data).hide().slideDown(500);
						$metjobcv.find('.met-form').validation();
						$metjobcv_body.find('input[placeholder],textarea[placeholder]').placeholder();
					}
				});
			}
		});
	}
});