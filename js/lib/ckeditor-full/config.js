/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'ru';
	 config.uiColor = '#eeeeee';
	 //config.allowedContent = true;
	//config.allowedContent = 'a[!href,data-toggle,data-target]{*}(*)';
	config.extraAllowedContent = 'div[data-loop,data-nav]';
	config.protectedSource.push( /<script[\s\S]*?script>/g );
};