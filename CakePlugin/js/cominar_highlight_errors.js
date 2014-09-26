jQuery(document).ready( function() {

    // Eric Lavoie, 2014
    // Work with CakePHP 'form-error' class
    // Will not work in 'dynamic/ajax' section. Setup only once.

    jQuery("input.form-error").focus(function() {
        jQuery(this).css('background-color', 'white');
    });

});
