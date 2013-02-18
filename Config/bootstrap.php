<?php
/**
 * Component
 *
 * This plugin's component will be loaded in ALL (*) controllers.
 */
	Croogo::hookComponent('*', 'Sliders.Sliders');

/**
 * Helper
 *
 * This plugin's helper will be loaded in ALL (*) NodesController.
 */
	Croogo::hookHelper('*', 'Sliders.Slider');

/**
 * Admin Menu
 *
 * Add navigation links to the admin menu.
 */
 	CroogoNav::add('extensions.children.sliders', array(
    'title' => __('Sliders'),
    'url' => array(
			'plugin' => 'sliders',
			'controller' => 'sliders',
			'action' => 'index',
		),
    'access' => array('admin'),
    'children' => array(
	    'sliders' => array(
				'title' => __('Sliders'),
				'url' => array(
					'plugin' => 'sliders',
					'controller' => 'sliders',
					'action' => 'index',
				),
				'weight' => 1,
			),
			'libraries' => array(
				'title' => __('Libraries'),
				'url' => array(
					'plugin' => 'sliders',
					'controller' => 'slider_libraries',
					'action' => 'index',
				),
				'weight' => 2,
			),
		),
  ));