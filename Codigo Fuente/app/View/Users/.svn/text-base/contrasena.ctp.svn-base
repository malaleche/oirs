<script>
    $(document).ready(function(){
        $("#UserContrasenaForm").validate({
            rules:{
                'data[User][password1]':'required',
                'data[User][password2]':{
                    required:true,
                    equalTo:'#UserPassword1'
                }
            }
        });
    });
</script>
<style>
    
    .error{
        color: red;
        display: block;
        float: left;
        margin-left: 5px;
    }
    
    .input {
        clear: both;
    }
    
    
</style>
<div class="users form">
    <?php echo $this->Session->flash(); ?>
    <fieldset class='span4'>
        <legend><?php echo __('Ingrese por favor una nueva contraseña'); ?></legend>
        <?php echo $this->Form->create('User', array('action' => 'contrasena')); ?>
        <?php
        echo $this->Form->input('password1', array('type'=>'password','label' => 'Ingresar nueva contraseña'));
        echo $this->Form->input('password2', array('type'=>'password','label' => 'Vuelva a ingresar contraseña'));
        ?>
        <?php echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-primary','div'=>array('class'=>'input'))); ?>
    </fieldset>
</div>
