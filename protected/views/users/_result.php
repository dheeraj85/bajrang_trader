<div id="msg_status"></div>
<div class="box" style="display:none;" id="mastercms">
    <div class="box-header bg-aqua">
        <h3 class="box-title">
            Master CMS
        </h3>
    </div>
    <div class="box-body">
        <table>
            <tr>
                <td><div class="checkbox">
            <label>
                <input type="checkbox" value="purchasecategory/admin" name="link[]" class="roles" id="check_Product_Category" onclick="GetRightID(this.checked, this.value, 'Product_Category', 'CMS','Item_Master','padmin')" class="allchecked allcheckedstud"> 
                 Product Category
            </label>
        </div></td>
                <td width="10"></td>
                <td>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="purchasesubcategory/admin" name="link[]" class="roles" id="check_Product_Sub_Category" onclick="GetRightID(this.checked, this.value, 'Product_Sub_Category', 'CMS','Item_Master','psadmin')" class="allchecked allcheckedstud"> 
                 Product Sub Category
            </label>
        </div></td>
         <td width="10"></td>
                <td><div class="checkbox">
            <label>
                <input type="checkbox" value="purchaseitem/create" name="link[]" class="roles" id="check_Add_Items" onclick="GetRightID(this.checked, this.value, 'Add_Items', 'CMS','Item_Master','picreate')" class="allchecked allcheckedstud"> 
                Add Items
            </label>
        </div></td>
                <td width="10"></td>
                <td>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="purchaseitem/admin" name="link[]" class="roles" id="check_Manage_Items" onclick="GetRightID(this.checked, this.value, 'Manage_Items', 'CMS','Item_Master','piadmin')" class="allchecked allcheckedstud"> 
                Manage Items
            </label>
        </div></td>
            </tr>
        </table>
    </div>
</div>
<div class="box">
    <div class="box-header bg-green">       
        <h3 class="box-title">
            Central Purchase System
        </h3>
    </div>
    <div class="box-body">
         <table>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="vendor/create" name="link[]" class="roles" id="check_Add_Vendor_Details" onclick="GetRightID(this.checked, this.value, 'Add_Vendor_Details', 'CPS','Vendor_Management','create')" class="allchecked allcheckedstud"> 
                            Add Vendor Details
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="vendor/admin" name="link[]" class="roles" id="check_Manage_Vendor_Details" onclick="GetRightID(this.checked, this.value, 'Manage_Vendor_Details', 'CPS','Vendor_Management','admin')" class="allchecked allcheckedstud"> 
                            Manage Vendor Details
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="vendor/ledger" name="link[]" class="roles" id="check_Vendor_Ledger" onclick="GetRightID(this.checked, this.value, 'Vendor_Ledger', 'CPS','Vendor_Management','ledger')" class="allchecked allcheckedstud"> 
                            Vendor Ledger
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="itemstock/admin" name="link[]" class="roles" id="check_Inventory" onclick="GetRightID(this.checked, this.value, 'Inventory', 'CPS','Inventory_Management','sadmin')" class="allchecked allcheckedstud"> 
                            Inventory
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="itemstock/indent" name="link[]" class="roles" id="check_Indenting" onclick="GetRightID(this.checked, this.value, 'Indenting', 'CPS','Inventory_Management','indent')" class="allchecked allcheckedstud"> 
                           Indenting
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="purchaseindentmaster/admin" name="link[]" class="roles" id="check_CPS_Indent_Review" onclick="GetRightID(this.checked, this.value, 'CPS_Indent_Review', 'CPS','Inventory_Management','indentreview')" class="allchecked allcheckedstud"> 
                            Indent Review
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="purchaseorder/admin" name="link[]" class="roles" id="check_Purchase_Order" onclick="GetRightID(this.checked, this.value, 'Purchase_Order', 'CPS','Inventory_Management','generatepo')" class="allchecked allcheckedstud"> 
                           Purchase Order
                        </label>            
                    </div>
                </td>
                 <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="purchaseinvoice/admin" name="link[]" class="roles" id="check_Invoice_Entry" onclick="GetRightID(this.checked, this.value, 'Invoice_Entry', 'CPS','Purchase_Invoice','admin')" class="allchecked allcheckedstud"> 
                           Invoice Entry
                        </label>            
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="box">
    <div class="box-header bg-yellow">
        <h3 class="box-title">
            Central Distribution System
        </h3>
    </div>
    <div class="box-body">
         <table>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="supply/viewIndents" name="link[]" class="roles" id="check_CDS_Internal_Indent" onclick="GetRightID(this.checked, this.value, 'CDS_Internal_Indent', 'CDS','Indents','viewindent_active')" class="allchecked allcheckedstud"> 
                            View Indents
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="supply/reviewIndents" name="link[]" class="roles" id="check_CDS_Indent_Review" onclick="GetRightID(this.checked, this.value, 'CDS_Indent_Review', 'CDS','Indents','review_indent')" class="allchecked allcheckedstud"> 
                            Indent Review
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="supply/invoice" name="link[]" class="roles" id="check_Invoice_Challan" onclick="GetRightID(this.checked, this.value, 'Invoice_Challan', 'CDS','Indents','indent_invoice')" class="allchecked allcheckedstud"> 
                            Invoice/Challan
                        </label>            
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="box">
    <div class="box-header bg-red">  
        <h3 class="box-title">
            Good Processing Unit
        </h3>
    </div>
    <div class="box-body">
        <table>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="indentmaster/create" name="link[]" class="roles" id="check_GPU_Stock_Issue_Indent" onclick="GetRightID(this.checked, this.value, 'GPU_Stock_Issue_Indent', 'GPU','Indents','create')" class="allchecked allcheckedstud"> 
                            Stock Issue Indent
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="indentmaster/admin" name="link[]" class="roles" id="check_GPU_Indent_Review" onclick="GetRightID(this.checked, this.value, 'GPU_Indent_Review', 'GPU','Indents','admin')" class="allchecked allcheckedstud"> 
                            Indent Review
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="indentitemsissue/admin" name="link[]" class="roles" id="check_GPU_Issue_Item_List" onclick="GetRightID(this.checked, this.value, 'GPU_Issue_Item_List', 'GPU','Indents','issueadmin')" class="allchecked allcheckedstud"> 
                            Issue Item List
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="finisheditem/create" name="link[]" class="roles" id="check_Add_Item_Stock" onclick="GetRightID(this.checked, this.value, 'Add_Item_Stock', 'GPU','Item_Stock','create')" class="allchecked allcheckedstud"> 
                            Add Item Stock
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="finisheditem/admin" name="link[]" class="roles" id="check_View_Item_Stock" onclick="GetRightID(this.checked, this.value, 'View_Item_Stock', 'GPU','Item_Stock','admin')" class="allchecked allcheckedstud"> 
                           View Item Stock
                        </label>            
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="box">
    <div class="box-header bg-orange">  
        <h3 class="box-title">
            Outlet Management System
        </h3>
    </div>
    <div class="box-body">
        <table>
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="outletindent/create" name="link[]" class="roles" id="check_OUTLET_MGR_Internal_Indent" onclick="GetRightID(this.checked, this.value, 'OUTLET_MGR_Internal_Indent', 'OUTLET_MGR','Indents','create')" class="allchecked allcheckedstud"> 
                            Internal Indent
                        </label>            
                    </div>
                </td>
                <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="outletindent/admin" name="link[]" class="roles" id="check_OUTLET_MGR_Internal_Review" onclick="GetRightID(this.checked, this.value, 'OUTLET_MGR_Internal_Review', 'OUTLET_MGR','Indents','admin')" class="allchecked allcheckedstud"> 
                            Indent Review
                        </label>            
                    </div>
                </td>
                 <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="outletstaff/create" name="link[]" class="roles" id="check_Add_Staff" onclick="GetRightID(this.checked, this.value, 'Add_Staff', 'OUTLET_MGR','Staffs','create')" class="allchecked allcheckedstud"> 
                            Add Staff
                        </label>            
                    </div>
                </td>
                 <td width="10"></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="outletstaff/admin" name="link[]" class="roles" id="check_Manage_Staff" onclick="GetRightID(this.checked, this.value, 'Manage_Staff', 'OUTLET_MGR','Staffs','admin')" class="allchecked allcheckedstud"> 
                            Manage Staff
                        </label>            
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        GetRightsById();
    });
    
    function GetRightID(check, a_val, cat, heading,subheading,action) {
        var linkurl = a_val;
        $("#msg_status").html("Alloting....");
        if (check) {
            var url = '<?php echo $this->createUrl('users/saveByAjax') ?>';
            $.get(url, {'linkurl': linkurl, 'linkname': cat, 'heading': heading, 'subheading': subheading, 'action': action}, function(data) {
                $("#msg_status").html("Alloted");
            });
        }
        else {
            var url = '<?php echo $this->createUrl('users/deleteByAjax') ?>';
            $.get(url, {'linkname': cat}, function(data) {
                $("#msg_status").html("Alloted");
            });
        }
    }
    function  GetRightsById() {
        var url = '<?php echo $this->createUrl('users/rightsByid') ?>';
        $.getJSON(url, function(data) {
            $.each(data, function(i, v) {
                //alert(v.link_name);
                $("#check_" + v.link_name).attr('checked', true);
            });
        });
    }
</script>