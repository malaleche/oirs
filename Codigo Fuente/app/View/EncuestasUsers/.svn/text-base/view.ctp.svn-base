<script>
    $(document).ready(function(){
        $('#myTab a:first').tab('show');
    });
    function goBack(){
        window.history.back();
    }
</script>
<?php
$this->Html->addCrumb('Control Anotaciones - Resultados encuesta', '/encuestasUsers/view');
?>
<ul class="nav nav-tabs" id="myTab">
    <li><a href="#tabla" data-toggle="tab">Tabla</a></li>
    <li><a href="#grafico" data-toggle="tab">Gráfico</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="tabla">
        <?php foreach ($array as $e => $ps): ?>
            <h1>Resultados encuesta: <?php echo $e; ?></h1>
            <?php foreach ($ps as $p => $as): ?>
                <h3><?php echo $p; ?></h3>
                <table class="table table-bordered">
                    <?php foreach ($as as $a => $v): ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $v; ?> Votos</td>
                            <?php if ($a != 'Total Votos'): ?>
                                <td><?php echo number_format(($v * 100) / $as['Total Votos'], 2, '.', ','); ?>%</td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <div class="tab-pane" id="grafico">
        <?php foreach ($array as $e => $ps): ?>
            <h1>Resultados encuesta: <?php echo $e; ?></h1>
            <?php foreach ($ps as $p => $as): ?>
                <h3><?php echo $p; ?></h3>
                <ul id="chart">
                    <?php foreach ($as as $a => $v): ?>
                        <?php if ($a != 'Total Votos'): ?>
                            <li title="<?php echo number_format(($v * 100) / $as['Total Votos'], 2, '.', ','); ?>%" class="yellow">
                                <span class="bar"></span>
                                <span class="alt"><?php echo $a; ?></span>
                                <span class="percent"></span>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php echo $this->Form->button('Volver', array('type' => 'button', 'class' => 'btn', 'onclick' => 'goBack()')); ?>