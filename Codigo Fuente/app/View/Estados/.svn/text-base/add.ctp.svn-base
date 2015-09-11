<script>
    $(document).ready(function(){
        $("#EstadoAddForm").validate({
            rules:{
                'data[Estado][estado]':'required'
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
$this->Html->addCrumb('Configuracion OIRS - Administrar Estados', '/estados');
$this->Html->addCrumb('Agregar', '#');
?>


<div class="estados form">
<?php echo $this->Form->create('Estado'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Estado'); ?></legend>
	<?php
		echo $this->Form->input('estado');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Agregar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
