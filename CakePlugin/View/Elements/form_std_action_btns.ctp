<?php 
    if ($form_mode == MODE_EDIT) { echo $this->Form->input('id', array('type' => 'hidden')); } ?>
<div class="btn-toolbar">
    <?php
        echo $this->Form->input(
            '<i class="'. $btn_icon  .'"></i> '. $btn_label,
            array('type' => 'button', 'class' => 'btn btn-primary', 'before' => '', 'between' => '', 'after' => '')
        );
        echo $this->Html->link(
            '<i class="fa fa-times"></i> '. __d('_pluginNameHere_', 'Cancel'),
            array('action' => 'index'),
            array('escape' => false, 'class' => 'btn btn-default')
        );
    ?>
</div>

