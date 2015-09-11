<script>

$(document).ready(function(){
       
       jQuery.validator.addMethod('formatRut', function(value, element){
           return this.optional(element) || value.match('^[\\d]{7,8}-[\\d|k|K]{1}$');
       },'Formato Incorrecto');
       
       jQuery.validator.addMethod('validarRut', function(value, element){
            var error = true;
            var rutsplit = value.split('-');
            var indice = rutsplit.pop();
            indice = (indice == 'k' || indice == 'K')?10:parseInt(indice);
            var num = rutsplit[0];
            num = num.split('');
            var acu = 0;
            var aux;
            var array = [7,6,5,4,3,2];
            var i;
            var largo = parseInt(num.length);
            for(i = 0;i < largo;i++){
                aux = parseInt(array.pop());
                acu += (parseInt(num.pop())*aux);
                array.unshift(aux);
            }
            if(indice != 11-(acu%11)){
                error= false;
            }  
           return this.optional(element) || error;
       },'El rut no es valido');

        $("#PerfilAddForm").validate({
            rules:{
                'data[Perfil][rut]':{
                    required:true,
                    formatRut:true,
                    validarRut:true
                },
                'data[Perfil][nombre]':'required',
                'data[Perfil][telefono]':{
                    required:true
                },
                'data[Perfil][celular]':{
                    required:true
                },
                'data[Perfil][direccion]':'required',
                'data[Perfil][sexo]':'required',
                'data[Perfil][correo]':{
                    required:true,
                    email:true
                }
            }
        });
    });
    
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
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/Users');
$this->Html->addCrumb('Agregar-Perfil', '#');
?>

<div class="perfiles form">
<?php echo $this->Form->create('Perfil'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Perfil'); ?></legend>
	<?php
                echo $this->Form->input('User.id',array('type'=>'hide', 'value'=>$this->request->params['pass'][0]));
		echo $this->Form->input('rut');
		echo $this->Form->input('nombre',array('label'=>'Nombre Completo'));
		//echo $this->Form->input('apellido');
		echo $this->Form->input('telefono');
		echo $this->Form->input('celular');
		echo $this->Form->input('direccion');
		$options = array('Masculino' => 'Masculino', 'Femenino' => 'Femenino');
                echo $this->Form->input('Perfil.sexo', array('options' => $options, 'empty' => 'Seleccionar'));
		echo $this->Form->input('comuna_id',array('selected'=>'307'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

