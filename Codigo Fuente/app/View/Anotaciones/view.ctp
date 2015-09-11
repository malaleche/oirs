<?php
$this->Html->addCrumb('Ver anotacion', '#');
?>
<div class="anotaciones view">
    <h2><?php echo __('Anotacion - ') . $anotacion['Anotacion']['titulo']; ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha Ingreso</th>
                <th>Días Plazo</th>
                <th>Fecha Expiración</th>
                <th>Estado</th>
                <?php
                if($this->Session->read('Auth.User.Rol.rol') === 'oirs'):
                ?>
                <th>Area</th>
                <th>Responsable</th>
                <th>Creado Por</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo date('d-m-Y H:i:s',  strtotime($anotacion['Anotacion']['created'])); ?></td>
                <td>
                    <?php
                    if (!isset($anotacion['Anotacion']['extension_plazo'])) {
                        echo $anotacion['TiposPlazo']['dias'] . ' días corridos';
                    } else {
                        echo $anotacion['Anotacion']['extension_plazo'] . ' días corridos';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (!isset($anotacion['Anotacion']['extension_plazo'])) {
                        $fechaCreada = $anotacion['Anotacion']['created'];
                        $diasPlazo = $anotacion['TiposPlazo']['dias'];
                        $fechaExpira = strtotime($fechaCreada . "+" . $diasPlazo . " days");
                        echo date('d-m-Y H:i:s', $fechaExpira);
                    } else {
                        $fechaCreada = $anotacion['Anotacion']['created'];
                        $diasPlazo = $anotacion['Anotacion']['extension_plazo'];
                        $fechaExpira = strtotime($fechaCreada . "+" . $diasPlazo . " days");
                        echo date('d-m-Y H:i:s', $fechaExpira);
                    }
                    ?>
                </td>
                <td><?php echo $anotacion['Estado']['estado']; ?></td>
                <?php
                if($this->Session->read('Auth.User.Rol.rol') === 'oirs'):
                ?>
                <td><?php echo $anotacion['Area']['area']; ?></td>
                <td><?php if (isset($anotacion['Unidad'][0])) {
                        $u = count($anotacion['Unidad']) - 1;
                        echo h($anotacion['Unidad'][$u]['unidad']);
                    } ?></td>
                <td>
                    <?php if (isset($anotacion['User']['Perfil']['nombre'])) {
                        echo $this->Form->postLink($anotacion['User']['Perfil']['nombre'],array('controller'=>'Anotaciones', 'action'=>'index', $anotacion['User']['id']));
                    }else {
                        echo $this->Form->postLink($anotacion['User']['username'], array('controller'=>'Anotaciones', 'action' => 'index', $anotacion['User']['id']));
                    } ?>
                </td> 
                <?php
                endif;
                ?>
            </tr>
        </tbody>
    </table>

    <div id="detalle" class="alert alert-info">
        <h5>Anotación del usuario</h5>
        <?php
        $cuerpo = str_ireplace(chr(10) . chr(13), '<br>', trim($anotacion['Anotacion']['cuerpo']));
        echo $cuerpo;
        ?>     
    </div>
    <?php
    if(!empty($files)):
    ?>
    <div id="Archivos" class="alert">
        <h5>Archivos de la anotacion</h5>
        <?php
        foreach ($files as $file) {
            echo "<i class='icon-download'></i>" . $this->Html->link(basename($file),array('controller'=>'Descargas', 'action'=>'download', base64_encode($file)),array('target'=>'_blank'));
            echo '<br>';
        }
        ?>
    </div>

    <?php
    endif;
    if ($this->Session->read('Auth.User.Rol.rol') === 'oirs' || $this->Session->read('Auth.User.Rol.rol') === 'unidad'):
        ?>
        <?php
        if (!empty($anotacion['ComentariosInterno'])):
            foreach ($anotacion['ComentariosInterno'] as $comentariosInterno):
                ?>
                <div name="comentario-<?php echo $comentariosInterno['id']; ?>" class="alert alert-success">
                    <table width="100%">
                        <tr>
                            <td width="5%">Fecha:</td>
                            <td width="80%"><?php echo $comentariosInterno['created'] . '<br>'; ?></td>
                            <td style="text-align: right"><i class="icon-pencil"></i><a id="editarC" href="#">Editar</a></td>
                            <td style="text-align: right"><i class="icon-remove-sign"></i><?php echo $this->Form->postLink(__('Eliminar'), array('controller'=>'ComentariosInternos','action' => 'delete', $comentariosInterno['id']), null, __('Esta seguro de eliminar el comentario# %s?', $comentariosInterno['id'])); ?></td>
                        </tr>
                        <tr>
                            <td>Usuario:</td>
                            <td><?php echo isset($comentariosInterno['User']['username'])?$comentariosInterno['User']['username']:'' . '<br>'; ?></td>
                        </tr>
                    </table>
                    <h5>Comentario Interno</h5>
                    <p id='comentario'>
                    <?php echo $comentariosInterno['comentario']; ?>
                    </p>
                </div>
                <?php
            endforeach;
        endif;
        ?>

    <?php endif; ?>

    <?php
    if (!empty($anotacion['Respuesta'])):
        foreach ($anotacion['Respuesta'] as $respuesta):
            ?>
            <div name="respuea-<?php echo $respuesta['id']; ?>" class="alert alert-error">
                <table>
                    <tr>
                        <td width="5%">Fecha:</td>
                        <td width="80%"><?php echo $respuesta['created'] . '<br>'; ?></td>
                        <?php if($this->Session->check('Auth.User.Rol.rol') && $this->Session->read('Auth.User.Rol.rol') !== 'user'): ?>
                        <td style="text-align: right"><i class="icon-pencil"></i><a id="editarR" href="#">Editar</a></td>
                        <td style="text-align: right"><i class="icon-remove-sign"></i><?php echo $this->Form->postLink(__('Eliminar'), array('controller'=>'Respuestas','action' => 'delete', $respuesta['id']), null, __('Esta seguro de eliminar la respuesta # %s?', $respuesta['id'])); ?></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Usuario:</td>
                        <td><?php echo isset($respuesta['User']['username'])?$respuesta['User']['username']:'' . '<br>'; ?></td>
                    </tr>
                </table>
                <h5>Respuesta al Usuario</h5>
                <p id="respuesta">
                <?php echo $respuesta['respuesta']; ?>
                </p>
                <?php if(isset($files_res['resp_'.$respuesta['id']])): ?>
                <p>
                <h5>Archivos adjuntos</h5>
                    <?php foreach ($files_res['resp_'.$respuesta['id']] as $value):
                        echo "<i class='icon-download'></i>" . $this->Html->link($value,array('controller'=>'Descargas', 'action'=>'download', base64_encode('anot_'. $anotacion['Anotacion']['id'] . DS . 'Respuestas' . DS . 'resp_'.$respuesta['id'] . DS . $value)),array('target'=>'_blank'));
                        //echo 'anot_'. $anotacion['Anotacion']['id'] . DS . 'Respuestas' . DS . 'resp_'.$respuesta['id'] . DS . $value;
                    endforeach; 
                endif;?>
                    
                </p>
            </div>
            <?php
        endforeach;
    endif;
    ?>
    <?php
if($this->Session->read('Auth.User.Rol.rol') == 'oirs' || $this->Session->read('Auth.User.Rol.rol') == 'unidad'){
    echo $this->Html->link('Procesar',array('controller'=>'Anotaciones', 'action'=>'edit',$anotacion['Anotacion']['id']),array('class'=>'btn btn-primary'));
}
echo " ";
echo $this->Form->button('Volver',array('type'=>'button','class'=>'btn', 'onclick'=>'goBack()'));
?>
<script>
    $(document).ready(function(){
        $("#editarC").click(function(){
            var coment = $(this).parents('div').eq(0);
            var indexComent = coment.attr('name').split('-')[1];
            $(coment).children('#comentario').wrapInner('<textarea name="data[ComentariosInterno][comentario]" style="width:100%"/>')
            var value = $(coment).children('#comentario').children('textarea').val();
            $(coment).children('#comentario').children('textarea').val($.trim(value));
            $(coment).children("#comentario").append("<input type='submit' value='Editar' class='btn btn-primary'/>");
            $(coment).children("#comentario").wrapInner("<form action='/oirs/ComentariosInternos/edit/"+indexComent+"' method='post'/>");
        });
        $("#editarR").click(function(){
            var resp = $(this).parents('div').eq(0);
            var indexResp = resp.attr('name').split('-')[1];
            $(resp).children('#respuesta').wrapInner('<textarea name="data[Respuesta][respuesta]" style="width:100%"/>')
            var value = $(resp).children('#respuesta').children('textarea').val();
            $(resp).children('#respuesta').children('textarea').val($.trim(value));
            $(resp).children("#respuesta").append("<input type='submit' value='Editar' class='btn btn-primary'/>");
            $(resp).children("#respuesta").wrapInner("<form action='/oirs/Respuestas/edit/"+indexResp+"' method='post'/>");
        });
        
    });
function goBack(){
   window.history.back();
}
</script>
