<?php
App::uses('AppController', 'Controller');

class _PluginNameHere_AppController extends AppController {
    
    public $helpers = array('Html', 'Form');
    public $components = array('Security');

    // ------------------------------>  // some config / final const data for app
    public $actionIndex = array('action' => 'index');      
    public $parRecallDefault = array('search');
    public $utilityMenu = array();      // main menu
    public $modeAdd = array();          // form mode Add
    public $modeEdit = array();         // form mode Edit

    // ------------------------------>  // action/view config arrays (@see child classes)
    public $navDefault = array();       // a pattern for each controller navbar
    public $navAct = array();           // navbar actions matrix for each controller
    public $rowAct = array();           // standard row actions for each controller
    public $filtersBtHabtm = array();   // index filters belongsTo and habtm relationships
    public $viewBtHabtm = array();      // view belongsTo and habtm relationships
    public $formBt = array();           // form (edit/add) belongsTo relationships
    public $formHabtm = array();        // form (edit/add) habtm relationships

    public function __construct($request = null, $response = null) {

        $this->_setDefault();
        $this->_setUtilityMenu();
        $this->_setConfigArrays();

        parent::__construct($request, $response);
    }
    
    private function _setDefault() {
        // ================================================================= //
        $this->navDefault = array(
            array(
                'btnIcon' => 'fa fa-plus',
                'btnLabel' => $this->_txtActionNew(),
                'redirectArr' => array('action' => 'add')
            )
        );
        // row actions classes : no class mean that the action IS available
        $this->rowAct = array('view' => '', 'edit' => '', 'delete' => '');
    }

    private function _setUtilityMenu() {
        // ================================================================= //
        $this->utilityMenu = array(
            array(
                'icon' => 'fa fa-globe',
                'label' => $this->_txtBtn_CtrlNameHere_(),
                'action' => array('controller' => '_ctrl_name_here_s', 'action' => 'index') 
            )
        );
    }

    private function _setConfigArrays() {
        // ================================================================= //
        $this->modeAdd = array(
            'form_mode' => MODE_ADD,
            'btn_icon' => 'fa fa-plus',
            'btn_label' => $this->_txtAddBtn()
        );
        $this->modeEdit = array(
            'form_mode' => MODE_EDIT,
            'btn_icon' => 'fa fa-pencil',
            'btn_label' => $this->_txtEditBtn()
        );
    }


    // i18n //

    protected function _txtBtn_CtrlNameHere_() { return __d('_pluginNameHere_', '_CtrlNameHere_ list'); } 
    
    protected function _txtTitle() { return __d('_pluginNameHere_', '_PluginNameHere_ and IP list'); } 
    protected function _txtExForbidden() { return __d('_pluginNameHere_', 'Forbidden action. This is not an error, this is an action that is forbidden for this interface (controller).'); }
    protected function _txtExRequest() { return __d('_pluginNameHere_', 'Invalid url parameter.'); }
    protected function _txtExMethod() { return __d('_pluginNameHere_', 'HTTP Method not allowed. Access unauthorized.'); }
    protected function _txtEditSuccess() { return __d('_pluginNameHere_', 'Informations have been updated.'); }
    protected function _txtEditFail() { return __d('_pluginNameHere_', 'Unable to update record.'); }
    protected function _txtEditBtn() { return __d('_pluginNameHere_', 'Save'); }
    protected function _txtAddSuccess() { return __d('_pluginNameHere_', 'Informations have been saved.'); }
    protected function _txtAddFail() { return __d('_pluginNameHere_', 'Unable to add record.'); }
    protected function _txtAddBtn() { return __d('_pluginNameHere_', 'Add'); }
    protected function _txtDeleteSuccess($s = '') { return __d('_pluginNameHere_', 'The record - %s - has been deleted.', $s); }
    protected function _txtDeleteFail($s = '') { return __d('_pluginNameHere_', 'Unable to delete record %s.', $s); }


    // i18n should be overridden in child classes //

    protected function _txtDesc() { return ''; }
    protected function _txtActionNew() { return ''; }


    // callbacks and security //

    public function beforeFilter() {
        // ================================================================= //
        $this->Security->csrfUseOnce = true;
        $this->Security->blackHoleCallback = 'blackhole';
    }

    public function beforeRender() {
        // ================================================================= //
        $this->set('title_for_layout', $this->_txtTitle());
        $this->set('description_for_layout', $this->_txtDesc());
        $this->set('utilities', $this->utilityMenu);
        $this->set('utility_element', '_PluginNameHere_.utility_element');
    }

    public function blackhole($type) {
        // ================================================================= //
        $this->redirect($this->actionIndex);
    }
    

    // to sanitize what you receive from the url or just send exception // generic //

    protected function _send_forbidden_access() {
        // ================================================================= //
        throw new ForbiddenException($this->_txtExForbidden()); // HTTP STATUS 403
    }

    protected function _check_all_digits($value) {
        // ================================================================= //
        if (!ctype_digit($value)) {
            throw new BadRequestException($this->_txtExRequest()); // HTTP STATUS 400
        }
    }

    protected function _check_allowed_methods($http_methods) {
        // ================================================================= //
        $except = true;
        foreach ($http_methods as $method) {
            if ($this->request->is($method)) { $except = false; }
        }
        if ($except) {
            throw new MethodNotAllowedException($this->_txtExMethod()); // HTTP STATUS 405
        }
    }


    // misc // generic // 
    
    protected function _setFlashMsg($msg, $msgClass = '') {
        // ================================================================= //
        $this->Session->setFlash($msg, 'flash-box', array('class' => $msgClass));
    }
    
    protected function _redirectOrRender($bRedir, $aRedir, $strView, $aSet = array()) {
        // ================================================================= //
        if ($bRedir) {
            $this->redirect($aRedir);
        } else {
            $this->set($aSet);
            $this->render($strView);
        }
    }    


    // almost generic (low or very low context) // 

    protected function _recallAndGetFilterDataArr($mainModel, $filters = array()) {
        // ================================================================= //
        $respArr = array();
        $params_to_recall = $this->parRecallDefault;
        foreach ($filters as $model) {
            $respArr[] = $this->{$mainModel}->{$model}->getFilterArray();
            $params_to_recall[] = $this->{$mainModel}->{$model}->filterParamName;
        }    
        $this->recallFilters($params_to_recall);
        return $respArr;
    }

    protected function _addNavbar(&$arrToSet, $model, &$filters, &$baseActions, &$actions) {
        // ================================================================= //
        $arrToSet['nav']['filters'] = $this->_recallAndGetFilterDataArr($model, $filters);
        $arrToSet['nav']['actions'] = array_merge($actions, $baseActions);
    }

    protected function _addRowActions(&$arrToSet, $row_actions_config) {
        // ================================================================= //
        $arrToSet['row_actions'] = $row_actions_config; 
    }

    protected function _buildJsonResponse($elementName, $data = '', $pagination = '') {
        // ================================================================= //
        $this->layout = 'ajax';
        $this->autoRender = false;
        $ajaxV = new View($this);
        return json_encode(array(
            'content' => $ajaxV->element($elementName, $data),
            'pagination' => $pagination
        ));
    }

    protected function _setFormListNames($mainModel, $modelNames = array()) {
        // ================================================================= //
        // Name (for select tag) is set according to a convention. @see FormHelper doc.
        // Data provided by the model getList(), proudly providing your data since 1889.
        foreach ($modelNames as $model) {
            $this->set(
                Inflector::pluralize(lcfirst($model)), 
                $this->{$mainModel}->{$model}->getList()
            );
        }        
    }
    
    protected function _saveRecord($mainModel, $msgSuccess = '', $msgFail = '') {
        // ================================================================= //
        $success = $this->{$mainModel}->save($this->request->data);
        if ($success) {
            $this->_setFlashMsg($msgSuccess, BOOT_SUCCESS);
        } else {
            $this->_setFlashMsg($msgFail, BOOT_ERROR);
        }
        return $success;
    }   
    
    protected function _saveEditedRecord($mainModel, $id) {
        // ================================================================= //
        $this->{$mainModel}->id = $id;
        return $this->_saveRecord($mainModel, $this->_txtEditSuccess(), $this->_txtEditFail());
    }

    protected function _saveAddedRecord($mainModel) {
        // ================================================================= //
        $this->{$mainModel}->create();
        return $this->_saveRecord($mainModel, $this->_txtAddSuccess(), $this->_txtAddFail());
    }   
    
    protected function _deleteRecord($mainModel, $id) {
        // ================================================================= //
        $data = $this->{$mainModel}->getDisplayFieldById($id);

        if ($this->{$mainModel}->delete($id)) {
            $this->_setFlashMsg($this->_txtDeleteSuccess($data), BOOT_SUCCESS);
        } else {
            $this->_setFlashMsg($this->_txtDeleteFail($data), BOOT_ERROR);
        }
    }


    // standard actions // full context methods //

    protected function _stdIndex($filt = array(), $btns = array(), $row = array(), $pag = '') {
        // ================================================================= //
        $this->_check_allowed_methods(array(HTTP_GET));
        
        $indexV = array(); 
        $this->_addNavbar($indexV, $this->modelClass, $filt, $this->navDefault, $btns);
        $this->_addRowActions($indexV, $row);
        $indexV['dataset'] = $this->{$this->modelClass}->getStdIndex($this->passedArgs);
        
        if ($this->RequestHandler->isAJax()) {
            $elementName = '_PluginNameHere_.' . $this->modelKey . 's_table';
            return $this->_buildJsonResponse($elementName, $indexV, $pag);
        } else {
            $this->set($indexV);
        }
    }

    protected function _stdView($id = null, $contain = false) {
        // ================================================================= //
        $this->_check_allowed_methods(array(HTTP_GET));
        $this->_check_all_digits($id);
        
        $this->set('dataset', $this->{$this->modelClass}->getById($id, $contain));
    }

    protected function _stdEdit($id = null, $bt = array(), $habtm = array()) {
        // ================================================================= //
        $this->_check_allowed_methods(array(HTTP_GET, HTTP_PUT));
        $this->_check_all_digits($id);
        
        $success = false; // false (default) -> render(); true -> redirect()
        $this->_setFormListNames($this->modelClass, array_merge($bt, $habtm));

        if ($this->request->is(HTTP_GET) && !$this->request->data) {
            $this->request->data = $this->{$this->modelClass}->getById($id, $habtm);
        }

        if ($this->request->is(HTTP_PUT)) {
            $success = $this->_saveEditedRecord($this->modelClass, $id);
        }

        $this->_redirectOrRender($success, $this->actionIndex, 'form', $this->modeEdit);
    }

    protected function _stdAdd($bt = array(), $habtm = array()) {
        // ================================================================= //
        $this->_check_allowed_methods(array(HTTP_GET, HTTP_POST));
        
        $success = false; // false (default) -> render(); true -> redirect()
        $this->_setFormListNames($this->modelClass, array_merge($bt, $habtm));

        if ($this->request->is(HTTP_POST)) {
            $success = $this->_saveAddedRecord($this->modelClass);
        }
        
        $this->_redirectOrRender($success, $this->actionIndex, 'form', $this->modeAdd);
    }

    protected function _stdDelete($id = null) {
        // ================================================================= //
        $this->_check_allowed_methods(array(HTTP_DELETE));
        $this->_check_all_digits($id);

        $this->_deleteRecord($this->modelClass, $id);

        $this->redirect($this->actionIndex);
    }


    // default actions // default behaviors // @see child controllers //

    public function index() { 
        return $this->_stdIndex($this->filtersBtHabtm, $this->navAct, $this->rowAct); 
    }
        
    public function view($id = null) { 
        $this->_stdView($id, $this->viewBtHabtm); 
    }
    
    public function edit($id = null) { 
        $this->_stdEdit($id, $this->formBt, $this->formHabtm); 
    }
    
    public function add() { 
        $this->_stdAdd($this->formBt, $this->formHabtm); 
    }
    
    public function delete($id = null) { 
        $this->_stdDelete($id); 
    }
}
