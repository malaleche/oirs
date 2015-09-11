<div class="preguntas form">
<?php echo $this->Form->create('Pregunta'); ?>
	<fieldset>
		<legend><?php echo __('Edit Pregunta'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('pregunta');
		echo $this->Form->input('encuesta_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pregunta.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Pregunta.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Preguntas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Encuestas'), array('controller' => 'encuestas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Encuesta'), array('controller' => 'encuestas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Alternativas'), array('controller' => 'alternativas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alternativa'), array('controller' => 'alternativas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Encuestas Useres'), array('controller' => 'encuestas_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Encuestas User'), array('controller' => 'encuestas_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
