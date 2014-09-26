<?php 
    echo $this->element('flash-box-wrapper'); 
?>
<div class="row-fluid">
    <div class="span12">
        <table class="table table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <th><?php echo __d('_pluginNameHere_', 'Other'); ?></th>
                    <td><?php echo $dataset['_PluginNameHere_Other']['name']; ?></td>
                </tr>
                <tr>
                    <th><?php echo __d('_pluginNameHere_', 'Name'); ?></th>
                    <td><?php echo $dataset['_CtrlNameHere_']['name']; ?></td>
                </tr>    
                <tr>
                    <th><?php echo __d('_pluginNameHere_', 'Other'); ?></th>
                    <td>
                        <?php 
                            foreach ($dataset['_PluginNameHere_Other'] as $row) {
                                echo $row['name'] . '<br/>'; 
                            }
                        ?>
                    </td>
                </tr>    
            </tbody>
        </table>
        <?php echo $this->element('_PluginNameHere_.view_back_to_index_link'); ?>
    </div> <!-- .span12 -->
</div> <!-- .row -->
