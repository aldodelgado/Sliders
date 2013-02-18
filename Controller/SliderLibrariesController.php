<?php

App::uses('SlidersAppController', 'Sliders.Controller');

class SliderLibrariesController extends SlidersAppController {

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
	}

/**
 * admin_index method
 *
 * @return void
 * @access public
 */
	public function admin_index() {
		$this->set('title_for_layout', __('Slider Libraries'));
		$this->SliderLibrary->recursive = 0;
		$this->set('sliderLibraries', $this->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __('Add Slider Library'));
		if (!empty($this->data)) {
			$this->SliderLibrary->create();
			if ($this->SliderLibrary->save($this->data)) {
				$this->Session->setFlash(__('Slider library has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));				
			} else {
				$this->Session->setFlash(__('Error saving slider library', true), 'default', array('class' => 'error'));
			}
		}
		$this->render('admin_edit');
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 * @access public
 */
	public function admin_edit($id = null) {
		$this->SliderLibrary->id = $id;
		if (!$this->SliderLibrary->exists()) {
			throw new NotFoundException(__('Invalid slider library'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SliderLibrary->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Slider library has been updated'), 'default', array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error updating slider library'));
			}
		} else {
			$this->set('title_for_layout', __('Edit Slider Library'));
			$this->request->data = $this->SliderLibrary->read(null, $id);
		}
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}

		if ($this->Project->delete()) {
			$this->Session->setFlash(__('Project deleted'), 'default', array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('Project was not deleted'));
		}
		$this->redirect(array('action' => 'index'));
	}

}