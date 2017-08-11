<?php
/* @var $this PurchaseinvoiceController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Purchase Invoice',
);
$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseinvoice', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseinvoice', 'url' => array('admin')),
);
$active_class="";
?>
<ul style="list-style-type:none;padding-left:10px;">
    <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('purchaseinvoice/admin'); ?>"><i class="fa fa-circle-o"></i> Invoice Entry</a>
    </li>  
</ul>   