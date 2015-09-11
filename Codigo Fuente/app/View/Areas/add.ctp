<script>
    $(document).ready(function(){
        $("#AreaAddForm").validate({
            rules:{
                'data[Area][area]':'required'
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
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/Areas');
$this->Html->addCrumb('Agregar', '/Areas/add');
?>

<div class="areas form">
<?php echo $this->Form->create('Area'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Area'); ?></legend>
	<?php
		echo $this->Form->input('area');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
