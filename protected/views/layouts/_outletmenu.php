<li class="treeview <?php echo ($active_menu == 'gpu') ? 'active' : ''; ?>">
    <a href="#">
        <span>Goods Processing Unit</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'gpu') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
             <a href="#">Indents<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'gpunit') ? 'display:block' : ''; ?>">
                <li class="<?php echo ($active_class =="create") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentmaster/create'); ?>"><i class="fa fa-circle-o"></i>Stock Issue Indent</a></li>
                <li class="<?php echo ($active_class == "admin") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentmaster/admin'); ?>"><i class="fa fa-circle-o"></i>Internal Indent</a></li>
                <li class="<?php echo ($active_class == "issueadmin") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentitemsissue/admin'); ?>"><i class="fa fa-circle-o"></i>Indent Review</a></li>
                <li class="<?php echo ($active_class == "gpuinventory") ? 'active' : ''; ?>"><a href="<?php echo $this->createUrl('indentitemsissue/inventory'); ?>"><i class="fa fa-circle-o"></i>GPU Inventory</a></li>
            </ul>
        </li>                
    </ul>
</li>
<li class="treeview <?php echo ($active_menu == 'pos') ? 'active' : ''; ?>">
    <a href="#">
        <span>POS Management System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'menu') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'pos_counters') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('positemoffers/counter'); ?>"><i class="fa fa-circle-o"></i>Counter Day Opening/Closing</a>
        </li>                   
        <li class="<?php echo ($active_class == 'pos_closing_counters') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('positemoffers/counterclosing'); ?>"><i class="fa fa-circle-o"></i>Outlet Day Closing</a>
        </li>
<!--            <li class="<?php echo ($active_class == 'pos_counters') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('positemoffers/counter'); ?>"><i class="fa fa-circle-o"></i>  Manage POS Counters</a>
        </li>-->
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
        <li class="<?php echo ($active_class == 'customer_ledger') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('offshelfsale/ledger'); ?>"><i class="fa fa-circle-o"></i>  Special Customer Ledger</a>
        </li>
    </ul>
</li>
<li class="treeview <?php echo ($active_menu == 'indent_outlet_mgr') ? 'active' : ''; ?>">
    <a href="#">
        <span>Outlet Indent</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'indent_outlet_mgr') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
            <a href="#">Indents<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'omunit') ? 'display:block' : ''; ?>">                   
                <?php foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'OUTLET_MGR', 'subheading' => 'Indents')) as $value) { ?>
                    <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("OUTLET_MGR_", " ", $value->link_name); ?></a></li>
                <?php } ?>
            </ul>
        </li>                
    </ul>
</li>

<li class="treeview <?php echo ($active_menu == 'staff_outlet_mgr') ? 'active' : ''; ?>">
    <a href="#">
        <span>Outlet Staff</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'staff_outlet_mgr') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
            <a href="#">Staffs<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'staffunit') ? 'display:block' : ''; ?>">                   
                <?php foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'OUTLET_MGR', 'subheading' => 'Staffs')) as $value) { ?>
                    <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("_", " ", $value->link_name); ?></a></li>
                    <?php } ?>
            </ul>
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
<li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
    <a class="<?php echo ($active_class == "transfer_shelf") ? 'active' : ''; ?>" href="<?php echo $this->createUrl('supply/transfershelf'); ?>">Shelf/POS items Position</a>
</li>