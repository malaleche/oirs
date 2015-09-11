<?php
$this->Html->addCrumb('Operaciones', '/Oirs');
$this->Html->addCrumb('Anotaciones-Transparencia Pasiva', '#');
?>
<div class="anotaciones index">
    <?php echo $this->Html->link('<< Volver', '', array('onclick' => 'goBack();return false;')); ?>
    <h2><?php echo __('Anotaciones'); ?></h2>
    <table class="table table-striped table-bordered">
        <tr>
            <th><?php echo 'Id'; ?></th>
            <th><?php echo 'Titulo'; ?></th>
<!--			<th><?php // echo $this->Paginator->sort('cuerpo');    ?></th>-->
            <th><?php echo 'Correo'; ?></th>
            <!--<th><?php // echo $this->Paginator->sort('extension_plazo');    ?></th>-->
            <!--<th><?php // echo $this->Paginator->sort('publica');    ?></th>-->
            <th><?php echo 'Created'; ?></th>
            <!--<th><?php // echo $this->Paginator->sort('user_id');    ?></th>-->
            <!--<th><?php // echo $this->Paginator->sort('tipo_ingreso_id');    ?></th>-->
            <th><?php echo 'Tipo Anotacion'; ?></th>
            <th><?php echo 'Tipo Plazo'; ?></th>
            <th><?php echo 'Estado'; ?></th>
            <th><?php echo 'Area'; ?></th>
            <th><?php echo 'Unidad'; ?></th>
        </tr>
        <?php foreach ($anotaciones as $anotacion): ?>
            <?php 
            $class='';
            if(!in_array($anotacion['Estado']['estado'], array('Cerrado','Reasignado', 'Con Respuesta'))){
            $hoy = new DateTime('now');
            $fecha = new DateTime($anotacion['Anotacion']['created']);
            $format = 'P'.$anotacion['Anotacion']['extension_plazo'].'D';
            $i = new DateInterval($format);
            $fecha->add($i);
            if ($anotacion['TiposPlazo']['tipo'] == 'Urgente') {
                $class = 'error';
            } else {
                if ($fecha <= $hoy) {
                   $class = 'warning';
                }
            }} ?>
            <tr class ="<?php echo $class ?>">
                <td><?php echo h($anotacion['Anotacion']['id']); ?>&nbsp;</td>
                <td><?php echo $this->Html->link($anotacion['Anotacion']['titulo'], array('controller' => 'transparenciaPasivas', 'action' => 'view', $anotacion['Anotacion']['id'])); ?></td>
                <!--<td><?php //echo h($anotacion['Anotacion']['cuerpo']);    ?>&nbsp;</td>-->
                <td><?php echo h($anotacion['Anotacion']['correo']); ?>&nbsp;</td>
                <td><?php echo h($anotacion['Anotacion']['created']); ?>&nbsp;</td>
    <!--		<td>
                <?php // echo $this->Html->link($anotacion['User']['username'], array('controller' => 'users', 'action' => 'view', $anotacion['User']['id']));   ?>
                </td>
                <td>
                <?php // echo $this->Html->link($anotacion['TiposIngreso']['tipo'], array('controller' => 'tipos_ingresos', 'action' => 'view', $anotacion['TiposIngreso']['id']));   ?>
                </td>-->
                <td>
                    <?php echo h($anotacion['TiposAnotacion']['tipo']); ?>
                </td>
                <td>
                    <?php echo h($anotacion['TiposPlazo']['tipo']); ?>
                </td>
                <td>
                    <?php echo h($anotacion['Estado']['estado']); ?>
                </td>
                <td>
                    <?php echo $anotacion['Area']['area']; ?>
                </td>
                <td>
                    <?php
                    if (isset($anotacion['Unidad'][0])) {
                        $u = count($anotacion['Unidad']) - 1;
                        echo $anotacion['Unidad'][$u]['unidad'];
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
    function goBack(){
        window.history.back();
    }
</script>