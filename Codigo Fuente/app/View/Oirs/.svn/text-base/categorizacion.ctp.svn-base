<?php
$this->Html->addCrumb('Operaciones', '/Oirs');
$this->Html->addCrumb('Categorizacion', '#');
?>
<div id="contenido">
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading alert-info">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Por Estado
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <table class="table table-striped">
                        <?php
                        if (isset($porEstado)):
                            foreach ($porEstado as $estado):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($estado['E']['estado'], array('controller' => 'Anotaciones', 'action' => 'index', $estado['E']['estado'])); ?></td>
                                    <td><?php echo $estado[0]['Cant']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading alert-info">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    Por Unidad
                </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner">
                    <table class="table table-striped">
                        <?php
                        if (isset($porUnidad)):
                            foreach ($porUnidad as $unidad):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($unidad['U']['unidad'], array('controller' => 'Anotaciones', 'action' => 'index', $unidad['U']['unidad'])); ?></td>
                                    <td><?php echo $unidad[0]['Cant']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading alert-info">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                    Por Área
                </a>
            </div>
            <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner">
                    <table class="table table-striped">
                        <?php
                        if (isset($porArea)):
                            foreach ($porArea as $area):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($area['Ar']['area'], array('controller' => 'Anotaciones', 'action' => 'index', $area['Ar']['area'])); ?></td>
                                    <td><?php echo $area[0]['Cant']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading alert-info">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                    Por Tipo
                </a>
            </div>
            <div id="collapseFour" class="accordion-body collapse">
                <div class="accordion-inner">
                    <table class="table table-striped">
                        <?php
                        if (isset($porTipo)):
                            foreach ($porTipo as $tipo):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($tipo['T']['tipo'], array('controller' => 'Anotaciones', 'action' => 'index', $tipo['T']['tipo'])); ?></td>
                                    <td><?php echo $tipo[0]['Cant']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading alert-info">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                    Por plazo
                </a>
            </div>
            <div id="collapseFive" class="accordion-body collapse">
                <div class="accordion-inner">
                    <table class="table table-striped">
                        <?php
                        if (isset($porPlazo)):
                            foreach ($porPlazo as $plazo):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($plazo['T']['tipo'], array('controller' => 'Anotaciones', 'action' => 'index', $plazo['T']['tipo'])); ?></td>
                                    <td><?php echo $plazo[0]['Cant']; ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>