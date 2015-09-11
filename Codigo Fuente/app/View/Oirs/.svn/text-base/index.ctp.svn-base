<script>
    $(document).ready(function(){
       $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })   
    })

</script>

<?php
$this->Html->addCrumb('Operaciones', '/Oirs');
$this->Html->addCrumb('Resumen General', '#');
?>
<div id="menu" class="pull-left span3" style="margin-left: 0px;">
    <ul class="nav nav-tabs nav-stacked">
        <li><?php echo $this->Html->link('Resumen General', array()); ?></li>
        <li><?php echo $this->Html->link('Ingresar', array('controller' => 'Anotaciones', 'action' => 'add')); ?></li>
        <li><?php echo $this->Form->postLink('Asignar', array('controller' => 'Anotaciones', 'action' => 'index', 'Sin Asignar')); ?></li>
        <li><?php echo $this->Form->postLink('Anotaciones Ingresadas', array('controller' => 'Anotaciones', 'action' => 'index')); ?></li>
        <li><?php echo $this->Form->postLink('Reasignacion', array('controller' => 'Anotaciones', 'action' => 'index', 'Solicitud Reasignacion')); ?></li>
        <li><?php echo $this->Form->postLink('Extension', array('controller' => 'Anotaciones', 'action' => 'index', 'Solicitud Tiempo Extendido')); ?></li>
        <li><?php echo $this->Html->link('Categorización General', array('controller' => 'Oirs', 'action' => 'categorizacion')); ?></li>
    </ul>
</div>
<div>
    <div id="ingresar" class="well span3 pull-left">
        <p>
        <h3>Ingresar Anotación</h3>
        Bienvenido a la Oficina virtual de Información, Reclamos y Sugerencias de la Municipalidad de Peñalolen.
        Registre su anotación aquí, y realice el seguimiento on-line de su solicitud. Una anotación es un registro
        de un reclamo, sugerencia, solicitud de información o felicitaciones.
        </p>
        <?php echo $this->Html->link('Ingresar Anotacion', array('controller' => 'Anotaciones', 'action' => 'add'), array('class' => 'btn btn-primary center')); ?>
    </div>
    <div id="buscar" class="well span4">
        <p>
        <h3>Estado Anotaciones Anteriores</h3>
        Si usted ya ha ingresado una anotacion y desea conocer el estado en que se encuentra, ingrese un criterio
        de búsqueda y haga click en el botón buscar.
        </p>
        <?php echo $this->Form->create('Anotacion', array('controller' => 'Anotaciones', 'action' => 'view', 'type' => 'get')); ?>

        <?php echo $this->Form->input('id', array('type' => 'text', 'label' => false, 'class' => 'pull-left', 'placeholder' => 'Ingresar codigo anotacion')); ?>

        <?php echo $this->Form->end(array('label' => 'Buscar', 'class' => 'btn btn-primary')); ?>

        <?php echo $this->Html->link('Busqueda Avanzada', array('controller' => 'Anotaciones', 'action' => 'buscar', '4')); ?>
    </div>
    <div id="resumen" style="clear: both;" class="">
        <p>
        <h3>Resumen General</h3>
        Resumen general de las anotaciones ingresadas por estado.
        </p>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a id='1' href="#tanot">Anotaciones Tradicionales</a></li>
            <li><a id='2' href="#tpasiva">Anotaciones Transparencia Pasiva</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tanot">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Número de Anotaciones</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($anotacionesNormal)):
                            foreach ($anotacionesNormal as $estado):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($estado[0]['estado'], array('controller' => 'Anotaciones', 'action' => 'index', $estado[0]['estado'])); ?></td>
                                    <td><?php echo $estado[0]['C']; ?></td>
                                    <td>
                                        <?php
                                        $prioridad = 'badge badge-success';
                                        foreach ($estadosAnotNormalPrioriAmarilla as $priori):
                                            if ($priori['Estado']['estado'] == $estado[0]['estado']):
                                                $prioridad = 'badge badge-warning';
                                            endif;
                                        endforeach;
                                        foreach ($estadosAnotNormalPrioriRoja as $priori):
                                            if ($priori['Estado']['estado'] == $estado[0]['estado']):
                                                $prioridad = 'badge badge-important';
                                            endif;
                                        endforeach;
                                        ?>
                                        <span class="<?php echo $prioridad ?>">&nbsp;</span>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tpasiva">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Número de Anotaciones</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($anotacionesTrans)):
                            foreach ($anotacionesTrans as $estado):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($estado[0]['estado'], array('controller' => 'TransparenciaPasivas', 'action' => 'index', $estado[0]['estado'])); ?></td>
                                    <td><?php echo $estado[0]['C']; ?></td>
                                    <td>
                                        <?php
                                        $prioridad = 'badge badge-success';
                                        foreach ($estadosAnotTransPrioriAmarilla as $priori):
                                            if ($priori['Estado']['estado'] == $estado[0]['estado']):
                                                $prioridad = 'badge badge-warning';
                                            endif;
                                        endforeach;
                                        foreach ($estadosAnotTransPrioriRoja as $priori):
                                            if ($priori['Estado']['estado'] == $estado[0]['estado']):
                                                $prioridad = 'badge badge-important';
                                            endif;
                                        endforeach;
                                        
                                        ?>
                                        <span class="<?php echo $prioridad ?>">&nbsp;</span>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>