/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.skin = 'office2003';
	//config.toolbar = 'Basic';
	config.toolbar_Full = [
	['Bold','Italic','Underline','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','NumberedList','BulletedList','Outdent','Indent','Strike','Subscript','Superscript'],
	['-','Undo','Redo','Cut','Copy','Paste','PasteText','PasteFromWord','-','Source'],
	'/',
	['Format','Font','FontSize','TextColor','BGColor'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','HorizontalRule','PageBreak','SpecialChar','SelectAll','RemoveFormat']
	];
	config.font_names = '宋体/宋体;黑体/黑体;仿宋/仿宋_GB2312;'+ config.font_names ;
	//CKEDITOR.config.enterMode = CKEDITOR.ENTER_DIV;
	config.disableNativeSpellChecker = false ;
	config.scayt_autoStartup = false;
};
