<?php
$this->extend('/Common/admin_index');
$this->name = 'sliders';
?>

<?php $this->start('tabs'); ?>
<li><?php
echo $this->Html->link(__('Add Slider'), array(
	'controller' => 'sliders',
	'action' => 'add',
));
?></li>
<?php $this->end(); ?>

<?php if (count($sliders) > 0): ?>
	<table cellpadding="0" cellspacing="0">
	<?php
		$tableHeaders = $this->Html->tableHeaders(array(
			'',
			__('Id'),
			__('Name'),
			__('Description'),
			__('Library'),
			__('Slide Count'),
			__('Actions'),
		));
		echo $tableHeaders;

		$rows = array();
		foreach ($sliders as $slider) {
			$actions  = $this->Html->link(__('View Slides'), array(
				'controller' => 'slider_slides',
				'action' => 'index',
				$slider['Slider']['id'],
			));
			$actions  .= $this->Html->link(__('Edit'), array(
				'action' => 'edit',
				$slider['Slider']['id'],
			));
			$actions .= ' ' . $this->Form->postLink(__('Delete'), array(
				'action' => 'delete',
				$slider['Slider']['id'],
			), null, __('Are you sure?'));
			
			$rows[] = array(
				'',
				$slider['Slider']['id'],
				$slider['Slider']['name'],
				substr(trim(strip_tags($slider['Slider']['description'])), 0, 100),
				$slider['SliderLibrary']['name'],
				$slider['Slider']['slide_count'],
				$actions,
			);
		}

		echo $this->Html->tableCells($rows);
		echo $tableHeaders;
	?>
	</table>
<?php else: ?>
	<p><?php echo __('No sliders found.'); ?></p>
<?php endif; ?>
