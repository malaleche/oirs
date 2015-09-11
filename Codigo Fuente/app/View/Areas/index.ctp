<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Areas', '/Areas');
?>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Agregar Area'), array('action' => 'add')); ?></li>
    </ul>
</div>
<div class="areas index">
    <h2><?php echo __('Areas'); ?></h2>
    <table class="table table-bordered">
        <tr>
            <th><?php echo 'Id'; ?></th>
            <th><?php echo 'Area'; ?></th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
        </tr>
        <?php foreach ($areas as $area): ?>
            <tr>
                <td><?php echo h($area['Area']['id']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($area['Area']['area'], array('action' => 'edit', $area['Area']['id'])); ?></td>
                <td class="actions">
                    
                    <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $area['Area']['id']), null, __('Seguro de Eliminar area # %s?', $area['Area']['id'])); ?>
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

