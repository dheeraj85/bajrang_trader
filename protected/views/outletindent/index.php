<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Internal Indent',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Indentmaster', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Indentmaster', 'url' => array('admin')),
);
?>
<ul style="list-style-type:none;padding-left:10px;">
    <?php 
    $active_class="";
    foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'GPU', 'subheading' => 'Indents')) as $value) { ?>
        <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("GPU_", " ", $value->link_name); ?></a></li>
        <?php } ?> 
</ul>   