<script>
function goBack(){
   window.history.back();
}
</script>
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Encuestas', '/encuestas');
$this->Html->addCrumb('Editar', '#');
?>

<div class="encuestas form">
    <?php echo $this->Form->create('Encuesta'); ?>
    <fieldset>
        <legend><?php echo __('Editar Encuesta'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('encuesta', array('label' => 'Titulo de la encuesta', 'style' => 'width:500px'));
        ?>
        <div id="encuesta">
            <?php
            if ($this->request->data('Pregunta') != 'NULL'):
                foreach ($this->request->data['Pregunta'] as $key => $value):
                ?>
                <div name="pregunta-<?php echo $key; ?>" class="alert alert-success">
                    <!--<div name="actions"><a href="#" class="btn btn-success"><i class="icon-plus"></i></a><a href="#" class="btn btn-danger"><i class="icon-remove"></i></a></div>-->
                    <?php
                    echo $this->Form->input('Pregunta.' . $key . '.id');
                    echo $this->Form->input('Pregunta.' . $key . '.pregunta', array('div' => false, 'style' => 'width:500px', 'class' => 'pull-left', 'label' => array('text' => 'Pregunta'), 'after' => '<div name="actions2">-'.$this->Html->link('', array('controller'=>'Preguntas','action' => 'delete', isset($value['id'])?$value['id']:''), array('class'=>'btn btn-danger'), __('Estas seguro de eliminar la pregunta # %s?', isset($value['id'])?$value['id']:'')).'</div><br/>'));
                    foreach ($value['Alternativa'] as $key1 => $value2):
                        ?>
                        <div name="alternativa-<?php echo $key1; ?>" class="alert alert-info">
                            <?php
                            echo $this->Form->input('Pregunta.' . $key . '.Alternativa.' . $key1 . '.id');
                            echo $this->Form->input('Pregunta.' . $key . '.Alternativa.' . $key1 . '.alternativa', array('div' => false, 'style' => 'width:500px', 'class' => 'pull-left', 'label' => array('text' => 'Alternativa'), 'after' => '<div name="actions2">-'.$this->Html->link('', array('controller'=>'Alternativas','action' => 'delete', isset($value2['id'])?$value2['id']:''), array('class'=>'btn btn-danger', 'name'=>'Aremove2'), __('Estas seguro de eliminar la alternativa # %s?', isset($value2['id'])?$value2['id']:'')).'</div><br/>'));
                            ?>
                        </div>
                        <?php
                    endforeach;
                    ?>
                    <a name="Aplus" href="#" class="btn btn-success"><i class="icon-plus"></i>Agregar Alternativa</a> 
                </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
        <a name="Pplus" href="#" class="btn btn-success"><i class="icon-plus"></i> Agregar Pregunta</a>
            <br>
            <br>
    </fieldset>
    <?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

<script>

$(document).ready(function(){
	//Codigo aqui
        $("[name=actions2]").children('a').wrapInner("<i class='icon-remove'></i>");
	$("[name=Pplus]").bind("click", crearPregunta);
        $("[name=Premove]").bind("click", borrarPregunta);
	$("[name=Aplus]").bind("click", crearAlternativa);
        $("[name=Aremove]").bind("click", borrarAlternativa);
	//Funciones
	function crearPregunta(e){
		e.preventDefault();
		var indexPreg = $('[name^=pregunta]:last').attr('name').split('-')[1];
		indexPreg = parseInt(indexPreg) + 1;
		/*Preparar nueva pregunta y agregarla a contenedor encuesta*/
		var newPreg = $("<div name='pregunta-"+indexPreg+"' class='alert alert-success'><label for='Pregunta"+indexPreg+"Pregunta'>Pregunta</label><input name='data[Pregunta]["+indexPreg+"][pregunta]' style='width:500px' class='pull-left' maxlength='100' type='text' id='Pregunta"+indexPreg+"Pregunta'><div name='actions'>-<a name='Premove' href='#' class='btn btn-danger'><i class='icon-remove'></i></a></div><br><div name='alternativa-0' class='alert alert-info'><label for='Pregunta0Alternativa0Alternativa'>Alternativa</label><input name='data[Pregunta]["+indexPreg+"][Alternativa][0][alternativa]' style='width:500px' class='pull-left' type='text' id='Pregunta"+indexPreg+"Alternativa0Alternativa'><div name='actions'>-<a name='Aremove' href='#' class='btn btn-danger'><i class='icon-remove'></i></a></div><br></div><div name='alternativa-1' class='alert alert-info'><label for='Pregunta"+indexPreg+"Alternativa1Alternativa'>Alternativa</label><input name='data[Pregunta]["+indexPreg+"][Alternativa][1][alternativa]' style='width:500px' class='pull-left' type='text' id='Pregunta"+indexPreg+"Alternativa1Alternativa'><div name='actions'>-<a name='Aremove' href='#' class='btn btn-danger'><i class='icon-remove'></i></a></div><br></div><a name='Aplus' href='#' class='btn btn-success'><i class='icon-plus'></i>Agregar Alternativa</a></div>");
		$(newPreg).children("[name=actions]").children('a').bind("click", borrarPregunta);
                $(newPreg).children("[name=Aplus]").bind("click", crearAlternativa);
                $(newPreg).children("[name^=alternativa]").children("[name=actions]").children("[name=Aremove]").bind("click",borrarAlternativa)
		$(newPreg).appendTo("#encuesta");
	}
        
        function borrarPregunta(e){
		e.preventDefault();
		if($("[name^=pregunta]").length > '1')
			$(e.currentTarget).parents('div').eq(1).remove();
		else
			alert('Minimo una pregunta por encuesta');
	}
	
	function crearAlternativa(e){
		e.preventDefault();
		var pregunta = $(e.currentTarget).parents("div").eq(0);
		var indexPreg = pregunta.attr("name").split("-")[1];
		var indexAlter = $(pregunta).children("[name^=alternativa]:last").attr("name").split("-")[1];
		indexAlter = parseInt(indexAlter) + 1;
		var newAlter = $("<div name='alternativa-"+indexAlter+"' class='alert alert-info'><label for='Pregunta"+indexPreg+"Alternativa"+indexAlter+"Alternativa'>Alternativa</label><input name='data[Pregunta]["+indexPreg+"][Alternativa]["+indexAlter+"][alternativa]' style='width:500px' class='pull-left' type='text' id='Pregunta"+indexPreg+"Alternativa"+indexAlter+"Alternativa'><div name='actions'>- <a name='Aremove' href='#' class='btn btn-danger'><i class='icon-remove'></i></a></div><br></div>");
		$(newAlter).children("[name=actions]").children('a').bind("click", borrarAlternativa);
		$(newAlter).insertBefore($(pregunta).children("a").eq(0));
	}
	
	function borrarAlternativa(e){
		e.preventDefault();
                var pregunta = $(e.currentTarget).parents("div").eq(2);
		if($(pregunta).children("[name^=alternativa]").length > '2')
			$(e.currentTarget).parents('div').eq(1).remove();
		else
			alert('Minimo 2 alternativas por pregunta');
	}
});

</script>
