<?php

function avg($cant = 0, $total = 0) {
    if ($total != 0) {
        return number_format(($cant * 100) / $total, 2, '.', ',');
    } else {
        return 0;
    }
}
?>
<script>
    $(document).ready(function() {
<?php
if (!empty($resultados)):
    ?>
                $('#collapseOne').collapse('hide');
    <?php
endif;
?>
        $("#DesempenoMunicipalDesde").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: "yy-mm-dd",
            onSelect: function( selectedDate ) {
                $( "#DesempenoMunicipalHasta" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $("#DesempenoMunicipalHasta").datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: "yy-mm-dd",
            onSelect: function( selectedDate ) {
                $( "#DesempenoMunicipalDesde" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
</script>
<style>
input[type="radio"], input[type="checkbox"] {
width: auto;
float: left;
}    
</style>
<?php

$this->Html->addCrumb('Control de Anotaciones', '/Oirs/controlAnotaciones');
$this->Html->addCrumb('Desempeño Municipal', '#');
?>

<div id="menu" class="pull-left span3" style="margin-left: 0px;">
    <ul class="nav nav-tabs nav-stacked">
        <li><?php echo $this->Html->link('Desempeño Municipal', array('controller' => 'Oirs', 'action' => 'desempenoMunicipal')); ?></li>
        <li><?php echo $this->Html->link('Control Anotaciones', array('controller' => 'Oirs', 'action' => 'controlAnotaciones')); ?></li>
		<li><?php echo $this->Html->link('Filtro por Unidades', array('controller' => 'Oirs', 'action' => 'filtrounidades')); ?></li>
        <li><?php if($this->Session->read('Auth.User.Rol.rol')!='unidad')echo $this->Html->link('Ver Encuestas', array('controller'=>'encuestasUsers', 'action'=>'index')); ?></li>
    </ul>
</div>
<div class="accordion span8" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading alert-info">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Formulario de Consulta
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
                <div id="anotacion buscar form">
                    <h2>Desempeño Municipal</h2>
                    <?php
                    echo $this->Form->create('DesempenoMunicipal', array('url' => array('controller' => 'Oirs', 'action' => 'desempenoMunicipal')));
                    echo '<h5>Seleccione la forma en la que se mostraran los resultados</h5>';
                    echo $this->Form->radio('forma', array('C' => 'Cantidades', 'P' => 'Porcentajes'), array('legend' => false, 'value' => 'C'));
                    echo '<h5>Seleccione el origen de los datos</h5>';
                    echo $this->Form->radio('origen', array('Digital' => 'Digital', 'Telefonico' => 'Telefonico', 'Presencial' => 'Presencial', '' => 'Todos'), array('legend' => false, 'value' => 'Digital'));
                    echo '<h5>Desde</h5>';
                    echo $this->Form->input('desde', array('class' => 'hasDatePicker', 'label' => false));
                    echo '<h5>Hasta</h5>';
                    echo $this->Form->input('hasta', array('class' => 'hasDatePicker', 'label' => false));
                    echo $this->Form->end(array('label' => 'Consultar', 'class' => 'btn btn-primary'));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($resultados)):
    ?>
    <div id="resultados" style="clear: both;">
        <?php echo $this->Form->postLink('Exportar a Excel',array('action'=>'reporteDesempeno'),array('class'=>'btn')); ?>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr class="info">
                    <th rowspan="2" style="text-align: center;">Unidad</th>
                    <th rowspan="2" style="text-align: center;">Total</th>
                    <th colspan="3" style="text-align: center;">Abiertas</th>
                    <th colspan="5" style="text-align: center;">Con Respuestas</th>
                    <th rowspan="2" style="text-align: center;">Rechazadas</th>
                    <th rowspan="2" style="text-align: center;">Dias Prom. Atraso</th>
                </tr>
                <tr>
                    <th class="alert-info" style="text-align: center;">Total</th>
                    <th class="alert-success"style="text-align: center;">D/Plazo</th>
                    <th class="alert-error"style="text-align: center;">F/Plazo</th>
                    <th class="alert-info"style="text-align: center;">Total</th>
                    <th class="alert-success"style="text-align: center;">D/Plazo</th>
                    <th class="alert-error"style="text-align: center;">F/Plazo</th>
                    <th class="alert-success"style="text-align: center;">Cerrada</th>
                    <th class="alert"style="text-align: center;">Sol.Pend.</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($resultados)):
					
					$totalinf 	= 0;
					$totalab	= 0;
					$dplazoab	= 0;
					$fplazoab	= 0;
					$totalresp	= 0;
					$dplazoresp = 0;
					$fplazoresp = 0;
					$cerrresp	= 0;
					$solpenresp = 0;
					$rechaz		= 0;
					$promtotal	= 0;
					$countprom  = 0;
				
                    foreach ($resultados['U'] as $r):
                        ?>
                        <tr>
                            <td>Unidad
								<?php 	//Nombre Unidades
								echo isset($r['unidad']) ? $r['unidad'] : '0'; ?>
							</td>
                            <td>
								<?php 	//Total
								$a = isset($r['Total']) ? $r['Total'] : '0';
								echo $a; 
								$totalinf = $totalinf + $a;
								?>

							</td>
                            <td>
								<?php	//Total Abiertas
								if ($resultados['forma'] == 'P') {
									$b = avg(isset($r['Abiertas']) ? $r['Abiertas'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $b;
								} else {
									$b = isset($r['Abiertas']) ? $r['Abiertas'] : '0';
									echo $b;
								}
								$totalab = $totalab + $b;
								?>
							</td>
                            <td><?php	//D/Plazo Abiertas
								if ($resultados['forma'] == 'P') {
									$c = avg(isset($r['AbiDP']) ? $r['AbiDP'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $c;
								} else {
									$c = isset($r['AbiDP']) ? $r['AbiDP'] : '0';
									echo $c;
								}
								$dplazoab = $dplazoab + $c;
								?>
							</td>
							<td><?php	//F/Plazo Abiertas
								if ($resultados['forma'] == 'P') {
									$d = avg(isset($r['AbiFP']) ? $r['AbiFP'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $d;
								} else {
									$d = isset($r['AbiFP']) ? $r['AbiFP'] : '0';
									echo $d;
								}
								$fplazoab = $fplazoab + $d;
								?>
							</td>
							<td><?php	//Total Respuestas
								if ($resultados['forma'] == 'P') {
									$e = avg(isset($r['ConRes']) ? $r['ConRes'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $e;
								} else {
									$e = isset($r['ConRes']) ? $r['ConRes'] : '0';
									echo $e;
								}
								$totalresp = $totalresp + $e;
								?>
							</td>
							<td><?php	//D/Plazo Respuestas
								if ($resultados['forma'] == 'P') {
									$f = avg(isset($r['ConResDP']) ? $r['ConResDP'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $f;
								} else {
									$f = isset($r['ConResDP']) ? $r['ConResDP'] : '0';
									echo $f;
								}
								$dplazoresp = $dplazoresp + $f;
								?>
							</td>
							<td><?php	//F/Plazo Respuestas
								if ($resultados['forma'] == 'P') {
									$g = avg(isset($r['ConResFP']) ? $r['ConResFP'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $g;
								} else {
									$g = isset($r['ConResFP']) ? $r['ConResFP'] : '0';
									echo $g;
								}
								$fplazoresp = $fplazoresp + $g;
								?>
							</td>
							<td><?php	//Cerrada Respuestas
								if ($resultados['forma'] == 'P') {
									$h = avg(isset($r['anotCerr']) ? $r['anotCerr'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $h;
								} else {
									$h = isset($r['anotCerr']) ? $r['anotCerr'] : '0';
									echo $h;
								}
								$cerrresp = $cerrresp + $h;
								?>
							</td>
							<td><?php	//Sol.Pend. Respuestas
								if ($resultados['forma'] == 'P') {
									$i = avg(isset($r['anotSolPen']) ? $r['anotSolPen'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $i;
								} else {
									$i = isset($r['anotSolPen']) ? $r['anotSolPen'] : '0';
									echo $i;
								}
								$solpenresp = $solpenresp + $i; 
								?>
							</td>
							<td><?php	//Rechazadas
								if ($resultados['forma'] == 'P') {
									$j = avg(isset($r['Rechazadas']) ? $r['Rechazadas'] : '0', isset($r['Total']) ? $r['Total'] : '0') . '%';
									echo $j;
								} else {
									$j = isset($r['Rechazadas']) ? $r['Rechazadas'] : '0';
									echo $j;
								}
								$rechaz = $rechaz + $j;
								?>
							</td>
							<td>
								<?php	//Dias Prom. Atraso
								
										$_AbiFP = 0;
										$_ConResFP = 0;
										if (isset($r['AbiFP'])) {
											$_AbiFP = $r['AbiFP'];
										}
										if (isset($r['ConResFP'])) {
											$_ConResFP = $r['ConResFP'];
										}
										$AFP = $_AbiFP + $_ConResFP;
										$_sumAbi = 0;
										$_sumConRes = 0;
										if (isset($r['sumAbi'])) {
											$_sumAbi = $r['sumAbi'];
										}
										if (isset($r['sumConRes'])) {
											$_sumConRes = $r['sumConRes'];
										}
										$sumDiasFP = $_sumAbi + $_sumConRes;
										$avg = $AFP > 0 ? $sumDiasFP / $AFP : 0;
										$promind = number_format($avg, 2, ',', '.');
										
										echo $promind;
										
										$promtotal = $promtotal + $promind;
										$countprom++;
										
								?>
							</td>
                        </tr>
                        <?php
                    endforeach;
					
					$prom_total = $promtotal / $countprom;
					
					echo '<tr style="background-color: #f5f5f5;font-weight:bold;"><td><b>Consolidados</b></td><td>'.$totalinf.'</td><td>'.$totalab.'</td><td>'.$dplazoab.'</td><td>'.$fplazoab.'</td><td>'.$totalresp.'</td><td>'.$dplazoresp.'</td><td>'.$fplazoresp.'</td><td>'.$cerrresp.'</td><td>'.$solpenresp.'</td><td>'.$rechaz.'</td><td>'.number_format($prom_total, 2, ',', '.').'</td></tr>';
					
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <?php
endif;
?>

