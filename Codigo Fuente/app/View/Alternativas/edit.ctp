<div class="alternativas form">
<?php echo $this->Form->create('Alternativa'); ?>
	<fieldset>
		<legend><?php echo __('Edit Alternativa'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('alternativa');
		echo $this->Form->input('pregunta_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Alternativa.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Alternativa.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Alternativas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Preguntas'), array('controller' => 'preguntas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pregunta'), array('controller' => 'preguntas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Encuestas Useres'), array('controller' => 'encuestas_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Encuestas User'), array('controller' => 'encuestas_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
