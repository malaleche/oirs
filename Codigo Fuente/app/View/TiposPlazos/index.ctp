<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos Plazos', '/tiposPlazos/index');
?>

<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Agregar Tipo Plazo'), array('action' => 'add')); ?></li>

    </ul>
</div>

<div class="tiposPlazos index">
    <h2><?php echo __('Tipos Plazos'); ?></h2>
    <table class="table table-bordered">
        <tr>
            <th><?php echo 'Id'; ?></th>
            <th><?php echo 'Tipo'; ?></th>
            <th><?php echo 'Dias'; ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($tiposPlazos as $tiposPlazo): ?>
            <tr>
                <td><?php echo h($tiposPlazo['TiposPlazo']['id']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($tiposPlazo['TiposPlazo']['tipo'], array('action' => 'edit', $tiposPlazo['TiposPlazo']['id'])); ?></td>
                <td><?php echo h($tiposPlazo['TiposPlazo']['dias']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $tiposPlazo['TiposPlazo']['id']), null, __('Seguro de Eliminar tipo plazo # %s?', $tiposPlazo['TiposPlazo']['id'])); ?>
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

