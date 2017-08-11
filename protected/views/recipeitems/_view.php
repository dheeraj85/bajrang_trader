<?php
/* @var $this RecipeitemsController */
/* @var $data Recipeitems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipe_category')); ?>:</b>
	<?php echo CHtml::encode($data->recipe_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_name_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_name_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight_limit_kg')); ?>:</b>
	<?php echo CHtml::encode($data->weight_limit_kg); ?>
	<br />


</div>