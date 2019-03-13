var replyreload = '', attachimgST = new Array(), zoomgroup = new Array(), zoomgroupinit = new Array();
function attachimggroup(pid) {

	if(!zoomgroupinit[pid]) {
		for(i = 0;i < aimgcount[pid].length;i++) {
		//alert(aimgcount[pid][i]);
			zoomgroup['aimg_' + aimgcount[pid][i]] = pid;
		}
		//alert(zoomgroupinit[pid]);
		zoomgroupinit[pid] = true;
	}
}
//id
function $idf(id) {
	return !id ? null : document.getElementById(id);
}
function attachimgshow(pid, onlyinpost) {
	onlyinpost = !onlyinpost ? false : onlyinpost;
	aimgs = aimgcount[pid];
	aimgcomplete = 0;
	loadingcount = 0;
	for(i = 0;i < aimgs.length;i++) {
		obj = $idf('aimg_' + aimgs[i]);
		if(!obj) {
			aimgcomplete++;
			continue;
		}
		if(onlyinpost && obj.getAttribute('inpost') || !onlyinpost) {
			if(!obj.status) {
				obj.status = 1;
				loadingcount++;
			} else if(obj.status == 1) {
				if(obj.complete) {
					obj.status = 2;
				} else {
					loadingcount++;
				}
			} else if(obj.status == 2) {
				aimgcomplete++;
				if(obj.getAttribute('thumbImg')) {
					thumbImg(obj);
				}
			}
			if(loadingcount >= 10) {
				break;
			}
		}
	}
	if(aimgcomplete < aimgs.length) {
		setTimeout(function () {
			attachimgshow(pid, onlyinpost);
		}, 100);
	}
}

zoomstatus = parseInt(1);
var imagemaxwidth = '500';//控制图片初始宽度
var aimgcount = new Array();

//class
function $CLASS(classname, ele, tag) {
	var returns = [];
	ele = ele || document;
	tag = tag || '*';
	if(ele.getElementsByClassName) {
		var eles = ele.getElementsByClassName(classname);
		if(tag != '*') {
			for (var i = 0, L = eles.length; i < L; i++) {
				if (eles[i].tagName.toLowerCase() == tag.toLowerCase()) {
						returns.push(eles[i]);
				}
			}
		} else {
			returns = eles;
		}
	}else {
		eles = ele.getElementsByTagName(tag);
		var pattern = new RegExp("(^|\\s)"+classname+"(\\s|$)");
		for (i = 0, L = eles.length; i < L; i++) {
				if (pattern.test(eles[i].className)) {
						returns.push(eles[i]);
				}
		}
	}
	return returns;
}

var aimgcounts = new Array();
var imgNum = $CLASS("metZoomTab")[0].getElementsByTagName("img").length;

for (var i=0;i<imgNum;i++){aimgcounts[i] = i+1;}
aimgcount[1000] = aimgcounts;
attachimggroup(1000);
attachimgshow(1000);
var aimgfid = 0;

