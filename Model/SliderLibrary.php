<?php

App::uses('SlidersAppModel', 'Sliders.Model');

class SliderLibrary extends SlidersAppModel {

/**
 * Validation
 *
 * @var array
 */
  var $validate = array(
		'name' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The name has already been taken.',
				'last' => true,
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.',
				'last' => true,
			),
		),
	);

/**
 * Model associations: hasMany
 *
 * @var array
 * @access public
 */
	public $hasMany = array(
		'Slider' => array(
			'className' => 'Sliders.Slider',
			'foreignKey' => 'slider_library_id',
			'dependent' => true,
			'conditions' => array(),
			'fields' => '',
			'order' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
		),
	);

}