<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Account Management System',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Expenseheads', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Expenseheads', 'url' => array('admin')),
);
$active_class = "";
?>
<ul style="list-style-type:none;padding-left:10px;">                 
    <li class="<?php echo ($active_class == 'head') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('expenseheads/create'); ?>"><i class="fa fa-circle-o"></i> Expense Heads</a>
    </li>
    <li class="<?php echo ($active_class == 'nature') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('expensenature/create'); ?>"><i class="fa fa-circle-o"></i> Expense Natures</a>
    </li>
    <li class="<?php echo ($active_class == 'expcreate') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('expensemaster/admin'); ?>"><i class="fa fa-circle-o"></i> Expense Masters</a> 
    </li>
    <li class="<?php echo ($active_class == 'expacccreate') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('expenseaccount/admin'); ?>"><i class="fa fa-circle-o"></i> Expense Accounts</a> 
    </li>
    <li class="<?php echo ($active_class == 'expinvoice') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('expenseinvoice/admin'); ?>"><i class="fa fa-circle-o"></i> Expense Invoice</a>
    </li>
    <li class="<?php echo ($active_class == 'exinfo') ? 'active' : ''; ?>">
        <a href="<?php echo Yii::app()->createUrl('expenseinfo/admin'); ?>"><i class="fa fa-circle-o"></i> Expense Reconciliation</a>
    </li>
</ul>