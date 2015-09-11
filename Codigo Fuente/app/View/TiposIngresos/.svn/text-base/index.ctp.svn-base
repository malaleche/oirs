<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos Ingresos', '/tiposIngresos/index');
?>

<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Agregar Tipo Ingreso'), array('action' => 'add')); ?></li>
    </ul>
</div>

<div class="tiposIngresos index">
    <h2><?php echo __('Tipo Ingresos'); ?></h2>
    <table class="table table-bordered">
        <tr>
            <th><?php echo 'Id'; ?></th>
            <th><?php echo 'Tipo'; ?></th>
            <th class="actions"><?php echo __('Accion'); ?></th>
        </tr>
        <?php foreach ($tiposIngresos as $tiposIngreso): ?>
            <tr>
                <td><?php echo h($tiposIngreso['TiposIngreso']['id']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($tiposIngreso['TiposIngreso']['tipo'], array('action' => 'edit', $tiposIngreso['TiposIngreso']['id'])); ?></td>
                <td class="actions">
                    <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $tiposIngreso['TiposIngreso']['id']), null, __('Seguro de Eliminar tipo ingreso # %s?', $tiposIngreso['TiposIngreso']['id'])); ?>
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
