<ul class="nav nav-pills pull-right">
<?php 
    // This is designed this way because it can be modified by ctrl code, if needed.
    foreach ($utilities as $u) { 
?> 
        <li class="">
        <?php
            echo $this->Html->link(
                '<i class="'.$u['icon'].'"></i> '.$u['label'],
                $u['action'],
                array('escape' => false, 'title' => $u['label'])
            ); 
        ?>
        </li>
<?php 
    } 
?>
</ul>
