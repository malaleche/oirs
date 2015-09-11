<script>
function goBack(){
   window.history.back();
}
</script>
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipo Anotaciones', '/TiposAnotaciones');
$this->Html->addCrumb('Editar', '#');
?>

<div class="tiposAnotaciones form">
<?php echo $this->Form->create('TiposAnotacion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Tipos Anotacion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tipo');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
