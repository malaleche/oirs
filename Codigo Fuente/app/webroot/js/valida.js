
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
      alert("El valor ingresado no corresponde a un RUT v�lido.");
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
      drut = drut + '.';
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
    alert("Debe ingresar un d�gito verificador v�lido.");
    control.select();
    control.focus();
    return false;
  }
  return true;
}