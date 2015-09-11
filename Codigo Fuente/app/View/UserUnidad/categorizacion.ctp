
<div id="menu" style="margin-left: 0px;">
    <ul class="nav nav-tabs nav-pills">
        <li><?php echo $this->Html->link('Mis Anotaciones', array('controller'=>'UserUnidad','action'=>'index')); ?></li>
        <li><?php echo $this->Html->link('Con Respuesta', array('controller' => 'UserUnidad', 'action' => 'respuesta')); ?></li>
        <li><?php echo $this->Form->postLink('Solucion Pendiente', array('controller' => 'UserUnidad', 'action' => 'pendiente')); ?></li>
        <li><?php echo $this->Html->link('Categorización General', array('controller'=>'UserUnidad','action'=>'categorizacion')); ?></li>
    </ul>
</div>
<div id="contenido">
    <h2>Categorización</h2>
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
                        if (isset($estados)):
                            foreach ($estados as $estado):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($estado[0]['estado'], array('controller' => 'UserUnidad', 'action' => 'index', $estado[0]['estado'])); ?></td>
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
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                    Por Tipo
                </a>
            </div>
            <div id="collapseFour" class="accordion-body collapse">
                <div class="accordion-inner">
                    <table class="table table-striped">
                        <?php
                        if (isset($tipos)):
                            foreach ($tipos as $tipo):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($tipo[0]['tipo'], array('controller' => 'UserUnidad', 'action' => 'index', $tipo[0]['tipo'])); ?></td>
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
                        if (isset($plazos)):
                            foreach ($plazos as $plazo):
                                ?>
                                <tr>
                                    <td><?php echo $this->Form->postLink($plazo[0]['tipo'], array('controller' => 'UserUnidad', 'action' => 'index', $plazo[0]['tipo'])); ?></td>
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