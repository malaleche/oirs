<script>
function goBack(){
   window.history.back();
}
</script>
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipos Plazos', '/tiposPlazos');
$this->Html->addCrumb('Editar', '#');
?>

<div class="tiposPlazos form">
<?php echo $this->Form->create('TiposPlazo'); ?>
	<fieldset>
		<legend><?php echo __('Editar Tipos Plazo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tipo');
		echo $this->Form->input('dias');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

