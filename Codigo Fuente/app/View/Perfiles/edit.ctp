<script>
function goBack(){
   window.history.back();
}
</script>
<div class="perfiles form">

    <fieldset>
        <legend><h2>Editar Perfil</h2></legend>
        <?php
        echo $this->Html->link('Modificar Contraseña', array('controller' => 'Users', 'action' => 'edit', $this->Session->read('Auth.User.id')));
        ?>
        <?php echo $this->Form->create('Perfil'); ?>
        <?php
        echo $this->Form->input('id');
        //echo $this->Form->input('rut');
        echo $this->Form->input('nombre');
        //echo $this->Form->input('apellido');
        echo $this->Form->input('telefono');
        echo $this->Form->input('celular');
        echo $this->Form->input('direccion');
        echo $this->Form->input('sexo',array('options'=>array('Masculino'=>'Masculino','Femenino'=>'Femenino')));
        echo $this->Form->input('User.correo');
        echo $this->Form->input('comuna_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>

</div>
