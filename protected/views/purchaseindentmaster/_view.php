<?php
/* @var $this PurchaseindentmasterController */
/* @var $data Purchaseindentmaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indend_date')); ?>:</b>
	<?php echo CHtml::encode($data->indend_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_done')); ?>:</b>
	<?php echo CHtml::encode($data->is_done); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />


</div>