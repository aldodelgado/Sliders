<!--
	<div class="slider">
		<div id="quartumCarousel" class="carousel slide">
		  <div class="carousel-inner">
        <div class="active item">
          <div class="carousel-caption">
            <div class="w1 pull-left">
              <a href="06work-project.html"><span class="title">Project name 1</span></a>
              <span class="description">1 Sed posuere, ipsum sit amet congue viverra, mi est gravida nisl.</span>
            </div>
            <div class="w2 pull-right"><a href="06work-project.html" class="btn orange-btn">see the work</a></div>
            <div class="clearfix"></div>
          </div>
          <div class="box"><img src="/theme/quartum/img/temp-slider-1.jpg" alt="" ></div>
        </div>
        <div class="item">
          <div class="carousel-caption">
            <div class="w1 pull-left">
              <a href="06work-project.html"><span class="title">Project name 2</span></a>
              <span class="description">2 Sed posuere, ipsum sit amet congue viverra, mi est gravida nisl.</span>
            </div>
            <div class="w2 pull-right"><a href="06work-project.html" class="btn orange-btn">see the work</a></div>
            <div class="clearfix"></div>
          </div>
          <div class="box"><img src="/theme/quartum/img/temp-slider-2.jpg" alt="" ></div>
        </div>
		  </div>
			<div class="controlContainer">
			  <a class="carousel-control left" href="#quartumCarousel" data-slide="prev"></a>
			  <a class="carousel-control right" href="#quartumCarousel" data-slide="next"></a>
			</div>
		</div>
	</div>-->


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
