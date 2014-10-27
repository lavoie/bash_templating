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
                        <?php echo $this->BsHtml->icon( 'check-square-o' ); ?>&nbsp<span class="text"></span>
                    </span>
                </li>
            </ul>
        </td>
        <td>
            <ul id='assoc-unselected-list' class='assoc-list'>
                <li id="assoc-unselected-avatar-container" class='assoc-target' orderby='' value=''>
                    <span class='assoc-content'>
                        <?php echo $this->BsHtml->icon( 'square-o' ); ?>&nbsp<span class="text"></span>
                    </span>
                </li>
            </ul>
        </td>
    </tr>
</table>
