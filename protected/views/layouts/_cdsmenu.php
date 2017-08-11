<li class="treeview <?php echo ($active_menu == 'cps') ? 'active' : ''; ?>">
    <a href="#">
        <span>Central Purchase System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'vindex') ? 'active' : ''; ?>">
            <a href="#">Vendor Management <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'vendor') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'create') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('vendor/create'); ?>"><i class="fa fa-circle-o"></i> Add Vendor Details</a>
                </li>
                <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('vendor/admin'); ?>"><i class="fa fa-circle-o"></i> Manage Vendor Details</a>
                </li>
                <li class="<?php echo ($active_class == 'ledger') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('vendor/ledger'); ?>"><i class="fa fa-circle-o"></i> Vendor Ledger</a>
                </li>
            </ul>
        </li>                
    </ul>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'iindex') ? 'active' : ''; ?>">
            <a href="#">Inventory Management<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'inventory') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'sadmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('itemstock/admin'); ?>"><i class="fa fa-circle-o"></i> Inventory</a>
                </li>                     
                <li class="<?php echo ($active_class == 'indent') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('itemstock/indent'); ?>"><i class="fa fa-circle-o"></i> Indenting</a>
                </li>                     
                <li class="<?php echo ($active_class == 'indentreview') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchaseindentmaster/admin'); ?>"><i class="fa fa-circle-o"></i> Indent Review</a>
                </li>                     
                <li class="<?php echo ($active_class == 'generatepo') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchaseorder/admin'); ?>"><i class="fa fa-circle-o"></i> Purchase Order</a>
                </li>                     
            </ul>
        </li>                
    </ul>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'pindex') ? 'active' : ''; ?>">
            <a href="#">Purchase Invoice <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'invoice') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchaseinvoice/admin'); ?>"><i class="fa fa-circle-o"></i> Invoice Entry</a>
                </li>                     
            </ul>
        </li>                
    </ul>

</li>
<li class="treeview <?php echo ($active_menu == 'cds') ? 'active' : ''; ?>">
    <a href="#">
        <span>Central Distribution System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cds') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
            <a href="#">Indents<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'viewindent_open') ? 'display:block' : ''; ?>">                   
                <?php foreach (Userrights::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id, 'heading' => 'CDS', 'subheading' => 'Indents')) as $value) { ?>
                    <li class="<?php echo ($active_class == $value->action) ? 'active' : ''; ?>"><a href="<?php echo Yii::app()->createUrl($value->link_url); ?>"><i class="fa fa-circle-o"></i> <?php echo str_replace("CDS_", " ", $value->link_name); ?></a></li>
                <?php } ?>
            </ul>
        </li>     
        
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
            <a class="<?php echo ($active_class == "transfer_shelf") ? 'active' : ''; ?>" href="<?php echo $this->createUrl('supply/transfershelf'); ?>">Shelf/POS items Position<i class="fa fa-angle-right pull-right"></i></a>
        </li>

       
    </ul>
</li>
 <li class="treeview <?php echo ($active_menu == 'customer') ? 'active' : ''; ?>">
            <a href="#">
                <span>Internal Customer/Sale</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'customer') ? 'display:block' : ''; ?>">
                <li class="<?php echo ($active_class == 'cust') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('customer/create'); ?>"><i class="fa fa-circle-o"></i>Manage Special Customer</a>
                </li>
                <li class="<?php echo ($active_class == 'sale') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('offshelfsale/create'); ?>"><i class="fa fa-circle-o"></i>Special Customer Sale</a>
                </li>
                <li class="<?php echo ($active_class == '') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('pos/ots_items'); ?>"><i class="fa fa-backward"></i>Back To POS</a>
                </li>
            </ul>
        </li>
<li class="treeview <?php echo ($active_menu == 'cds') ? 'active' : ''; ?>">
    <a href="<?php echo $this->createUrl('supply/viewstock'); ?>">
        <span>Central Store Keeper</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
</li>

