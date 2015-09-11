<div class="respuestas form">
<?php echo $this->Form->create('Respuesta'); ?>
	<fieldset>
		<legend><?php echo __('Edit Respuesta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('respuesta');
		echo $this->Form->input('user_id');
		echo $this->Form->input('anotacion_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Respuesta.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Respuesta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Respuestas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Anotaciones'), array('controller' => 'anotaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Anotacion'), array('controller' => 'anotaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>
