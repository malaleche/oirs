<script>

    $(document).ready(function() {
        //        var urlsplit = document.URL.split(':');
        //        if(urlsplit.length > '1'){
        //            var tab = urlsplit.pop();
        //            if(!isNaN(tab)){
        //                var obj = '#'.concat(tab);
        //                $(obj).tab('show');
        //            }
        //        }
        //
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })  
        
        $("#TransparenciaPasivaSubmitForm").validate({
            rules:{
                'data[TransparenciaPasiva][nombre]':'required',
                'data[TransparenciaPasiva][direccion]':'required',
                'data[TransparenciaPasiva][correo]':{
                    required:true,
                    email:true
                },
                'data[TransparenciaPasiva][correo2]':'email',
                'data[TransparenciaPasiva][descripcion]':'required'
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
	
    .error1{
        color: red;
        display: block;
        float: left;
        margin-left: 15px;
		background-color: #e3e3e3;
		padding: 12px 15px;
		border: 1px solid #ccc;
		-webkit-border-radius: 4px;
		-moz-border-radius: 4px;
		border-radius: 4px;
    }
    
	.input, h4{
        clear: both;
    }

</style>
<?php
$tab = isset($this->request->params['named']['tab'])?$this->request->params['named']['tab']:'';
switch ($tab) {
    case '1':$class1 = 'active';
        $class2 = '';
        $class3 = '';
        break;
    case '2':$class1 = '';
        $class2 = 'active';
        $class3 = '';
        break;
    case '3':$class1 = '';
        $class2 = '';
        $class3 = 'active';
        break;
    default :$class1 = 'active';
        $class2 = '';
        $class3 = '';
        break;
}

?>
<ul class="nav nav-tabs" id="myTab">
    <li class="<?php echo $class1; ?>"><a id='1' href="#login">Iniciar Sesion</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane <?php echo $class1; ?>" id="login">
        <?php echo $this->Session->flash('login'); ?>
        <!--        Seccion de login-->
        <div id='MensajeBienvenida' class='well pull-left' style="text-align: center;">
            <p class='span4' style="text-align: justify;display: block;clear: both;">
                Estimado vecino y vecina, queremos darle la bienvenida y contarle que el municipio ha creado la Oficina de Informaciones Reclamos y Sugerencias (OIRS) Digital de Peñalolén, iniciativa consistente en un portal informático mediante Internet el cual usted podrá ingresar sus sugerencias y reclamos y conocer las respuestas a las mismas en un plazo determinado. Porque su opinión nos interesa, en el caso de no tener un computador o bien un telecentro cercano a su hogar, la Municipalidad ha dispuesto un centro de Internet gratuito en el Hall del segundo piso del Municipio
            </p>
            <br>
            <p style="display:block;clear: both;">
                <?php echo $this->Html->link('Registrarse', array('controller' => 'Home', 'action' => 'registrarse'), array('class' => 'btn btn-primary')); ?>
                <!--<a href="Home/registrarse" class="btn btn-primary centered">Registrarse</a>-->
            </p>
        </div>
        <!--        Formulario inicio de sesion-->
        <div class="users form offset5">		

            <fieldset class='span4'>
                <legend><?php echo __('Iniciar Sesión'); ?></legend>
                <?php echo $this->Form->create('User', array('action' => 'login')); ?>
                <?php
                echo $this->Form->input('username', array('label' => 'Usuario/Rut'));
                echo $this->Form->input('password', array('label' => 'Contraseña'));
                ?>
                <?php echo $this->Html->link('Recuperar contraseña', array('controller' => 'users', 'action' => 'recuperarContrasena')); ?>
                <?php echo $this->Form->end(array('label' => 'Login', 'class' => 'btn btn-primary')); ?>
            </fieldset>
			<div class="error1"><strong>
				<?php 
				if ($this->Session->check('Message.flash')){ echo $this->Session->flash(); }
				?></strong>
			</div>
        </div>
    </div>
    
</div>

