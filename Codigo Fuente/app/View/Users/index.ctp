<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/Users/index');

?>
<style>
    .error{
		text-align:center; 
		margin-bottom: 20px;
		color:#ff0000; 
		font-weight:bold;
    }
    #BuscarUsuarioNomUsuario{
		height: 22px;
		padding: 4px;
    }
</style>

<div id="menu user">
    <?php echo '<h4>Acciones</h4>'; ?>
    <ul>
        <li><?php echo $this->Html->link(__('Agregar Usuario'), array('controller' => 'users', 'action' => 'add')); ?></li>
    </ul>
</div>

<div class="wrapper_search">
	<?php
	if(!isset($this->params['url']['term']) && !isset($this->passedArgs['term']))
		$term = '';
	else
		$term = (isset($this->params['url']['term']))? $this->params['url']['term'] : $this->passedArgs['term'];

	?>
	<?php echo $this->Form->Create('User',array('url'=>'/users/index',
													'type'=>'get',
													'id' => 'search_form')
									);							
	echo $this->Html->div('input_search',$this->Form->input('term', array('label'=>false,'value'=>$term,'type'=>'text','id'=>'buscar', 'placeholder' => 'Buscar Usuario')));
	echo $this->Form->button('Buscar', array('class'=>'btn btn-primary', 'type'=>'submit'));
	?>
</div>﻿


<div class="users index">
	<h2><?php echo __('Usuarios'); ?></h2>
	<table class="table table-bordered">

	<tr>
			<th><?php echo 'Id'; ?></th>
			<th><?php echo 'Nombre usuario'; ?></th>
                        <th><?php echo 'Correo'; ?></th>
			<th><?php echo 'Creado'; ?></th>
			<th><?php echo 'Modificado'; ?></th>
			<th><?php echo 'Rol'; ?></th>
			<th><?php echo 'Perfil'; ?></th>
			<th><?php echo 'Unidad'; ?></th>
			<th class="actions"><?php echo __('Accion'); ?></th>
	</tr>

	<?php
	if(!empty($users)){ 	?>

		<?php
		foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($user['User']['username'], array('action' => 'edit', $user['User']['id'])); ?></td>
			<td><?php echo h($user['User']['correo']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
			<td><?php echo h($user['Rol']['nombre']); ?></td>
			<td><?php echo $this->Html->link($user['Perfil']['id'], array('controller' => 'perfiles', 'action' => 'edit', $user['Perfil']['id'])); ?></td>
			<td><?php echo $this->Html->link($user['Unidad']['unidad'], array('controller' => 'unidades', 'action' => 'edit', $user['Unidad']['id'])); ?></td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $user['User']['id']), null, __('Seguro de Eliminar usuario # %s?', $user['User']['id'])); ?>
			</td>
		</tr>
	<?php 
		endforeach; ?>

	
	<?php
	}else{
		echo "<div class='error'>No se encontraron datos. Favor revisar criterios de busqueda.</div>";

	}?>
	
	</table>


	<p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} de {:pages}, mostrando {:current} anotacion(es) de un total de {:count}, comenzando con la anotacion {:start} y terminando con la {:end}')
        ));
        ?>	
    </p>
    <div class="pagination pagination-centered">
        <ul>
            <?php
            echo '<li>' . $this->Paginator->prev('< ' . __('previous'), array(), null, array('currentClass')) . '</li>';
            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active'));
            echo '<li>' . $this->Paginator->next(__('next') . ' >', array(), null, array()) . '</li>';
            ?>
        </ul>
    </div>
</div>
<script>
    $('.active').wrapInner('<a href="#" />');
</script>