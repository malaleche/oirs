<script>
function goBack(){
   window.history.back();
}
</script>
<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Usuarios', '/Estados');
$this->Html->addCrumb('Editar', '#');
?>

<div class="estados form">
<?php echo $this->Form->create('Estado'); ?>
	<fieldset>
		<legend><?php echo __('Editar Estado'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('estado');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>

