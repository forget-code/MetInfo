define(function(require, exports, module) {

	var common = require('common');
	var table;
	function tablexp(dm){
		dm.parents(".v52fmbx").css("border","0");
		if(dm.attr('data-table-datatype') == 'jsonp'){
			require('epl/table/js/jquery.dataTables.jsonp');
		}else{
			require('epl/table/js/jquery.dataTables.min');
		}
		var url = dm.attr('data-table-ajaxurl');
		var pageLength = parseInt(dm.attr('data-table-pageLength'));
			if(!pageLength||pageLength==''){
				pageLength=100000000;
			}
		var cadcs = $("th[data-table-columnclass]"),cjson=[];
			if(cadcs.length>0){
				cadcs.each(function(i){
					var c = $(this).attr("data-table-columnclass"),n=$(this).index();
					cjson[i] = [];
					cjson[i]['className'] = c;
					cjson[i]['targets']=[];
					cjson[i]['targets'][0] = n;
				});
			}
		table = dm.DataTable({
			"scrollX": met_mobile?true:'',
			"ordering": false, //是否支持排序
			"searching": false, //搜索
			"searchable": false, //让搜索支持ajax异步查询
			"info": true, //左下角条数信息
			"lengthChange": false,//让用户可以下拉无刷新设置显示条数
			"pageLength":pageLength,//默认每一页的显示数量
			//"paging": true,  //分页功能
			//"processing": true, //
			"serverSide": true, //ajax服务开启
			"stateSave": true,//记录当前页（新商城框架）
			"ajax": {
				'url': url,
				"data": function ( v ) {
					var l = $("input[data-table-search],select[data-table-search]"),vlist='{ ',i=0;
					if(l.length>0){
						l.each(function(){
							i++;
							var n  = '"'+$(this).attr("name")+'"',val = '"'+$(this).val()+'"';
							if(val!='')vlist+=i==l.length?n+':'+val:n+':'+val+',';
						});
					}
					vlist+=' }';
					vlist=$.parseJSON(vlist);
					return $.extend( {}, v, vlist );
				}
			},
			"language": { //语言配置文件
				url: pubjspath + 'js/examples/table/lang/cn.php'
			},
			"rowCallback": function( row, data ) { //行定义class
				if ( data.toclass ) {
					$(row).addClass(data.toclass);
				}
			},
			"initComplete": function(settings, json) { //加载完成后
				//alert(JSON.stringify(json));
				common.defaultoption();
			},
			"columnDefs": cjson,
			// 增加页面重绘回调（新商城框架）
			drawCallback: function(settings){
	            if($(window).scrollTop()>$(this).offset().top) $(window).scrollTop($(this).offset().top);// 表单重绘后页面滚动回表单顶部
	    //         if($('[data-original]',this).length){
	    //         	var $original=$('[data-original]',this);
	    //         	// 增加图片延迟加载效果（新商城框架）
					// window.M=new Array(),
					// 	met_lazyloadbg_base64='';
					// M['weburl']=siteurl;
					// M['navurl']='../';
					// require.async([siteurl+'public/ui/v2/static/plugin/StackBlur.js',siteurl+'public/ui/v2/static/plugin/lazyload/jquery.lazyload.min.js'],function(){
					// 	$original.lazyload();
					// })
	    //         }
	        }
		});
	}

	exports.func = function(d){
		d = d.find('.ui-table');
		d.each(function(){
			tablexp($(this));
		});
	}

		/*动态事件绑定，无需重载*/

		//自定义搜索框
		$(document).on('change keyup',"input[data-table-search],select[data-table-search]",function(){
			table.ajax.reload();
		})

		//全选
		$(document).on('change',".ui-table input[data-table-chckall]",function(){
			var v = $(this).attr("data-table-chckall"),t = $(this).attr("checked")?true:false;
			$("input[name='"+v+"']").attr('checked',t);
			$("input[name='"+v+"']").each(function(){
				var mt = $(this).attr("checked")?true:false,tr=$(this).parents("td").eq(0).parent("tr");
				if(mt){
					tr.addClass("ui-table-td-hover");
				}else{
					tr.removeClass("ui-table-td-hover");
				}
			});
		})

		//下拉菜单提交表单
		$(document).on('change',".ui-table select[data-isubmit='1']",function(){
			if($(this).val()!=''){
				$("input[name='submit_type']").val('');
				$(this).parents("form").submit();
			}
		})

		//按钮提交表单
		$(document).on('click',".ui-table *[type='submit']",function(){
			var nm = $(this).attr('name'),ip=$("input[name='submit_type']");
			if(ip.length>0){
				ip.val(nm);
			}else{
				$(this).parents("form").append("<input type='hidden' name='submit_type' value='"+nm+"' />");
			}
		})

		//删除栏目
		$(document).on('click',".ui-table tr.newlist td .delet",function(){
			var newl = $(this).parents('tr.newlist');
			if(newl.length>0){ //删除正在新增的栏目
				newl.remove();
				common.ifreme_methei();//高度重置
				return false;
			}
		})


		var ai = 0;
		$(document).on('click',"*[data-table-addlist]",function(){

			var url = $(this).attr("data-table-addlist"),d=$(".ui-table tbody tr").last();

			//AJAX获取HTML并追加到页面
			d.after('<tr><td colspan="'+d.find('td').length+'">Loading...</td></tr>');

			$.ajax({
				url: url,//新增行的数据源
				type: "POST",
				data: 'ai=' + ai,
				success: function(data) {
					d.next("tr").remove();
					d.after(data);
					d.next("tr").find("input[type='text']").eq(0).focus();
					common.defaultoption(d.next("tr"));
					common.ifreme_methei();//高度重置
				}
			});

			ai++;
			return false;

		});

		//自动选中
		function table_check(){
			var check = $(".ui-table td input[type='checkbox'],.ui-table td input[type='radio']");
			if(check.length>0){
				var v = check.eq(0).parents(".ui-table").find("input[data-table-chckall]").eq(0).attr("data-table-chckall");
				$(document).on('change',".ui-table td input[type='checkbox'],.ui-table td input[type='radio']",function(){
					var t = $(this).attr("checked")?true:false,tr = $(this).parents("td").eq(0).parent("tr");
					if(v&&t){
						tr.addClass("ui-table-td-hover");
						tr.find("input[name='"+v+"']").attr("checked",t);
					}else if(!t&&$(this).attr("name")==v){
						tr.removeClass("ui-table-td-hover");
					}
				});
			}
		}

		/*表格内容修改后自动勾选对应选项*/
		function modifytick(){
			var fints = $(".ui-table td input,.ui-table td select");
			if(fints.length>0){
				var nofocu = true;
				fints.each(function() {
					$(this).data($(this).attr('name'), $(this).val());
				});
				fints.focusout(function() {
					var tr = $(this).parents("tr");
					if ($(this).val() != $(this).data($(this).attr('name'))) tr.find("input[name='id']").attr('checked', nofocu);
				});
				$(".ui-table td input:checkbox[name!='id']").change(function(){
					var tr = $(this).parents("tr");
					tr.find("input[name='id']").attr('checked', nofocu);
				});
			}
		}

		//表格控件事件
		$(document).on( 'init.dt', function ( e, settings ) {

			var page = $.cookie('tablepage');
			if(page){
				var y = page.split('|'),u = metn+','+metc+','+meta;
				if(y[1]==u){
					table.page(parseInt(y[0])).draw( false );
				}else{
					$.cookie('tablepage',null);
				}
			}

			var api = new $.fn.dataTable.Api( settings );

			var show = function ( str ) {
				// Old IE :-|
				try {
					str = JSON.stringify( str, null, 2 );
				} catch ( e ) {}

				//alert(str);
				table_check();
				var cklist = $(".ui-table td select[data-checked]");
				if(cklist.length>0){
					cklist.each(function(){
						var v = $(this).attr('data-checked');
						if(v!=''){
							if($(this)[0].tagName=='SELECT'){
								$(this).val(v);
							}
						}
					});
				}
				//common.defaultoption();
				modifytick();
			};

			// First draw
			var json = api.ajax.json();
			if ( json ) {
				show( json );
			}

			// Subsequent draws
			api.on( 'xhr.dt', function ( e, settings, json ) {
				show( json );
			} );

			api.on( 'draw.dt', function ( e, settings, json ) {
				show( json );
				var info = table.page.info();
				$.cookie('tablepage',info.page+'|'+metn+','+metc+','+meta);
			} );

		} );

});