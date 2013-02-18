<?php
$this->extend('/Common/admin_index');
$this->name = 'slider_libraries';
?>

<?php $this->start('tabs'); ?>
<li><?php
echo $this->Html->link(__('Add Slider Library'), array(
	'controller' => 'slider_libraries',
	'action' => 'add',
));
?></li>
<?php $this->end(); ?>

<?php if (count($sliderLibraries) > 0): ?>
	<table cellpadding="0" cellspacing="0">
	<?php
		$tableHeaders = $this->Html->tableHeaders(array(
			'',
			__('Id'),
			__('Name'),
			__('Description'),
			__('Actions'),
		));
		echo $tableHeaders;

		$rows = array();
		foreach ($sliderLibraries as $sliderLibrary) {
			$actions  = $this->Html->link(__('Edit'), array(
				'action' => 'edit',
				$sliderLibrary['SliderLibrary']['id'],
			));
			$actions .= ' ' . $this->Form->postLink(__('Delete'), array(
				'action' => 'delete',
				$sliderLibrary['SliderLibrary']['id'],
			), null, __('Are you sure?'));

			$rows[] = array(
				'',
				$sliderLibrary['SliderLibrary']['id'],
				$sliderLibrary['SliderLibrary']['name'],
				substr(trim(strip_tags($sliderLibrary['SliderLibrary']['description'])), 0, 100),
				$actions,
			);
		}

		echo $this->Html->tableCells($rows);
		echo $tableHeaders;
	?>
	</table>
<?php else: ?>
	<p><?php echo __('No slider libraries found.'); ?></p>
<?php endif; ?>
