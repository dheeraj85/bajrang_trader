<?php
/* @var $this VendorController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Vendor Management',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendor', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Vendor', 'url' => array('admin')),
);
$active_class="";
?>
<ul style="list-style-type:none;padding-left:10px;">
    <li class="<?php echo ($active_class == 'create') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('vendor/create'); ?>"><i class="fa fa-circle-o"></i> Add Vendor Details</a>
    </li>
    <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('vendor/admin'); ?>"><i class="fa fa-circle-o"></i> Manage Vendor Details</a>
    </li>
    <li class="<?php echo ($active_class == 'ledger') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('vendor/ledger'); ?>"><i class="fa fa-circle-o"></i> Vendor Ledger</a>
    </li>
</ul>