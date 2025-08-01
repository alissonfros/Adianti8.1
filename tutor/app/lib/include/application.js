Adianti.loading = true;

Application = {};
Application.translation = {
    'en' : {
        'loading' : 'Loading',
        'close'   : 'Close',
        'insert'  : 'Insert',
        'open_new_tab' : 'Open on a new tab'
    },
    'pt' : {
        'loading' : 'Carregando',
        'close'   : 'Fechar',
        'insert'  : 'Inserir',
        'open_new_tab' : 'Abrir em uma nova aba'
    },
    'es' : {
        'loading' : 'Cargando',
        'close'   : 'Cerrar',
        'insert'  : 'Insertar',
        'open_new_tab' : 'Abrir en una nueva pestaña'
    }
};

Adianti.onClearDOM = function(){
	/* $(".select2-hidden-accessible").remove(); */
	/* $(".colorpicker-hidden").remove(); */
	$(".pcr-app").remove();
	$(".select2-display-none").remove();
	$(".tooltip.fade").remove();
	$(".select2-drop-mask").remove();
	/* $(".autocomplete-suggestions").remove(); */
	$(".datetimepicker").remove();
	$(".note-popover").remove();
	$(".dtp").remove();
	$("#window-resizer-tooltip").remove();
};


Adianti.showLoading = function() {
    if (Adianti.loading)
    {
        __adianti_block_ui(Application.translation[Adianti.language]['loading']);
    }
}

Adianti.onBeforeLoad = function(url) {
    setTimeout(function(){
        Adianti.showLoading()
    }, 400);
    
    if (url.indexOf('&static=1') == -1 && url.indexOf('&noscroll=1') == -1) {
        $("html, body").animate({ scrollTop: 0 }, "fast");
    }
    
    url = url.replace('engine.php?', '');
    url = url.replace('index.php?', '');
    
    query_object = __adianti_query_to_json(url);
    if (typeof query_object == 'object' && typeof query_object.register_state == 'undefined')
    {
        url  = 'engine.php?class=DocumentationView&method=onHelp&classname='+query_object.class;
        $('#view-source').attr('data-oldhref', $('#view-source').attr('href'));
        $('#view-source').attr('href', url);
        
        $('#change-bootstrap').attr('data-old-href', $('#change-bootstrap').attr('href'));
        $('#change-material').attr('data-old-href', $('#change-material').attr('href'));
        
        $('#change-bootstrap').attr('href', "index.php?class="+query_object.class+"&theme=theme3");
        $('#change-material').attr('href', "index.php?class="+query_object.class+"&theme=theme4");
    }
};

Adianti.onAfterLoad = function(url, data) {
    //Adianti.loading = false; 
    __adianti_unblock_ui( true );
    
    if ($('#adianti_div_content').find('code').length > 0) {
        $('#view-source').attr('class', 'float-button disabled');
        $('#view-source').attr('disabled', 1);
        $('#view-source').css('pointer-events',   'none');
    }
    else {
        $('#view-source').attr('class', 'float-button');
        $('#view-source').attr('disabled', null);
        $('#view-source').css('pointer-events',   'auto');
    }
    if (data.indexOf("TWindow") > 0) {
        // $('#view-source').attr('href', $('#view-source').attr('data-oldhref'));
        $('#change-bootstrap').attr('href', $('#change-bootstrap').attr('data-old-href'));
        $('#change-material').attr('href', $('#change-material').attr('data-old-href'));
    }
};

$( document ).on( 'click', '[generator="adianti-docs"]', function() {
    url = $(this).attr('href').replace('index.php', 'engine.php');
   __adianti_load_page_no_register(url);
   return false;
});

window.onpopstate = function(stackstate) {
	if (stackstate.state) {
		__adianti_load_page_no_register(stackstate.state.url);
	}
};

// set select2 language
$.fn.select2.defaults.set('language', $.fn.select2.amd.require("select2/i18n/pt"));
