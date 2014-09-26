<?php 
  $searchValue = (isset($searchValue)) ? $searchValue : ''; 
  $searchPlaceholder = (isset($searchPlaceholder)) ? $searchPlaceholder : __d('core',  'filter by keyword' ); 
  $formOptions = array( 'class' => 'navbar-form pull-left' );
  if (isset($formAttributes)) {
    foreach($formAttributes as $singleAttrName => $singleAttrValue) {
      $formOptions[$singleAttrName] = $singleAttrValue;
    }
  }
?>

<div class="navbar table-navbar">
    <?php if (isset($navbarHeader)): ?>
        <div class="header span6"><?php echo $this->element($navbarHeader); ?></div>
    <?php endif; ?>

    <div>
        <?php if ((isset($filters) && !empty($filters)) || (isset($search_action) && !empty($search_action))): ?>
            <?php echo $this->form->create( 'Filter', $formOptions ); ?>

            <?Php if (isset($filters) && !empty($filters)): ?>
                <?php foreach( $filters as $filter ): ?>
                        <?php echo $filter; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            
            <?php if (isset($search_action) && !empty($search_action)): ?>
                <div class="input-prepend">
                <span class="add-on fa fa-search"></span>
                <input id="cominarAction" type="hidden" data-plugin="<?php echo $search_action['plugin'] ?>" data-ctrl="<?php echo $search_action['controller'] ?>" data-action="<?php echo $search_action['action'] ?>" data-hidden="true" />
                <?php echo $this->Form->input('FilterSearch', array(
                    'placeholder' => $searchPlaceholder,
                    'label' => false,
                    'action' => $search_action,
                    'div' => false
                ) ); ?>

                </div> <!-- .input-prepend -->
            <?php endif; ?>

            <button id="btnFilter" class="btn btn-primary"><i class="fa fa-filter"></i> <?php echo __d('core',  'Filter' ); ?></button>
            <button id="btnClearFilters" class="btn btn-default"><i class="fa fa-times"></i> <?php echo __d('core',  'Clear filters' ); ?></button>
            <?php echo $this->form->end(); ?>
        <?php endif; ?>

        <?php if( isset( $actions ) && !empty( $actions ) ): ?>
            <div class="btn-toolbar pull-right">
                <?php foreach( $actions as $action ): ?>
                    <?php echo $action; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div> <!-- .navbar -->
