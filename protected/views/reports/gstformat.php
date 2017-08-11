<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'GST',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Expenseheads', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Expenseheads', 'url' => array('admin')),
);
$active_class = "";
?>
<ul style="list-style-type:none;padding-left:10px;">                 
    <li class="<?php echo ($active_class == 'gstr_format1') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('reports/gstr_format1'); ?>"><i class="fa fa-circle-o"></i> Form GSTR - 1</a>
    </li>
    <li class="<?php echo ($active_class == 'gstr_format2') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('reports/gstr_format2'); ?>"><i class="fa fa-circle-o"></i> Form GSTR - 2</a>
    </li>
    <li class="<?php echo ($active_class == 'gstr_format3') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('reports/gstr_format3'); ?>"><i class="fa fa-circle-o"></i> Form GSTR - 3</a>
    </li>
    <li class="<?php echo ($active_class == 'gstr_format4') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('reports/gstr_format4'); ?>"><i class="fa fa-circle-o"></i> Form GSTR - 4</a>
    </li>
    <li class="<?php echo ($active_class == 'gstr_format5') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('reports/gstr_format5'); ?>"><i class="fa fa-circle-o"></i> Form GSTR - 5</a>
    </li>
    <li class="<?php echo ($active_class == 'gstr_format9') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('reports/gstr_format9'); ?>"><i class="fa fa-circle-o"></i> Form GSTR - 9</a>
    </li>
</ul>