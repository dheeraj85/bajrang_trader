<?php
$this->breadcrumbs = array(
    'Home' => array('site/cdsdashboard'),
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
          <li class="<?php echo ($active_class == "viewindent_active") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('supply/viewIndents'); ?>"><i class="fa fa-circle-o"></i> Internal_Indent</a></li>
                <li class="<?php echo ($active_class == "review_indent") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('supply/reviewIndents'); ?>"><i class="fa fa-circle-o"></i> Indent_Review</a></li>
                <li class="<?php echo ($active_class == "indent_invoice") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('supply/invoice'); ?>"><i class="fa fa-circle-o"></i> Invoice_Challan</a></li>
    </ul>
<?php } ?>