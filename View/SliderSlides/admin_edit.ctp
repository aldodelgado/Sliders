<?php
$this->extend('/Common/admin_edit');
$this->set('className', 'slider_slides');
?>
<?php
	echo $this->Form->create('SliderSlide');
?>
<fieldset>
	<div class="tabs">
		<ul>
			<li><a href="#slider-main"><span><?php echo __('Slider'); ?></span></a></li>
		</ul>

		<div id="slider-main">
		<?php
			echo $this->Form->input('id', array());
			echo $this->Form->input('slider_id', array('type'=>'hidden'));
			echo $this->Form->input('name', array());
			echo $this->Form->input('description', array());
			echo $this->Form->input('content', array());
			echo $this->Form->input('status', array());
		?>
		</div>
	</div>
</fieldset>

<div class="buttons">
<?php
	echo $this->Form->end(__('Save'));
	echo $this->Html->link(
		__('Cancel', true), 
		array('action' => 'index', $this->request->data['SliderSlide']['slider_id']), 
		array('class' => 'cancel')
	);
?>
</div>
