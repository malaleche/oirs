<script>
    $(document).ready(function(){
        $("#UnidadAddForm").validate({
            rules:{
                'data[Unidad][unidad]':'required'
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
$this->Html->addCrumb('Configuracion OIRS - Administrar Unidades', '/unidades');
$this->Html->addCrumb('Agregar', '#');
?>

<div class="unidades form">
<?php echo $this->Form->create('Unidad'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Unidad'); ?></legend>
	<?php
		echo $this->Form->input('unidad');
		//echo $this->Form->input('Anotacion');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

