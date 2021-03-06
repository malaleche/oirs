
<script>
    $(document).ready(function(){
        if($('#AnotacionTipoPlazoId option:selected').text() == 'Extendido'){
            $('#AnotacionExtensionPlazo').attr('readonly', false);
        }else
        {
            $('#AnotacionExtensionPlazo').attr('readonly', true);
        }
        $('#AnotacionTipoPlazoId').change(function(){
            if($('#AnotacionTipoPlazoId option:selected').text() == 'Extendido'){
                $('#AnotacionExtensionPlazo').attr('readonly', false);
            }else
            {
                $('#AnotacionExtensionPlazo').attr('readonly', true);
            }
        });
        
    });
num=0;
function crear(obj) {
  num++;
  fi = document.getElementById('field'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num; // 3
  fi.appendChild(contenedor); // 4

  ele = document.createElement('input'); // 5
  ele.type = 'file'; // 6
  ele.name = 'data[Respuesta][archivo]['+num+']'; // 6
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.name = 'div'+num; // 8
  ele.onclick = function () {borrar(this.name)} // 9
  contenedor.appendChild(ele); // 7
}
function borrar(obj) {
  fi = document.getElementById('field'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
}
    function goBack(){
        window.history.back();
    }
</script>
<?php
$this->Html->addCrumb('Procesar anotacion', '#');
?>

<fieldset>
    <legend><?php echo __('Editar Anotacion'); ?></legend>
    <div id="datos">
        <div id="detalle" class="alert alert-info">
            <h5>Anotación del usuario</h5>
            <?php
            $cuerpo = str_ireplace(chr(10) . chr(13), '<br>', trim($anotacion['Anotacion']['cuerpo']));
            echo $cuerpo;
            ?>     
        </div>
        <div id="user">
            <table class="table table-bordered">
                <thead>
                <th clospan="2">Datos del Usuario</th>
                </thead>
                <tbody>
                    <?php if (!isset($anotacion['User']['Perfil']['rut'])): ?>
                        <tr>
                            <td>Usuario</td><td><?php echo $anotacion['User']['username']; ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>Rut</td><td><?php echo $anotacion['User']['Perfil']['rut']; ?></td>
                        </tr>
                        <tr>
                            <td>Usuario</td><td><?php echo $this->Form->postLink($anotacion['User']['Perfil']['nombre'], array('controller' => 'Anotaciones', 'action' => 'index', $anotacion['User']['id'])); ?></td>
                        </tr>


                        <tr>
                            <td>Direcion</td><td><?php echo $anotacion['User']['Perfil']['direccion']; ?></td>
                        </tr>
                        <tr>
                            <td>Telefono</td><td><?php echo $anotacion['User']['Perfil']['telefono']; ?></td>
                        </tr>
                        <tr>
                            <td>Celular</td><td><?php echo $anotacion['User']['Perfil']['celular']; ?></td>
                        </tr>
                    <?php endif; ?>
                        <tr>
                            <td>Correo</td><td><?php echo $anotacion['User']['correo']; ?></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="anotaciones form">
        <?php echo $this->Form->create('Anotacion',array('type'=>'file')); ?>

        <?php
        echo $this->Form->input('id');
        //echo $this->Form->input('titulo');
        //echo $this->Form->input('cuerpo');
        //echo $this->Form->input('correo');
        echo $this->Form->input('extension_plazo', array('type' => 'text'));
        //echo $this->Form->input('publica');
        //echo $this->Form->input('user_id');
        //echo $this->Form->input('tipo_ingreso_id');
        //echo $this->Form->input('tipo_anotacion_id');
        echo $this->Form->input('tipo_plazo_id');
        echo $this->Form->input('estado_id');
        echo $this->Form->input('area_id');
        echo $this->Form->input('Unidad', array('multiple' => false, 'empty' => 'Seleccionar'));
        echo $this->Form->input('ComentariosInterno.comentario', array('type' => 'textarea', 'label' => 'Comentario Interno','style'=>'width:440px'));
        echo $this->Form->input('Respuesta.respuesta', array('type' => 'textarea', 'label' => 'Respuesta','style'=>'width:440px'));
        ?>
        <br>
        <div id="field" class="input">
            <input type="button" value="Agregar Archivo" onclick="crear(this)" />
            <br><br>
        </div>
        <br>
        <?php
        echo $this->Form->end(array('label' => 'Guardar', 'class' => 'btn btn-primary', 'div' => false, 'after' => ' ' . $this->Form->button('Cancelar', array('type' => 'button', 'class' => 'btn', 'onclick' => 'goBack()'))));
//echo $this->Html->link('Cancelar',array('action'=>'view', $this->request->data('Anotacion.id')),array('class'=>'btn'));
        ?>
    </div>
    
</fieldset>

