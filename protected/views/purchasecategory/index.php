<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Item Master',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchasecategory', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchasecategory', 'url' => array('admin')),
);
$active_class="";
?>
<ul style="list-style-type:none;padding-left:10px;">
    <li class="<?php echo ($active_class == 'padmin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('purchasecategory/admin'); ?>"><i class="fa fa-circle-o"></i> Product Category</a>
    </li>
    <li class="<?php echo ($active_class == 'psadmin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('purchasesubcategory/admin'); ?>"><i class="fa fa-circle-o"></i> Product Sub Category</a>
    </li>
    <li class="<?php echo ($active_class == 'picreate') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('purchaseitem/create'); ?>"><i class="fa fa-circle-o"></i> Add Items</a> <!--(Set Schedules for items (Eg. Add Expiry date or Warranty information or Service & Maintenance dates))-->
    </li>
    <li class="<?php echo ($active_class == 'piadmin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('purchaseitem/admin'); ?>"><i class="fa fa-circle-o"></i> Manage Items</a> 
    </li>
</ul>