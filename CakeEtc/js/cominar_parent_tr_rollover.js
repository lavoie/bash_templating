jQuery(document).ready(function() {

    // Eric Lavoie, 2014
    // Use class 'cominar-parent-tr-rollover' on a tag within a <tr> tag.
    // Ex: <tr> <td>1</td> <td><div class="cominar-parent-tr-rollover">2</div></td> </tr>
    // Will add and remove class 'cominar-line-hover' on <tr> tag.

    jQuery(document).on('mouseenter', '.cominar-parent-tr-rollover', function() { 
        jQuery(this).parents('tr').addClass("cominar-line-hover");
    });
    
    jQuery(document).on('mouseleave', '.cominar-parent-tr-rollover', function() { 
        jQuery(this).parents('tr').removeClass("cominar-line-hover");
    });

});
