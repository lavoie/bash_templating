<div class="btn-toolbar">
    <?php
        echo $this->Html->link(
            '<i class="fa fa-arrow-left"></i> '. __d('_pluginNameHere_', 'List'),
            array('action' => 'index'),
            array('escape' => false, 'class' => 'btn btn-default')
        );
    ?>
</div>
