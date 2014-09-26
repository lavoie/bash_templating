jQuery(document).on("ready DOMNodeInserted", function() {

    // Eric Lavoie, 2014
    // Work with base.js confirmBox function, AND Cake "Form->postLink" 
    // Use 'class' => 'cominar-postLink-confirm' in Form->postLink options.
    // If you want a confirm msg, use 'cominar-msg' => __d('p', 'delete %s ?', your_var) 

    jQuery('.cominar-postLink-confirm').each(function() {
        var msg = jQuery(this).attr("cominar-msg");
        var submit = jQuery(this).attr("onclick");
        if (submit.indexOf("confirmBox") == -1) {
            submit = submit.substring(0,submit.indexOf(";")+1);
            jQuery(this).attr("onclick","confirmBox('"+msg+"',function(v,o){if(v===1){"+submit+"} event.returnValue=false;return false;});");
        }
    });
});
