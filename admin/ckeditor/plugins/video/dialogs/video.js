CKEDITOR.dialog.add('video', function(editor){  
    return {  
        title: '添加视频',  
        resizable: CKEDITOR.DIALOG_RESIZE_BOTH,  
        minWidth: 500,  
        minHeight: 500,         
        contents: [
			{  
				id: 'video_code',  
				label: '视频代码',  
				title: 'video_code',  
				elements: [
					{  
						type: 'textarea',                    
						label: '<div style="padding-bottom:10px;"><p style=" font-size:14px; font-weight:bold;line-height:1.8;">视频HTML代码</p><p style="color:#999;line-height:1.8;">为节省空间，可以将视频上传至优酷、新浪、腾讯等视频平台，然后获取视频HTML代码。<br/>添加好之后需要保存后到前台对应页面看效果，也可以右键视频区域 Flash 属性预览和设置宽高。</p></div>',  
						id: 'code',  
						rows: 10 ,
						style: 'margin-top:5px'
					}
				]  
			},
			{  
				id: 'Upload',  
				hidden: true, 
				label: '上传视频',   
				filebrowser: 'uploadButton',				
				elements: [
					{
						type: 'file',
						id: 'upload',
						label: '<p style="color:#999;margin-bottom:10px; ">仅支持 <strong style="color:red;">H.264编码的MP4</strong> 格式，转换方法：<a href="http://jingyan.baidu.com/article/c1465413b5ebc40bfdfc4c7a.html" target="_blank">http://jingyan.baidu.com/article/c1465413b5ebc40bfdfc4c7a.html</a>。<br/>如上传未成功，请手动通过FTP上传至空间后填写视频地址。</p>',
						size: 38
					}, 
					{
						type: 'fileButton',
						id: 'uploadButton',
						filebrowser: 'Upload:url',
						label: '上传文件（选择文件后需要点此按钮才能上传）',
						'for': ['Upload', 'upload']
					},
					{
						type: 'text',
						id: 'url',
						label: '<div style="border-bottom:1px solid #ddd; margin:0px 0px 10px; padding:8px 0px; font-size:14px;font-weight:bold;">视频地址</div><p style="color:#999;margin-bottom:10px; ">仅支持 <strong style="color:red;">H.264编码的MP4</strong> 格式，视频支持在电脑、平板、手机设备浏览器上观看。</p>'
					},
					{
						type: 'hbox',
						widths: ['30%', '30%','30%'],
						children: [
							{
								type: 'text',
								width: '40px',
								id: 'vwidth',
								'default':'100%',
								label: '宽度'
							},
							{
								type: 'text',
								width: '40px',
								id: 'vheight',
								'default':'450',
								label: '高度'
							},
							{
								type: 'radio',
								id: 'vdebg',
								items : [ [ '开启', '1' ], [ '关闭', '0' ] ] ,
								'default':'0',
								label: '<p style="margin-bottom:10px;">自动播放</p>'
							}
						]
					},
					{
						type : 'html',
						html : '<h3>编辑器无法直接显示视频播放，需要保存后到前台页面查看效果。</h3>'
					}
				]  
			},
			{  
				id: 'video_img',  
				label: '封面图片', 
				hidden: true, 				
				filebrowser: 'uploadButton',	  
				elements: [
					{
						type: 'file',
						id: 'upload_fm',
						label: '<p style="color:#999;margin-bottom:10px; ">采用上传视频的情况下，视频播放之前显示的图片，如果不上传则显示黑色背景。</p>',
						size: 38
					}, 
					{
						type: 'fileButton',
						id: 'uploadButton',
						filebrowser: 'video_img:url_fm',
						label: '上传图片',
						'for': ['video_img', 'upload_fm']
					},
					{
						type: 'text',
						id: 'url_fm',
						label: '<div style="border-bottom:1px solid #ddd; margin:0px 0px 10px; padding:8px 0px; font-size:14px;font-weight:bold;">封面图片地址</div>'
					}
				]  
			}

		],  
        onOk: function(){  
            var code = this.getValueOf('video_code', 'code');  
            //代码文本输入区域为空，则不进行添加
            if(code.replace(/^\s*|\s*$/g,'')!=""){
                 var html = code;
                editor.insertHtml(html);
            }
			//D.getCustomData('isReady') == 'true'
			var src = this.getValueOf('Upload', 'url');  
			if(src!=""){
				var width = this.getValueOf('Upload', 'vwidth');  
				var height = this.getValueOf('Upload', 'vheight'); 
				var autoplay = this.getValueOf('Upload', 'vdebg')=='1'?"true":"false";				
				var poster = this.getValueOf('video_img', 'url_fm');				
				var vhtml = '<hr class="metvideobox" style="width:'+width+'px; height:'+height+'px; background:#000 url('+poster+') no-repeat 50% 50%; background-size:contain;" data-metvideo="'+width+'|'+height+'|'+poster+'|'+autoplay+'|'+src+'" />';
				editor.insertHtml(vhtml);
			}

        },  
        onLoad: function(){             
        }  
    };  
});