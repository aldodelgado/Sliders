<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Sliders'), $this->here);

?>
<table class="table table-striped">
<?php
	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id', __d('croogo', 'Id')),
		$this->Paginator->sort('name', __d('croogo', 'Name')),
		$this->Paginator->sort('description', __d('croogo', 'Description')),
		$this->Paginator->sort('slider_library_id', __d('croogo', 'Library')),
		$this->Paginator->sort('slide_count', __d('croogo', 'Slide Count')),
		__d('croogo', 'Actions'),
	));
?>
	<thead>
		<?php echo $tableHeaders; ?>
	</thead>
<?php

	$rows = array();
	foreach ($sliders as $slider) :
		$actions = array();
		$actions[] = $this->Croogo->adminRowAction('',
			array('controller' => 'slider_slides', 'action' => 'index', $slider['Slider']['id']),
			array('icon' => 'zoom-in', 'tooltip' => __d('croogo', 'View slides'))
		);
		$actions[] = $this->Croogo->adminRowActions($slider['Slider']['id']);
		$actions[] = $this->Croogo->adminRowAction('',
			array('action' => 'edit', $slider['Slider']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
		);
		$actions[] = $this->Croogo->adminRowAction('',
			array('action' => 'delete', $slider['Slider']['id']),
			array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
			__d('croogo', 'Are you sure?'));
		$actions = $this->Html->div('item-actions', implode(' ', $actions));
		$rows[] = array(
			$slider['Slider']['id'],
			$this->Html->link($slider['Slider']['name'], array('controller' => 'slider_slides', 'action' => 'index', $slider['Slider']['id'])),	
			substr(trim(strip_tags($slider['Slider']['description'])), 0, 100),
			$slider['SliderLibrary']['name'],
			$slider['Slider']['slide_count'],
			$actions,
		);
	endforeach;

	echo $this->Html->tableCells($rows);
?>
</table>
