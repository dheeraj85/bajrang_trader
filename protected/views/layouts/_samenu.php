<li class="treeview <?php echo ($active_menu == 'mcms') ? 'active' : ''; ?>">
    <a href="#">
        <span><i class="fa fa-book"></i> Master CMS</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'scale') ? 'display:block' : ''; ?>">
        <li>
            <a href="#">Scale's & Measures <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'scale') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('itemscale/admin'); ?>"><i class="fa fa-circle-o"></i> Scale's type</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#">HR CMS <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'hr') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('designation/admin'); ?>"><i class="fa fa-circle-o"></i>  Designation</a>
                </li>
            </ul>
        </li>

        <li class="<?php echo ($active_class == 'pcindex') ? 'active' : ''; ?>">
            <a href="#">Item Master <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'category') ? 'display:block' : ''; ?>">
                <li class="<?php echo ($active_class == 'padmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchasecategory/admin'); ?>"><i class="fa fa-circle-o"></i> Product Category</a>
                </li>
                <li class="<?php echo ($active_class == 'psadmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchasesubcategory/admin'); ?>"><i class="fa fa-circle-o"></i> Product Sub Category</a>
                </li>
                <li class="<?php echo ($active_class == 'picreate') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchaseitem/create'); ?>"><i class="fa fa-circle-o"></i> Add Items</a> <!--(Set Schedules for items (Eg. Add Expiry date or Warranty information or Service & Maintenance dates))-->
                </li>
                <li class="<?php echo ($active_class == 'piadmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchaseitem/admin'); ?>"><i class="fa fa-circle-o"></i> Manage Items</a> 
                </li>

            </ul>
        </li>
        <li class="">
            <a href="#">Invoice Setting <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'invoice') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('invoicesettings/admin'); ?>"><i class="fa fa-circle-o"></i>  Invoice Setting</a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="treeview <?php echo ($active_menu == 'cps') ? 'active' : ''; ?>">
    <a href="#">
        <span><i class="fa fa-shopping-bag"></i> Purchase System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'cps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'vindex') ? 'active' : ''; ?>">
            <a href="#">Vendor Management <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'vendor') ? 'display:block' : ''; ?>">                   
                <li class="<?php echo ($active_class == 'create') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('vendor/create'); ?>"><i class="fa fa-circle-o"></i> Add Vendor</a>
                </li>
                <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('vendor/admin'); ?>"><i class="fa fa-circle-o"></i> Manage Vendor</a>
                </li>
                <li class="<?php echo ($active_class == 'ledger') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('vendor/ledger'); ?>"><i class="fa fa-circle-o"></i> Vendor Payment Detailss</a>
                </li>
<!--                <li class="<?php echo ($active_class == 'mainledger') ? 'active' : ''; ?>">
                    <a href="#"><i class="fa fa-circle-o"></i> Vendor Ledger</a>
                </li>-->
            </ul>
        </li>                
    </ul>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'ps') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'generatepo') ? 'active' : ''; ?>">
            <a href="#">Purchase Order<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'ps') ? 'display:block' : ''; ?>">                   
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
                <li class="<?php echo ($active_class == 'cadmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('challan/admin'); ?>"><i class="fa fa-circle-o"></i> Challan Entry</a>
                </li>                     
                <li class="<?php echo ($active_class == 'cpadmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('calculatepayout/admin'); ?>"><i class="fa fa-circle-o"></i> Payout list</a>
                </li>                     
            </ul>
        </li>                
    </ul>

</li>

    <li class="treeview <?php echo ($active_menu == 'bill') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-shopping-cart"></i> Sale</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'bill') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'create') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('bill/create'); ?>"><i class="fa fa-circle-o"></i>Cost Bill</a>
            </li> 
            <li class="<?php echo ($active_class == 'incremental') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('bill/incremental'); ?>"><i class="fa fa-circle-o"></i>Incremental Bill</a>
            </li> 
        </ul>
    </li>
<?php if (Yii::app()->user->isSA()) { ?>
    <li class="treeview <?php echo ($active_menu == 'cds') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-database"></i> Stock Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'cds') ? 'display:block' : ''; ?>">
                  <li class="<?php echo ($active_class == 'stkadmin') ? 'active' : ''; ?>">
                    <a href="<?php echo $this->createUrl('purchaseitem/stockadmin'); ?>"><i class="fa fa-circle-o"></i>Stock Settlement</a> 
                </li>
            <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
                <a class="<?php echo ($active_class == "transfer_shelf") ? 'active' : ''; ?>" href="<?php echo $this->createUrl('supply/transfershelf'); ?>"><i class="fa fa-circle-o"></i>Shelf/POS items Position</a>
            </li>
<li class="treeview <?php echo ($active_class == 'view_stock') ? 'active' : ''; ?>">
    <a href="<?php echo $this->createUrl('supply/viewstock'); ?>">
        <i class="fa fa-circle-o"></i> Central Store Position
    </a>
</li>


        </ul>
    </li>
<!--    <li class="treeview <?php echo ($active_menu == 'customer') ? 'active' : ''; ?>">
        <a href="#">
            <span>Internal Customer/Sale</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'customer') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'cust') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('customerinternal/create'); ?>"><i class="fa fa-circle-o"></i>Manage Customer</a>
            </li>
            <li class="<?php echo ($active_class == 'sale') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('internalsale/create'); ?>"><i class="fa fa-circle-o"></i>Internal Sale/Bill</a>
            </li>

        </ul>
    </li>-->
<?php } else { ?>
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
        </ul>
    </li>
<?php } ?>

    <li class="treeview <?php echo ($active_menu == 'customer') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-users"></i> Customer</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'customer') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'cust') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('customer/create'); ?>"><i class="fa fa-circle-o"></i>Manage Customer</a>
            </li>
                        <li class="<?php echo ($active_class == 'customer_ledger') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('offshelfsale/ledger'); ?>"><i class="fa fa-circle-o"></i>Customer Ledger</a>
            </li>
        </ul>
    </li>


   <li class="treeview <?php echo ($active_menu == 'reports') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-area-chart"></i> Reports</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'reports') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'fresh') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/freshstock'); ?>"><i class="fa fa-circle-o"></i>Fresh Stock</a>
            </li>
            <li class="<?php echo ($active_class == 'payment') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/vendorpayment'); ?>"><i class="fa fa-circle-o"></i>Vendor Payment</a>
            </li>
            <li class="<?php echo ($active_class == 'rawmaterial') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/purchaserawmaterial'); ?>"><i class="fa fa-circle-o"></i>Purchased Item</a>
            </li>
            <li class="<?php echo ($active_class == 'salesitem') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/salesitem'); ?>"><i class="fa fa-circle-o"></i>Sales Item</a>
            </li>
            <li class="<?php echo ($active_class == 'salesitemwise') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/salesitemwise'); ?>"><i class="fa fa-circle-o"></i>Sale Item Wise </a>
            </li>
            <li class="<?php echo ($active_class == 'goodsreturn') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/goodsreturn'); ?>"><i class="fa fa-circle-o"></i>Goods Return</a>
            </li>
            <li class="<?php echo ($active_class == 'attendance') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/attendance'); ?>"><i class="fa fa-circle-o"></i>Attendance</a>
            </li>
        </ul>
    </li>
    <li class="treeview <?php echo ($active_menu == 'gst') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-list-ol"></i> GST</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'gst') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'gstr_format1') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/gstr_format1'); ?>"><i class="fa fa-circle-o"></i>Form GSTR - 1</a>
            </li>
            <li class="<?php echo ($active_class == 'gstr_format2') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/gstr_format2'); ?>"><i class="fa fa-circle-o"></i>Form GSTR - 2</a>
            </li>
            <li class="<?php echo ($active_class == 'gstr_format3') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/gstr_format3'); ?>"><i class="fa fa-circle-o"></i>Form GSTR - 3</a>
            </li>
            <li class="<?php echo ($active_class == 'gstr_format4') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/gstr_format4'); ?>"><i class="fa fa-circle-o"></i>Form GSTR - 4</a>
            </li>
            <li class="<?php echo ($active_class == 'gstr_format5') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/gstr_format5'); ?>"><i class="fa fa-circle-o"></i>Form GSTR - 5</a>
            </li>
            <li class="<?php echo ($active_class == 'gstr_format9') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('reports/gstr_format9'); ?>"><i class="fa fa-circle-o"></i>Form GSTR - 9</a>
            </li>
        </ul>
    </li>

 <li class="treeview <?php echo ($active_menu == 'pos') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-bank"></i> Store Management System</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'menu') ? 'display:block' : ''; ?>">
            <li class="<?php echo ($active_class == 'pos_counters') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('positemoffers/counter'); ?>"><i class="fa fa-circle-o"></i>Counter Day Opening/Closing</a>
            </li>                   
            <li class="<?php echo ($active_class == 'pos_closing_counters') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('positemoffers/counterclosing'); ?>"><i class="fa fa-circle-o"></i>Outlet Day Closing</a>
            </li>
                <li class="<?php echo ($active_class == 'pos_counters') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('positemoffers/counter'); ?>"><i class="fa fa-circle-o"></i>  Manage Store Counters</a>
            </li>
       <!--        <li class="<?php echo ($active_class == 'pos_item_offers') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('positemoffers/create'); ?>"><i class="fa fa-circle-o"></i>  Store Item Offers</a>
            </li>
         <li class="<?php echo ($active_class == 'menu_items') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('menuitems/create'); ?>"><i class="fa fa-circle-o"></i>  Menu Items</a>
            </li>
            <li class="<?php echo ($active_class == 'pos_taxes') ? 'active' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('postaxes/create'); ?>"><i class="fa fa-circle-o"></i>  POS Taxes</a>
            </li>
            <li class="<?php echo ($active_class == 'category_taxes') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('categorytaxes/create'); ?>"><i class="fa fa-circle-o"></i>  Category Taxes</a>-->
            </li>
            <li class="<?php echo ($active_class == 'shelf_items') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('shelfitems/create'); ?>"><i class="fa fa-circle-o"></i>  Store Items</a>
            </li>

            <li class="<?php echo ($active_class == 'view_order') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('pos/vieworders'); ?>"><i class="fa fa-circle-o"></i> POS Order Details</a>
            </li>
        </ul>
    </li>
<li class="treeview <?php echo ($active_menu == 'hr') ? 'active' : ''; ?>">
    <a href="#">
        <span>Human Resource System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'hr') ? 'display:block' : ''; ?>">
        <li class="<?php echo ($active_class == 'eindex') ? 'active' : ''; ?>">
            <a href="#">Human Resource <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="<?php echo ($open_class == 'hrm') ? 'display:block' : ''; ?>">                   
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
        </li>                
    </ul>
</li>
<li class="treeview <?php echo ($active_menu == 'ums') ? 'active' : ''; ?>">
    <a href="#">
        <span><i class="fa fa-user-o"></i> User Management System</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu" style="<?php echo ($open_class == 'users') ? 'display:block' : ''; ?>">                   
        <?php if (Yii::app()->user->isSA()) { ?>
            <li class="<?php echo ($active_class == 'create') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('users/create'); ?>"><i class="fa fa-circle-o"></i>  Add Account</a>
            </li>
            <li class="<?php echo ($active_class == 'admin') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('users/admin'); ?>"><i class="fa fa-circle-o"></i>  Manage Account</a>
            </li>
            <li class="<?php echo ($active_class == 'assign') ? 'active' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('users/assignroles'); ?>"><i class="fa fa-circle-o"></i>  Assign Roles</a>
            </li>
        <?php } ?>
        <li class="<?php echo ($active_class == 'logadmin') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('userslogins/admin'); ?>"><i class="fa fa-circle-o"></i>  View Logs</a>
        </li>
        <li class="<?php echo ($active_class == 'logapp') ? 'active' : ''; ?>">
            <a href="<?php echo $this->createUrl('userslogins/viewlogs'); ?>"><i class="fa fa-circle-o"></i>  View Application Logs</a>
        </li>
    </ul>
</li>



    <li class="treeview <?php echo ($active_menu == 'exps') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-exchange"></i> Expense Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'exps') ? 'display:block' : ''; ?>">                   
            <li class="<?php echo ($active_class == 'head') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('expenseheads/create'); ?>"><i class="fa fa-circle-o"></i>Expense Heads</a>
            </li>
            <li class="<?php echo ($active_class == 'nature') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('expensenature/create'); ?>"><i class="fa fa-circle-o"></i>Expense Natures</a>
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
                <a href="<?php echo Yii::app()->createUrl('expenseinfo/admin'); ?>"><i class="fa fa-circle-o"></i>Expense Reconciliation</a>
            </li>
        </ul>
    </li>

<?php if (Yii::app()->user->isSA()) { ?>
<!--    <li class="treeview <?php echo ($active_menu == 'cms') ? 'active' : ''; ?>">
        <a href="#">
            <span>Cake Management System</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'cake') ? 'display:block' : ''; ?>">                   
            <li class="<?php echo ($active_class == 'cake_weight') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('cakeweight/create'); ?>"><i class="fa fa-circle-o"></i>  Add Cake Weight</a>
            </li>
            <li class="<?php echo ($active_class == 'cake_rate') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('cakerate/create'); ?>"><i class="fa fa-circle-o"></i>  Cake Rate</a>
            </li>
            <li class="<?php echo ($active_class == 'cake_flavour') ? 'active' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('cakeflavour/create'); ?>"><i class="fa fa-circle-o"></i>  Cake Flavor</a>
            </li>
            <li class="<?php echo ($active_class == 'cake_shape') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('cakeshape/create'); ?>"><i class="fa fa-circle-o"></i>  Cake Shape</a>
            </li>
            <li class="<?php echo ($active_class == 'design_complexity') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('designcomplexity/create'); ?>"><i class="fa fa-circle-o"></i>  Design Complexity</a>
            </li>
            <li class="<?php echo ($active_class == 'cake_addons') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('cakeaddons/create'); ?>"><i class="fa fa-circle-o"></i>  Cake Addons</a>
            </li>
            <li class="<?php echo ($active_class == 'recipe_items') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('recipeitems/create'); ?>"><i class="fa fa-circle-o"></i>  Recipe Items</a>
            </li>
        </ul>
    </li>-->
   
    <li class="treeview <?php echo ($active_menu == 'ex') ? 'active' : ''; ?>">
        <a href="#">
            <span><i class="fa fa-balance-scale"></i> Account Management</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="<?php echo ($open_class == 'exp') ? 'display:block' : ''; ?>"> 
            <li class="<?php echo ($active_class == 'bdetails') ? 'active' : ''; ?>">
                <a href="<?php echo $this->createUrl('bankdetails/admin'); ?>"><i class="fa fa-circle-o"></i>Company Bank Details</a>
            </li>
            <li class="<?php echo ($active_class == 'vtype') ? 'active' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('vouchertype/admin'); ?>"><i class="fa fa-circle-o"></i>Voucher Types</a>
            </li>
            <li class="<?php echo ($active_class == 'ex') ? 'active' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('voucher/index'); ?>"><i class="fa fa-circle-o"></i>Voucher</a>
            </li>
            <li class="<?php echo ($active_class == 'vadmin') ? 'active' : ''; ?>">
                <a href="<?php echo Yii::app()->createUrl('voucher/admin'); ?>"><i class="fa fa-circle-o"></i>Vouchers List</a>
            </li>
        </ul>
    </li>

 
<?php } ?>