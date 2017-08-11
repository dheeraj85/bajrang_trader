<?php
/* @var $this ExpensemasterController */
/* @var $data Expensemaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goods_service')); ?>:</b>
	<?php echo CHtml::encode($data->goods_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gs_name')); ?>:</b>
	<?php echo CHtml::encode($data->gs_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_classification')); ?>:</b>
	<?php echo CHtml::encode($data->item_classification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hsn_sac_code')); ?>:</b>
	<?php echo CHtml::encode($data->hsn_sac_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_percent')); ?>:</b>
	<?php echo CHtml::encode($data->tax_percent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cess_percent')); ?>:</b>
	<?php echo CHtml::encode($data->cess_percent); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>