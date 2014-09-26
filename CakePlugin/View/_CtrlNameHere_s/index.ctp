<?php 
    $this->AssetCompress->addCss('cominar_row_actions.css', '__plugin_name_here__.__ctrl_name_here__.index.min.css');
    $this->AssetCompress->addScript('cominar_filter.js', '__plugin_name_here__.__ctrl_name_here__.index.min.js');
    $this->AssetCompress->addScript('cominar_postLink_confirm.js', '__plugin_name_here__.__ctrl_name_here__.index.min.js');
    
    echo $this->element('flash-box-wrapper');

    if (isset($nav) && !empty($nav)) {
        echo $this->element('_PluginNameHere_.navbar');
    }
?>
<div class="row-fluid">
    <div class="span12">

        <!-- also an ajax content section, see cominar_filter.js -->
        <div class="cominar-dynamic-content">
            <?php 
                echo $this->element('_PluginNameHere_._ctrl_name_here_s_table', array('dataset' => $dataset));
            ?>
        </div>

    </div> <!-- .span12 -->
</div> <!-- .row -->
