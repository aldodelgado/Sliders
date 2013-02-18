<?php

App::uses('SlidersAppModel', 'Sliders.Model');

class Slider extends SlidersAppModel {

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
		'alias' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The alias has already been taken.',
				'last' => true,
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This alias cannot be left blank.',
				'last' => true,
			),
		),
	);
	
/**
 * Model associations: belongsTo
 *
 * @var array
 * @access public
 */
	public $belongsTo = array(
		'SliderLibrary' => array(
			'className' => 'Sliders.SliderLibrary',
			'foreignKey' => 'slider_library_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
	);

/**
 * Model associations: hasMany
 *
 * @var array
 * @access public
 */
	public $hasMany = array(
		'SliderSlide' => array(
			'className' => 'Sliders.SliderSlide',
			'foreignKey' => 'slider_id',
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