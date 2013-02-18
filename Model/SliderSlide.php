<?php

App::uses('SlidersAppModel', 'Sliders.Model');

class SliderSlide extends SlidersAppModel {

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
		'name' => array(
			'content' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank.',
				'last' => true,
			),
		),
	);
	
/**
 * Behaviors used by the Model
 *
 * @var array
 * @access public
 */
	public $actsAs = array(
		'Containable',
		'Tree',
		'Cached' => array(
			'prefix' => array(
				'slide_',
				'slides_',
				'croogo_slides_',
				'croogo_slider_'
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
		'Slider' => array(
			'className' => 'Sliders.Slider',
			'foreignKey' => 'slider_id',
			'counterCache' => 'slide_count',
		),
	);

}