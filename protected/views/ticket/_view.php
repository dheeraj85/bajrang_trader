<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket_type')); ?>:</b>
	<?php echo CHtml::encode($data->ticket_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('submitted_by')); ?>:</b>
	<?php echo CHtml::encode($data->submitted_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('submit_date')); ?>:</b>
	<?php echo CHtml::encode($data->submit_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assigned_to')); ?>:</b>
	<?php echo CHtml::encode($data->assigned_to); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('assigned_date')); ?>:</b>
	<?php echo CHtml::encode($data->assigned_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('close_reason')); ?>:</b>
	<?php echo CHtml::encode($data->close_reason); ?>
	<br />

	*/ ?>

</div>