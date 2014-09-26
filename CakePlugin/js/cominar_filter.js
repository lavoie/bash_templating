jQuery(document).ready(function() {

    ///////////////////////////////////
    // Modified by Eric Lavoie, 2014 //

    // anchors // css selectors
    
    var _flash = 'body .cominar-flash-zone';        // A flash zone to hide
    var _url_data_holder = '#cominarAction';        // Store [data-*] plugin, ctrl, action
    var _input_search = '#FilterSearch';            // Your search box id 
    var _search = 'search';                         // Search param name
    var _filters = '.cominar-filter';               // Filter boxes. Use #id to get filt name
    var _btn_filter = '#btnFilter';                 // Trigger ajax request
    var _btn_clear_filter = '#btnClearFilters';     // Clean boxes and trigger ajax request
    var _drop_zone = '.cominar-dynamic-content';    // Output

    // functions lib

    var cleanSearchAndFilters = function() {
        jQuery(_input_search).val('');
        jQuery(_filters).each(function() { jQuery(this).val(0); });
    }

    var getBaseUrl = function() {
        var plugin = jQuery(_url_data_holder).data('plugin');
        var ctrl = jQuery(_url_data_holder).data('ctrl');
        var action = jQuery(_url_data_holder).data('action');
        var base_url = '/'+ plugin +'/'+ ctrl +'/'+ action;
        return { full: base_url, base: base_url, params: '' };
    }

    var getParams = function() {
        var par_str = '/' + _search + ':' + jQuery(_input_search).val();
        jQuery(_filters).each(function() {
            par_str = par_str + '/' +  jQuery(this).attr('id') + ':' + jQuery(this).val();
        });
        return par_str;
    }

    var getUrl = function() {
        var u = getBaseUrl();
        var p = getParams();
        return { full: u.full + p, base: u.base, params: p };
    }

    var isParamsModified = function() {
        var store = jQuery(_btn_filter);
        var u = getUrl();
        return ((store.data('last-base')==u.base) && (store.data('last-params')!=u.params));
    }

    var doneHandler = function(data, t_status, jq_xhr) {
        jQuery(_drop_zone).html(data.content);
    }
    
    var alwaysHandler = function(data, t_status, jq_xhr) {
        jQuery(_btn_filter).removeAttr('disabled');
        if (isParamsModified()) {
            getNewData(getUrl());
        }
    }

    var getNewData = function(url) {
        if (!jQuery(_btn_filter).is('[disabled]')) {
            jQuery(_btn_filter).attr('disabled', 'disabled');
            jQuery(_btn_filter).data('last-base', url.base);
            jQuery(_btn_filter).data('last-params', url.params);
            jQuery(_flash).fadeOut();
            jQuery.ajax({url: url.full, dataType: 'json'})
                .done(doneHandler)
                .always(alwaysHandler);
        }
    }

    // events
    
    jQuery(document).on('input', _input_search, function(e) {
        getNewData(getUrl());
    });
    
    jQuery(document).on('change', _filters, function(e) {
        getNewData(getUrl());
    });
    
    jQuery(document).on('click', _btn_filter, function(e) {
        getNewData(getUrl());
    });
 
    jQuery(document).on('click', _btn_clear_filter, function(e) {
        cleanSearchAndFilters();
        getNewData(getBaseUrl());
    });

});
