<script>
    $(document).ready(function(){
        $("#TiposIngresoAddForm").validate({
            rules:{
                'data[TiposIngreso][tipo]':'required',
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
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos Ingresos', '/TiposIngresos');
$this->Html->addCrumb('Agregar', '/TiposIngresos/add');
?>
<div class="tiposIngresos form">
<?php echo $this->Form->create('TiposIngreso'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Tipo Ingreso'); ?></legend>
	<?php
		echo $this->Form->input('tipo');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

