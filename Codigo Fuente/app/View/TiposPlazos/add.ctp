<script>
    $(document).ready(function(){
        $("#TiposPlazoAddForm").validate({
            rules:{
                'data[TiposPlazo][tipo]':'required',
                'data[TiposPlazo][dias]':{
                    required:true,
                    min:0
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
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos Plazos', '/tiposPlazos');
$this->Html->addCrumb('Agregar', '/tiposPlazos/add');
?>

<div class="tiposPlazos form">
<?php echo $this->Form->create('TiposPlazo'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Tipos Plazo'); ?></legend>
	<?php
		echo $this->Form->input('tipo');
		echo $this->Form->input('dias');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
