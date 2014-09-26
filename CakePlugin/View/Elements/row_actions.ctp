<div class="pull-right cominar-parent-tr-rollover">
<?php
    echo $this->Html->link(
        '<span class="fa fa-eye '. FA_SIZE .'"></span> ',
        array('action' => 'view', $row_id),
        array('class' => $row_actions['view'], 'title' => __d('_pluginNameHere_', 'View %s', $row_name), 'escape' => false)
    ); 
    echo $this->Html->link(
        '<span class="fa fa-pencil '. FA_SIZE .'"></span> ',
        array('action' => 'edit', $row_id),
        array('class' => $row_actions['edit'], 'escape' => false, 'title' => __d('_pluginNameHere_', 'Edit %s', $row_name))
    );
    echo $this->Form->postLink(
        '<span class="fa fa-times '. FA_SIZE .'"></span> ',
        array('action' => 'delete', $row_id),
        array('class' => $row_actions['delete'].' '.'cominar-postLink-confirm', 'escape' => false, 'method' => HTTP_DELETE, 'cominar-msg' => __d('_pluginNameHere_', 'Are you sure you want to erase the record - <strong>%s</strong> - ?', $row_name), 'title' => __d('_pluginNameHere_', 'Delete %s', $row_name))
    );
?>
</div>
