<table id="assoc-lists-container" class='assoc-two-lists'>
    <tr>
        <th><?php echo __d('core', 'IN'); ?></th>
        <th><?php echo __d('core', 'OUT'); ?></th>
    </tr>
    <tr>
        <td>
            <ul id='assoc-selected-list' class='assoc-list'>
                <li id="assoc-selected-avatar-container" class='assoc-target assoc-selected' orderby='' value=''>
                    <span class='assoc-content'>
                        <i class='fa fa-check-square-o'></i>&nbsp<span class="text"></span>
                    </span>
                </li>
            </ul>
        </td>
        <td>
            <ul id='assoc-unselected-list' class='assoc-list'>
                <li id="assoc-unselected-avatar-container" class='assoc-target' orderby='' value=''>
                    <span class='assoc-content'>
                        <i class='fa fa-square-o'></i>&nbsp<span class="text"></span>
                    </span>
                </li>
            </ul>
        </td>
    </tr>
</table>

<?php
    $p = $this->request->params['plugin'] . '.';
    $c = $this->request->params['controller'] . '.';
    $a = $this->request->params['action'] . '.min.';
    $this->AssetCompress->addCss('cominar_custom_assoc.css', $p.$c.$a.'css');
    $this->AssetCompress->addScript('cominar_custom_assoc.js', $p.$c.$a.'js');
