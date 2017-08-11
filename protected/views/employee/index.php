<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Human Resource',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Employee', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Employee', 'url' => array('admin')),
);
$active_class = "";
?>
<ul style="list-style-type:none;padding-left:10px;">                 
    <li class="<?php echo ($active_class == 'create') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('employee/create'); ?>"><i class="fa fa-circle-o"></i> Add Employee</a>
    </li>
    <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('employee/admin'); ?>"><i class="fa fa-circle-o"></i> Manage Employee</a>
    </li>
    <li class="<?php echo ($active_class == 'stadmin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('hremployeesalarysettings/create'); ?>"><i class="fa fa-circle-o"></i> Salary Settings</a>
    </li>
    <li class="<?php echo ($active_class == 'attcreate') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('employeeatt/create'); ?>"><i class="fa fa-circle-o"></i> Employee Attendance</a>
    </li>   
    <li class="<?php echo ($active_class == 'beftadmin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('employeebenifits/admin'); ?>"><i class="fa fa-circle-o"></i> Employee Benefits</a>
    </li>
    <li class="<?php echo ($active_class == 'saadmin') ? 'active' : ''; ?>">
        <a href="<?php echo $this->createUrl('employeesalary/admin'); ?>"><i class="fa fa-circle-o"></i>Employee Salary</a>
    </li>
</ul>