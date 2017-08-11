<?php
/* @var $this IndentmasterController */
/* @var $data Indentmaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sync_id')); ?>:</b>
	<?php echo CHtml::encode($data->sync_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indent_date')); ?>:</b>
	<?php echo CHtml::encode($data->indent_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indent_type')); ?>:</b>
	<?php echo CHtml::encode($data->indent_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_type')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_user_role')); ?>:</b>
	<?php echo CHtml::encode($data->created_user_role); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('supply_type')); ?>:</b>
	<?php echo CHtml::encode($data->supply_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_date')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issued_to')); ?>:</b>
	<?php echo CHtml::encode($data->issued_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_indenting_done')); ?>:</b>
	<?php echo CHtml::encode($data->is_indenting_done); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_order_done')); ?>:</b>
	<?php echo CHtml::encode($data->is_order_done); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_sync')); ?>:</b>
	<?php echo CHtml::encode($data->is_sync); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sync_date')); ?>:</b>
	<?php echo CHtml::encode($data->sync_date); ?>
	<br />

	*/ ?>

</div>