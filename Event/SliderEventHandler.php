<?php
/**
 * Sliders Event Handler
 *
 * PHP version 5
 *
 * @category Event
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class SliderEventHandler extends Object implements CakeEventListener {

/**
 * Event view
 *
 * @var array
 * @access public
 */
	public $view = null;

/**
 * implementedEvents
 *
 * @return array
 */
	public function implementedEvents() {
		return array(
			'Helper.Layout.afterFilter' => array(
				'callable' => 'onLayoutAfterFilter',
			),
		);
	}

/**
 * onLayoutAfterFilter
 *
 * @param CakeEvent $event
 * @return void
 */
	public function onLayoutAfterFilter($event) {
		$this->view = $event->subject(); // is there a better way to do this?
		$event->data['content'] = $this->filterSliders($event->data['content']);
	}
	
/**
 * Filter content for Sliders
 *
 * Replaces [slider:slider_alias] or [s:slider_alias] with Slider
 *
 * @param string $content
 * @return string
 */
	public function filterSliders($content) {
		preg_match_all('/\[(slider|s):([A-Za-z0-9_\-]*)(.*?)\]/i', $content, $tagMatches);
		for ($i = 0, $ii = count($tagMatches[1]); $i < $ii; $i++) {
			$regex = '/(\S+)=[\'"]?((?:.(?![\'"]?\s+(?:\S+)=|[>\'"]))+.)[\'"]?/i';
			preg_match_all($regex, $tagMatches[3][$i], $attributes);
			$menuAlias = $tagMatches[2][$i];
			$options = array();
			for ($j = 0, $jj = count($attributes[0]); $j < $jj; $j++) {
				$options[$attributes[1][$j]] = $attributes[2][$j];
			}
			$content = str_replace($tagMatches[0][$i], $this->displaySlider($menuAlias, $options), $content);
		}
		return $content;
	}
	
/**
 * Show Slider by Alias
 *
 * @param string $alias Slider alias
 * @param array $options (optional)
 * @return string
 */
	public function displaySlider($alias, $options = array()) {
		if (!isset($this->view->viewVars['sliders_for_layout'][$alias])) {
			return false;
		}
		$slider = $this->view->viewVars['sliders_for_layout'][$alias];
	
		$_options = array(
			'element' => 'slider',
			'tag' => 'div',
			'attributes' => array(),
			'id' => 'slider-' . $slider['Slider']['id'],
			'slide_tag' => 'div',
			'slide_attributes' => array(),
		);
		$options = array_merge($_options, $options);
		
		$output = $this->view->element(
			$options['element'], 
			array(
				'slider' => $this->view->viewVars['sliders_for_layout'][$alias],
				'options' => $options,
			), 
			array(
				'plugin' => 'Sliders'
			)
		);
		return $output;
	}

}
