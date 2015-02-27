(function(){
	tinymce.create('tinymce.plugins.JqueryBannerRotate', {
		init : function(ed, url){
			ed.addCommand('JBRCommand', function(){
				ed.windowManager.open({
					file: ajaxurl + '?action=jquery_banner_rotate_tinymce_ajax',
					width: 640,
					height: 480,
					inline: 1
				});
			});

			ed.addButton('jquerybannerrotate', {
				title : 'jQuery Banner Rotate',
				image : url + '/../img/tinymce-button.png',
				cmd: 'JBRCommand'
			});
		},
		getInfo : function(){
			return {
				longname : "jQuery Banner Rotate",
				author : 'Pedro Marcelo',
				authorurl : 'https://github.com/pedromarcelojava/',
				infourl : 'https://github.com/pedromarcelojava/jquery-banner-rotate/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('jquerybannerrotate', tinymce.plugins.JqueryBannerRotate);
})();