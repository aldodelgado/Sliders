<?php
/**
 * Sliders Plugin Activation
 * Activation class for Sliders plugin.
 *
 * @package  Croogo
 * @version  1.4
 * @author   Paul Gardner <paul@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.webbedit.co.uk
 */
class SlidersActivation {

/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
  public function beforeActivation(&$controller) {
    return true;
  }

/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
  public function onActivation(&$controller) {
    // ACL: set ACOs with permissions
    $controller->Croogo->addAco('Sliders');
    $controller->Croogo->addAco('Sliders/admin_index');
    $controller->Croogo->addAco('Sliders/admin_add');
    $controller->Croogo->addAco('Sliders/admin_edit');
    
    $controller->Croogo->addAco('SliderSlides');
    $controller->Croogo->addAco('SliderSlides/admin_index');
    $controller->Croogo->addAco('SliderSlides/admin_add');
    $controller->Croogo->addAco('SliderSlides/admin_edit');
    
    $controller->Croogo->addAco('SliderLibraries');
    $controller->Croogo->addAco('SliderLibraries/admin_index');
    $controller->Croogo->addAco('SliderLibraries/admin_add');
    $controller->Croogo->addAco('SliderLibraries/admin_edit');
	
	  $this->_schema('create');
  }

/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
  public function beforeDeactivation(&$controller) {
    return true;
  }

/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
  public function onDeactivation(&$controller) {
    // ACL: remove ACOs with permissions
    $controller->Croogo->removeAco('Sliders'); // SlidersController ACO and it's actions will be removed
    $controller->Croogo->removeAco('SliderSlides'); // SliderSlidesController ACO and it's actions will be removed
    $controller->Croogo->removeAco('SliderLibraries'); // SliderSlidesController ACO and it's actions will be removed
	
	  $this->_schema('drop');
	}
			
/**
 * Schema
 *
 * @param string sql action
 * @return void
 * @access protected
 */
	protected function _schema($action = 'create') {
		App::uses('File', 'Utility');
		App::import('Model', 'CakeSchema', false);
		App::import('Model', 'ConnectionManager');
		$db = ConnectionManager::getDataSource('default');
		if(!$db->isConnected()) {
			$this->Session->setFlash(__('Could not connect to database.'), 'default', array('class' => 'error'));
		} else {
			CakePlugin::load('NodeExtras'); //is there a better way to do this?
			$schema =& new CakeSchema(array('name'=>'nodeExtras', 'plugin'=>'NodeExtras'));
			$schema = $schema->load();
			foreach($schema->tables as $table => $fields) {
			  if($action == 'create') {
			  	$sql = $db->createSchema($schema, $table);
			  } else {
  			  $sql = $db->dropSchema($schema, $table);
			  }
				$db->execute($sql);
			}
		}
	}
  
}