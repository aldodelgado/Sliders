<?php
$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Sliders'), array('controller' => 'sliders', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html
		->addCrumb(__d('croogo', 'Libraries'), array('action' => 'index'))
		->addCrumb($this->request->data['SliderLibrary']['name'], $this->here);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html
		->addCrumb(__d('croogo', 'Libraries'), array('action' => 'index'))
		->addCrumb(__d('croogo', 'Add'), $this->here);
}

echo $this->Form->create('SliderLibrary');

?>
<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
		<?php
			echo $this->Croogo->adminTab(__d('croogo', 'Library'), '#library-basic');
			echo $this->Croogo->adminTabs();
		?>
		</ul>

		<div class="tab-content">

			<div id="library-basic" class="tab-pane">
			<?php
				echo $this->Form->input('id');
				$this->Form->inputDefaults(array(
					'class' => 'span10',
					'label' => false,
				));
				echo $this->Form->input('name', array(
					'label' => __d('croogo', 'Name'),
				));
				echo $this->Form->input('description', array(
					'class' => 'alias span10',
					'label' => __d('croogo', 'Description'),
				));
				echo $this->Form->input('css', array(
					'label' => __d('croogo', 'CSS'),
				));
				echo $this->Form->input('js', array(
					'label' => __d('croogo', 'JavaScript'),
				));
			?>
			</div>

			<?php echo $this->Croogo->adminBoxes(); ?>
		</div>
	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('croogo', 'Publishing')) .
			$this->Form->button(__d('croogo', 'Save'), array('button' => 'default')) .
			$this->Html->link(
				__d('croogo', 'Cancel'),
				array('action' => 'index'),
				array('button' => 'danger')
			) .
			$this->Html->endBox();
	?>
	</div>

</div>
<?php echo $this->Form->end(); ?>
