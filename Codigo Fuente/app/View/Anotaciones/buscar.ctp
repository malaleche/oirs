<script>
<?php
    $this->Html->addCrumb('Buscador Anotaciones', '#');
?>
    $(document).ready(function(){
<?php
if (!empty($anotaciones)):
    ?>
                $("#collapseOne").collapse('hide');
                $("#collapseTwo").collapse('show');
    <?php
endif;
?>
        $("#AnotacionDesde").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: "yy-mm-dd",
            onSelect: function( selectedDate ) {
                $( "#AnotacionHasta" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $("#AnotacionHasta").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: "yy-mm-dd",
            onSelect: function( selectedDate ) {
                $( "#AnotacionDesde" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        if( $('#AnotacionId1').val().trim()!=''){
            $('.elem').attr('disabled', 'disabled');
        }else{
            $('.elem').removeAttr('disabled');
        }
        $('#AnotacionId1').change(function(){
            if( $('#AnotacionId1').val().trim()!=''){
                $('.elem').attr('disabled', 'disabled');
            }else{
                $('.elem').removeAttr('disabled');
            }
        });
    });
</script>
<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading alert-info">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Formulario de Busqueda
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
                <div id="anotacion buscar form">
                    <h2>Buscar Anotaciones</h2>
                    <?php
                    echo $this->Form->create('Anotacion', array('action' => 'buscar'));
                    echo $this->Form->input('Anotacion.id1', array('type' => 'text', 'label' => 'Codigo Anotacion'));
                    if ($this->Session->read('Auth.User.Rol.rol') !== 'user'){
                        echo $this->Form->input('User.id', array('label' => 'Creada Por', 'type' => 'text', 'class' => 'elem'));
                    echo $this->Form->input('area_id', array('empty' => 'Seleccionar', 'class' => 'elem'));
                    echo $this->Form->input('tipo_anotacion_id', array('empty' => 'Seleccionar', 'class' => 'elem'));
                    echo $this->Form->input('tipo_plazo_id', array('empty' => 'Seleccionar', 'class' => 'elem'));
                    echo $this->Form->input('estado_id', array('empty' => 'Seleccionar', 'class' => 'elem'));
                    echo 'Desde';
                    echo $this->Form->input('desde', array('class' => 'hasDatePicker elem', 'label' => false));
                    echo 'Hasta';
                    echo $this->Form->input('hasta', array('class' => 'hasDatePicker elem', 'label' => false));
                    if ($this->Session->read('Auth.User.Rol.rol') !== 'unidad')
                        echo $this->Form->input('AnotacionesUnidad.unidad_id', array('label' => 'Unidades', 'options' => $unidades, 'empty' => 'Seleccionar', 'class' => 'elem'));
                    }
                    echo $this->Form->end(array('label' => 'Buscar', 'class' => 'btn btn-primary'));
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($anotaciones)): ?>
    <div class="anotaciones index" style="clear: both;">
        <h2><?php echo __('Resultados Busqueda'); ?></h2>
        <table class="table table-striped table-bordered">
            <tr>
                <th><?php echo 'Id'; ?></th>
                <th><?php echo 'Titulo'; ?></th>
    <!--			<th><?php // echo $this->Paginator->sort('cuerpo');              ?></th>-->
                <th><?php echo 'Correo'; ?></th>
                <!--<th><?php // echo $this->Paginator->sort('extension_plazo');              ?></th>-->
                <!--<th><?php // echo $this->Paginator->sort('publica');              ?></th>-->
                <th><?php echo 'Created'; ?></th>
                <!--<th><?php // echo $this->Paginator->sort('user_id');              ?></th>-->
                <!--<th><?php // echo $this->Paginator->sort('tipo_ingreso_id');              ?></th>-->
                <th><?php echo 'Tipo Anotacion'; ?></th>
                <th><?php echo 'Tipo Plazo'; ?></th>
                <th><?php echo 'Estado'; ?></th>
                <th><?php echo 'Area'; ?></th>
                <th><?php echo 'Unidad'; ?></th>
            </tr>
            <?php foreach ($anotaciones as $anotacion): ?>
                <tr>
                    <td><?php echo h($anotacion['Anotacion']['id']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($anotacion['Anotacion']['titulo'], array('controller' => 'Anotaciones', 'action' => 'view', $anotacion['Anotacion']['id'])); ?></td>
                    <!--<td><?php //echo h($anotacion['Anotacion']['cuerpo']);              ?>&nbsp;</td>-->
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
                    <td>
                        <?php echo h($anotacion['TiposPlazo']['tipo']); ?>
                    </td>
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
    </div>
    <?php
endif;
?>
</div>

