(function() {
CKEDITOR.plugins.add( 'custom-356142fd6da1ea6dc8e28fcd09aba0eb', {
icons: 'custom-356142fd6da1ea6dc8e28fcd09aba0eb',
init: function( editor ) {
	editor.addCommand( 'custom-356142fd6da1ea6dc8e28fcd09aba0eb', ips.utils.defaultEditorPlugins.inline( 'custom-356142fd6da1ea6dc8e28fcd09aba0eb', "[hide] [\/hide]" ) );
	editor.ui.addButton && editor.ui.addButton( 'custom-356142fd6da1ea6dc8e28fcd09aba0eb', {
		label: ips.getString('editorbutton_custom-356142fd6da1ea6dc8e28fcd09aba0eb'),
		command: 'custom-356142fd6da1ea6dc8e28fcd09aba0eb',
		toolbar: ''
	});
	
}
});
})();