<?php
$this->extend('/Common/admin_index');
$this->name = 'slider_slides';
?>

<?php $this->start('tabs'); ?>
<li><?php
echo $this->Html->link(__('Add Slide'), array(
	'controller' => 'slider_slides',
	'action' => 'add',
	$slider_id,
));
?></li>
<?php $this->end(); ?>

<?php if (count($slides) > 0): ?>
	<table cellpadding="0" cellspacing="0">
	<?php
		$tableHeaders = $this->Html->tableHeaders(array(
			'',
			__('Id'),
			__('Name'),
			__('Description'),
			__('Order'),
			__('Actions'),
		));
		echo $tableHeaders;

		$rows = array();
		foreach ($slides as $slide) {
			$actions  = $this->Html->link(__('Edit'), array(
				'action' => 'edit',
				$slide['SliderSlide']['id'],
			));
			$actions .= ' ' . $this->Form->postLink(__('Delete'), array(
				'action' => 'delete',
				$slide['SliderSlide']['id'],
			), null, __('Are you sure?'));
			
			$rows[] = array(
				'',
				$slide['SliderSlide']['id'],
				$slide['SliderSlide']['name'],
				substr(trim(strip_tags($slide['SliderSlide']['description'])), 0, 100),
				$slide['SliderSlide']['lft'],
				$actions,
			);
		}

		echo $this->Html->tableCells($rows);
		echo $tableHeaders;
	?>
	</table>
<?php else: ?>
	<p><?php echo __('No slides found.'); ?></p>
<?php endif; ?>
