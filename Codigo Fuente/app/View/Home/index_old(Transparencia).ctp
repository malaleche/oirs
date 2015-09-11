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
    <li class="<?php echo $class2; ?>"><a id='2' href="#tpasiva">Transparencia Pasiva</a></li>
    <li class="<?php echo $class3; ?>"><a id='3' href="#buscar">Seguimiento de Anotaciones Transparencia Pasiva</a></li>
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
    <div class="tab-pane <?php echo $class2; ?>" id="tpasiva">
        <!--        Seccion de transparencia pasiva -->
        <?php echo $this->Session->flash('tpasiva'); ?>
        <fieldset>
            <legend style="margin-top: 0px;"><?php echo __('Formulario de Transparencia Pasiva'); ?></legend>
            <p>Solicitud de Información Transparencia Municipal (Ley 20.285)</p>
            <?php echo $this->Form->create('TransparenciaPasiva', array('controller' => 'TransparenciaPasivas', 'action' => 'submit')); ?>
            <h4>Información del Solicitante</h4>
            <?php
            echo $this->Form->input('nombre', array('label' => 'Nombre Completo', 'style' => 'width:400px;'));
            echo $this->Form->input('direccion', array('label' => 'Direccion Completa', 'style' => 'width:400px;'));
            echo $this->Form->input('correo', array('label' => 'Correo Electronico'));
            ?>
            <h4>Información del Apoderado(En caso que exista)</h4>
            <?php
            echo $this->Form->input('nombre2', array('label' => 'Nombre Completo', 'style' => 'width:400px;'));
            echo $this->Form->input('direccion2', array('label' => 'Direccion Completa', 'style' => 'width:400px;'));
            echo $this->Form->input('correo2', array('label' => 'Correo Electronico'));
            ?>
            <h4>
                Señale claramente la informacion que solicita, indicando fecha, periodos, materia, unidad de origen u 
                otra indicación que ayude a identificar lo solicitado
            </h4>

            <?php
            echo $this->Form->input('descripcion', array('cols' => '120', 'rows' => '15', 'style' => 'width:977px;height:240px;'));
            ?>
            <div class="well span10" style="margin:0px; text-align: justify">
                <h3>SABÍA USTED QUE…</h3> 
                El plazo legal para la entrega de la información requerida, es de 20 días hábiles, contados desde la recepción de su solicitud, que cumple con los requisitos enunciados en el artículo 12 de la Ley 20.285. Dicho plazo eventualmente podrá variar en caso de:<br>
                <br>
                1-	 Subsanación: En el caso de que la solicitud no reúna los requisitos enunciados en el inciso 1° del artículo 12 de la Ley 20.285, se requerirá al solicitante para que, en un plazo de 5 días, contados desde la respectiva notificación, subsane la falta. Indicando expresamente que, en caso de no subsanar, se le tendrá por desistido (a) de su solicitud.
                <br>
                <br>
                2-	Prórroga del plazo: Excepcionalmente el plazo de entrega de la información podrá ser prorrogado por 10 días hábiles, cuando existan circunstancias que hagan difícil reunir la información solicitada, en dicha situación la Municipalidad se lo comunicará al solicitante antes del vencimiento del plazo legal. 
                <br>
                <br>
                Asimismo le comunicamos que vencido el plazo de 20 días hábiles, establecido en el artículo 14 de la Ley 20.285, para la entrega de la documentación requerida, o denegada la petición, usted tiene derecho a recurrir ante el Consejo para la Transparencia, solicitando amparo a su derecho de acceso a la información.
                <br>
                <br>
                En cuanto a los costos directos de reproducción, que sean necesarios para obtener la información en el soporte que el peticionario haya solicitado, deben ser cancelados por los interesados.
            </div>
            <?php
            echo '<div class="input text">';
            echo $this->Form->checkbox('publica', array('class' => 'pull-left'));
            echo '</div>';
            echo $this->Form->label('TransparenciaPasiva.publica', 'Acepta hacer publica su solicitud a otros usuarios');
            ?>
            <?php echo $this->Form->end(array('label' => 'Enviar', 'class' => 'btn btn-primary')); ?>
        </fieldset>
    </div>
    <div class="tab-pane <?php echo $class3; ?>" id="buscar">
        <?php echo $this->Session->flash('buscar'); ?>
        <!--            Seccion de buscador de anotaciones-->
        <div id='cuadroExplicativo' class='well pull-left span4' style="text-align:center">
            <p style="text-align:justify">
                En esta seccion podrás realizar el seguimiento de tus anotaciones de transparencia pasiva para saber en que estado de proceso se encuentran, sin necesidad de iniciar sesión.
            </p>
            <p>
            <?php echo $this->Html->link('Ver Anotaciones Publicas',array('controller'=>'transparenciaPasivas','action'=>'listPublic'),array('class'=>'btn btn-primary')); ?>
            </p>
        </div>
        <div class="buscar form offset5">
            <fieldset class='span4'>
                <legend><?php echo __('Buscar Anotación'); ?></legend>
                <?php echo $this->Form->create('Anotacion', array('controller' => 'Anotaciones', 'action' => 'view', 'type' => 'get')); ?>

                <?php echo $this->Form->input('id', array('type' => 'text', 'label' => 'Ingresar Codigo de Anotacion')); ?>
                <?php echo $this->Form->input('correo', array('type' => 'text', 'label' => 'Ingresar correo del solicitante registrado en la anotacion')); ?>
                <?php echo $this->Form->end(array('label' => 'Buscar', 'class' => 'btn btn-primary')); ?>
        </div>
    </div>
</div>

