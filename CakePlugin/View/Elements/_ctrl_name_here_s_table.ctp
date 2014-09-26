<?php 
if (!empty($dataset)) { 
?>
<table class="table table-striped table-condensed table-hover">
    <thead>
        <tr>
            <th><?php echo __d('_pluginNameHere_', 'Name'); ?></th>
            <th><?php echo __d('_pluginNameHere_', 'Description'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($dataset as $row) { 
        $row_id = $row['_CtrlNameHere_']['id']; 
        $row_name = $row['_CtrlNameHere_']['name']; 
    ?>
        <tr>
            <td class="cominar-parent-tr-rollover">
                <?php
                    echo $this->Html->link(
                        $row_name,
                        array('action' => 'view', $row_id),
                        array('escape' => false)
                    );
                ?>
            </td>
            <td><?php echo $row['_CtrlNameHere_']['description']; ?></td>
            <td>
                <?php 
                    // check is disabled to improve speed: 3 checks X x rows, it's many ms
                    //if (isset($row_actions) && isset($row_name) && isset($row_id)) {
                    echo $this->element('_PluginNameHere_.row_actions', array(
                        'row_actions' => $row_actions,
                        'row_name' => $row_name, 
                        'row_id' => $row_id
                    ));
                    //} 
                ?>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>
<?php 
    echo $this->element('_PluginNameHere_.table_footer', array('count' => count($dataset)));
} else { 
?>
    <div class="well">
        <p><?php echo __d('_pluginNameHere_', 'No _CtrlNameHere_ found !'); ?></p>
    </div>
<?php 
} 
?>
