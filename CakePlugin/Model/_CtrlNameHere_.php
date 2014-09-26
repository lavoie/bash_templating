<?php
App::uses('_PluginNameHere_AppModel', '_PluginNameHere_.Model');

class _CtrlNameHere_ extends _PluginNameHere_AppModel {

    public function __construct($id = false, $table = null, $ds = null) {
        // ================================================================= //
        $this->name = '_CtrlNameHere_';
        $this->icon = 'fa fa-globe';
        $this->basicSearchArray = array('name'); 
        $this->displayField = 'name';


        // Describe model //
        
        $this->bt = array('_PluginNameHere_Other');
        $this->habtm = array('_PluginNameHere_Other');
        /*
        $this->virtualFields = array(
            'address_city' => 'CONCAT(_CtrlNameHere_.building_address, " ", _CtrlNameHere_.city)',
            'address_city_location' => 'CONCAT(_CtrlNameHere_.building_address, " ", _CtrlNameHere_.city, " ", _CtrlNameHere_.location_note)'
        );
        */
        $this->_schema = array(
            'name' => $this->getStrArr(50)
        );
        
        
        // Model validation //
        
        $this->validate = array(
            'name' => $this->getRuleRegEx1()
        );
        
        parent::__construct($id, $table, $ds);
    }

    protected function _txtFilterEmpty() { 
        return __d('_pluginNameHere_', '-- Filter by _CtrlNameHere_ --'); 
    }
}
