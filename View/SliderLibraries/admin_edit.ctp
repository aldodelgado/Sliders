<?php
$this->extend('/Common/admin_edit');
$this->set('className', 'slider_libraries');
?>
<?php
	echo $this->Form->create('SliderLibrary', array('url' => array('action' => $this->action)));
?>
<fieldset>
	<div class="tabs">
		<ul>
			<li><a href="#slider-library-main"><span><?php echo __('Slider Library'); ?></span></a></li>
		</ul>

		<div id="slider-library-main">
		<?php
			echo $this->Form->input('id', array());
			echo $this->Form->input('name', array());
			echo $this->Form->input('description', array());
		?>
		</div>
	</div>
</fieldset>

<div class="buttons">
<?php
	echo $this->Form->end(__('Save'));
	echo $this->Html->link(
		__('Cancel', true), 
		array('action' => 'index'), 
		array('class' => 'cancel')
	);
?>
</div>