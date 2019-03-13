//管理员添加验证
function CheckForm()
{   
	if (document.myform.useid.value.length == 0) {
		alert(user_msg['admin_id']);
		document.myform.useid.focus();
		return false;
	}
   if (document.myform.pass1.value.length == 0) {
		alert(user_msg['admin_pass1']);
		document.myform.pass1.focus();
		return false;
	}
   if (document.myform.email.value.length == 0) {
		alert(user_msg['admin_email']);
		document.myform.email.focus();
		return false;
	}
   if (document.myform.pass1.value !== document.myform.pass2.value) {
		alert(user_msg['admin_pass2']);
		document.myform.pass1.focus();
		return false;
	}
}
//显示控制
function displayid(onid,offid)
{ 
 document.getElementById(onid).style.display="";
 document.getElementById(offid).style.display="none";
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

// 二级栏目联动
function changelocation(locationid)
    {
    document.myform.class3.length = 1; 
    var locationid=locationid;
    var i;
    for (i=0;i < onecount; i++)
        {
            if (subcat[i][1] == locationid)
            { 
                document.myform.class3.options[document.myform.class3.length] = new Option(subcat[i][0], subcat[i][2]);
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
    document.myform.foldername.value =foldernames[locationid][0];
	document.getElementById("list_order").style.display=foldernames[locationid][1];
	if(locationid!=1){
	document.getElementById("filename").style.display="none";
	}
	else{
	document.getElementById("filename").style.display="";	
	}	
    }
	//上传检查
function CheckFormupload()

{   
	if (document.myform.imgurl.value.length == 0) {
		alert(user_msg['input_file']);
		document.myform.imgurl.focus();
		return false;
	}
}
//招聘模块检查
function CheckFormjob()

{   
	if (document.myform.c_position.value.length == 0) {
		alert(user_msg['c_position']);
		document.myform.c_position.focus();
		return false;
	}
}
//文章模块检查
function CheckFormarticle()
{   
	if (document.myform.c_title.value.length == 0) {
		alert(user_msg['input_tile']);
		document.myform.c_title.focus();
		return false;
	}
   if (document.myform.class2.value =='0') {
		alert(user_msg['class2']);
		document.myform.class2.focus();
		return false;
	}
}
//下载模块检查
function CheckFormdownload()
{   
	if (document.myform.c_title.value.length == 0) {
		alert(user_msg['input_tile']);
		document.myform.c_title.focus();
		return false;
	}
   if (document.myform.class2.value =='0') {
		alert(user_msg['class2']);
		document.myform.class2.focus();
		return false;
	}
   if (document.myform.downloadurl.value.length == 0) {
		alert(user_msg['downloadurl']);
		document.myform.downloadurl.focus();
		return false;
	}
}
//模板添加
function CheckForm_skin()
{   
	if (document.myform.skin_name.value.length == 0) {
		alert(user_msg['skin_name']);
		document.myform.skin_name.focus();
		return false;
	}
   if (document.myform.skin_file.value.length == 0) {
		alert(user_msg['skin_file']);
		document.myform.skin_file.focus();
		return false;
	}
}
//标签添加
function CheckForm_label()
{   
	if (document.myform.oldwords.value.length == 0) {
		alert(user_msg['oldwords']);
		document.myform.oldwords.focus();
		return false;
	}
}

//模块添加
function CheckForm_moudle()
{   
	if (document.myform.c_name.value.length == 0) {
		alert(user_msg['c_name']);
		document.myform.c_name.focus();
		return false;
	}
}
//友情链接添加
function CheckFormlink()
{   
	if (document.myform.c_webname.value.length == 0) {
		alert(user_msg['c_webname']);
		document.myform.c_webname.focus();
		return false;
	}
	if (document.myform.weburl.value.length == 0 || document.myform.weburl.value =='http://' ) {
		alert(user_msg['weburl']);
		document.myform.weburl.focus();
		return false;
	}
}

function CheckForm_e()
{   
   if (document.myform.pass1.value !== document.myform.pass2.value) {
		alert(user_msg['admin_pass2']);
		document.myform.pass1.focus();
		return false;
	}
   if (document.myform.email.value.length == 0) {
		alert(user_msg['admin_email']);
		document.myform.email.focus();
		return false;
	}
}

function ConfirmDel()
{
   if(confirm(user_msg['deleteinfo']))
     return true;
   else
     return false;
	 
}

function ConfirmDelall()
{   
   for (var i=0;i<del.elements.length;i++)
    {
    var e = del.elements[i]; 
    if (e.name=="id"&&e.checked){
       del.allid.value=del.allid.value+e.value+",";
	 }
    }
	if(confirm(user_msg['deleteinfo']))
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
    if (typeof(mode) == 'undefined'){
        return false;
    } else{
	
        var adminname = encodeURIComponent(document.getElementById('' + mode + '').value);
        
        var gourl="ajax.php?action=admin"+"&id="+adminname+"&date="+Math.random();;
    }
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
			alert(user_msg['error']);
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
