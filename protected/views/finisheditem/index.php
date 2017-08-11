<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'GPU' => array('site/gpudashboard'),
    'Item Stock',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemstock', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Itemstock', 'url' => array('admin')),
);
$active_class = "";
?>
<?php if (Yii::app()->user->isSA()) { ?>
<ul style="list-style-type:none;padding-left:10px;">
     <li class="<?php echo ($active_class == "create") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('finisheditem/create'); ?>"><i class="fa fa-circle-o"></i> Add_Finished_Item</a></li>
     <li class="<?php echo ($active_class == "admin") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('finisheditem/admin'); ?>"><i class="fa fa-circle-o"></i> View_Finished_Item</a></li>
</ul>
<?php } else { ?>
<ul style="list-style-type:none;padding-left:10px;">
    <?php 
    $active_class="";
    foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'GPU', 'subheading' => 'Item_Stock')) as $value) { ?>
        <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name); ?></a></li>
    <?php } ?> 
</ul>
<?php } ?>