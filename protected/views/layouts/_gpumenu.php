<li class="treeview <?php echo ($active_menu == 'gpu') ? 'active' : ''; ?>">
    <a href="#">
        <span>Goods Processing Unit</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'gpu') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
             <a href="#">Indents<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'gpunit') ? 'display:block' : ''; ?>">
             <?php foreach (Userrights::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'heading'=>'GPU','subheading'=>'Indents')) as $value) {?>
                <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("GPU_", " ", $value->link_name);?></a></li>
             <?php }?>            
            </ul>
        </li>                
    </ul>
</li>
<li class="treeview <?php echo ($active_menu == 'gpu2') ? 'active' : ''; ?>">
    <a href="#">
        <span>Finished Item Stock</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'gpu2') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
             <a href="#">Item Stock<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'factory') ? 'display:block' : ''; ?>">                   
               <?php foreach (Userrights::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id,'heading'=>'GPU','subheading'=>'Item_Stock')) as $value) {?>
                <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name);?></a></li>
             <?php }?> 
            </ul>
        </li>                
    </ul>
</li>