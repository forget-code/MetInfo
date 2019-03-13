function _zoom(obj, zimg, nocover, pn, showexif) {
//alert(455);
	zimg = !zimg ? obj.src : zimg;
	showexif = !parseInt(showexif) ? 0 : showexif;
	if(!zoomstatus) {
		window.open(zimg, '', '');
		return;
	}
	if(!obj.id) obj.id = 'img_' + Math.random();
	var faid = !obj.getAttribute('aid') ? 0 : obj.getAttribute('aid');
	var menuid = 'imgzoom';
	var menu = $id(menuid);
	var zoomid = menuid + '_zoom';
	var imgtitle = !nocover && obj.title ? '<div class="imgzoom_title">' + obj.title + '</div>' +
		(showexif ? '<div id="' + zoomid + '_exif" class="imgzoom_exif" onmouseover="this.className=\'imgzoom_exif imgzoom_exif_hover\'" onmouseout="this.className=\'imgzoom_exif\'"></div>' : '')
		: '';
	var cover = !nocover ? 1 : 0;
	var pn = !pn ? 0 : 1;
	var maxh = (document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight) - 83;
	var loadCheck = function (obj) {
		if(obj.complete) {
			var imgw = loading.width;
			var imgh = loading.height;
			var r = imgw / imgh;
			var w = document.body.clientWidth * 0.95;
			w = imgw > w ? w : imgw;
			var h = w / r;
			if(w < 100 & h < 100) {
				$id(menuid + '_waiting').style.display = 'none';
				hideMenu();
				return;
			}
			if(h > maxh) {
				h = maxh;
				w = h * r;
			}
			if($id(menuid)) {
				$id(menuid).removeAttribute('top_');$id(menuid).removeAttribute('left_');
				clearTimeout($id(menuid).getAttribute('timer'));
			}
			showimage(zimg, w, h, imgw, imgh);
			if(showexif && faid) {
				var x = new Ajax();
				x.get('forum.php?mod=ajax&action=exif&aid=' + faid + '&inajax=1', function(s, x) {
					if(s) {
						$id(zoomid + '_exif').style.display = '';
						$id(zoomid + '_exif').innerHTML = s;
					} else {
						$id(zoomid + '_exif').style.display = 'none';
					}
				});
			}
		} else {
			setTimeout(function () { loadCheck(loading); }, 100);
		}
	};
	var showloading = function (zimg, pn) {
		if(!pn) {
			if(!$id(menuid + '_waiting')) {
				waiting = document.createElement('img');
				waiting.id = menuid + '_waiting';
				waiting.src = IMGDIR + '/imageloading.gif';
				waiting.style.opacity = '0.8';
				waiting.style.filter = 'alpha(opacity=80)';
				waiting.style.position = 'absolute';
				waiting.style.zIndex = '100000';
				$id('append_parent').appendChild(waiting);
			}
		}
		$id(menuid + '_waiting').style.display = '';
		$id(menuid + '_waiting').style.left = (document.body.clientWidth - 42) / 2 + 'px';
		$id(menuid + '_waiting').style.top = ((document.documentElement.clientHeight - 42) / 2 + Math.max(document.documentElement.scrollTop, document.body.scrollTop)) + 'px';
		loading = new Image();
		setTimeout(function () { loadCheck(loading); }, 100);
		if(!pn) {
			$id(menuid + '_zoomlayer').style.display = 'none';
		}
		loading.src = zimg;
	};
	var adjustpn = function(h) {
		h = h < 90 ? 90 : h;
		if($id('zimg_prev')) {
			$id('zimg_prev').style.height= parseInt(h) + 'px';
		}
		if($id('zimg_next')) {
			$id('zimg_next').style.height= parseInt(h) + 'px';
		}
	};
	var showimage = function (zimg, w, h, imgw, imgh) {
		$id(menuid + '_waiting').style.display = 'none';
		$id(menuid + '_zoomlayer').style.display = '';
		$id(menuid + '_img').style.width = 'auto';
		$id(menuid + '_img').style.height = 'auto';
		$id(menuid).style.width = (w < 300 ? 320 : w + 20) + 'px';
		mheight = h + 60;
		menu.style.height = mheight + 'px';
		$id(menuid + '_zoomlayer').style.height = (mheight < 120 ? 120 : mheight) + 'px';
		$id(menuid + '_img').innerHTML = '<img id="' + zoomid + '" src="' + zimg + '" width="' + w + '" height="' + h + '" w="' + imgw + '" h="' + imgh + '" />' + imgtitle;
		if($id(menuid + '_imglink')) {
			$id(menuid + '_imglink').href = zimg;
		}
		setMenuPosition('', menuid, '00');
		adjustpn(h);
	};
	var adjustTimer = 0;
	var adjustTimerCount = 0;
	var wheelDelta = 0;
	var clientX = 0;
	var clientY = 0;
	var adjust = function(e, a) {
		if(BROWSER.ie && BROWSER.ie<7) {
		} else {
			if(adjustTimerCount) {
				adjustTimer = (function(){
					return setTimeout(function () {
						adjustTimerCount++;
						adjust(e);
					}, 20);
					})();
					$id(menuid).setAttribute('timer', adjustTimer);
				if(adjustTimerCount > 17) {
					clearTimeout(adjustTimer);
					adjustTimerCount = 0;
					doane();
				}
			} else if(!a) {
				adjustTimerCount = 1;
				if(adjustTimer) {
					clearTimeout(adjustTimer);
					adjust(e, a);
				} else {
					adjust(e, a);
				}
				doane();
			}
		}
		var ele = $id(zoomid);
		if(!ele) {
			return;
		}
		var imgw = ele.getAttribute('w');
		var imgh = ele.getAttribute('h');

		if(!a) {
			e = e || window.event;
			try {
				if(e.altKey || e.shiftKey || e.ctrlKey) return;
			} catch (e) {
				e = {'wheelDelta':wheelDelta, 'clientX':clientX, 'clientY':clientY};
			}
			var step = 0;
			if(e.wheelDelta <= 0 || e.detail > 0) {
				if(ele.width - 1 <= 200 || ele.height - 1 <= 200) {
					clearTimeout(adjustTimer);
					adjustTimerCount = 0;
					doane(e);return;
				}
				step = parseInt(imgw/ele.width)-4;
			} else {
				if(ele.width + 1 >= imgw*40) {
					clearTimeout(adjustTimer);
					adjustTimerCount = 0;
					doane(e);return;
				}
				step = 4-parseInt(imgw/ele.width) || 2;
			}
			if(BROWSER.ie && BROWSER.ie<7) { step *= 5;}
			wheelDelta = e.wheelDelta;
			clientX = e.clientX;
			clientY = e.clientY;
			var ratio = 0;
			if(imgw > imgh) {
				ratio = step/ele.height;
				ele.height += step;
				ele.width = imgw*(ele.height/imgh);
			} else if(imgw < imgh) {
				ratio = step/ele.width;
				ele.width += step;
				ele.height = imgh*(ele.width/imgw);
			}
			if(BROWSER.ie && BROWSER.ie<7) {
				setMenuPosition('', menuid, '00');
			} else {
				var menutop = parseFloat(menu.getAttribute('top_') || menu.style.top);
				var menuleft = parseFloat(menu.getAttribute('left_') || menu.style.left);
				var imgY = clientY - menutop - 39;
				var imgX = clientX - menuleft - 10;
				var newTop = (menutop - imgY*ratio) + 'px';
				var newLeft = (menuleft - imgX*ratio) + 'px';
				menu.style.top = newTop;
				menu.style.left = newLeft;
				menu.setAttribute('top_', newTop);
				menu.setAttribute('left_', newLeft);
			}
		} else {
			ele.width = imgw;
			ele.height = imgh;
		}
		menu.style.width = (parseInt(ele.width < 300 ? 300 : parseInt(ele.width)) + 20) + 'px';
		var mheight = (parseInt(ele.height) + 60);
		menu.style.height = mheight + 'px';
		$id(menuid + '_zoomlayer').style.height = (mheight < 120 ? 120 : mheight) + 'px';
		adjustpn(ele.height);
		doane(e);
	};
	if(!menu && !pn) {
		menu = document.createElement('div');
		menu.id = menuid;
		if(cover) {
			menu.innerHTML = '<div class="zoominner" id="' + menuid + '_zoomlayer" style="display:none"><p><span class="y"><a id="' + menuid + '_imglink" class="imglink" target="_blank" title="'+met_blank_d+'">'+met_blank_d+'</a><a id="' + menuid + '_adjust" href="javascipt:;" class="imgadjust" title="'+met_full_d+'">'+met_full_d+'</a>' +
				'<a href="javascript:;" onclick="hideMenu()" class="imgclose" title="'+met_close_d+'">'+met_close_d+'</a></span>'+met_zoom_d+'</p>' +
				'<div class="zimg_p" id="' + menuid + '_picpage"></div><div class="hm" id="' + menuid + '_img"></div></div>';
		} else {
			menu.innerHTML = '<div class="popupmenu_popup" id="' + menuid + '_zoomlayer" style="width:auto"><span class="right y"><a href="javascript:;" onclick="hideMenu()" class="flbc" style="width:20px;margin:0 0 2px 0">'+met_close_d+'</a></span>'+met_zoom_d+'<div class="zimg_p" id="' + menuid + '_picpage"></div><div class="hm" id="' + menuid + '_img"></div></div>';
		}
		if(BROWSER.ie || BROWSER.chrome){
			menu.onmousewheel = adjust;
		} else {
			menu.addEventListener('DOMMouseScroll', adjust, false);
		}
		$id('append_parent').appendChild(menu);
		if($id(menuid + '_adjust')) {
			$id(menuid + '_adjust').onclick = function(e) {adjust(e, 1)};
		}
	}
	showloading(zimg, pn);
	picpage = '';

	$id(menuid + '_picpage').innerHTML = '';
	
	
//obj  是点击的那个图片
	
// alert(typeof zoomgroup == 'object');
// alert(zoomgroup[obj.id]);
// alert(typeof aimgcount == 'object');
// alert(aimgcount[zoomgroup[obj.id]]);
// alert(obj.id);

	
	
	if(typeof zoomgroup == 'object' && zoomgroup[obj.id] && typeof aimgcount == 'object' && aimgcount[zoomgroup[obj.id]]) {
	// alert(4545445);
		authorimgs = aimgcount[zoomgroup[obj.id]];
		var aid = obj.id.substr(5), authorlength = authorimgs.length, authorcurrent = '';
		// alert(authorlength);
		if(authorlength > 1) {
			for(i = 0; i < authorlength;i++) {
				if(aid == authorimgs[i]) {
					authorcurrent = i;
				}
			}
			if(authorcurrent !== '') {
				paid = authorcurrent > 0 ? authorimgs[authorcurrent - 1] : authorimgs[authorlength - 1];
				picpage += ' <div id="zimg_prev" onmouseover="dragMenuDisabled=true; onstate(this,\'133px\');" onmouseout="dragMenuDisabled=false; onstate(this,\'10000px\');" onclick="_zoom_page(\'' + paid + '\', ' + (showexif ? 1 : 0) + ')" class="zimg_prev"><strong>'+met_zimg_prev+'</strong></div> ';
				paid = authorcurrent < authorlength - 1 ? authorimgs[authorcurrent + 1] : authorimgs[0];
				picpage += ' <div id="zimg_next" onmouseover="dragMenuDisabled=true; onstate(this,\'133px\');" onmouseout="dragMenuDisabled=false; onstate(this,\'10000px\');" onclick="_zoom_page(\'' + paid + '\', ' + (showexif ? 1 : 0) + ')" class="zimg_next"><strong>'+met_zimg_next+'</strong></div> ';
			}
			if(picpage) {
				$id(menuid + '_picpage').innerHTML = picpage;
			}
		}
	}
	showMenu({'ctrlid':obj.id,'menuid':menuid,'duration':3,'pos':'00','cover':cover,'drag':menuid,'maxh':''});
}

function _zoom_page(paid, showexif) {
	var imagesrc = $id('aimg_' + paid).getAttribute('zoomfile');
	zoom($id('aimg_' + paid), imagesrc, 0, 1, showexif ? 1 : 0);
}

function onstate(eValue,dis){
	var eValues = eValue.getElementsByTagName("strong");
	eValues[0].style.lineHeight=dis;
};