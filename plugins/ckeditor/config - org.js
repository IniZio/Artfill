/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
	config.toolbar = [
		{ name: 'document'},
		{ name: 'clipboard'},
		{ name: 'editing'},
		{ name: 'forms'},
		'/',
		{ name: 'basicstyles' ,groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike'] },
		{ name: 'paragraph'},
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'insert'},
		'/',
		{ name: 'styles', items: [ 'FontSize' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools'},
		{ name: 'others'},
		{ name: 'about'}
	];

	// Toolbar groups configuration.
	config.toolbarGroups = [
		{ name: 'document'},
		{ name: 'clipboard'},
		{ name: 'editing'},
		{ name: 'forms' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph'},
		{ name: 'links' },
		{ name: 'insert' },
		'/',
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];
};

