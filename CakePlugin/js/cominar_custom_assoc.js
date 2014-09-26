jQuery(document).ready(function() {

    // Eric Lavoie, 2014
    // Will work if you have a <select class="cominar-custom-assoc"></select> tag. That's it.
    // Output two "associative" lists acting like an avatar, replacing your select tag.
    // Transfer item from one list to another with a single click.
    // Use Font Awesome
    // Will not work in 'dynamic/ajax' section. Setup only once.

    // a click moving function for avatars ////
    var moving_fn = function() {
        // move to the right place
        if (jQuery(this).hasClass("cominar-selected")) {
            jQuery(this).appendTo("#cominar-unselected-list");
            jQuery(".cominar-custom-assoc option[value="+jQuery(this).val()+"]").removeAttr("selected");
        } else {
            jQuery(this).appendTo("#cominar-selected-list");
            jQuery(".cominar-custom-assoc option[value="+jQuery(this).val()+"]").attr("selected","selected");
        }
        // update status
        jQuery(this).toggleClass("cominar-selected"); 
        jQuery(this).find("i.fa").toggleClass("fa-check-square-o"); 
        jQuery(this).find("i.fa").toggleClass("fa-square-o"); 
    };    

    // setup once ///////////////////
    
    // get canevas 
    var assoc_lists = jQuery('#list-container').detach().attr('id','');
    var selected_avatar = jQuery('#selected-avatar-container').detach().attr('id','');
    var unselected_avatar = jQuery('#unselected-avatar-container').detach().attr('id','');

    // install a copy of the list in place
    jQuery(".cominar-custom-assoc").parent().append(assoc_lists.clone());
  
    // grab all selected and put a <li> avatar in selected-list
    jQuery(".cominar-custom-assoc option[selected]").each(function() {
        var ac = selected_avatar.clone();
        jQuery(ac).attr("value", jQuery(this).val());
        jQuery(ac).find(".text").text(jQuery(this).text());
        jQuery(ac).click(moving_fn).appendTo("#cominar-selected-list");
    });

    // grab all unselected and put a <li> avatar in unselected-list
    jQuery(".cominar-custom-assoc option:not(:selected)").each(function() {
        var ac = unselected_avatar.clone();
        jQuery(ac).attr("value", jQuery(this).val());
        jQuery(ac).find(".text").text(jQuery(this).text());
        jQuery(ac).click(moving_fn).appendTo("#cominar-unselected-list");
    });

});

