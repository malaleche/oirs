<?php
$this->Html->addCrumb('Operaciones', '/Oirs');
$this->Html->addCrumb('Ingresar', '#');
?>

<script>
    $(document).ready(function(){
        var options = new Array();
        options.placement = 'right';
        $('label a').tooltip(options);
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
        $("#AnotacionAddForm").validate({
            rules:{
                'data[Anotacion][titulo]':'required',
                'data[Anotacion][cuerpo]':'required',
                'data[Anotacion][correo]':{
                    required:true,
                    email:true
                },
                'data[User][password]':'required',
                'data[User][password2]':{
                    required:true,
                    equalTo:'#UserPassword'
                }
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
  ele.name = 'data[Anotacion][archivo]['+num+']'; // 6
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

<style>
    
    .error{
        color: red;
        display: block;
        float: left;
        margin-left: 5px;
    }
    
    .input{
        clear: both;
    }
    
</style>

<div class="anotaciones form">
    <?php if($this->Session->read('Auth.User.Rol.rol')!='user') echo $this->Html->link('<< Volver', '#',array('onclick'=>'goBack();return false;')); ?>
    <?php echo $this->Form->create('Anotacion',array('type'=>'file')); ?>
    <fieldset >
        <legend><?php echo __('Ingresar Anotación'); ?></legend>
        <?php
        echo $this->Form->input('titulo', array('label' => '<a href="#" rel="tooltip" data-original-title="Suministre un corto y descriptivo título para la anotación. Un buen título hace que los administradores del proyecto identifiquen y respondan más facilmente a una anotación.">Titulo</a>', 'style' => 'width:400px'));
        echo $this->Form->input('cuerpo', array('label' => '<a href="#" rel="tooltip" data-original-title="Por favor suministre detalles adicionales">Detalle</a>', 'cols' => '30', 'rows' => '10', 'style' => 'width:400px'));
        echo $this->Form->input('tipo_anotacion_id', array('label' => '<a href="#" rel="tooltip" data-original-title="Seleccione el tipo de anotación">Tipo de Anotación</a>', 'style' => 'width:400px'));
        echo $this->Form->input('correo', array('label' => '<a href="#" rel="tooltip" data-original-title="Adicionalmente, suministre una dirección de correo donde usted puede ser contactado para información adicional.">Correo</a>', 'style' => 'width:400px','value' =>$correo));
        if ($this->Session->read('Auth.User.Rol.rol') !== 'user'):
            echo $this->Form->input('extension_plazo', array('type' => 'text', 'label' => '<a href="#" rel="tooltip" data-original-title="Ingrese numero de días que tomará resolver la anotación.">Extension Plazo</a>'));
            echo $this->Form->input('area_id', array('label' => '<a href="#" rel="tooltip" data-original-title="Seleccione el área a la que pertenece la anotación">Area</a>', 'style' => 'width:400px'));
            //echo $this->Form->input('publica', array('type' => 'checkbox'));
            //echo $this->Form->input('tipo_ingreso_id');
            echo $this->Form->input('tipo_plazo_id', array('label' => '<a href="#" rel="tooltip" data-original-title="Seleccione la urgencia para resolver la anotación.">Urgencia</a>'));
            echo $this->Form->input('estado_id', array('label' => '<a href="#" rel="tooltip" data-original-title="Seleccione el estado que debe tomar la anotación.">Estado</a>'));
            echo $this->Form->input('Unidad', array('type' => 'select', 'label' => '<a href="#" rel="tooltip" data-original-title="Seleccione la unidad Encargada de la anotación.">Unidad Encargada</a>', 'empty' => 'Seleccionar'));
        endif;
        ?>
        <div id="field" class="input">
            <input type="button" value="Agregar Archivo" onclick="crear(this)" />
            <br><br>
        </div>
        
    <?php echo $this->Form->buttom('Enviar', array('type' => 'submit', 'class' => 'btn btn-primary pull-left')); ?>
    &nbsp;
    <?php echo $this->Form->buttom('Limpiar', array('type' => 'reset', 'class' => 'btn')); ?>
</form> <!--Cierre del form creado con $this->Form->create();-->
</div>
