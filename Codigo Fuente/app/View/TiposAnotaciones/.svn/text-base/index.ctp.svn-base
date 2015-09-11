<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos Anotaciones', '/tiposAnotaciones/index');
?>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Agregar Tipo Anotacion'), array('action' => 'add')); ?></li>
    </ul>
</div>
<div class="tiposAnotaciones index">
	<h2><?php echo __('Tipos Anotaciones'); ?></h2>
	<table class="table table-bordered">
	<tr>
			<th><?php echo 'Id'; ?></th>
			<th><?php echo 'Tipo'; ?></th>
			<th class="actions"><?php echo __('Accion'); ?></th>
	</tr>
	<?php
	foreach ($tiposAnotaciones as $tiposAnotacion): ?>
	<tr>
		<td><?php echo h($tiposAnotacion['TiposAnotacion']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($tiposAnotacion['TiposAnotacion']['tipo'], array('action' => 'edit', $tiposAnotacion['TiposAnotacion']['id'])); ?></td>
		<td class="actions">
			
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $tiposAnotacion['TiposAnotacion']['id']), null, __('Seguro de eliminar tipo anotacion # %s?', $tiposAnotacion['TiposAnotacion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} de {:pages}, mostrando {:current} anotacion(es) de un total de {:count}, comenzando con la anotación {:start} y terminando con la {:end}')
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
