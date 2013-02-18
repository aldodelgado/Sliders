<<?php echo $options['tag']; ?> id="<?php echo $options['id']; ?>" class="slider">
<?php
	foreach ($slider['SliderSlide'] as $slide) {
		echo $this->element(
			'slider_slide', 
			array('slide' => $slide, 'options' => $options),
			array('plugin' => 'Sliders')
		);
	}
?>
</<?php echo $options['tag']; ?>>
