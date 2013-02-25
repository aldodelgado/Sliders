<?php

App::uses('Component', 'Controller');

/**
 * Sliders Component
 *
 * @category Component
 * @package  Croogo
 * @version  1.0
 * @author   Paul Gardner <paul@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.webbedit.co.uk
 */
class SlidersComponent extends Component {
  
/**
 * Enabled
 *
 * @var boolean
 * @access public
 */
  public $enabled = true;
  
/**
 * Components
 *
 * @var array
 * @access public
 */
  public $components = array('Croogo');
  
/**
 * Blocks for layout
 *
 * @var string
 * @access public
 */
  public $sliders_for_layout = array();
  
/**
 * javascript files component will be using
 *
 * @var array
 */
  public $javascript = array();
  
/**
 * CSS files component will be using
 *
 * @var array
 */
 public $css = array();
 
/**
* Blocks data: contains parsed value of bb-code like strings
*
* @var array
* @access public
*/
 	public $blocksData = array(
 		'sliders' => array(),
 	);

/**
 * Startup
 *
 * @param object $controller instance of controller
 * @return void
 */
  public function startup(&$controller) {
    $this->controller = $controller;
    $this->controller->uses[] = "Sliders.Slider";
    if (!isset($this->controller->params['admin']) && !isset($this->controller->params['requested']) && $this->enabled) {
      $this->controller->helpers[] = 'Sliders.Slider';
      $this->processBlocksData($this->Croogo->blocks_for_layout);
      $this->sliders();
    }
  }

/**
 * beforeRender
 *
 * @param object $controller instance of controller
 * @return void
 */
  public function beforeRender(&$controller) {
    if($this->enabled) {
      $this->controller = $controller;
      
  		$this->javascript = array_unique(array_filter($this->javascript));
  		$this->css = array_unique(array_filter($this->css));
  		
			$controller->set(array(
				'sliders_for_layout' => $this->sliders_for_layout,
				'slidersJs' => $this->javascript,
				'slidersCss' => $this->css,
				'blocks_for_layout' => $this->Croogo->blocks_for_layout
			));
    }
  }

/**
 * Process blocks for bb-code like strings
 * Modified version of CroogoComponent::processBlocksData()
 *
 * @param array $regions (CroogoComponent::blocks_for_layout)
 * @return void
 */
	public function processBlocksData($regions) {
		foreach ($regions as $blocks) {
			foreach ($blocks as $block) {
				$this->blocksData['sliders'] = Set::merge(
					$this->blocksData['sliders'], 
					$this->Croogo->parseString('slider|s', $block['Block']['body'], array(
						'convertOptionsToArray' => true
					))
				);
			}
		}
	}
  
/**
 * Sliders
 *
 * Sliders will be available in this variable in views: $sliders_for_layout
 *
 * @return void
 */
	public function sliders() {
		$sliders = array();
		$themeData = $this->Croogo->getThemeData(Configure::read('Site.theme'));
		if (isset($themeData['sliders']) && is_array($themeData['sliders'])) {
			$sliders = Set::merge($sliders, $themeData['sliders']);
		}
		$sliders = Set::merge($sliders, array_keys($this->blocksData['sliders']));

		foreach ($sliders as $alias) {
			$slider = $this->controller->Slider->find('first', array(
				'conditions' => array(
					'Slider.status' => 1,
					'Slider.alias' => $alias,
					'Slider.slide_count >' => 0,
				),
				'contain' => array(
					'SliderLibrary',
					'SliderSlide' => array(
						'conditions' => array(
							'SliderSlide.status' => 1,
						),
						'order' => array(
							'SliderSlide.lft' => 'ASC',
						)
					)
				),
				'cache' => array(
					'name' => 'croogo_slider_' . $alias,
					'config' => 'croogo_blocks', // uses default cache config
				)
			));
			if (isset($slider['Slider']['id'])) {
				$this->sliders_for_layout[$alias] = $slider;
				
				if($slider['SliderLibrary']['css'] && explode(PHP_EOL, $slider['SliderLibrary']['css'])) {
					$this->css = array_merge($this->css, explode(PHP_EOL, $slider['SliderLibrary']['css']));
				}
				if($slider['SliderLibrary']['js'] && explode(PHP_EOL, $slider['SliderLibrary']['js'])) {
					$this->javascript = array_merge($this->javascript, explode(PHP_EOL, $slider['SliderLibrary']['js']));
				}
			}
		}
	}
    
}
