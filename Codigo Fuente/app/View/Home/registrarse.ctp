<script>
	function checkRutPersona(control)
		{
		  var rut = control.value;
		  var tmpstr = "";
		  if((rut==null)||(rut=="")){return true;}
		  
		  for ( i=0; i < rut.length ; i++ )
			if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' )
			  tmpstr = tmpstr + rut.charAt(i);
		  rut = tmpstr;
		  largo = rut.length;
		// [VARM+]
		  tmpstr = "";
		  for ( i=0; rut.charAt(i) == '0' ; i++ );
		  for (; i < rut.length ; i++ )
			 tmpstr = tmpstr + rut.charAt(i);
		  rut = tmpstr;
		  largo = rut.length;
		// [VARM-]
		  if ( largo < 2 )
		  {
			alert("Debe ingresar el RUT completo.");
			control.focus();
			control.select();
			return false;
		  }
		  for (i=0; i < largo ; i++ )
		  {
			if( (rut.charAt(i) != '0') && (rut.charAt(i) != '1') && (rut.charAt(i) !='2') && (rut.charAt(i) != '3') && (rut.charAt(i) != '4') && (rut.charAt(i) !='5') && (rut.charAt(i) != '6') && (rut.charAt(i) != '7') && (rut.charAt(i) != '8') && (rut.charAt(i) != '9') && (rut.charAt(i) !='k') && (rut.charAt(i) != 'K') )
			{
			  alert("El valor ingresado no corresponde a un RUT válido.");
			  control.focus();
			  control.select();
			  return false;
			}
		  }
		  
		  rutMax = control.value;
		  tmpstr="";
		  for ( i=0; i < rutMax.length ; i++ )
			if ( rutMax.charAt(i) != ' ' && rutMax.charAt(i) != '.' && rutMax.charAt(i) != '-' )
			  tmpstr = tmpstr + rutMax.charAt(i);
		  tmpstr = tmpstr.substring(0, tmpstr.length - 1);
		  if ( !(tmpstr < 50000000) )
		  {
		/*******************
			alert('El Rut ingresado no corresponde a un RUT de Persona Natural')
				control.focus();
				control.select();		
				return false;

		********************/
		  }
		  
		  var invertido = "";
		  for ( i=(largo-1),j=0; i>=0; i--,j++ )
			invertido = invertido + rut.charAt(i);
		  var drut = "";
		  drut = drut + invertido.charAt(0);
		  drut = drut + '-';
		  cnt = 0;
		  
		  for ( i=1,j=2; i<largo; i++,j++ )
			{
			if ( cnt == 3 )
			{
			  drut = drut + '';
			  j++;
			  drut = drut + invertido.charAt(i);
			  cnt = 1;
			}
			else
			{
			  drut = drut + invertido.charAt(i);
			  cnt++;
			}
		  }
		  invertido = "";
		  for ( i=(drut.length-1),j=0; i>=0; i--,j++ )
		  {
			if (drut.charAt(i)=='k')
				invertido = invertido + 'K';
			else
				invertido = invertido + drut.charAt(i);
		  }
		  control.value = invertido;
		  if(!checkDVPersona(rut, control))
			return false;
		  return true;
		}

		/********** DIGITO  *******/
		function checkDVPersona(crut, control)
		{
		  largo = crut.length;
		  if(largo < 2){
			alert("Debe ingresar el RUT completo.");
			control.select();
			control.focus();
			return false;
		  }
		  if(largo > 2){
			rut = crut.substring(0, largo - 1);
		  }
		  else{
			rut = crut.charAt(0);
		  }
		  dv = crut.charAt(largo-1);

		  if(!checkCDVPersona(dv))
			 return false;

		  if(rut == null || dv == null){
			  return false;
		  }

		  var dvr = '0';
		  suma = 0;
		  mul  = 2;
		  for (i= rut.length -1 ; i >= 0; i--){
			suma = suma + rut.charAt(i) * mul;
			if(mul == 7){
			  mul = 2;
			}
			else{
			  mul++;
			}
		  }
		  res = suma % 11;
		  if (res==1){
			dvr = 'k';
		  }
		  else{
			if(res==0){
			  dvr = '0';
			}
			else{
			  dvi = 11-res;
			  dvr = dvi + "";
			}
		  }
		  if(dvr != dv.toLowerCase()){
			alert("El RUT es incorrecto.");
			control.select();
			control.focus();
			return false;
		  }
		  return true;
		}

		function checkCDVPersona(dvr)
		{
		  dv = dvr + "";
		  if(dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K'){
			alert("Debe ingresar un dígito verificador válido.");
			control.select();
			control.focus();
			return false;
		  }
		  return true;
		}

    $(document).ready(function(){
       
		jQuery.validator.addMethod('formatRut', function(value, element){
            return this.optional(element) || value.match('^[\\d]{7,8}-[\\d|k|K]{1}');
        },'Formato Incorrecto');
		/*
        jQuery.validator.addMethod('formatFono', function(value, element){
            return this.optional(element) || value.match('^[\\d]{1,2}-2[\\d]{7}$');
        },'Formato Incorrecto');
        jQuery.validator.addMethod('formatFonoCel', function(value, element){
            return this.optional(element) || value.match('^[\\d]{1,2}-[\\d]{7}$');
        },'Formato Incorrecto');
		*/
        jQuery.validator.addMethod('lettersAndSpaceOnly', function(value, element){
            return this.optional(element) || value.match('^[a-zA-z ]*$'); 
        },'Ingrese letras y espacios solamente');
		/*
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
		*/
        $("#UserRegistrarseForm").validate({
            rules:{
                'data[Perfil][rut]':{
                    required:true,
                    //formatRut:true
                    //validarRut:true
                },
                'data[Perfil][nombre]':{
                    required:true,
                    lettersAndSpaceOnly:true
                },
                'data[Perfil][telefono]':{
                    //required:true,
                    formatFono:true
                    
                },
                'data[Perfil][celular]':{
                    //required:true,
                    formatFono:true
                },
                'data[Perfil][direccion]':'required',
                'data[Perfil][sexo]':'required',
                'data[User][correo]':{
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
<div id="registrarse form">
    <h2>Registro de Usuario</h2>
    <?php echo $this->Html->link('<< Volver', '#', array('onclick' => 'goBack();return false;')); ?>
    <br><br>
    <div id="error" style="display: none" class="alert alert-error">
        <h5>Errores</h5>
    </div>
    <?php
    echo $this->Form->create(null, array('url' => array('controller' => 'Home', 'action' => 'registrarse')));
    echo $this->Form->input('Perfil.rut', array('style' => 'width:300px;', 'placeholder' => 'Ej: 12345678-k', 'onblur' => 'checkRutPersona(this);'));
    echo $this->Form->input('Perfil.nombre', array('label' => 'Nombre Completo', 'style' => 'width:300px;'));
    //echo $this->Form->input('Perfil.apellido', array('style' => 'width:300px;'));
    echo $this->Form->input('Perfil.telefono', array('style' => 'width:300px;', 'placeholder' => '(Cod. Ciudad)-(Numero)Ej:02-1234567'));
    echo $this->Form->input('Perfil.celular', array('style' => 'width:300px;', 'placeholder' => 'Ej: 9-1234567'));
    echo $this->Form->input('Perfil.direccion', array('style' => 'width:300px;', 'placeholder' => 'Calle, #Numero, Villa/Pobl., Ciudad'));
    echo $this->Form->input('Perfil.comuna_id', array('selected' => '307'));
    $options = array('Masculino' => 'Masculino', 'Femenino' => 'Femenino');
    echo $this->Form->input('Perfil.sexo', array('options' => $options, 'empty' => 'Seleccionar'));
    echo $this->Form->input('User.correo', array('style' => 'width:300px;', 'placeholder' => 'Ej:ejemplo_de_correo01@correo.com'));
    echo $this->Form->input('User.password', array('label' => 'Contraseña', 'style' => 'width:300px;'));
    echo $this->Form->input('password2', array('label' => 'Confirmar contraseña', 'type' => 'password', 'style' => 'width:300px;'));
    if ($this->Session->read('Auth.User.Rol.rol') == 'oirs'):
        echo $this->Form->input('User.username', array('style' => 'width:300px;'));
        echo $this->Form->input('User.rol_id');
        echo $this->Form->input('User.unidad_id', array('empty' => 'Seleccionar'));
    endif;
    echo $this->Form->end(array('label' => 'Agregar', 'class' => 'btn btn-primary', 'div' => array('class' => 'input')));
    ?>
</div>