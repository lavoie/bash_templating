<?php
App::uses('_PluginNameHere_AppController', '_PluginNameHere_.Controller');

class _CtrlNameHere_sController extends _PluginNameHere_AppController {

    public function __construct($request = null, $response = null) {
  
        //$this->filtersBtHabtm = array('_PluginNameHere_Other');
        //$this->viewBtHabtm = array('_PluginNameHere_Other');  
        //$this->formBt = array('_PluginNameHere_Other');      
        //$this->formHabtm = array('_PluginNameHere_Other');          
        
        parent::__construct($request, $response);
    }
    
    protected function _txtDesc() { return __d('_pluginNameHere_', '_CtrlNameHere_ List'); }
    protected function _txtActionNew() { return __d('_pluginNameHere_', 'New _CtrlNameHere_'); }
}
