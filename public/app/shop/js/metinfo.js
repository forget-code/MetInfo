//
function number_format(num, decimal, dec, spe) { 
    decimal = (undefined === decimal) ? 0 : decimal; 
    decimal = parseInt(decimal); 
    dec  = (undefined === dec) ? '.' : dec; 
    spe  = (undefined === spe) ? ',' : spe; 
    num  = parseFloat(num) + ''; 
    var length, tmp, left, right; 
    length = num.length; 
    tmp  = num.split('.', 2); 
    left = tmp[0]; 
    left = _split(left, 3, spe); 
    right = (undefined === tmp[1]) ? '' : tmp[1]; 
    right = _pad(right, decimal); 
    if (0 == right.length) { 
        num = left; 
    } else { 
        num = left + dec + right; 
    } 
    return num; 
    function _split(str, len, spe) { 
        var l  = str.length; 
        var tmp = new Array(); 
        if (l > len) { 
            var b = l % len; 
            var ts = str.substr(0, b); 
            tmp.push(ts); 
   
            while (b < l) { 
                var ts = str.substr(b, len); 
                tmp.push(ts); 
                b += len; 
           } 
          str = tmp.join(spe); 
      } 
        return str; 
    } 
    function _pad(str, len) { 
        var l = str.length; 
        if (l < len) { 
            for (var i = 0; i < (len - l); i++) { 
                 str += '0'; 
           } 
       } else { 
              str = str.substr(0, len); 
       } 
        return str; 
    } 
} 
//核对订单信息
function bodyonload(){
	if($('#defaultaddrid').val()==''){
			$('#modifylink').hide();
			$('#infolist').show();
			$('#addaddress').show();
	}
	$('input:radio[name=method]')[0].click();
}
function changetotal(freight){
	var totalnow=$('#total').val();
	totalnow=totalnow*1+freight*1;
	totalnow=number_format(totalnow,2);
	$('#shop_zong').html(totalnow);
	$('#shop_yunfei').html(number_format(freight,2));
	$('#freightnow').val(freight);
}
function showaddress(){
	$('#address').val('');
	$('#consignee').val('');
	$('#tel').val('');
	$('#email').val('');
	$('#postal').val('');
	$("#met_prov_select").get(0).selectedIndex=0; 
	$('#met_city_select').html('<option value="" >请选择</option>');
	$('#met_area_select').html('<option value="" >请选择</option>');
	$('#defaultaddr').attr('checked',false);
	$('#detr').show();
	$('#addaddress').show();
	$('#modifylink').hide();
}
function hiddenaddress(){
	$('#infolist').hide();
	$('#addaddress').hide();
	$('#yuan_addaddress').show();
	$('#shop_chexiao').hide();
	$('#defaultaddrid1').val('');
}
function addone(tp) {
	if(!checkaddress())return false;
	var de=$('#defaultaddr').attr("checked")?1:0;
	var urls='met_shop_settle.php?action=addaddress'+'&address='+$('#address').val()+'&consignee='+$('#consignee').val()+'&tel='+$('#tel').val()+'&email='+$('#email').val()+'&postal='+$('#postal').val()+'&province='+$('#met_prov_select').val()+'&city='+$('#met_city_select').val()+'&district='+$('#met_area_select').val()+'&defaultaddr='+de;
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			if(data=='metinfo'){
				alert('已经存在一个收货人姓名、收货地址完全一样的常用地址，不需要重复添加！');
			}else{
				$('#defaultaddrid').val(data);
				if(tp!=1)changeaddress();
			}
		}
	});
}
function changeaddress(){
	var urls='met_shop_settle.php?action=changeaddress';
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			$('#infolist').html(data);
			$('#infolist').show();
		}
	});
}
function modifyaddress(){
	var addressid=$('#defaultaddrid').val();
	var urls='met_shop_settle.php?action=modifyaddress'+'&addressid='+addressid;
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			if(data=='nodata'){
				alert("当前没有选择收货地址！");
			}else{
				$('#yuan_addaddress').hide();
				var datas=data.split('|');
				$('#address').val(datas[0]);
				$('#consignee').val(datas[1]);
				$('#tel').val(datas[2]);
				$('#email').val(datas[3]);
				$('#postal').val(datas[4]);
				selectchange(datas[5],datas[6],datas[7]);
				if(datas[8]==1){
					$('#defaultaddr').attr('checked',true);
					$('#detr').hide();
				}
				else{				
					$('#defaultaddr').attr('checked',false);
					$('#detr').show();
				}
				$('#addaddress').show();
				$('#shop_chexiao').show();
				$('#modifylink').show();
				changeaddress();
			}
		}
	});
}
function changeaddressnow(addressid){
	var urls='met_shop_settle.php?action=changeaddressnow'+'&addressid='+addressid;
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			var orderlist = data.split('#metinfo#');
			$('#consignee').val(orderlist[0]);
			selectchange(orderlist[1],orderlist[2],orderlist[3]);
			$('#address').val(orderlist[4]);
			$('#tel').val(orderlist[5]);
			$('#email').val(orderlist[6]);
			$('#postal').val(orderlist[7]);
			$('#defaultaddrid1').val(addressid);
		}
	});
}
function modifyone(tp){
	if(!checkaddress())return false;
	if(tp==1)addone(tp);
	if($('#defaultaddrid1').val()!='')$('#defaultaddrid').val($('#defaultaddrid1').val());
	var de=$('#defaultaddr').attr("checked")?1:0;
	var urls='met_shop_settle.php?action=modifyaddressnow'+'&addressid='+$('#defaultaddrid').val()+'&address='+$('#address').val()+'&consignee='+$('#consignee').val()+'&tel='+$('#tel').val()+'&email='+$('#email').val()+'&postal='+$('#postal').val()+'&province='+$('#met_prov_select').val()+'&city='+$('#met_city_select').val()+'&district='+$('#met_area_select').val()+'&defaultaddr='+de;
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			$('#addaddress').hide();
			$('#infolist').hide();
			$('#info').show();
			$('#metapp_shop_xname').html($('#consignee').val());
			$('#metapp_shop_xpcdname').html($('#met_prov_select').find("option[value='"+$('#met_prov_select').val()+"']").html()+$('#met_city_select').find("option[value='"+$('#met_city_select').val()+"']").html()+$('#met_area_select').find("option[value='"+$('#met_area_select').val()+"']").html());
			$('#metapp_shop_xaddress').html($('#address').val());
			$('#metapp_shop_xtel').html($('#tel').val());
			$('#metapp_shop_xemail').html($('#email').val());
			$('#metapp_shop_xpostal').html($('#postal').val());
			$('#yuan_addaddress').show();
			$('#shop_chexiao').hide();
			$('#shop_modifydz').show();
			$('#addlink').show();
		}
	});
}
function checkorder(){
	if($('#defaultaddrid').val()==''){
		alert('请输入收货地址');
		return false;
	}
	if($('input:radio[name="method"]:checked').length==0){
		alert('请选择收货方式');
		return false;
	}
	return true;
}
function selectchange(pid,cid,did){
	$("#met_prov_select").val(pid);
	if(did==''||did==0)did='metinfo';
	changecity(cid,did);
}
function changecity(y,z){
	var urls='met_shop_addressview.php?action=changecity&provid='+$('#met_prov_select').val();
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			datas=data.split(',');
			var str='';
			str+="<option value=''>请选择</option>";	
			for(var i=0;i<datas.length-1;i++){
					datass=datas[i].split('|');
					str+='<option value='+datass[0]+'>'+datass[1]+'</option>';					
			}
			$('#met_city_select').html(str);
			if(y){
				$('#met_city_select').val(y);
				changearea(z); 
			}else{
				changearea();
			}
			$('#postal').val(datas[0].split('|')[2]);
		}
	});
}
function changearea(z){
	var urls='met_shop_addressview.php?action=changearea&cityid='+$('#met_city_select').val();
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			datas=data.split(',');
			var str='';
			str+='<option value="">请选择</option>';	
			for(var i=0;i<datas.length-1;i++){
					datass=datas[i].split('|');
					str+='<option value="'+datass[0]+'">'+datass[1]+'</option>';					
			}
			if(str)str+='<option value="0">其他</option>';
			$('#met_area_select').html(str);
			$('#postal').val(datas[datas.length-1]);
			if(z){
				z=z=='metinfo'?0:z;
				$("#met_area_select").val(z);
			}
		}
	});
}
function checkaddress(){
	if(!$('#consignee').val()){
		alert('请输入收件人姓名');
		$('#consignee').focus();
		return false;
	}
	if(!$('#address').val()){
		alert('请输入街道地址');
		$('#address').focus();
		return false;
	}
	if(!$('#tel').val()){
		alert('请输入联系电话');
		$('#tel').focus();
		return false;
	}
	if(!$('#met_prov_select').val()){
		alert('请选择地区');
		$('#met_prov_select').focus();
		return false;
	}
	return true;
}
//
function metapp_shop_shopnum(d,t){
	d.val(function(){
		var v = Number($(this).val());
			t==1?v++:v--;
		return v<1?1:v;
	});
}
function metapp_shop_ifint(str){
	var regu = /^[-]{0,1}[0-9]{1,}$/;
	return regu.test(str)?true:false;
}
function metapp_shop_setamount(shopid,order,amountype,shopamount){
	shopamount=amountype=='set'?$('#num_'+order).val():shopamount;
	var urls='met_shop_shop.php?action=amount'+'&amountype='+amountype+'&shopid='+shopid+'&shopamount='+shopamount;
	$.ajax({
		url: urls,
		type: "POST",
		success: function(data) {
			var idamount=amountype=='set'?shopamount:(amountype=='add'?$('#num_'+order).val()*1+shopamount*1:$('#num_'+order).val()*1-shopamount*1);
			if(idamount<1){idamount=1}				
			$('#num_'+order).val(idamount);
			$('#span_xiaoji_'+order).html(number_format(Number($('#pr_'+order).val().split(',')[1]*idamount),2));
			data = number_format(Number(data),2);
			$('#total').html(data);
		}
	});
	return false;
}
function recharge(){
	var url=$('#alipayto').attr('href');
	var total=$('#total').val();
	if(total<0){
		alert('请输入充值金额');
		return false;
	}
	$('#alipayto').attr('href',url+'&total='+total);
	return true;
}
function shop_add(){
	var dom='',metv5 = $("dl.pshow"),metv4 = $("dl.productshow"),met007=$("#showproduct dl").eq(0),metv3=$(".product_list").eq(0);
	if(metv5.size()>0)dom=metv5.find('dd ul').eq(0);
	if(metv4.size()>0)dom=metv4.find('dd ul').eq(0);
	if(met007.size()>0)dom=met007.find('dd ul').eq(0);
	if(metv3.size()>0)dom=metv3;
	dom.after("<div id='met_shop'>加载中...</div>");
	var urls='../member/met_shop_return.php?action=cartmenu'+'&shop_shopid='+shop_shopid+'&lang='+langnow;
	$.ajax({url: urls,type: 'POST',success: function(data) {
		$("#met_shop").remove();
		dom.after(data);
	}});
}
if(metapp_shop_ym==1){
	$('#metapp_shop_shopnum_increase').live('click',function(){ metapp_shop_shopnum($('#metapp_shop_shopnum_val'),1); return false; });
	$('#metapp_shop_shopnum_decrease').live('click',function(){ metapp_shop_shopnum($('#metapp_shop_shopnum_val'),0); return false; });
	$('#metapp_shop_addtocart').live('click',function(){
		var shopnum=Number($('#metapp_shop_shopnum_val').val());
			if(shopnum<1||!metapp_shop_ifint(shopnum)){
				alert('请填写正确的购买数量！');
				$('#metapp_shop_shopnum_val').focus();
				return false;
			}
		var shopdescription='';
		var checked=0;
		var slistcount=Number($("#met_shop").attr('data-scount'));
		var shopid=shop_shopid;
		var alertxt=shop_alertxt;
		var href=$(this).attr('href');
		for(var i=1;i<=slistcount;i++){
			var namelist=$('input[name=spara'+i+']');
				namelist.each(function(){
					if($(this).attr('checked')=='checked'||$(this).attr('checked')==true){shopdescription+=$(this).val()+' ';checked=1;}
				});
			if(checked==0){
				alert(alertxt+'!!!');
				return false;
			}
			checked=0;
		}
		var url=$('#metapp_shop_addtocart').attr('href');
		var urls='../member/met_shop_shop.php?action=insmert'+'&shopnum='+shopnum+'&shopdescription='+shopdescription+'&shopid='+shopid+'&lang='+$('#metapp_shop_lang').val();
		$.ajax({url: urls,type: 'POST',success: function(data) {
			window.location.href=href;
		}});
		return false;
	});
	shop_add();
}else{
	$(document).ready(function(){
		if($("#continue_shopping").size()>0)$("#continue_shopping").attr('href',document.referrer);
		var shoplistb=$(".metapp_shop_cartlist_dd_listbox");

		if(shoplistb.size()>0){
			shoplistb.each(function(){
				var td = $(this).find('.metapp_shop_cartlist_dd_list');
				var ht=0;
				td.each(function(){
					if($(this).height()>ht){
						ht=$(this).height();
					}	
				});
				td.find('span').height(ht-10);
			});
		}
		//订单提交
		if($('#Orders_submitted').size()>0){
			$('#Orders_submitted').submit(function() {
				var urls = $(this).attr('action');
				var vals = $('#Orders_submitted').serialize();
				$.post(urls, vals ,function(data) {
					window.location.href=urls+'&ordernumber='+data;
				});
				return false;
			});
			var formlistval = $('#Orders_submitted').serialize()
	$.post("ajax/test.html", function(data) {
	  $(".result").html(data);
	});
			//formSerialize（）
		}
	});
}
function formtarget(target){
	var form=$('#payment_submitted');
	form.attr('target',target);
}
function paymentsubmit(){
	if($('input:radio[name="payment"]:checked').val()==1){
		formtarget('_blank');
	}else{
		formtarget('_self');	
	}
	var form=$('#payment_submitted');
	form.submit();
	return false;
}