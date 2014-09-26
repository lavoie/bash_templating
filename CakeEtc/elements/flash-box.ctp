<!-- Session->setFlash() element model 'flash-box'; use bootstrap 3; 2014-06-11 -->
<!-- CSS class available :  ['success','info','warning','danger'] -->
<div class="alert alert-<?php echo $class;?> alert-dismissable fade in">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <?php echo $message; ?>
</div>
