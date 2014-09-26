<?php 
    $this->AssetCompress->addCss('cominar_custom_assoc.css', '__plugin_name_here__.__ctrl_name_here__.form.min.css');
    $this->AssetCompress->addCss('cominar_highlight_errors.css', '__plugin_name_here__.__ctrl_name_here__.form.min.css');
    $this->AssetCompress->addScript('cominar_custom_assoc.js', '__plugin_name_here__.__ctrl_name_here__.form.min.js');
    $this->AssetCompress->addScript('cominar_highlight_errors.js', '__plugin_name_here__.__ctrl_name_here__.form.min.js');

    echo $this->element('cominar_custom_assoc'); 
    echo $this->element('flash-box-wrapper'); 
?>
<div class="row-fluid">
    <div class="span12">
        <?php 
            echo $this->Form->create(
                '_CtrlNameHere_', 
                array('inputDefaults' => array('class' => 'span6', 'label' => false, 'div' => false, 'between' => '<div class="controls">', 'after' => '</div>'), 'type' => 'file')
            ); 
        ?>
        <div class="well">
            <fieldset>
                <legend><?php echo __d('_pluginNameHere_', '_CtrlNameHere_ informations'); ?></legend>

                <div class="control-group">
                    <?php 
                        echo $this->Form->label('_CtrlNameHere_._pluginNameHere__other_id', __d('_pluginNameHere_', 'Material Type'), array('class' => 'control-label'));
                        echo $this->Form->input('_CtrlNameHere_._pluginNameHere__other_id'); 
                    ?>
                    <span class="help-block help-block-bold"></span>
                </div>

                <div class="control-group">
                    <?php 
                        echo $this->Form->label('_CtrlNameHere_.name', __d('_pluginNameHere_', 'Name'), array('class' => 'control-label'));
                        echo $this->Form->input('_CtrlNameHere_.name'); 
                    ?>
                    <span class="help-block"></span>
                </div>

                <div class="control-group">
                    <?php 
                        echo __d('_pluginNameHere_', 'Other list');
                        echo $this->Form->input('_PluginNameHere_Other', array('class' => 'cominar-custom-assoc')); 
                    ?>
                    <span class="help-block"></span>
                </div>
            </fieldset>
        </div> <!-- .well -->
        <?php 
            echo $this->element('_PluginNameHere_.form_std_action_btns'); 
            echo $this->Form->end(); 
        ?>
    </div> <!-- .span12 -->
</div> <!-- .row-fluid -->
