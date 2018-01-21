<?php
App::uses('AppModel', 'Model');
/**
 * Email Model
 *
 */
class Email extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'notEmpty' => array('rule' => 'notEmpty'),
			'unique'   => array('rule' => 'isUnique')
		),
	);
}
