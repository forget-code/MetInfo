// category
/*___________________nav____________________________________________________*/
         var h = document.getElementById("top_ul").getElementsByTagName("a");
		 var dl = new Array(6);
		     dl[0] = document.getElementById("list0");
			 dl[1] = document.getElementById("list1");
			 dl[2] = document.getElementById("list2");
			 dl[3] = document.getElementById("list3");
			 dl[4] = document.getElementById("list4");
			 dl[5] = document.getElementById("list5");
			 dl[6] = document.getElementById("list6");
		 for(var i=0; i<7;i++){
			 if(i!=3&&i!=5){
		 document.getElementById('list'+i+'_0').className="left_clicka";
		 document.getElementById('list'+i+'_0').style.border="1px solid #c5edf9";
		 document.getElementById('list'+i+'_0').style.color="#1788c2";
			 }
		 }
		 
      function san(ao,lang){ 
	    //if(ao==3) {
        //setCookie ('colunmid', 'metinfo')
		//window.location.reload();
		//}
		//if(ao=='metinfo')ao=3;
	    for(var i=0; i<h.length;i++){
		  if( ao == i){
		 h[i].className="clicka";
		 h[i].style.color="#ffffff";
		dl[i].style.display = "block";
		  var srcshow="list"+i+"_0";
		  if(document.getElementById(srcshow)){
		  document.getElementById("main").src=document.getElementById(srcshow).href;
		  }else{
		  document.getElementById("main").src='site/sysadmin.php?lang='+lang;
			}
		} 
		  else{
		h[i].className="clickb";
		h[i].style.color="#40a0d7";
		dl[i].style.display = "none";
		  }
		}
	    if(ao!=3 && ao!=5 ){
		   san1(ao+1,0);
		}
	  }

/*__________________category 1____________________________________________________*/

      function san1(ao,nowao){
	    var h= document.getElementById("left_ul"+ao).getElementsByTagName("a");
	    for(var i=0; i<h.length;i++){
		  if( nowao == i){
		h[i].className="left_clicka";
		h[i].style.border="1px solid #c5edf9";
		h[i].style.color="#1788c2";
		} 
		  else{
		h[i].className="left_clickb";
		h[i].style.border="none";
		h[i].style.color="#777777";
		  }
		}
	  }


/*___________________category 4____________________________________________________*/

      function san4(ao){
	 var h4 = document.getElementById("left_ul4").getElementsByTagName("span");
	    for(var i=0; i<h4.length;i++){
		  if( ao == i){
		        if(h4[i].style.display=="none"){
				    h4[i].style.display="block";
				}
				else{
				h4[i].style.display="none";
				}
		} 
		   else{h4[i].style.display="none";}
		}
	  }

   function san6(ao){
	 var h6 = document.getElementById("left_ul6").getElementsByTagName("span");
	    for(var i=0; i<h6.length;i++){
		  if( ao == i){
		        if(h6[i].style.display=="none"){
				    h6[i].style.display="block";
				}
				else{
				h6[i].style.display="none";
				}
		} 
		   else{h6[i].style.display="none";}
		}
	  }

function setCookie ( name, value ) 
{ 
expires = new Date(); 
expires.setTime(expires.getTime() + (1000 * 86400 * 365)); 
document.cookie = name + "=" + escape(value) + "; expires=" + expires.toGMTString() + "; path=/"; 
} 

function getCookie ( name ) 
{ 
cookie_name = name + "="; 
cookie_length = document.cookie.length; 
cookie_begin = 0; 
while (cookie_begin < cookie_length) 
{ 
value_begin = cookie_begin + cookie_name.length; 
if (document.cookie.substring(cookie_begin, value_begin) == cookie_name) 
{ 
var value_end = document.cookie.indexOf ( ";", value_begin); 
if (value_end == -1) 
{ 
value_end = cookie_length; 
} 
return unescape(document.cookie.substring(value_begin, value_end)); 
} 
cookie_begin = document.cookie.indexOf ( " ", cookie_begin) + 1; 
if (cookie_begin == 0) 
{ 
break; 
} 
} 
return null; 
}

function delCookie ( name ) 
{ 
var expireNow = new Date(); 
document.cookie = name + "=" + "; expires=Thu, 01-Jan-70 00:00:01 GMT" + "; path=/"; 
} 
