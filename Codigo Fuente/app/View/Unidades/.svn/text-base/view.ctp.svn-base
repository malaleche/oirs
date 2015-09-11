<div class="unidades view">
<h2><?php  echo __('Unidad'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unidad['Unidad']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidad'); ?></dt>
		<dd>
			<?php echo h($unidad['Unidad']['unidad']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unidad'), array('action' => 'edit', $unidad['Unidad']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unidad'), array('action' => 'delete', $unidad['Unidad']['id']), null, __('Are you sure you want to delete # %s?', $unidad['Unidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidad'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Anotaciones'), array('controller' => 'anotaciones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Anotacion'), array('controller' => 'anotaciones', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($unidad['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Rol Id'); ?></th>
		<th><?php echo __('Perfil Id'); ?></th>
		<th><?php echo __('Unidad Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unidad['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td><?php echo $user['rol_id']; ?></td>
			<td><?php echo $user['perfil_id']; ?></td>
			<td><?php echo $user['unidad_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Anotaciones'); ?></h3>
	<?php if (!empty($unidad['Anotacion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Titulo'); ?></th>
		<th><?php echo __('Cuerpo'); ?></th>
		<th><?php echo __('Extension Plazo'); ?></th>
		<th><?php echo __('Publica'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Tipo Ingreso Id'); ?></th>
		<th><?php echo __('Tipo Anotacion Id'); ?></th>
		<th><?php echo __('Tipo Plazo Id'); ?></th>
		<th><?php echo __('Estado Id'); ?></th>
		<th><?php echo __('Area Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unidad['Anotacion'] as $anotacion): ?>
		<tr>
			<td><?php echo $anotacion['id']; ?></td>
			<td><?php echo $anotacion['titulo']; ?></td>
			<td><?php echo $anotacion['cuerpo']; ?></td>
			<td><?php echo $anotacion['extension_plazo']; ?></td>
			<td><?php echo $anotacion['publica']; ?></td>
			<td><?php echo $anotacion['created']; ?></td>
			<td><?php echo $anotacion['user_id']; ?></td>
			<td><?php echo $anotacion['tipo_ingreso_id']; ?></td>
			<td><?php echo $anotacion['tipo_anotacion_id']; ?></td>
			<td><?php echo $anotacion['tipo_plazo_id']; ?></td>
			<td><?php echo $anotacion['estado_id']; ?></td>
			<td><?php echo $anotacion['area_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'anotaciones', 'action' => 'view', $anotacion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'anotaciones', 'action' => 'edit', $anotacion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'anotaciones', 'action' => 'delete', $anotacion['id']), null, __('Are you sure you want to delete # %s?', $anotacion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Anotacion'), array('controller' => 'anotaciones', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
