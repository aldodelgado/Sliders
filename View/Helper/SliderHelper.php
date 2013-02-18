<?php
App::uses('AppHelper', 'View/Helper');

/**
 * Slider: Helper
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Paul Gardner <paul@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.firecreek.co.uk
 */
class SliderHelper extends AppHelper {
	
/**
 * beforeRender
 *
 */
	public function beforeRender() {
		if (isset($this->_View->viewVars['slidersCss']) && !empty($this->_View->viewVars['slidersCss'])) {
			$this->_View->Html->css($this->_View->viewVars['slidersCss'], null, array('inline'=>false));
		}
		if (isset($this->_View->viewVars['slidersJs']) && !empty($this->_View->viewVars['slidersJs'])) {
			$this->_View->Html->script($this->_View->viewVars['slidersJs'], array('inline'=>false));
		}
	}

/**
 * Show Slider by Alias
 *
 * @param string $menuAlias Menu alias
 * @param array $options (optional)
 * @return string
 */
	public function display($alias, $options = array()) {
		if (!isset($this->_View->viewVars['sliders_for_layout'][$alias])) {
			return false;
		}
		$slider = $this->_View->viewVars['sliders_for_layout'][$alias];
	
		$_options = array(
			'element' => 'slider',
			'tag' => 'div',
			'attributes' => array(),
			'id' => 'slider-' . $slider['Slider']['id'],
			'slide_tag' => 'div',
			'slide_attributes' => array(),
		);
		$options = array_merge($_options, $options);
		
		$output = $this->_View->element(
			$options['element'], 
			array(
				'slider' => $this->_View->viewVars['sliders_for_layout'][$alias],
				'options' => $options,
			), 
			array(
				'plugin' => 'Sliders'
			)
		);
		return $output;
	}
  
}