
<<?php echo $options['tag']; ?> id="<?php echo $options['id']; ?>" class="carousel slide">
  <div class="carousel-inner">
  <?php
  	foreach ($slider['SliderSlide'] as $slide) {
  		echo $this->element(
  			'slider_slide_carousel_bootstrap', 
  			array('slide' => $slide, 'options' => $options),
  			array('plugin' => 'Sliders')
  		);
  	}
  ?>
  </div>
  <div class="controlContainer">
    <a class="carousel-control left" href="#<?php echo $options['id']; ?>" data-slide="prev"></a>
    <a class="carousel-control right" href="#<?php echo $options['id']; ?>" data-slide="next"></a>
  </div>
</<?php echo $options['tag']; ?>>
