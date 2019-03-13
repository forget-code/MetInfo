
	var video = $(".metvideobox");        		
	if(video.length>0){
		
		var videolist = $(".metvideobox");
		videolist.each(function(){
			var data = $(this).attr("data-metvideo");
				data = data.split("|");
			var width  = data[0],
				height = data[1],
				poster = data[2],
				autoplay = data[3],
				src = data[4];
			var vhtml = '<div class="metvideobox"><video class="metvideo video-js vjs-default-skin" controls preload="none" width="'+width+'" height="'+height+'" poster="'+poster+'" data-setup=\'{\"autoplay\": '+autoplay+'}\'>';
				vhtml+= '<source src="'+src+'" type="video/mp4" />';
				vhtml+= '</video></div>';
				$(this).after(vhtml);
				$(this).remove();
		});
		
	}