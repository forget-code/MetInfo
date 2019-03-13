//onchange select
function changes(th){
    location.href = th.val();	
}
//add admin
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
//
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

function showclass(classid,classtype)
{ 
//alert(document.getElementById('class3_1_1').style.display);
for(var i=0; i<classcount; i++){
if(classtype==2){
  if(classid==subclass[i][1]){
   if(document.getElementById('class_'+subclass[i][0]).style.display=="none"){
     document.getElementById('class_'+subclass[i][0]).style.display="";
   }else{
     document.getElementById('class_'+subclass[i][0]).style.display="none";
	  }
    }
  }else{
  if(classid==subclass[i][2]){
   if(document.getElementById('class_'+subclass[i][0]).style.display=="none" && classid==subclass[i][1]){
     document.getElementById('class_'+subclass[i][0]).style.display="";
   }else{
     document.getElementById('class_'+subclass[i][0]).style.display="none";
	  }
    } 
 
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

function displayall(my,onid1,onid2){ 
if(my.attr('checked')){
	$(onid1).show();
	$(onid2).show();
}
else{
	$(onid1).hide();
	$(onid2).hide();
}
}

// Two part linkage options.remove(f.keywords.selectedIndex);
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
	
//Three part linkage
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
//templates linkage
function changecss(my)
 {
    my.next("select").empty();	
    for (var i=0;i < onecount; i++)
        {
			if (subcat[i][0] == my.val())
            { 
                my.next("select").append("<option value='"+subcat[i][2]+"'>"+subcat[i][1]+"</option>");
            }
        }
	
}
//online skin linkage
function changeonline(locationid,onecount,subcat)
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
// folder names linkage
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
	 foldernames[10]=new Array("member","none");
	 foldernames[11]=new Array("search","none");
	 foldernames[12]=new Array("sitemap","none");
	 foldernames[100]=new Array("product","none");
	 foldernames[101]=new Array("img","none");
    document.myform.foldername.value =foldernames[locationid][0];
	document.myform.foldername1.value =foldernames[locationid][0];
	document.getElementById("list_order").style.display=foldernames[locationid][1];	
	if(locationid>1 && locationid<7)
	{	
	if(!metadminpagename)document.getElementById("static1").style.display="none";
	document.getElementById("static2").style.display="none";
	}
	else if(locationid>6 && locationid<13)
	{	
	document.getElementById("static1").style.display="none";
	document.getElementById("static2").style.display="none";
	}
	else if(locationid>99)
	{	
	if(!metadminpagename)document.getElementById("static1").style.display="none";
	document.getElementById("static2").style.display="none";
	}
	else	
	{
	document.getElementById("static1").style.display="";	
	document.getElementById("static2").style.display="";	
	}
	if(locationid>=6)	document.getElementById("showdoc").disabled=true;
	else	document.getElementById("showdoc").disabled=false;
    }
	//upload checked
function CheckFormupload()

{   
	if (document.myform.imgurl.value.length == 0) {
		alert(user_msg['js15']);
		document.myform.imgurl.focus();
		return false;
	}
}
//add flash
function CheckFormflash()
{   

	if ((document.getElementById("met_flash_type_1").checked || document.getElementById("met_flash_type_3").checked) && document.myform.img_path.value.length == 0) {
		alert(user_msg['js25']);
		document.myform.img_path.focus();
		return false;
	}

	if (document.getElementById("met_flash_type_2").checked && document.myform.flash_path.value.length == 0) {
		alert(user_msg['js26']);
		document.myform.flash_path.focus();
		return false;
	}
}
//content check
function CheckFormarticle()
{   
	if (document.myform.title.value==null || document.myform.title.value.length == 0) {
		alert(user_msg['js13']);
		document.myform.title.focus();
		return false;
	}
   if (document.myform.class2.value =='0') {
		alert(user_msg['js14']);
		document.myform.class2.focus();
		return false;
	}
}
//add friendly link
function CheckFormlink()
{   
	if (document.myform.webname.value==null || document.myform.webname.value.length == 0) {
		alert(user_msg['js19']);
		document.myform.webname.focus();
		return false;
	}
	
	if (document.myform.weburl.value.length == 0 || document.myform.weburl.value =='http://' ) {
		alert(user_msg['js20']);
		document.myform.weburl.focus();
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

function Confirmarchive(langtext)
{   
   if(confirm(langtext))
     return true;
   else
     return false;
}


//change
function ConfirmChange()
{   
   if(confirm(user_msg['js22']))
     return true;
   else
     return false;
	return false; 
}

function Confirmall()
{   
	var flag=0;
   for (var i=0;i<document.del.elements.length;i++)
    {
    var e = document.del.elements[i]; 
    if (e.name=="id"&&e.checked){
       document.myform.allid.value=document.myform.allid.value+e.value+",";
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
  

//member usename
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

//
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
//column
function linkage(m,p){
    var id     = "."+p;
    var inputs = $(id);
	var num    = m.attr("checked")==true?true:false;
        if(inputs.length>0){
	        inputs.attr("checked",num);
			for(var i=0;i<inputs.length;i++){
				var ed = ".bgid_"+inputs.eq(i).val();
				    if($(ed).length>0){
					    $(ed).attr("checked",num);
					}
			}
        }		
}
//copy
function copyform(){  
	var flag=0;
   for (var i=0;i<document.del.elements.length;i++)
    {
    var e = document.del.elements[i]; 
    if (e.name=="id"&&e.checked){
       document.myform.allid.value=document.myform.allid.value+e.value+",";
	   flag=1;
	 }
    }
	if(flag==0)
	{
		alert(user_msg['js23']);
		return false;
	}
	if(document.myform.copylang.value==""){
		alert(user_msg['js36']);
		return false;
	}
    if(confirm(user_msg['js24']))
     return true;
   else
     return false;	
}
function copyother(){
	if(document.myform.copylang.value==""){
		alert(user_msg['js36']);
		return false;
	}
    if(confirm(user_msg['js24']))
     return true;
   else
     return false;
}
