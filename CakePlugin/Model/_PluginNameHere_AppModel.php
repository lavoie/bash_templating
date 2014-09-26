<?php
App::uses('AppModel', 'Model');

class _PluginNameHere_AppModel extends AppModel {

    public $actsAs = array('Containable');
    public $recursive = -1;
    public $filterParamPrefix = 'Filter';
    public $filterParamName = '';       
    public $btFields = array();
    public $habtmJoins = array();


    // should be overridden by child class //
    
    public $icon = 'fa fa-globe';
    public $basicSearchArray = array('id');
    public $hm = array(); 
    public $bt = array(); 
    public $habtm = array(); 

    public function __construct($id = false, $table = null, $ds = null) {
        
        $this->filterParamName = $this->filterParamPrefix . $this->name; 
        
        $this->_setupRelationship($this->hasMany, $this->hm);
        $this->_setupRelationship($this->belongsTo, $this->bt);
        $this->_setupRelationship($this->hasAndBelongsToMany, $this->habtm);
        
        parent::__construct($id, $table, $ds);
        
        $this->_buildBtFields();
        $this->_buildHabtmJoins();
    }

    private function _setupRelationship(& $rel, & $lst) {
        // ================================================================= //
        foreach ($lst as $m) { $rel[$m] = array('className' => '_PluginNameHere_.' . $m); }
    }    
    
    private function _buildBtFields() {
        // ================================================================= //
        foreach($this->belongsTo as $model => $data) {    
            $this->btFields[$this->filterParamPrefix.$model] = $this->name.'.'.$data['foreignKey'];
        }
    }    

    private function _buildHabtmJoins() {
        // ================================================================= //
        foreach ($this->hasAndBelongsToMany as $model => $data) {    
            $this->habtmJoins[$this->filterParamPrefix.$model] = array(
                'table' => $data['joinTable'],
                'type' => 'INNER',
                'conditions' => array(
                    $data['joinTable'].'.'.$data['associationForeignKey'].' = ',
                    $data['joinTable'].'.'.$data['foreignKey'].' = '.$this->name.'.id'
                )
            );
        }
    }


    // i18n //

    protected function _txtRegEx1() { return __d('_pluginNameHere_', 'Only alphanumeric, dot, coma, single quote, space or dash allowed.'); }
    protected function _txtRegEx2() { return __d('_pluginNameHere_', 'Only alphanumeric, dot, coma, underscore, space or dash allowed.'); }
    protected function _txtRegEx3() { return __d('_pluginNameHere_', 'Only digit, dot, or semicolon allowed.'); }
    protected function _txtExFoundFalse() { return __d('_pluginNameHere_', 'The database request failed. Please contact the software manager.'); }
    protected function _txtExFoundZero() { return __d('_pluginNameHere_', 'This resource was not found in the database. If you think this is a broken link (application bug), please contact the software manager.'); }


    // i18n should be overridden in child classes //

    protected function _txtFilterEmpty() { return ''; }


    // to check query results // generic //

    public function check_false($resource) {
        // ================================================================= //
        if ($resource === false) {
            throw new NotFoundException($this->_txtExFoundFalse()); // HTTP STATUS 404
        }
    }

    public function check_count_zero($resource) {
        // ================================================================= //
        if (count($resource) === 0) {
            throw new NotFoundException($this->_txtExFoundZero()); // HTTP STATUS 404
        }
    }


    // getters //
    
    final public function getStrArr($length) {
        return array('type' => 'string', 'length' => $length);
    }
    
    final public function getRule($rule, $msg, $allowEmpty = true) {
        return array('rule' => $rule, 'message' => $msg, 'allowEmpty' => $allowEmpty);
    }
    
    final public function getRuleRegEx1() {
        return $this->getRule(REGEX_1_UTF8_SINGLE_QUOTE_, $this->_txtRegEx1());
    }
    
    final public function getRuleRegEx2() {
        return $this->getRule(REGEX_2_UTF8_UNDERSCORE_, $this->_txtRegEx2());
    }
    
    final public function getRuleRegEx3() {
        return $this->getRule(REGEX_3_DIGIT_DOT_, $this->_txtRegEx3());
    }

    public function getFilterArray() {
        // ================================================================= //
        return array(
            'field' => $this->filterParamName,
            'icon' => $this->icon,
            'empty' => $this->_txtFilterEmpty(),
            'options' => $this->getList()
        );
    }


    // to build queries // 
    
    public function getStandardSearch($args, $searchParam = null) {
        // ================================================================= //
        $resp = array();
        $searchArray = (is_null($searchParam)) ? $this->basicSearchArray : $searchParam;
        if (isset($args['search']) && !empty($args['search'])) {
            foreach ($searchArray as $field) {
                $resp[$this->name. '.' .$field. ' LIKE'] = '%' .$args['search']. '%';
            }
        }
        return $resp;
    }

    public function getBtConditions($args) {
        // ================================================================= //
        $resp = array();
        foreach($this->btFields as $filterName => $field) {
            if (isset($args[$filterName]) && !empty($args[$filterName])) {
                $resp[$field] = $args[$filterName];
            }
        }
        return $resp;
    }
    
    public function setupJoin($join, $idValue) {
        // ================================================================= //
        $resp = $join;
        $resp['conditions'][0] .= (string)$idValue; // idValue must be an integer (id)
        return $resp;
    }

    public function getHabtmJoins($args) {
        // ================================================================= //
        $resp = array();
        foreach($this->habtmJoins as $filterName => $join) {
            if (isset($args[$filterName]) && !empty($args[$filterName])) {
                $resp[] = $this->setupJoin($join, $args[$filterName]);
            }
        }
        return $resp;
    }


    // to retrieve data // half generic half context //

    public function getList() {
        // ================================================================= //
        $data = $this->find('list', array('order' => $this->displayField));
        $this->check_false($data);
        return $data;
    }

    public function getAll($conditions = array(), $joins = array()) {
        // ================================================================= //
        $data = $this->find('all', array(
            'conditions' => $conditions,
            'joins' => $joins
        ));
        $this->check_false($data);
        return $data;
    }
    
    public function getById($id, $models = false) {
        // ================================================================= //
        $key = $this->name . '.id';
        $data = $this->find('first', array(
            'contain' => $models,
            'conditions' => array($key => $id)
        ));
        $this->check_false($data);
        $this->check_count_zero($data);
        return $data;
    }

    public function getDisplayFieldById($id) {
        // ================================================================= //
        $key = $this->name . '.id';
        $field = $this->name . '.' . $this->displayField;
        $data = $this->find('first', array(
            'fields' => array($field),
            'conditions' => array($key => $id)
        ));
        $this->check_false($data);
        $this->check_count_zero($data);
        return $data[$this->name][$this->displayField];
    }    

    public function getStdIndex($args) {
        // ================================================================= //
        $conditions = $this->getBtConditions($args);
        $conditions['OR'] = $this->getStandardSearch($args); 
        $joins = $this->getHabtmJoins($args);
        
        return $this->getAll($conditions, $joins);
    }
}
