<?php
$navbar = array(); // navbar that fit table_navbar_gen

$navbar['search_action'] = array(
    'plugin' => $this->request->params['plugin'],
    'controller' => $this->request->params['controller'],
    'action' => $this->request->params['action']
);

foreach ($nav['filters'] as $filter) {
    $navbar['filters'][] = $this->element(
        'filter-select', 
        array_merge(array('class' => 'cominar-filter'), $filter)
    );
}

foreach ($nav['actions'] as $action) {
    $navbar['actions'][] = $this->Html->link(
        '<i class="' . $action['btnIcon'] . '"></i> ' . $action['btnLabel'],
        $action['redirectArr'],
        array('escape' => false, 'title' => $action['btnLabel'], 'class' => 'btn btn-primary')
    );
}

echo $this->element('table_navbar_gen', $navbar);
?>
