/*
招聘模块
 */
$(function(){
	// 招聘模块表单
	$(".met-job-cvbtn").click(function(){
		$("#met-job-cv form").find('input[name="jobid"]').val($(this).data('jobid'));
	});
});