<script>
    $(document).ready(function(){
        $("#TiposAnotacionAddForm").validate({
            rules:{
                'data[TiposAnotacion][tipo]':'required',
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
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos ANotaciones', '/TiposIngresos');
$this->Html->addCrumb('Agregar', '/TiposIAnotaciones/add');
?>
<div class="tiposAnotaciones form">
<?php echo $this->Form->create('TiposAnotacion'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Tipo Anotacion'); ?></legend>
	<?php
		echo $this->Form->input('tipo');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

