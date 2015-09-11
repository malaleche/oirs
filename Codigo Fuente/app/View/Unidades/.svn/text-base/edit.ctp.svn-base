<script>
function goBack(){
   window.history.back();
}
</script>
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Unidades', '/unidades');
$this->Html->addCrumb('Editar', '#');
?>

<div class="unidades form">
<?php echo $this->Form->create('Unidad'); ?>
	<fieldset>
		<legend><?php echo __('Editar Unidad'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('unidad');
		//echo $this->Form->input('Anotacion');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

