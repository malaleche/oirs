<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/encuestas/index');
?>

<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Agregar Encuesta'), array('action' => 'add')); ?></li>
    </ul>
</div>

<div class="encuestas index">
    <h2><?php echo __('Encuestas'); ?></h2>
    <table class="table table-bordered">
        <tr>
            <th><?php echo 'Id'; ?></th>
            <th><?php echo 'Encuesta'; ?></th>
            <th class="actions"><?php echo __('Accion'); ?></th>
        </tr>
        <?php foreach ($encuestas as $encuesta): ?>
            <tr>
                <td><?php echo h($encuesta['Encuesta']['id']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($encuesta['Encuesta']['encuesta'], array('action' => 'edit', $encuesta['Encuesta']['id'])); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $encuesta['Encuesta']['id']), null, __('Seguro de Eliminar encuesta # %s?', $encuesta['Encuesta']['id'])); ?>
                    
                    <?php 
                    if($encuesta['Encuesta']['active'] == false)
                        echo $this->Form->postLink(__('Activar'), array('action' => 'selectEncuesta', $encuesta['Encuesta']['id']), null, __('Seguro de Activar encuesta # %s?', $encuesta['Encuesta']['id']));
                    else
                        echo $this->Form->postLink(__('Desactivar'), array('action' => 'desactivarEncuesta', $encuesta['Encuesta']['id']), null, __('Seguro de Desactivar encuesta # %s?', $encuesta['Encuesta']['id']));
                    ?>
                    
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

