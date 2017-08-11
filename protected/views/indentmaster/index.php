<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'GPU' => array('site/gpudashboard'),
    'Internal Indent',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Indentmaster', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Indentmaster', 'url' => array('admin')),
);
$active_class = "";
?>
<?php if (Yii::app()->user->isSA()) { ?>
    <ul style="list-style-type:none;padding-left:10px;">
        <li class="<?php echo ($active_class == "create") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentmaster/create'); ?>"><i class="fa fa-circle-o"></i>Indent_Review</a></li>
        <li class="<?php echo ($active_class == "admin") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentmaster/admin'); ?>"><i class="fa fa-circle-o"></i>Internal_Indent</a></li>
        <li class="<?php echo ($active_class == "issueadmin") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentitemsissue/admin'); ?>"><i class="fa fa-circle-o"></i>Indent_Review</a></li>
        <li class="<?php echo ($active_class == "gpuinventory") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentitemsissue/inventory'); ?>"><i class="fa fa-circle-o"></i>GPU Inventory</a></li>
    </ul>   
<?php } else { ?>
    <ul style="list-style-type:none;padding-left:10px;">
        <?php
        foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'GPU', 'subheading' => 'Indents')) as $value) {
            ?>
            <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("GPU_", " ", $value->link_name); ?></a></li>
            <?php } ?> 
    </ul>   
<?php } ?>
