jQuery(document).ready(function() {

    ///////////////////////
    // Eric Lavoie, 2014 //

    // anchors // css selectors

    var _assoc_select_tag = '.cominar-custom-assoc';    //  Your form select tag.

    // Will work with <select class="cominar-custom-assoc"></select> tag. That's it.
    // Output two "associative" lists acting like an avatar, replacing your select tag.
    // Transfer item from one list to another with a single click.
    // Use Font Awesome
    // Will not work in 'dynamic/ajax' section. Setup only once.

    // functions lib
    
    // a sorting function for avatars ////
    var assoc_avatar_sorting = function(a, b) {
        return jQuery(a).attr("orderby") - jQuery(b).attr("orderby");
    };

    // move to the right place and sort
    var assoc_place_sort = function(jQavatar, sel_target_list) {
        var jQ_target_list = jQuery(sel_target_list);
        jQavatar.appendTo(jQ_target_list);
        jQuery(sel_target_list + " li")
            .detach()
            .sort(assoc_avatar_sorting)
            .appendTo(jQ_target_list);
    }

    // a click moving function for avatars ////
    var assoc_moving = function() {
        if (jQuery(this).hasClass("assoc-selected")) {
            assoc_place_sort(jQuery(this), "#assoc-unselected-list");
            jQuery(_assoc_select_tag + " option[value=" + jQuery(this).val() + "]")
                .removeAttr("selected");
        } else {
            assoc_place_sort(jQuery(this), "#assoc-selected-list");
            jQuery(_assoc_select_tag + " option[value=" + jQuery(this).val() + "]")
                .attr("selected","selected");
        }
        // update status
        jQuery(this).toggleClass("assoc-selected"); 
        jQuery(this).find("i.fa").toggleClass("fa-check-square-o"); 
        jQuery(this).find("i.fa").toggleClass("fa-square-o"); 
    };  

    // foreach <option> : clone avatar, fill it with <option> infos, put it in right place 
    var assoc_build_avatars = function(sel_targets, jQ_avatar_model, sel_avatar_drop_zone) {
        jQuery(sel_targets).each(function() { 
            var jQclone = jQ_avatar_model.clone();
            var jQoption = jQuery(this);
            jQclone.attr("value", jQoption.val());
            jQclone.attr("orderby", jQoption.attr("orderby"));
            jQclone.find(".text").text(jQoption.text());
            jQclone.click(assoc_moving).appendTo(sel_avatar_drop_zone);
        });
    };

    // setup once ///////////////////
    
    // get canevas out of DOM 
    var assoc_unselected_avatar = jQuery('#assoc-unselected-avatar-container').detach().attr('id','');
    var assoc_selected_avatar = jQuery('#assoc-selected-avatar-container').detach().attr('id','');
    var assoc_lists = jQuery('#assoc-lists-container').detach().attr('id','');

    // numbering <option> tags
    var optCounter = 0;
    jQuery(_assoc_select_tag + " option").each(function() {
        optCounter++;
        jQuery(this).attr("orderby", optCounter);
    });
    
    // install a clone of assoc_lists (two-lists output section) in place
    jQuery(_assoc_select_tag).parent().append(assoc_lists.clone());

    // grab all selected and put a <li> avatar in selected-list
    assoc_build_avatars(
        _assoc_select_tag + " option[selected]", 
        assoc_selected_avatar, 
        "#assoc-selected-list"
    );

    // grab all unselected and put a <li> avatar in unselected-list
    assoc_build_avatars(
        _assoc_select_tag + " option:not(:selected)", 
        assoc_unselected_avatar, 
        "#assoc-unselected-list"
    );

});

