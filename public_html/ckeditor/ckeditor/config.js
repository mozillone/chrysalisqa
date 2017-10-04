/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.allowedContent = true;

    config.autoParagraph = false;

    config.enterMode = CKEDITOR.ENTER_BR;

    config.extraPlugins = 'html5video,widget,widgetselection,clipboard,lineutils';

    config.filebrowserBrowseUrl = '/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';

    config.filebrowserImageBrowseUrl = '/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';

    config.filebrowserFlashBrowseUrl = '/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';

    config.filebrowserUploadUrl = '/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';

    config.filebrowserImageUploadUrl = '/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';

    config.filebrowserFlashUploadUrl = '/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
};

CKEDITOR.config.toolbar = [
    ['Styles','Format','Font','FontSize'],
    '/',
    ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
    '/',
    ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Image','Table','-','Link','Flash','Smiley','TextColor','BGColor','Source']
] ;
