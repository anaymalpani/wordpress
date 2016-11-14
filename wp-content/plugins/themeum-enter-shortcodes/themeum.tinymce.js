(function() {
    tinymce.create('tinymce.plugins.themeumtiny', {
        init : function(ed, url) {
            ed.addCommand('shortcodeGenerator', function() {

                tb_show("Shortcodes", url + '/shortcodes-new.php?&width=630&height=600');

                
            });
            //Add button
            ed.addButton('themeumscgenerator', {    title : 'Shortcodes', cmd : 'shortcodeGenerator', image : url + '/shortcode-icon.png' });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : 'Themeum TinyMCE',
                author : 'Themeum',
                authorurl : 'http://www.themeum.com',
                infourl : 'http://www.themeum.com',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('themeum_buttons', tinymce.plugins.themeumtiny);
})();