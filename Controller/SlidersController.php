<?php

App::uses('SlidersAppController', 'Sliders.Controller');

class SlidersController extends SlidersAppController {

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
		$this->set('title_for_layout', __('Sliders'));
		$this->Slider->recursive = 0;
		$this->set('sliders', $this->paginate());
	}

/**
 * admin_add method
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __('Add Slider'));
		if (!empty($this->data)) {
			$this->Slider->create();
			if ($this->Slider->save($this->data)) {
				$this->Session->setFlash(__('Slider has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));				
			} else {
				$this->Session->setFlash(__('Error saving slider', true), 'default', array('class' => 'error'));
			}
		}
		$this->set('sliderLibraries', $this->Slider->SliderLibrary->find('list'));
		$this->render('admin_form');
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 * @access public
 */
	public function admin_edit($id = null) {
		$this->Slider->id = $id;
		if (!$this->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Slider->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Slider has been updated'), 'default', array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error updating slider'));
			}
		} else {
			$this->set('title_for_layout', __('Edit Slider'));
			$this->request->data = $this->Slider->read(null, $id);
			
			$this->set('sliderLibraries', $this->Slider->SliderLibrary->find('list'));
		}
		$this->render('admin_form');
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