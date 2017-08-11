<?php if (Yii::app()->user->isPOS()) { ?>
    <li class="treeview <?php echo ($active_menu == 'customer') ? 'active' : ''; ?>">
        <a href="#">
            <span>Manage Customer</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'customer') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'cust') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('customer/create'); ?>"><i class="fa fa-circle-o"></i>Manage Special Customer</a>
            </li>
        </ul>
    </li>
    <li class="treeview <?php echo ($active_menu == 'sale') ? 'active' : ''; ?>">
        <a href="#">
            <span>Sale</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'sale') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'sale') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('offshelfsale/create'); ?>"><i class="fa fa-circle-o"></i>B2B,B2C Sale</a>
            </li> 
        </ul>
    </li>
    
        <li class="treeview <?php echo ($active_menu == 'production') ? 'active' : ''; ?>">
        <a href="#">
            <span>Production KOT</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'production') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'pkot') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('productionkot/create'); ?>"><i class="fa fa-circle-o"></i>Production KOT</a>
            </li>
        </ul>
    </li>
               <li class="<?php echo ($active_class == '') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('pos/ots_items'); ?>"><i class="fa fa-backward"></i>Back To POS</a>
            </li
<?php } ?>