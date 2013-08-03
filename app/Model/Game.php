<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class Game extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $useTable = 'game';
    public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
}
