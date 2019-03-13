var pagingData = new Array();

var pagingIndex = 0;

pagingData[0] = '';

var Paging = {

     init: function(){           //分页初始化

         if(Paging.config() != true){

             alert(FCKLang.Paging6);
             return;
         }
         Paging.start = window.parent.document.getElementById(Paging.editor + '___PagingStart').value ;
		 //Paging.start = Paging.start.replace('metinfopage','"metinfopage"');
         Paging.stop = window.parent.document.getElementById(Paging.editor + '___PagingStop').value ;

         if(Paging.start.length==0 && Paging.stop.length==0){

             alert(FCKLang.Paging7);

             return;

         }

         document.getElementById('xPagingAnalyse').style.display = 'none' ;

         document.getElementById('xPagingList').innerHTML = '';

         document.getElementById('xPagingCreate').style.display = 'block' ;

         document.getElementById('xPagingDelete').style.display = 'block' ;

         document.getElementById('xPagingUnite').style.display = 'block' ;

         document.getElementById('xPagingMessage').innerHTML = FCKLang.Paging8;

         var body = Paging.get();

         
         body = body.replace('<p>'+Paging.start,'');

         body = body.replace(Paging.stop+'</p>','');

         body = body.replace('<p>'+Paging.stop+Paging.start+'</p>',Paging.stop+Paging.start);

         var data = body.split(Paging.stop+Paging.start);

         var index = 0;

         for(var i = 0 ; i < data.length ; i++){

             if(data.length>0){
					
				 data[i] = data[i].replace(Paging.start,'');

				 data[i] = data[i].replace(Paging.stop,'');
				 
                 pagingData[index] = data[i] ;

                 document.getElementById('xPagingList').appendChild(Paging.node(index, data[i])) ;

                 index++;

             }

         }

         pagingIndex=0;

         Paging.set(pagingData[0]) ;

         Paging.style(pagingIndex,true);

     },

     create: function(data){         //创建新页

         Paging.save();

         if (typeof(data) != 'string')

             data = '' ;

         var index = pagingData.length ;

         var span = Paging.node(index, data);

        

         Paging.style(pagingIndex,false);

         pagingIndex = index ;

         pagingData[pagingIndex] = data ;

         Paging.set(data) ;

         document.getElementById('xPagingList').appendChild(Paging.node(index, data)) ;

         Paging.style(pagingIndex,true);

     },

     go: function(index){             //转到页

         if(index != pagingIndex && index >= 0 && index < pagingData.length){

             //检测有没有保存

             Paging.save();

             //切换CSS样式

             Paging.style(pagingIndex,false);

             //写入编辑器内容

             pagingIndex = index ;

             Paging.set(pagingData[pagingIndex]);

             Paging.style(pagingIndex,true);

         }

     },

     remove: function(){             //删除分页

         var index = pagingIndex;

         if(index >= 0 && index < pagingData.length){

             //检测

             if(pagingData.length == 1){

                 alert(FCKLang.Paging9);

                 return;

             }

             if(confirm(FCKLang.Paging10 + ( pagingIndex +1 ) + FCKLang.Paging11) == false)

                 return;

             //删除节点

             var list = document.getElementById('xPagingList');

             list.removeChild(list.childNodes[index]);

             //更新编辑器内容

             Paging.style(pagingIndex,false);

             if(index == 0){

                 Paging.set(pagingData[pagingIndex+1]);

             }else{

                 pagingIndex --;

                 Paging.set(pagingData[pagingIndex]);

             }

             //删除数组元素

             document.getElementById('xPagingList').innerHTML = '' ;

             for ( var i=0 ; i < pagingData.length ; ++i ){

                 if ( i == index ){

                     if ( i > pagingData.length/2 ){

                         for ( var j=i ; j < pagingData.length-1 ; ++j ){

                             pagingData[j] = pagingData[j+1];

                         }

                         pagingData.pop();

                     }else{

                         for ( var j=i ; j > 0 ; --j ){

                             pagingData[j] = pagingData[j-1];

                         }

                         pagingData.shift();

                     }  

                 }

             }

             //重新绘制分页信息

             for ( var k=0; k< pagingData.length ; k++)

             {

                 var span = Paging.node(k, pagingData[k]);

                 document.getElementById('xPagingList').appendChild(span) ;

             }

             Paging.style(pagingIndex,true);

         }

     },

     unite: function(){               //合并数据

         Paging.save();

         var data = "";

         var index = 0;

         for(var i = 0 ; i < pagingData.length ; i++ ){

             if(pagingData[i] != null && pagingData[i] != '' && pagingData[i] != '<p>&nbsp;</p>'){

                 index++;

				 var reg = new RegExp("^((<p>&nbsp;</p>)|(</p>)|(/n)|( ))*");
				 
				 pagingData[i] = pagingData[i].replace(reg,'');;
				 
                 if(data == ""){

                     data = pagingData[i] ;

                 }else if(index == 2){

                     data = Paging.start + data + Paging.stop;

                     data += Paging.start + pagingData[i] + Paging.stop;

                 }else{

                     data += Paging.start + pagingData[i] + Paging.stop;

                 }

             }

         }
		 
		 
         pagingData = new Array();

         Paging.set(data);

         document.getElementById('xPagingAnalyse').style.display = 'block' ;

         document.getElementById('xPagingList').innerHTML = '';

         document.getElementById('xPagingCreate').style.display = 'none' ;

         document.getElementById('xPagingDelete').style.display = 'none' ;

         document.getElementById('xPagingUnite').style.display = 'none' ;

         document.getElementById('xPagingMessage').innerHTML = FCKLang.Paging12;

     },

     node: function(index,data){     //private

         var span = document.createElement('span') ;

         span.id = 'xPage_' + index ;

         span.className = 'xPageNode1' ;

         if (typeof(data) != 'string')

             data = '' ;
		 if ( FCKBrowserInfo.IsIE )
			span.attachEvent("onclick",function(){Paging.go(index);});
		 else
			span.addEventListener("click", function(){Paging.go(index);}, false);
         span.innerHTML = FCKConfig.PagingCode.replace('{0}',index + 1) ;

         return span;

     },

     set: function(data,mode){       //private

         var left = new RegExp("^((<p>&nbsp;</p>)|(</p>)|(/n)|( ))*");

         var right = new RegExp("((<p>&nbsp;</p>)|(<p>)|(//n)|( ))*$");		 
		 
         data = data.replace(left,'');

         data = data.replace(right,'');
		 
         FCKeditorAPI.GetInstance(Paging.editor).SetHTML(data,mode) ;

     },

     get: function(){                 //private

         return FCKeditorAPI.GetInstance(Paging.editor).GetXHTML(true) ;

     },

     style: function(index,mode){     //private

         var list = document.getElementById('xPagingList') ;

         if(index >= 0 && index < list.childNodes.length){

             var name = 'xPageNode1' ;

             if(mode == true) name = 'xPageNode2' ;

             list.childNodes[index].className = name ;

         }

     },

     save: function(){               //private

         if(pagingIndex >= 0 && pagingIndex < pagingData.length){

             pagingData[pagingIndex] = Paging.get() ;

         }

     },

     submit: function(){             //private

         if(pagingData.length > 1){

             alert(FCKLang.Paging13);

             return false;

         }

     },

     config: function(){             //private
		 
         var iframes = window.parent.frames;
		
         for(var i=0 ; i < iframes.length ; i++){

             var obj1 = iframes[i].document.getElementById('xPagingAnalyse');

             var obj2 = document.getElementById('xPagingAnalyse');

             if(obj1 == obj2){

                 Paging.editor = iframes[i].name.split('___')[0] ;
                 return true;

             }

         }

         return false;

     }

}
if ( FCKBrowserInfo.IsIE )
	window.parent.document.forms[0].attachEvent("onsubmit", Paging.submit);
else
	window.parent.document.forms[0].addEventListener(
		"submit", 
		function(event) 
		{ 
			if(pagingData.length > 1){
				alert(FCKLang.Paging13);			
				if (event.cancelable){event.preventDefault();}
				return false;
			}
		},
		false
	);
