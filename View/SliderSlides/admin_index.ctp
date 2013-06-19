<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Sliders'), array('controller' => 'sliders', 'action' => 'index'))
	->addCrumb($slider, $this->here);

?>

<?php $this->start('actions'); ?>
<?php
	echo $this->Croogo->adminAction(
		__d('croogo', 'New Slide'),
		array('action' => 'add', $slider_id),
		array('button' => 'success')
	);
?>
<?php $this->end(); ?>

<?php
	if (isset($this->params['named'])) {
		foreach ($this->params['named'] as $nn => $nv) {
			$this->Paginator->options['url'][] = $nn . ':' . $nv;
		}
	}
?>
	
<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id', __d('croogo', 'Id')),
		$this->Paginator->sort('name', __d('croogo', 'Name')),
		$this->Paginator->sort('description', __d('croogo', 'Description')),
		__d('croogo', 'Actions'),
	));
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>
<?php

	$rows = array();
	foreach ($slides as $slide) :
		$actions = array();
  	$actions[] = $this->Croogo->adminRowAction('',
  		array('action' => 'moveup', $slide['SliderSlide']['id']),
  		array('icon' => 'chevron-up', 'tooltip' => __d('croogo', 'Move up'))
  	);
  	$actions[] = $this->Croogo->adminRowAction('',
  		array('action' => 'movedown', $slide['SliderSlide']['id']),
  		array('icon' => 'chevron-down', 'tooltip' => __d('croogo', 'Move down'))
  	);
		$actions[] = $this->Croogo->adminRowActions($slide['SliderSlide']['id']);
		$actions[] = $this->Croogo->adminRowAction('',
			array('action' => 'edit', $slide['SliderSlide']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
		);
		$actions[] = $this->Croogo->adminRowAction('',
			array('action' => 'delete', $slide['SliderSlide']['id']),
			array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
			__d('croogo', 'Are you sure?'));
		$actions = $this->Html->div('item-actions', implode(' ', $actions));
		$rows[] = array(
			$slide['SliderSlide']['id'],
			$slide['SliderSlide']['name'],
			substr(trim(strip_tags($slide['SliderSlide']['description'])), 0, 100),
			$actions,
		);
	endforeach;

	echo $this->Html->tableCells($rows);
?>
</table>
