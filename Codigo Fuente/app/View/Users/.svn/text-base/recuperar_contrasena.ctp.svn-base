<script>
    function goBack(){
        window.history.back();
    }
</script>
<hr>
    <?php echo $this->Session->flash(); ?>
<div id='MensajeBienvenida' class='well pull-left' style="text-align: center;">
    <p class='span4' style="text-align: left;display: block;clear: both;">
        Ingrese su nombre de usuario y le será enviada una contraseña a su correo registrado.
    </p>
</div>
<div class="users form offset5">
    <fieldset class='span4'>

        <legend><?php echo __('Recuperar Contraseña'); ?></legend>
        <?php echo $this->Form->create('User', array('action' => 'recuperarContrasena')); ?>
        <?php
        echo $this->Form->input('username', array('label' => 'Ingresar nombre de usuario'));
        ?>
        <?php echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-primary', 'div' => false, 'after' => ' ' . $this->Form->button('Cancelar', array('type' => 'button', 'class' => 'btn', 'onclick' => 'goBack()')))); ?>
    </fieldset>
</div>
