<?php
/* @var $this IndentitemsissueController */
/* @var $data Indentitemsissue */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internal_id')); ?>:</b>
	<?php echo CHtml::encode($data->internal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->p_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_sub_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->p_sub_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_name')); ?>:</b>
	<?php echo CHtml::encode($data->item_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_brand')); ?>:</b>
	<?php echo CHtml::encode($data->item_brand); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_qty')); ?>:</b>
	<?php echo CHtml::encode($data->issue_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_date')); ?>:</b>
	<?php echo CHtml::encode($data->issue_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_purpose')); ?>:</b>
	<?php echo CHtml::encode($data->issue_purpose); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_user_role')); ?>:</b>
	<?php echo CHtml::encode($data->created_user_role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_issue_done')); ?>:</b>
	<?php echo CHtml::encode($data->is_issue_done); ?>
	<br />

	*/ ?>

</div>