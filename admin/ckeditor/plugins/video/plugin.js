(function(){
    b='video';
    CKEDITOR.plugins.add(b,{
		requires: ['dialog'],
        init:function(editor){
            editor.addCommand(b, new CKEDITOR.dialogCommand('video'));
            editor.ui.addButton('video',{
                label:'添加视频',
                icon: this.path + 'video.png',
                command:b
            });
			CKEDITOR.dialog.add('video', this.path + 'dialogs/video.js');
        }
    });
})();

