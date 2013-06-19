<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Sliders'), array('controller' => 'sliders', 'action' => 'index'))
	->addCrumb(__d('croogo', 'Libraries'), $this->here);

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
	foreach ($sliderLibraries as $library) :
		$actions = array();
		$actions[] = $this->Croogo->adminRowActions($library['SliderLibrary']['id']);
		$actions[] = $this->Croogo->adminRowAction('',
			array('action' => 'edit', $library['SliderLibrary']['id']),
			array('icon' => 'pencil', 'tooltip' => __d('croogo', 'Edit this item'))
		);
		$actions[] = $this->Croogo->adminRowAction('',
			array('action' => 'delete', $library['SliderLibrary']['id']),
			array('icon' => 'trash', 'tooltip' => __d('croogo', 'Remove this item')),
			__d('croogo', 'Are you sure?'));
		$actions = $this->Html->div('item-actions', implode(' ', $actions));
		$rows[] = array(
			$library['SliderLibrary']['id'],
			$library['SliderLibrary']['name'],
			$library['SliderLibrary']['description'],
			$actions,
		);
	endforeach;

	echo $this->Html->tableCells($rows);
?>
</table>
