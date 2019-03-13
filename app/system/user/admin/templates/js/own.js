define(function(require, exports, module) {

	var common = require('common');

	$(document).on('change',"select.paratype",function(){
		var value = $(this).val();
		if(value==2||value==4||value==6){
			$(this).parents("tr").find("button").removeClass("none");
		}else{
			$(this).parents("tr").find("button").addClass("none");
		}
	});

	$(document).on('click',"button.paraoption",function(){
		var md = $('#myModal'),id = $(this).data('id');
		md.find(".modal-body dt").html($("input[name='name-"+id+"']").val());
		md.find(".modal-body dd .fbox").html('<input name="options" data-inname="options-'+id+'" type="hidden" data-label="$|$" value="'+$("input[name='options-"+id+"']").val()+'">');
		common.AssemblyLoad(md);
		md.modal('toggle');
	});

	$(document).on('click',"#myModal button.btn-primary",function(){
		var option = $("#myModal").find("input[name='options']"),name = $("input[name='"+option.data('inname')+"']");
		name.val(option.val());
		name.parents("tr").find("input[name='id']").attr("checked",true);
		$('#myModal').modal('hide');
	});

	$(document).on('click',".usercsv",function(){
		var keyword = $("input[name='keyword']").val(),groupid = $("select[name='groupid']").val(),url = $(this).attr('href');
		if(keyword!='')url += '&keyword='+keyword;
		if(groupid!='')url += '&groupid='+groupid;
		if(keyword!=''||groupid!='')$(this).attr('href',url);
		return true;
	});

    // 会员组金额设置
    $(document).on('click', '#user-group-list td .set-price-ok', function(event) {
    	if($(this).is(':checked')){
    		$(this).parents('td').find('input[type="text"]').show();
    	}else{
    		$(this).parents('td').find('input[type="text"]').hide();
    	}
    });
    // 开通认证次数套餐
    $('#user-idvalidate-buy .recharge').click(function(event) {
    	event.preventDefault();
    	$.ajax({
    		url: $(this).attr('href'),
    		type: 'POST',
    		dataType: 'json',
    		success:function(result){
    			alert(result.msg);
    			switch(parseInt(result.status)){
    				case 200:
    					location.reload();
						break;
					case 209:
    					location.href=adminurl+'anyid=65&n=appstore&c=member&a=dorecharge&return_this=1';
						break;
					case 213:
						tologin();
						break;
    			}
    		}
    	});
    });
});