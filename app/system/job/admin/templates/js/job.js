/*
招聘模块
 */
(function(){
	var that=$.extend(true,{}, admin_module);
		datatableHtml=function(thats,table_order){// 职位、简历列表渲染
			if(thats.hash=='job/position_list'){
				var edit_dataurl=thats.module+'/position_edit/?c='+thats.module+'_admin&a=doeditor&class1='+thats.data.class1+'&class2='+(thats.data.class2||'')+'&class3='+(thats.data.class3||'')+'&id=';
		        return {
		        	ajax:{
		        		dataSrc:function(result){
							var data=[];
							result.data && $.each(result.data, function(index, val) {
								var status='';
								if(parseInt(val.top_ok)) status+='<span class="badge font-weight-normal py-1 mx-1 badge-success">'+METLANG.top+'</span>';
								if(!parseInt(val.displaytype)) status+='<span class="badge font-weight-normal py-1 mx-1 badge-secondary">'+METLANG.displaytype2+'</span>';
								val.count=parseInt(val.count);
								!val.count && (val.count=METLANG.josAlways);
								var item=[
										M.component.checkall('item',val.id),
										'<span>'+val.position+'</span>',
										'<span>'+val.count+'</span>',
										status,
										'<span>'+val.useful_life+'</span>',
										'<span>'+val.updatetime+'</span>',
										'<span>'+val.access.name+'</span>',
										M.component.formWidget('no_order-'+val.id,val.no_order,'text',1,0,'text-center'),
										'<button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target=".'+thats.module+'-position-details-modal" data-modal-title="'+METLANG.jobposition+'" data-modal-size="lg" data-modal-url="'+edit_dataurl+val.id+'" data-modal-fullheight="1">'+METLANG.editor+'</button>'
										+'<button type="button" class="btn btn-sm btn-primary mr-1 btn-view-cv" data-id="'+val.id+'">'+METLANG.memberCV+'</button>'
										+M.component.btn('del',{del_url:val.delete})
									];
								data.push(item);
							});
						    return data;
				        }
		        	}
		        };
			}else{
				var edit_dataurl=thats.module+'/edit/?c='+thats.module+'_manage&a=doview&class1='+thats.data.class1+'&class2='+thats.data.class2+'&class3='+thats.data.class3+'&id=';
				return {
					ajax:{
		        		dataSrc:function(result){
							var data=[];
							result.data && $.each(result.data, function(index, val) {
								val.readok=parseInt(val.readok);
								var para_list=(function(){
										var list=[];
										$.each(val.para_list, function(index1, val1) {
											list.push(val1);
										});
										return list;
									})(),
									item=[
										M.component.checkall('item',val.id),
										val.position,
										'<span class="badge font-weight-normal py-1 badge-'+(val.readok?'secondary':'warning')+'">'+METLANG[val.readok?'read':'unread']+'</span>'
									];
								if(para_list.length) item=item.concat(para_list);
								item=item.concat([
									val.addtime||'',
									'<button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="modal" data-target=".'+thats.module+'-details-modal" data-modal-title="'+METLANG.memberCV+'" data-modal-size="lg" data-modal-url="'+edit_dataurl+val.id+'" data-modal-fullheight="1" data-modal-tablerefresh="'+table_order+'" data-modal-tablerefresh-type="'+(val.readok.val?0:1)+'" data-modal-oktext="" data-modal-notext="'+METLANG.close+'">'+METLANG.View+'</button>'
									+M.component.btn('del',{del_url:val.del_url})
								]);
								data.push(item);
							});
						    return data;
		        		}
	        		}
				};
			}
		};
	// 职位列表
    M.component.commonList(datatableHtml);
    // 简历列表
	var hash=that.hash=='job/position_list'?'job/list':'job/position_list';
	TEMPLOADFUNS[hash]=function(){
		M.component.commonList(datatableHtml);
	}
	// 查看简历
	$(document).on('click', '[id^="job-position-list-"] tbody .btn-view-cv', function(event) {
		var id=$(this).data('id'),
			$tab=$(this).parents('.content-show-item').find('.met-headtab a:eq(1)'),
			url=$tab.attr('data-url').split('&jobid')[0];
		$($tab.attr('href')).find('form [name="jobid"]').val(id);
		$tab.attr({'data-url':url+'&jobid='+id}).click();
		setTimeout(function(){
			$tab.attr({'data-url':url+'&jobid='});
		},500);
	});
	// 查看所有简历
	$(document).on('click', '.content-show-item[data-path^="job/"] .met-headtab a:eq(1)', function(event) {
		if($(this).attr('data-url').split('&jobid=')[1]=='') $($(this).attr('href')).find('form [name="jobid"]').val('');
	});
})();