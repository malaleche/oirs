<script>
function goBack(){
   window.history.back();
}
</script>

<?php
$this->Html->addCrumb('Configuracion OIRS - Administrar Tipo Ingresos', '/TiposIngresos');
$this->Html->addCrumb('Editar', '#');
?>

<div class="tiposIngresos form">
<?php echo $this->Form->create('TiposIngreso'); ?>
	<fieldset>
		<legend><?php echo __('Editar Tipo Ingresos'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tipo');
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>'Guardar','class'=>'btn btn-primary','div'=>false,'after'=>' '.$this->Form->button('Cancelar',array('type'=>'button','class'=>'btn','onclick'=>'goBack()')))); ?>
</div>
