<?php

App::uses('SlidersAppController', 'Sliders.Controller');

class SliderSlidesController extends SlidersAppController {

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
	public function admin_index($slider_id = null) {
		$this->SliderSlide->Slider->id = $slider_id;
		if (!$this->SliderSlide->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}
		
		$this->set('title_for_layout', __('Slides: ') . $this->SliderSlide->Slider->field('name'));
		$this->SliderSlide->recursive = 0;
		$this->paginate = array(
      'conditions' => array('SliderSlide.slider_id' => $slider_id),
      'limit' => 10,
      'order' => 'SliderSlide.lft'
    );
		$this->set(array(
			'slides' => $this->paginate(),
			'slider_id' => $slider_id,
			'slider' => $this->SliderSlide->Slider->field('name')
		));
	}

/**
 * admin_add method
 *
 * @return void
 * @access public
 */
	public function admin_add($slider_id = null) {
		$this->SliderSlide->Slider->id = $slider_id;
		if (!$this->SliderSlide->Slider->exists()) {
			throw new NotFoundException(__('Invalid slider'));
		}
		
		$this->set('title_for_layout', __('Add Slide: ') . $this->SliderSlide->Slider->field('name'));
		if (!empty($this->data)) {
			$this->SliderSlide->create();
			$this->SliderSlide->Behaviors->attach('Tree', array(
				'scope' => array(
					'SliderSlide.slider_id' => $this->request->data['SliderSlide']['slider_id'],
				),
			));
			if ($this->SliderSlide->save($this->data)) {
				$this->Session->setFlash(__('Slide has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index', $this->request->data['SliderSlide']['slider_id']));				
			} else {
				$this->Session->setFlash(__('Error saving slide', true), 'default', array('class' => 'error'));
			}
		} else {
			$this->request->data['SliderSlide']['slider_id'] = $slider_id;
			$this->set(array(
			  'title_for_layout' => __('Add Slide: ') . $this->SliderSlide->Slider->field('name'),
			  'slider' => $this->SliderSlide->Slider->field('name')
			));
		}
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
		$this->SliderSlide->id = $id;
		if (!$this->SliderSlide->exists()) {
			throw new NotFoundException(__('Invalid slide'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->SliderSlide->Behaviors->attach('Tree', array(
				'scope' => array(
					'SliderSlide.slider_id' => $this->request->data['SliderSlide']['slider_id'],
				),
			));
			if ($this->SliderSlide->saveAll($this->request->data)) {
				$this->Session->setFlash(__('Slide has been updated'), 'default', array('class'=>'success'));
				$this->redirect(array('action' => 'index', $this->request->data['SliderSlide']['slider_id']));
			} else {
				$this->Session->setFlash(__('Error updating slide'));
			}
		} else {
			$this->request->data = $this->SliderSlide->read(null, $id);
			
			$this->SliderSlide->Slider->id = $this->request->data['SliderSlide']['slider_id'];
			$this->set(array(
			  'title_for_layout' => __('Edit Slide: ') . $this->SliderSlide->Slider->field('name'),
			  'slider' => $this->SliderSlide->Slider->field('name')
			));
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
		$this->SliderSlide->id = $id;
		if (!$this->SliderSlide->exists()) {
			throw new NotFoundException(__('Invalid slide'));
		}
		
		$slider_id = $this->SliderSlide->field('slider_id');
		$this->SliderSlide->Behaviors->attach('Tree', array(
			'scope' => array(
				'SliderSlide.slider_id' => $slider_id,
			),
		));
		if ($this->SliderSlide->delete()) {
			$this->Session->setFlash(__('Slide deleted'), 'default', array('class'=>'success'));
		} else {
			$this->Session->setFlash(__('Slide was not deleted'));
		}
		$this->redirect(array('action' => 'index', $slider_id));
	}
		
/**
 * Admin moveup
 *
 * @param integer $id
 * @param integer $step
 * @return void
 * @access public
 */
	public function admin_moveup($id, $step = 1) {
		$slide = $this->SliderSlide->findById($id);
		if (!isset($slide['SliderSlide']['id'])) {
			$this->Session->setFlash(__('Invalid id for slide'), 'default', array('class' => 'error'));
			$this->redirect(array(
				'action' => 'index',
			));
		}
		$this->SliderSlide->Behaviors->attach('Tree', array(
			'scope' => array(
				'SliderSlide.slider_id' => $slide['SliderSlide']['slider_id'],
			),
		));
		if ($this->SliderSlide->moveUp($id, $step)) {
			$this->Session->setFlash(__('Moved up successfully'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('Could not move up'), 'default', array('class' => 'error'));
		}
		$this->redirect(array('action' => 'index', $slide['SliderSlide']['slider_id']));
	}

/**
 * Admin movedown
 *
 * @param integer $id
 * @param integer $step
 * @return void
 * @access public
 */
	public function admin_movedown($id, $step = 1) {
		$slide = $this->SliderSlide->findById($id);
		if (!isset($slide['SliderSlide']['id'])) {
			$this->Session->setFlash(__('Invalid id for slide'), 'default', array('class' => 'error'));
			$this->redirect(array(
				'action' => 'index',
			));
		}
		$this->SliderSlide->Behaviors->attach('Tree', array(
			'scope' => array(
				'SliderSlide.slider_id' => $slide['SliderSlide']['slider_id'],
			),
		));
		if ($this->SliderSlide->moveDown($id, $step)) {
			$this->Session->setFlash(__('Moved down successfully'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('Could not move down'), 'default', array('class' => 'error'));
		}
		$this->redirect(array('action' => 'index', $slide['SliderSlide']['slider_id']));
	}

}