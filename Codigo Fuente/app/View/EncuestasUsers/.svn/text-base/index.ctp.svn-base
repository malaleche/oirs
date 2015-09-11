<?php
$this->Html->addCrumb('Control Anotaciones - Ver Encuestas', '/encuestasUsers/index');
?>

<div class="encuestasUsers index">
	<h2><?php echo __('Resultados Encuestas'); ?></h2>
	<table class="table table-bordered">
	<tr>
			<th><?php echo 'Id'; ?></th>
			<th><?php echo 'Encuesta'; ?></th>
                        <th>Eliminar</th>

	</tr>
	<?php
	foreach ($encuestasUsers as $encuestasUser): ?>
	<tr>
		<td><?php echo h($encuestasUser['Encuesta']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($encuestasUser['Encuesta']['encuesta'], array('controller' => 'encuestasUsers', 'action' => 'view', $encuestasUser['Encuesta']['id'])); ?>
		</td>
                <td>
                    <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $encuestasUser['Encuesta']['id']), null, __('Seguro de Eliminar resultados encuesta # %s?', $encuestasUser['Encuesta']['id'])); ?>
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
