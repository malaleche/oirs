
<div class="anotaciones index">
    <h2><?php echo __('Anotaciones'); ?></h2>
    <table class="table table-striped table-bordered">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('titulo'); ?></th>
<!--			<th><?php // echo $this->Paginator->sort('cuerpo');  ?></th>-->
            <th><?php echo $this->Paginator->sort('correo'); ?></th>
            <!--<th><?php // echo $this->Paginator->sort('extension_plazo');  ?></th>-->
            <!--<th><?php // echo $this->Paginator->sort('publica');  ?></th>-->
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <!--<th><?php // echo $this->Paginator->sort('user_id');  ?></th>-->
            <!--<th><?php // echo $this->Paginator->sort('tipo_ingreso_id');  ?></th>-->
            <th><?php echo $this->Paginator->sort('tipo_anotacion_id'); ?></th>
            <!--<th><?php // echo $this->Paginator->sort('tipo_plazo_id');  ?></th>-->
            <th><?php echo $this->Paginator->sort('estado_id'); ?></th>
            <th><?php echo $this->Paginator->sort('area_id'); ?></th>
            <th><?php echo $this->Paginator->sort('Unidad'); ?></th>
        </tr>
        <?php foreach ($anotaciones as $anotacion): ?>
            <tr>
                <td><?php echo h($anotacion['Anotacion']['id']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($anotacion['Anotacion']['titulo'], array('controller' => 'Anotaciones', 'action' => 'view', $anotacion['Anotacion']['id'])); ?></td>
                <!--<td><?php //echo h($anotacion['Anotacion']['cuerpo']);  ?>&nbsp;</td>-->
                <td><?php echo h($anotacion['Anotacion']['correo']); ?>&nbsp;</td>
                <td><?php echo h($anotacion['Anotacion']['created']); ?>&nbsp;</td>
    <!--		<td>
                <?php // echo $this->Html->link($anotacion['User']['username'], array('controller' => 'users', 'action' => 'view', $anotacion['User']['id']));  ?>
                </td>
                <td>
                <?php // echo $this->Html->link($anotacion['TiposIngreso']['tipo'], array('controller' => 'tipos_ingresos', 'action' => 'view', $anotacion['TiposIngreso']['id']));  ?>
                </td>-->
                <td>
                    <?php echo h($anotacion['TiposAnotacion']['tipo']); ?>
                </td>
    <!--		<td>
                <?php // echo $this->Html->link($anotacion['TiposPlazo']['tipo'], array('controller' => 'tipos_plazos', 'action' => 'view', $anotacion['TiposPlazo']['id']));  ?>
                </td>-->
                <td>
                    <?php echo h($anotacion['Estado']['estado']); ?>
                </td>
                <td>
                    <?php echo h($anotacion['Area']['area']); ?>
                </td>
                <td>
                    <?php
                    if (isset($anotacion['Unidad'][0])) {
                        $u = count($anotacion['Unidad']) - 1;
                        echo h($anotacion['Unidad'][$u]['unidad']);
                    }
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