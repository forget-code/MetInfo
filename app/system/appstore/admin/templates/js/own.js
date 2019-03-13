define(function(require, exports, module) {
	var common = require('common'); //加载公共函数文件（语言文字获取等）
	if($(".tempservice").length>0) require.async('own_tem/js/tempservice');
	if($(".support").length>0) require.async('own_tem/js/support');
	var datatype = $('.v52fmbx').attr('data-type');
	var datainfo = $('.v52fmbx').attr('data-info');
	var dataver  = $('.v52fmbx').attr('data-ver');
	var dataappid  = $('.v52fmbx').attr('data-appid');
	var datacmsver  = $('.v52fmbx').attr('data-cmsver');
	var datadownload = $('.v52fmbx').attr('data-download');
	var secret_key_appdetail = $('#secret_key_appdetail').val();
	var authkey = $('#authkey').val();
	var authcode = $('#authcode').val();
	var url;
	// 应用列表页
	if($('.hotapplist').length){
		// datatable表格返回数据的自定义处理
		window.datatable_option=[];
		// datatable表格返回数据的处理
		datatable_option['dataSrc']=function(result){
		    return false;
		}
		// 渲染应用列表
		$(document).on( 'draw.dt', function ( e,settings ) {
			var json=table.ajax.json(),
				html='';
			$.each(json.data, function(index, val) {
				if(val.app_url){
					html+='<div class="col-md-4 col-sm-6 col-xs-12">'
						+'<div class="media">'
							+'<div class="media-left">'
								+'<a href="'+val.app_url+'" data-no="'+val.no+'"><img class="media-object" src="'+val.imgurl+'" width="80"></a>'
							+'</div>'
							+'<div class="media-body">'
								+'<div>'
									+'<span class="label label-success">'+val.price+'</span>'
									+'<a href="'+val.app_url+'">'
										+'<h4 class="media-heading">'+val.appname+'<span class="text-danger"></span></h4>'
										+val.appinfo
									+'</a>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>';
				}
			});
			if(!html) html='<div class="text-center">'+settings.oLanguage.sEmptyTable+'</div>';
			$('.hotapplist').html(html);
		});
	}
	//common.remodal();
	$(document).on('click',".buybutton",function(){
		url = apppath+'n=platform&c=pay&a=dopayment';
		$.ajax({
			url: url,
			type: "GET",
			cache: false,
			data: 'buytype=' + datatype + '&buyinfo=' + datainfo + '&user_key=' + secret_key_appdetail,
			dataType: "jsonp",
			success: function(data) {
				if(data.jsdo == 'pay'){
					location.href = own_name+'c=member&a=dorecharge'+ '&sucurl=' + encodeURIComponent(location.href);
				}else if(data.jsdo == 'buy'){
					location.hash='modalbuydiv';
					$('.buydiv').show();
					//$('.paydiv').hide();
					//$('.appdetail').hide()
				}else if(data.jsdo == 'error_code'){
					alert(js_error('error_code'));
					tologin();
				}else{
					alert(js_error(data.jsdo));
				}
			}
		});
		return true;
	});
	$(document).on('click',".paysucjump",function(){
		url = apppath+'n=platform&c=pay&a=dois_pay';
		var ordernum = $("#ordernum").val();
		var href = $("#payjumphref").val();
		location.href = href;
		/*
		$.ajax({
			url: url,
			type: "GET",
			cache: false,
			data: 'ordernum='+ordernum,
			dataType: "jsonp",
			success: function(data) {
				if (data.pay == 1) {
					alert(langtxt.prepaid_successfully);
				} else {
					alert(langtxt.system_temporarily);
					href = href;
				}

				location.href = href;
			}
		});
		*/
		return false;
	});
	$(document).on('click',"input[type='submit']",function(e){
		if($(this).attr("name")=='paysubmit'||$(this).attr("name")=='buysubmit'||$(this).attr("name")=='evaluationsubmit'){
			if($(this).attr("name")=='paysubmit'){
				if(!$("input[name='payprice']").val()||$("input[name='payprice']").val()==0){
					alert(langtxt.enter_amount);
					return false;
				}
				$('.paydiv').hide();
				$('.paysuc').show();
				return true;
			}else if($(this).attr("name")=='buysubmit'){
				if($("input[name='buysubmit']").attr('data-click')==1){
					$("input[name='buysubmit']").attr('data-click',0);
					url = apppath+'n=platform&c=pay&a=dobalance';
					$.ajax({
						url: url,
						type: "GET",
						cache: false,
						data: 'buytype=' + datatype + '&buyinfo=' + datainfo + '&user_key=' + secret_key_appdetail + '&user_passpay=' + $("input[name='user_passpay']").val()+ '&domain=' +  $("input[name='domain']").val()+ '&tmp=' +  $("input[name='tmp']").val(),
						dataType: "jsonp",
						success: function(data) {
							if (data.error) {
								alert(js_error(data.error));
								if(data.error == 'error_code') tologin();
							} else {
								metAlert(METLANG.jsok,undefined,'',1);
								var inst = $.remodal.lookup[$('[data-remodal-id="modalbuydiv"]').data('remodal')];
								inst.close();
								$('.buydiv').hide();
								$('.appdetail').show();
								$('.downloaddiv').show();
								// $('.metcms_upload_download,.btn-metcms_upload').html(langtxt.downloads+"...");
								$('.buybuttondiv').hide();
								$('.metcms_upload_download,.btn-metcms_upload').html(langtxt.appinstall).after('<span style="color:#555;display: inline-block;margin-left: 10px;">'+langtxt.have_bought+'</span>');
								$('#purchase-notice-modal').modal('hide');
								$('#download-notice-modal').modal();
								// $('.metcms_upload_download').click();
							}
							$("input[name='buysubmit']").attr('data-click',1);
						}
					});
				}
				return false;
			}else if($(this).attr("name")=='evaluationsubmit'){
				if($("input[name='my_evaluation_num']").val()==0){
					alert(langtxt.click_rating);
					return false;
				}
				if($("input[name='evaluationsubmit']").attr('data-click')==1){
					$("input[name='evaluationsubmit']").attr('data-click',0);
					url = apppath+'n=platform&c=platform&a=docomment_add';
					$.ajax({
						url: url,
						type: "GET",
						cache: false,
						data: 'type=' + datatype + '&no=' + datainfo + '&user_key=' + secret_key_appdetail + '&evaluation_num=' + $("input[name='my_evaluation_num']").val() +'&evaluation=' +$("textarea[name='my_evaluation']").val(),
						dataType: "jsonp",
						success: function(data) {
							if(!data.error){
								$("textarea[name='my_evaluation']").val('');
								$('.evaluationinfo').html('');
								$('#evaluation_page').val('1');
								eva();
								alert(langtxt.sys_evaluation);
							}else{
								alert(js_error(data.error));
							}
							$("input[name='evaluationsubmit']").attr('data-click',1);
						}
					});
				}
				return false;
			}
		}
	});
	//评论翻页
	function eva(mythis){
		var click = $('#evaluation_page_click');
		if(click.val() == 0){
			if(mythis){
				click.val(1);
				var a = mythis.attr('data-page-action');
				var n = $('#evaluation_page').val();
				if(a == 'up'){
					n = n*1 - 1;
				}else{
					n = n*1 + 1;
				}
			}else{
				n = 1;
			}
			url = apppath+'n=platform&c=platform&a=docomment_check';
			$.ajax({
				url: url,
				type: "GET",
				cache: false,
				data: 'type=' + datatype + '&no=' + datainfo + '&page='+ n +'&user_key=' + secret_key_appdetail + '&pagelength=10',
				dataType: "jsonp",
				success: function(data) {
					//alert(data.page.min);
					//alert(data.page.max);
					if(mythis){
						if(n <= data.page.min){
							$('#evaluation_page').val(data.page.min);
							$('#pagedown').show();
							$('#pageup').hide();
						}else if(n >= data.page.max){
							$('#evaluation_page').val(data.page.max);
							$('#pagedown').hide();
							$('#pageup').show();
						}else{
							$('#evaluation_page').val(n);
							$('.page').show();
						}
					}else{
						if(data.page.max >1){
							$('#pagedown').show();
						}else{
							$('#pagedown').hide();
						}
					}
					$('.evaluationinfo').html('');
					$('.evaluation').attr("data-score",data.eva.evaluation);
					$('.evaluation_num').html(data.eva.evaluation_num);
					pingfen();
					evainfo(data.comment);
					click.val(0);
				}
			});
		}
	}
	$(document).on('click',".page",function(){
		eva($(this));
	});
	$(document).ready(function(){
		url = 'https://app.metinfo.cn/index.php?n=platform&c=kf&a=dokfhtml';
		$.ajax({
				url: url,//新增行的数据源
				type: "GET",
				data: '&ver='+ dataver +'&user_key=' + secret_key,
				cache: false,
				dataType: "jsonp",
				success: function(data) {
					if(data.suc){
						$("body").append(data.html)
					}

				}
			});
		//详细页面，请求APP应用信息
		if(datatype && datainfo){
			url = apppath+'n=platform&c=platform&a=doapp_check';
			$.ajax({
				url: url,//新增行的数据源
				type: "GET",
				data: 'type=' + datatype + '&no=' + datainfo + '&appid=' +dataappid+ '&cmsver='+ datacmsver + '&ver='+ dataver +'&user_key=' + secret_key_appdetail + '&authkey=' + authkey + '&authcode=' + authcode+ '&download=' + datadownload,
				cache: false,
				dataType: "jsonp",
				success: function(data) {
					if(data.products.a == 'cmsupdate'){
						$('.completediv').show();
						$('.complete').html(langtxt.download_application);
					}else{
						if(datadownload == 1){
                            if(data.products.no.indexOf('ui')<0){
                                if(data.products.a == 'update'){
                                    $('.downloaddiv').show();
                                    $('.metcms_upload_download,.btn-metcms_upload').html(langtxt.appupgrade);
                                }else{
                                    $('.completediv').show();
                                }
                            }else{
                                $('.completediv').show();
                            }
						}else{
							if(data.products.a == 'buy'){
								$('.buybuttondiv').show();
							}else{
								if(data.products.price==0){
									$('.metcms_upload_download,.btn-metcms_upload').html(langtxt.appinstall);
								}else{
									$('.metcms_upload_download,.btn-metcms_upload').html(langtxt.appinstall).after('<span style="color:#555;display: inline-block;margin-left: 10px;">'+langtxt.have_bought+'</span>');
								}
								$('.downloaddiv').show();
							}
						}
					}
					$('.buyname').html(data.products.name);
					$('.appdetail_dl dt img').attr("src",data.products.imgsrc);
					/*价格*/
					var price = data.products.price==0?langtxt.usertype1:common.fmoney(data.products.price,2);
					if(data.products.price==0){
						$('.buybuttondiv button').html(langtxt.appinstall);
					}
					$('.buyprice').html(data.products.price_html.replace("<br/>","&nbsp"));
					$('.balance').html(data.user.balance);
					$('.updateime').html(data.products.updatetime);
					$('.ver').html(data.products.ver);
					$('.sys_text').html(data.products.sys_text);
					if(data.products.info){
						$('.appdetail_info').show();
						$('.info').html(data.products.info);
					}

					$('.img').html();
					var imgs = data.products.img.split('|');
					var imgstr = '';
					$.each(imgs, function(i, item){
						imgstr = imgstr + '<a class="example-image-link" href="'+item+'" data-lightbox="example-set"><img class="example-image" src="'+item+'" /></a>';
					});
					$('.img').html(imgstr);
					$.getScript(own_tem+'js/lightbox-2.6.min.js');
					if(data.products.module == 1){
						$('.demo_url').html(data.products.demo_url);
					}else{
						$('.demo_url').html('<a href="'+data.products.demo_url+'" target="_blank">'+data.products.demo_url+'</a>');
					}
					if(data.products.img!=''){
						$(".appdetail_imglist").show();
					}
					if(data.products.demo_url!=''){
						$(".appdetail_demo_url").show();
					}
					//$('.head').html(data.developers.head);
					$('.homepage').attr("href",data.developers.homepage);
					$('.introduction').html(data.developers.introduction);
					$('.developer_id').html(data.developers.user_name);
					$("input[name='domain']").val(data.url.domain);
					$("input[name='tmp']").val(data.url.tmp);
					$("input[name='user_passpay']").val('');
					var recharge = $('#recharge').val();
					if(recharge == 1 && Number(data.user.balance) >= Number(data.products.price)){
						$('.metcms_upload_download').click();
					}
					$('#purchase-notice,#purchase-notice-modal .modal-body').html(data.products.de_info);// 购买须知
					/*请求完成后*/
					//pingfen();
				}
			});
		}
		eva();
	});
	function evainfo(data){
		var html = '';
		for(var i=0;i<data.length;i++){
			html+= '<dl>';
			html+= '<dd>';
			html+= '<h5>'+'<span data-score="'+data[i].score+'"></span>'+data[i].info_id+' - '+data[i].time+'</h5>';
			html+= '<p>'+data[i].content+'</p>';
			html+= '</dd>';
			html+= '</dl>';
		}
		$('.evaluationinfo').append(html);
		require('own_tem/raty/jquery.raty.css');
		require('own_tem/raty/jquery.raty');
		$('.evaluationinfo h5 span').html('');
		$('.evaluationinfo h5 span').raty({
			score:function() {
				return $(this).attr('data-score');
			},
			path:own_tem+'raty/images/',
			readOnly: true
		});
	}
	// 未登录弹出登录提示
	$('.buybuttondiv').click(function(event) {
		if(!$('button[data-toggle]',this).length) $('.buybutton').click();
	});
	/*获取推荐应用列表*/
	// if($(".hotapplist").length>0){
	// 	url = apppath + 'n=platform&c=platform&a=dotable_applist_json&type=dlist&lang=' +lang+'&user_key=' + secret_key;;
	// 	$.ajax({
	// 		type: "GET",
	// 		cache: false,
	// 		dataType: "jsonp",
	// 		url: url,
	// 		success: function(json){
	// 			var html='',adu=apppath.split('index.php'),imgsrc='',price='';
	// 			$.each(json, function(i, item){
	// 				if(i<9){
	// 					price  = item.price_html;
	// 					imgsrc = item.icon;
	// 					var media = $(".hotapplist .media").eq(i);
	// 					media.find(".media-left a").html('<img src="'+imgsrc+'" class="media-object" width="80">');
	// 					media.find(".media-heading").html(item.appname+'<span class="text-danger"></span>');
	// 					media.find("a").attr('href',adminurl+'n=appstore&c=appstore&a=doappdetail&type=app&no='+item.no+'&anyid=65');
	// 					media.find(".media-body p").html(item.info);
	// 					media.find(".media-body .label-success").html(price);
	// 				}
	// 			});
	// 		}
	// 	});
	// }
	/*获取推荐模板列表*/
	// if($(".hotmblist").length>0){
	// 	url = apppath + 'n=platform&c=platform&a=dotable_temlist_json&type=dlist'+'&user_key=' + secret_key;
	// 	$.ajax({
	// 		type: "GET",
	// 		cache: false,
	// 		dataType: "jsonp",
	// 		url: url,
	// 		success: function(json){
	// 			var html='',adu=apppath.split('index.php'),imgsrc='',price='';
	// 			$.each(json, function(i, item){
	// 				price  = item.price_html;
	// 				imgsrc = item.icon;
	// 				var media = $(".hotmblist .hotmblist-md").eq(i);
	// 				media.find(".hotmblist-md-img").html('<img src="'+imgsrc+'" class="img-responsive" >');
	// 				media.find("a").attr('href',adminurl+'n=appstore&c=appstore&a=doappdetail&type=tem&no='+item.no+'&appid='+item.id+'&lang='+lang+'&anyid=65');
	// 				media.find(".price").html(price);
	// 				media.find(".eye").html('<i class="fa fa-eye"></i>'+item.hits);
	// 			});
	// 		}
	// 	});
	// }
	/*获取模板筛选条件*/
	// function tem_search(){
	// 	var industry = $("input[name='industry']").val();
	// 	var color = $("input[name='color']").val();
	// 	var mince = $("input[name='mince']").val();
	// 	var temtype = $("input[name='temtype']").val();
	// 	url = apppath + 'n=platform&c=platform&a=doscreening'+'&industry='+industry+'&mince='+mince+'&color='+color+'&temtype='+temtype;
	// 	$.ajax({
	// 		type: "GET",
	// 		cache: false,
	// 		dataType: "jsonp",
	// 		url: url,
	// 		success: function(json){
	// 			var class_select = '';
	// 			search_url = own_form + 'a=dotem_market'+'&industry='+industry+'&mince='+mince+'&color='+color+'&temtype='+temtype;
	// 			var html = '';
	// 			var all = common.replaceParamVal(search_url, 'industry', '');
	// 			all = common.replaceParamVal(all, 'mince', '');
	// 			class_select = '';
	// 			if(industry == '')class_select = "select";
	// 			html = '<span class="all '+class_select+'"><a href="'+all+'">'+langtxt.cvall+'</a></span>';
	// 			if(json.c){
	// 				$(".industrydl").show();
	// 				$.each(json.c, function(i, item){
	// 					class_select = '';
	// 					if(industry == item.n1){class_select = "class='select'";unfold(i);}
	// 					html = html + '<span '+class_select+'><a href="'+common.replaceParamVal(common.replaceParamVal(search_url, 'mince', ''), 'industry', item.n1)+'">' + item.n1 + '</a></span>';
	// 					if(item.n2 && item.n1 == industry){
	// 						$('.mincedl').show();
	// 						class_select = '';
	// 						if(mince == '')class_select = "select";
	// 						var mincehtml = '<span class="all '+class_select+'"><a href="'+common.replaceParamVal(search_url, 'mince', '')+'">'+langtxt.cvall+'</a></span>';
	// 						$.each(item.n2, function(i, item){
	// 							class_select = '';
	// 							if(mince == item)class_select = "class='select'";
	// 							mincehtml = mincehtml + '<span '+class_select+'><a href="'+common.replaceParamVal(search_url, 'mince', item)+'">' + item + '</a></span>';
	// 							$(".mince").html(mincehtml);
	// 						});
	// 					}
	// 				});
	// 				$(".industry").html(html);
	// 			}else{
	// 				$(".industrydl").hide();
	// 				$(".mincedl").hide();
	// 			}

	// 			class_select = '';
	// 			if(temtype == '')class_select = "select";
	// 			var search_url_type = common.replaceParamVal(search_url, 'color', '');
	// 			search_url_type = common.replaceParamVal(search_url_type, 'industry', '');
	// 			search_url_type = common.replaceParamVal(search_url_type, 'mince', '');
	// 			html = '<span class="all '+class_select+'"><a href="'+common.replaceParamVal(search_url_type, 'temtype', '')+'">'+langtxt.cvall+'</a></span>';
	// 			$.each(json.t, function(i, item){
	// 				class_select = '';
	// 				if(temtype == item)class_select = "class='select'";
	// 				html = html + '<span '+class_select+'><a href="'+common.replaceParamVal(search_url_type, 'temtype', item)+'">' + item + '</a></span>';
	// 			});
	// 			$(".temtype").html(html);

	// 			if(json.y){
	// 				$(".colordl").show();
	// 				class_select = '';
	// 				if(color == '')class_select = "select";
	// 				html = '<span class="all '+class_select+'"><a href="'+common.replaceParamVal(search_url, 'color', '')+'">'+langtxt.cvall+'</a></span>';
	// 				$.each(json.y, function(i, item){
	// 					class_select = '';
	// 					if(color == item)class_select = "class='select'";
	// 					html = html + '<span '+class_select+'><a href="'+common.replaceParamVal(search_url, 'color', item)+'">' + item + '</a></span>';
	// 				});
	// 				$(".color").html(html);
	// 			}else{
	// 				$(".colordl").hide();
	// 			}
	// 		}
	// 	});
	// 	function unfold(i){
	// 		var nums=Math.floor($(".industry").width()/150)*2-2;
	// 		if(i>nums){
	// 			$(".industry").removeClass("unfold");
	// 			$(".ico").css("background-position","center -6px");
	// 		}
	// 	};
	// 	$(".more").click(function(){
	// 		if ($(".industry").hasClass("unfold")){
	// 			$(".industry").removeClass("unfold");
	// 			$(".ico").css("background-position","center -6px");
	// 		}else{
	// 			$(".industry").addClass("unfold");
	// 			$(".ico").css("background-position","center top");
	// 		}
	// 	});
	// }
	// if($("input[name='industry']").length>0){
	// 	tem_search();
	// }
	/*详情页评分*/
	function pingfen(){
		require('own_tem/raty/jquery.raty.css');
		require('own_tem/raty/jquery.raty');
		$('.evaluation').html('');
		$('.evaluation').raty({
			score:function() {
				return $(this).attr('data-score');
			},
			path:own_tem+'raty/images/',
			readOnly: true
		});
		$('.my_evaluation_num_box').html('');
		$('.my_evaluation_num_box').raty({
			score:function() {
				return $("input[name='my_evaluation_num']").val();
			},
			path:own_tem+'raty/images/',
			click: function(score, evt) {
				$("input[name='my_evaluation_num']").val(score);
			}
		});
	}
	// $(document).on('change keyup',"input[data-table-search-tem]",function(){
	// 	$('.select').removeClass('select');
	// 	$('.all').addClass('select');
	// 	$("input[name='color']").val('');
	// 	$("input[name='mince']").val('');
	// 	$("input[name='industry']").val('');
	// 	$("input[name='temtype']").val('');
	// 	tem_search();
	// 	//$(".industrydl").show();
	// 	//alert(u);
	// });
});
