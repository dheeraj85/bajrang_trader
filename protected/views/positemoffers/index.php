<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'POS Management System',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Positemoffers', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Positemoffers', 'url' => array('admin')),
);
$active_class = "";
?>
<ul style="list-style-type:none;padding-left:10px;"> 
    <li class="<?php echo ($active_class == 'pos_counters') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('positemoffers/counter'); ?>"><i class="fa fa-circle-o"></i>Counter Day Opening/Closing</a>
    </li>                   
    <li class="<?php echo ($active_class == 'pos_closing_counters') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('positemoffers/counterclosing'); ?>"><i class="fa fa-circle-o"></i>Outlet Day Closing</a>
    </li>
    <li class="<?php echo ($active_class == 'pos_item_offers') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('positemoffers/create'); ?>"><i class="fa fa-circle-o"></i>  POS Item Offers</a>
    </li>
    <li class="<?php echo ($active_class == 'menu_items') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('menuitems/create'); ?>"><i class="fa fa-circle-o"></i>  Menu Items</a>
    </li>
    <li class="<?php echo ($active_class == 'pos_taxes') ? 'active' : ''; ?>">
        <a href="<?php echo Yii::app()->createUrl('postaxes/create'); ?>"><i class="fa fa-circle-o"></i>  POS Taxes</a>
    </li>
    <li class="<?php echo ($active_class == 'category_taxes') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('categorytaxes/create'); ?>"><i class="fa fa-circle-o"></i>  Category Taxes</a>
    </li>
    <li class="<?php echo ($active_class == 'shelf_items') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('shelfitems/create'); ?>"><i class="fa fa-circle-o"></i>  Shelf Items</a>
    </li>
</ul>