define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');

	$(document).on('change',"select.paratype",function(){
		var value = $(this).val();
		if(value==2||value==4||value==6){
			$(this).parents("tr").find("button").removeClass("none");
		}else{
			$(this).parents("tr").find("button").addClass("none");
		}
	});

	$(document).on('click','.ui-table .paraoption',function(){
		var md = $('#myModal'),
			id = $(this).data('id'),
			$tr=$(this).parents('tr'),
			html='';
		md.find(".example-title").html($tr.find("input[name='name-"+id+"']").val());
		md.find('button[type="submit"]').attr({'data-id':id});
		if($tr.find('[name="options-'+id+'"]').val()){
			$.each(JSON.parse($tr.find('[name="options-'+id+'"]').val()), function(index, val) {
				html+='<tr>'
						+'<td><input name="id" type="checkbox" value="'+val.id+'"/></td>'
						+'<td><input type="text" name="order" value="'+val.order+'" class="ui-input text-center"></td>'
						+'<td><input type="text" name="value" value="'+val.value+'" class="ui-input"></td>'
						+'<td><button type="button" class="btn btn-default ui-table-del">删除</button>'
						+'</td>'
					+'</tr>';
			});
		}
		md.find('.ui-table tbody').html(html);
		md.modal();
	});
	$(document).on('click','#myModal button[type="submit"]',function(){
		var id=$(this).attr('data-id'),
			json=[];
		if($('#myModal .ui-table tbody tr').length){
			$('#myModal .ui-table tbody tr').each(function(index, el) {
				var val_json={};
				$('[name]',this).each(function(index, el) {
					val_json[$(this).attr('name')]=$(this).val();
				});
				json.push(val_json);
			});
		}
		$('.ui-table[data-table-ajaxurl] [name="options-'+id+'"]').val(JSON.stringify(json));
		$('.ui-table[data-table-ajaxurl] input[name="id"][value="'+id+'"]').attr('checked',true);
		$('#myModal').modal('hide');
	});

});