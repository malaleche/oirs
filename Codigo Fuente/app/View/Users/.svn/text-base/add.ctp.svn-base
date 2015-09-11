<script>
    $(document).ready(function(){
        $("#UserAddForm").validate({
            rules:{
                'data[User][username]':'required',
                'data[User][password]':'required',
                'data[User][correo]':{
                    required:true,
                    email:true
                }
            }
        });
        $("#UserRolId").change(function(){
            if($("#UserRolId option:selected").text() == 'Unidad Municipal'){
                $("#unidad").fadeIn('fast');
            }else{
                $("#unidad").fadeOut('fast');
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
$this->Html->addCrumb('Agregar', '#');
?>

<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Agregar Usuario'); ?></legend>
        <?php
        echo $this->Form->input('username', array('label' => 'Nombre de Usuario'));
        echo $this->Form->input('correo', array('label' => 'Correo'));
        echo $this->Form->input('password', array('label' => 'Contraseña'));
        echo $this->Form->input('rol_id',array('selected'=>'2'));
        //echo $this->Form->input('perfil_id');
        echo $this->Form->input('unidad_id', array('empty' => 'Seleccionar','div'=> array('style'=>'display:none','id'=>'unidad')));
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => 'Agregar', 'class' => 'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>