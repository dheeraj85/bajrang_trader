<?php
/* @var $this ItemstockController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemstock', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Itemstock', 'url' => array('admin')),
);
$active_class="";
?>
<?php if (Yii::app()->user->isSA() == 'sa') { ?>
    <ul style="list-style-type:none;padding-left:10px;">
        <li class="<?php echo ($active_class == 'sadmin') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('itemstock/admin'); ?>"><i class="fa fa-circle-o"></i> Inventory</a>
        </li>                     
        <li class="<?php echo ($active_class == 'indent') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('itemstock/indent'); ?>"><i class="fa fa-circle-o"></i> Indenting</a>
        </li>                     
        <li class="<?php echo ($active_class == 'indentreview') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('purchaseindentmaster/admin'); ?>"><i class="fa fa-circle-o"></i> Indent Review</a>
        </li>                     
        <li class="<?php echo ($active_class == 'generatepo') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('purchaseorder/admin'); ?>"><i class="fa fa-circle-o"></i> Purchase Order</a>
        </li>   
    </ul> 
<?php } else { ?>
    <ul style="list-style-type:none;padding-left:10px;">
        <?php foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'CPS', 'subheading' => 'Inventory_Management')) as $value) { ?>
            <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name); ?></a></li>
            <?php } ?>
    </ul> 
<?php } ?>