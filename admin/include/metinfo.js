//管理员添加验证
function CheckForm()
{   
	if (document.myform.useid.value.length == 0) {
		alert(user_msg['js3']);
		document.myform.useid.focus();
		return false;
	}
   if (document.myform.pass1.value.length == 0) {
		alert(user_msg['js4']);
		document.myform.pass1.focus();
		return false;
	}
   if (document.myform.email.value.length == 0) {
		alert(user_msg['js5']);
		document.myform.email.focus();
		return false;
	}
   if (document.myform.pass1.value !== document.myform.pass2.value) {
		alert(user_msg['js6']);
		document.myform.pass1.focus();
		return false;
	}
}
//显示控制
function setCheckedValue(radioName, newValue) {  
    if(!radioName) return;  
       var radios = document.getElementsByName(radioName);     
       for(var i=0; i<radios.length; i++) {  
          radios[i].checked = false;  
          if(radios[i].value == newValue.toString()) {  
          radios[i].checked = true;  
       }  
        }  
}

function displayid(onid,offid)
{ 
 document.getElementById(onid).style.display="";
 document.getElementById(offid).style.display="none";
 if(onid=='columnin')
	setCheckedValue('if_in','0');
  if(onid=='columnout')
 setCheckedValue('if_in','1');
}

function displayall(onid1,onid2)
{ 
if(document.myform.img_ok.checked==false){
 document.getElementById(onid1).style.display="";
 document.getElementById(onid2).style.display="";
}
else{
 document.getElementById(onid1).style.display="none";
 document.getElementById(onid2).style.display="none";
}
}

// 二级栏目联动options.remove(f.keywords.selectedIndex);
function changelocation(locationid)
    {
    document.myform.class3.length = 1; 
    var locationid=locationid;
    var i;
	var lev;
    for (i=0;i < onecount; i++)
        {			
			if(subcat[i][2] == locationid)
				lev=subcat[i][3];
            if (subcat[i][1] == locationid)
            { 
                document.myform.class3.options[document.myform.class3.length] = new Option(subcat[i][0], subcat[i][2]);
            }
        }

	document.myform.access.length = 0;
	if(lev=="all") lev="0";
	switch(parseInt(lev))
	{
		case 0:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js28'], 'all');
		case 1:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js29'], '1');
		case 2:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js30'], '2');
		case 3:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js31'], '3');
	}
    }
function changelocation2(locationid)
    {
    var locationid=locationid;
    var i;
	var lev;
    for (i=0;i < onecount; i++)
        {			
			if(subcat[i][2] == locationid)
				lev=subcat[i][3];
        }

	document.myform.access.length = 0;
	if(lev=="all") lev="0";
	switch(parseInt(lev))
	{
		case 0:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js28'], 'all');
		case 1:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js29'], '1');
		case 2:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js30'], '2');
		case 3:document.myform.access.options[document.myform.access.length] = new Option(user_msg['js31'], '3');
	}
    }	
	
//三级栏目移动
function changelocation1(locationid,classtype)
{   
    var locationid=locationid;
	var classtype=classtype;
    var i;
	if(classtype==1 && document.myform.class2.length>1) {document.myform.class2.length = 1; document.myform.class3.length = 1;}
	if(classtype==2 && document.myform.class3.length>1) document.myform.class3.length = 1; 
	for (i=0;i < onecount; i++)
        {
            if (lev[i][1] == locationid)
            { 
				if(classtype==1)  document.myform.class2.options[document.myform.class2.length] = new Option(lev[i][0], lev[i][2]);
				else document.myform.class3.options[document.myform.class3.length] = new Option(lev[i][0], lev[i][2]);
            }        
        }

} 	
//模板风格联动
function changecss(locationid)
 {
	
    document.myform.met_skin_css.length = 0; 
    var locationid=locationid;
    var i;
	var lev;
    for (i=0;i < onecount; i++)
        {
			if (subcat[i][0] == locationid)
            { 
                document.myform.met_skin_css.options[document.myform.met_skin_css.length] = new Option(subcat[i][1], subcat[i][2]);
            }
        }
	
}
//在线交流风格联动
function changeonline(locationid)
 {
	
    document.myform.met_online_color.length = 0; 
    var locationid=locationid;
    var i;
	var lev;
    for (i=0;i < onecount; i++)
        {
			if (subcat[i][0] == locationid)
            { 
                document.myform.met_online_color.options[document.myform.met_online_color.length] = new Option(subcat[i][1], subcat[i][2]);
            }
        }
	
}
// 文件目录联动
function changefile(locationid)
    {
	 foldernames = new Array();
     foldernames[1]=new Array("about","none");
	 foldernames[2]=new Array("news","");
	 foldernames[3]=new Array("product","");
	 foldernames[4]=new Array("download","");
	 foldernames[5]=new Array("img","");
	 foldernames[6]=new Array("job","none");
	 foldernames[7]=new Array("message","none");
	 foldernames[8]=new Array("feedback","none");
	 foldernames[9]=new Array("link","none");
    document.myform.foldername.value =foldernames[locationid][0];
	document.myform.foldername1.value =foldernames[locationid][0];
	document.getElementById("list_order").style.display=foldernames[locationid][1];	
	if(locationid!=1)
	{	
	document.getElementById("static1").style.display="none";
	document.getElementById("static2").style.display="none";
	}
	else	
	{
	document.getElementById("static1").style.display="";	
	document.getElementById("static2").style.display="";	
	}
	if(locationid==6 || locationid==7 || locationid==8 || locationid==9)	document.getElementById("showdoc").disabled=true;
	else	document.getElementById("showdoc").disabled=false;
    }
	//上传检查
function CheckFormupload()

{   
	if (document.myform.imgurl.value.length == 0) {
		alert(user_msg['js15']);
		document.myform.imgurl.focus();
		return false;
	}
}
//添加flash检查
function CheckFormflash()
{   
	if (document.myform.width.value.length == 0) {
		alert(user_msg['js25']);
		document.myform.width.focus();
		return false;
	}
   if (document.myform.height.value.length ==0) {
		alert(user_msg['js26']);
		document.myform.height.focus();
		return false;
	}

}
//招聘模块检查
function CheckFormjob()

{   
	if (document.getElementById('c_position')!=null && document.myform.c_position.value.length == 0) {
		alert(user_msg['js17']);
		document.myform.c_position.focus();
		return false;
	}
	
	if (document.getElementById('c_position')==null && document.getElementById('e_position')!=null && document.myform.e_position.value.length == 0) {
		alert(user_msg['js17']);
		document.myform.e_position.focus();
		return false;
	}
	if (document.getElementById('c_position')==null && document.getElementById('e_position')==null && document.getElementById('o_position')!=null && document.myform.o_position.value.length == 0) {
		alert(user_msg['js17']);
		document.myform.o_position.focus();
		return false;
	}
	
}
//文章模块检查
function CheckFormarticle()
{   
	if (document.getElementById('c_title')!=null && document.myform.c_title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.c_title.focus();
		return false;
	}
	
	if (document.getElementById('c_title')==null && document.getElementById('e_title')!=null && document.myform.e_title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.e_title.focus();
		return false;
	}
	if (document.getElementById('c_title')==null && document.getElementById('e_title')==null && document.getElementById('o_title')!=null && document.myform.o_title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.o_title.focus();
		return false;
	}
   if (document.myform.class2.value =='0') {
		alert(user_msg['js14']);
		document.myform.class2.focus();
		return false;
	}
}
//下载模块检查
function CheckFormdownload()
{   
	if (document.getElementById('c_title')!=null && document.myform.c_title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.c_title.focus();
		return false;
	}
	
	if (document.getElementById('c_title')==null && document.getElementById('e_title')!=null && document.myform.e_title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.e_title.focus();
		return false;
	}
	if (document.getElementById('c_title')==null && document.getElementById('e_title')==null && document.getElementById('o_title')!=null && document.myform.o_title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.o_title.focus();
		return false;
	}
   if (document.myform.class2.value =='0') {
		alert(user_msg['js14']);
		document.myform.class2.focus();
		return false;
	}
   if (document.myform.downloadurl.value.length == 0) {
		alert(user_msg['js16']);
		document.myform.downloadurl.focus();
		return false;
	}
}
//模板添加
function CheckForm_skin()
{   
	if (document.myform.skin_name.value.length == 0) {
		alert(user_msg['js8']);
		document.myform.skin_name.focus();
		return false;
	}
   if (document.myform.skin_file.value.length == 0) {
		alert(user_msg['js9']);
		document.myform.skin_file.focus();
		return false;
	}
}
//标签添加
function CheckForm_label()
{   
	if (document.myform.oldwords.value.length == 0) {
		alert(user_msg['js18']);
		document.myform.oldwords.focus();
		return false;
	}
}

//模块添加
function CheckForm_moudle()
{   
	if (document.getElementById('c_name')!=null && document.myform.c_name.value.length == 0) {
		alert(user_msg['js1']);
		alert(user_msg['js11']);
		document.myform.c_name.focus();
		return false;
	}
	
	if (document.getElementById('c_name')==null && document.getElementById('e_name')!=null && document.myform.e_name.value.length == 0) {
		alert(user_msg['js1']);
		alert(user_msg['js11']);
		document.myform.e_name.focus();
		return false;
	}
	if (document.getElementById('c_name')==null && document.getElementById('e_name')==null && document.getElementById('o_name')!=null && document.myform.o_name.value.length == 0) {
		alert(user_msg['js1']);
		alert(user_msg['js11']);
		document.myform.o_name.focus();
		return false;
	}
}
//友情链接添加
function CheckFormlink()
{   
	if (document.getElementById('c_webname')!=null && document.myform.c_webname.value.length == 0) {
		alert(user_msg['js19']);
		document.myform.c_webname.focus();
		return false;
	}
	
	if (document.getElementById('c_webname')==null && document.getElementById('e_webname')!=null && document.myform.e_webname.value.length == 0) {
		alert(user_msg['js19']);
		document.myform.e_webname.focus();
		return false;
	}
	if (document.getElementById('c_webname')==null && document.getElementById('e_webname')==null && document.getElementById('o_webname')!=null && document.myform.o_webname.value.length == 0) {
		alert(user_msg['js19']);
		document.myform.o_webname.focus();
		return false;
	}
	
	if (document.myform.weburl.value.length == 0 || document.myform.weburl.value =='http://' ) {
		alert(user_msg['js20']);
		document.myform.weburl.focus();
		return false;
	}
}

function CheckForm_e()
{   
   if (document.myform.pass1.value !== document.myform.pass2.value) {
		alert(user_msg['js6']);
		document.myform.pass1.focus();
		return false;
	}
   if (document.myform.email.value.length == 0) {
		alert(user_msg['js5']);
		document.myform.email.focus();
		return false;
	}
}

function ConfirmDel()
{   
   if(confirm(user_msg['js7']))
     return true;
   else
     return false;
}

//提示改变状态
function ConfirmChange()
{   
   if(confirm(user_msg['js22']))
     return true;
   else
     return false;
	return false; 
}
function ConfirmDelall()
{   
   var flag=0;
   for (var i=0;i<del.elements.length;i++)
    {
    var e = del.elements[i]; 
    if (e.name=="id"&&e.checked){
       del.allid.value=del.allid.value+e.value+",";
	   flag=1;
	 }
    }
	
	if(flag==0)
	{
		alert(user_msg['js23']);
		return false;
	}
	if(confirm(user_msg['js7']))
     return true;
   else
     return false;
}

function Confirmall()
{   
	var flag=0;
   for (var i=0;i<del.elements.length;i++)
    {
    var e = del.elements[i]; 
    if (e.name=="id"&&e.checked){
       myform.allid.value=myform.allid.value+e.value+",";
	   flag=1;
	 }
    }
	if(flag==0)
	{
		alert(user_msg['js23']);
		return false;
	}
	if(confirm(user_msg['js24']))
     return true;
   else
     return false;	
}

function unselectall()
{
    if(document.del.chkAll.checked){
	document.del.chkAll.checked = document.del.chkAll.checked&0;
    } 	
}

function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if (e.Name != "chkAll")
       e.checked = form.chkAll.checked;
    }
  }
  

//会员用户名检验
function Usercheck(mode)
{
        var adminname = encodeURIComponent(document.getElementById('' + mode + '').value);
        var gourl="ajax.php?action=admin"+"&id="+adminname+"&date="+Math.random();
        makeRequest(gourl,'check_member','GET')
    　
}
function check_member() {
	var show=document.getElementById('div_name');
	if (http_request.readyState == 1) {
	   show.innerHTML=user_msg['checking'];
	}
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			show.innerHTML = http_request.responseText;
			savetime=-1000;
		}  else {
			alert(user_msg['js2']);
		}
	}
}
//end

//发送一个请求
function makeRequest(url, functionName, httpType, sendData) {

	http_request = false;
	if (!httpType) httpType = "GET";

	if (window.XMLHttpRequest) { // Non-IE...
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/plain');
		}
	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
	}

	if (!http_request) {
		alert('Cannot send an XMLHTTP request');
		return false;
	}

	var changefunc="http_request.onreadystatechange = "+functionName;
	eval (changefunc);
	http_request.open(httpType, url, true);
	http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http_request.send(null);
}
