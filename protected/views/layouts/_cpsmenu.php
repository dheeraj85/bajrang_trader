<li class="treeview <?php echo ($active_menu == 'mcms') ? 'active' : ''; ?>">
    <a href="#">
        <span>Master CMS</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'scale') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'pcindex') ? 'active' : ''; ?>">
            <a href="#">Item Master <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'category') ? 'display:block' : ''; ?>">
             <?php foreach (Userrights::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'heading'=>'CMS','subheading'=>'Item_Master')) as $value) {?>
                <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name);?></a></li>
             <?php }?>
            </ul>
        </li>
    </ul>
</li>
<li class="treeview <?php echo ($active_menu == 'cps') ? 'active' : ''; ?>">
    <a href="#">
        <span>Central Purchase System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'vindex') ? 'active' : ''; ?>">
            <a href="#">Vendor Management <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'vendor') ? 'display:block' : ''; ?>">                   
             <?php foreach (Userrights::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'heading'=>'CPS','subheading'=>'Vendor_Management')) as $value) {?>
                <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name);?></a></li>
             <?php }?>
            </ul>
        </li>                
    </ul>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'iindex') ? 'active' : ''; ?>">
            <a href="#">Inventory Management<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'inventory') ? 'display:block' : ''; ?>">                   
              <?php foreach (Userrights::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'heading'=>'CPS','subheading'=>'Inventory_Management')) as $value) {?>
                <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name);?></a></li>
             <?php }?>                  
            </ul>
        </li>                
    </ul>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'pindex') ? 'active' : ''; ?>">
            <a href="#">Purchase Invoice <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'invoice') ? 'display:block' : ''; ?>">                   
              <?php foreach (Userrights::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'heading'=>'CPS','subheading'=>'Purchase_Invoice')) as $value) {?>
                <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name);?></a></li>
             <?php }?>                    
            </ul>
        </li>                
    </ul>
</li>