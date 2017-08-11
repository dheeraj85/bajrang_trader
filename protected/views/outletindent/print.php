<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management',
    'View Indent',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-aqua">
                    <h3 class="panel-title pull-left">Indent No : <?php echo $model->id?></h3>
                    <a href="#" class="btn btn-default pull-right" id="print_bill"><i class="fa fa-print"></i> Print</a>              
                 </div>
                <div class="panel-body">
                    <div class='row'> 
                <div class="panel-body">
                    <div class="table-responsive">
                 <?php
                       if(!empty($model)){    
                        $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' order by id desc");   
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($ilist)) {
                            ?>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Item with Scale</th>
                                        <th>Brand</th>       
                                        <th>Item Purpose</th>      
                                        <th>R.Qty.</th>            
                                        <th>Require Date</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    foreach ($ilist as $v) {
                                        ?>
                                        <tr>
                                            <td width="30%"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                            <td width="15%"><?php echo $v->item_brand; ?></td>
                                            <td width="15%"><?php echo $v->item_purpose; ?></td>
                                            <td width="15%"><?php echo $v->qty_required; ?></td>
                                            <td width="25%"> <?php echo $v->req_date;?></td>
                                        </tr>    
                                    <?php
                                    $c++;
                                    }
                                ?>
                                </tbody>
                            </table>
                            </div>
                 <?php }} ?>
                </div>
                     </div>
                    </div>
                </div>
            
               <div style="display:none;" id="printorder">
                   <legend><h3 class="panel-title">Indent No : <?php echo $model->id?></h3></legend>
                   Prepared By <?php echo $model->createdby->name;?> &nbsp;&nbsp;&nbsp;&nbsp; Indent date : <?php echo $model->indent_date;?>
                 <?php
                       if(!empty($model)){    
                         $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' order by id desc"); 
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($ilist)) {
                            ?>
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <th style="border:1px solid #ddd;padding:5px;text-align: left;">Item with Scale</th>
                                        <th style="border:1px solid #ddd;padding:5px;text-align: left;">Brand</th>            
                                        <th style="border:1px solid #ddd;padding:5px;text-align: left;">Item Purpose</th>            
                                        <th style="border:1px solid #ddd;padding:5px;text-align: left;">R.Qty.</th>            
                                        <th style="border:1px solid #ddd;padding:5px;text-align: left;">Require Date</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    foreach ($ilist as $v) {
                                        ?>
                                        <tr>
                                            <td width="30%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                            <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_brand; ?></td>
                                            <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->item_purpose; ?></td>
                                            <td width="15%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->qty_required; ?></td>
                                            <td width="25%" style="border:1px solid #ddd;padding:5px;text-align: left;"><?php echo $v->req_date;?></td>
                                        </tr>    
                                    <?php
                                    $c++;
                                    }
                                ?>
                                </tbody>
                            </table>
                 <?php }} ?>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#print_bill').click(function () { 
        Popup($('#printorder').html());   
    });
});
function Popup(data) {
        var mywindow = window.open('', 'go_highway_print', 'height=500,width=700');
        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('</head><body >');
       //alert(data);
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        //return true;
    }
</script>