<script>
    $(document).ready(function(){
       $("#UserEditForm").validate({
           rules:{
               'data[User][passwordOld]':'required',
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
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/Users/index');
$this->Html->addCrumb('Editar', '#');
?>

<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php
            if ($this->Session->read('Auth.User.Rol.rol') !== 'user'):
                echo __('<h2>Editar Usuario</h2>');
            else:
                echo __('<h2>Modificar Contraseña</h2>');
            endif;
            ?>
        </legend>
        <?php
        if (!isset($this->request->data['User']['perfil_id'])) {
            echo $this->Html->link('Agregar Perfil', array('controller' => 'Perfiles', 'action' => 'add', $this->request->params['pass']['0']));
        }
        ?>
        <?php
        echo $this->Form->input('id');
        if ($this->Session->read('Auth.User.Rol.rol') !== 'user') {
            echo $this->Form->input('username', array('label' => 'Nombre de Usuario'));
            echo $this->Form->input('correo', array('label' => 'Correo'));
            if ($this->Session->read('Auth.User.Rol.rol') !== 'unidad') {
                echo $this->Form->input('rol_id');
                //echo $this->Form->input('perfil_id');
                echo $this->Form->input('unidad_id', array('empty' => 'Seleccionar','div'=>array('style'=>'display:none', 'id'=>'unidad')));
            }
        }
        if($this->Session->read('Auth.User.Rol.rol')!='oirs'){
            echo $this->Form->input('passwordOld', array('label' => 'Contraseña Actual', 'type' => 'password'));
        }
        echo $this->Form->input('password', array('label' => 'Contraseña Nueva'));
        echo $this->Form->input('password2', array('label' => 'Confirmar Contraseña', 'type' => 'password'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
