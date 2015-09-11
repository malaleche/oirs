<?php

if (!empty($anotaciones)): ?>
    
	<div class="anotaciones index" style="clear: both;">
	<br><br>
        <table class="table table-striped table-bordered">
            <tr>
                <th><?php echo 'Id'; ?></th>
                <th><?php echo 'Titulo'; ?></th>
    <!--			<th><?php // echo $this->Paginator->sort('cuerpo');              ?></th>-->
                <th><?php echo 'Correo'; ?></th>
                <!--<th><?php // echo $this->Paginator->sort('extension_plazo');              ?></th>-->
                <!--<th><?php // echo $this->Paginator->sort('publica');              ?></th>-->
                <th><?php echo 'Creada'; ?></th>
                <!--<th><?php // echo $this->Paginator->sort('user_id');              ?></th>-->
                <!--<th><?php // echo $this->Paginator->sort('tipo_ingreso_id');              ?></th>-->
                <th><?php echo 'Tipo Anotación'; ?></th>
                <th><?php echo 'Tipo Plazo'; ?></th>
                <th><?php echo 'Estado'; ?></th>
                <th><?php echo 'Unidad'; ?></th>
                <th><?php echo 'Días'; ?></th>				
            </tr>
            <?php foreach ($anotaciones as $anotacion): ?>
			<tbody>
                <tr>
                    <td><?php echo h($anotacion['Anotacion']['id']); ?>&nbsp;</td>
                    <td><?php 
						echo '<a href="http://oirsdigital.penalolen.cl/Anotaciones/view/'.h($anotacion['Anotacion']['id']).'" >'.$anotacion['Anotacion']['titulo'].'</a>';  
						//echo $this->Html->link($anotacion['Anotacion']['titulo'], array('controller' => 'Anotaciones', 'action' => 'view', $anotacion['Anotacion']['id'])); ?>
					</td>
                    <td><?php echo h($anotacion['Anotacion']['correo']); ?>&nbsp;</td>
                    <td><?php echo h($anotacion['Anotacion']['created']); ?>&nbsp;</td>
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
                        <?php
                        if (isset($anotacion['Unidad'][0])) {
                            $u = count($anotacion['Unidad']) - 1;
                            echo h($anotacion['Unidad'][$u]['unidad']);
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
							$fch_now	= date('Y-m-d ');
							$fch_create = h($anotacion['Anotacion']['created']);
							$dias		= h($anotacion['TiposPlazo']['dias']);
							
							$nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ($fch_create) ) ;
							$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
							
							$segundos	= strtotime($nuevafecha) - strtotime('now');
							$diastrans	= intval($segundos/60/60/24);
							
							if($diastrans < 0){
								echo "<div style='color:#ff0000;font-weight:bold'>". $diastrans ."</div>";
							}else{
								$diastrans = $diastrans + 1;
								echo "<div style='font-weight:bold'>". $diastrans ."</div>";
							}
						?>
                    </td>
                </tr>
			</tbody>	
            <?php endforeach; ?>
        </table>
	</div>
<?php	
endif;
?>