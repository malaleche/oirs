<script>
function goBack(){
   window.history.back();
}
</script>
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/Areas');
$this->Html->addCrumb('Editar', '#');
?>

<div class="areas form">
<?php echo $this->Form->create('Area'); ?>
	<fieldset>
		<legend><?php echo __('Editar Area'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('area');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
