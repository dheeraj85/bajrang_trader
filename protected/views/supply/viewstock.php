<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Central Store Keeper',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">   
    <div class="panel panel-primary">
        <div class="panel-heading">Central Store Keeper</div>
        <div class="panel-body">
            <div class="row">
                <?php
                foreach ($categories as $cat) {
                    $count_subcat = Purchasesubcategory::model()->countByAttributes(array('category_id' => $cat->id));
                    ?>          
                    <div class="col-lg-3" style="font-size: 16px">
                        <i class="glyphicon glyphicon-ok "></i>
                        <a href="<?php echo $this->createUrl('supply/viewstock', array('cat_id' => $cat->id)); ?>">
                            <?php echo $cat->name; ?>  <span class="badge"><?php echo $count_subcat; ?></span>   
                        </a>

                    </div>        

                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3" >
            <div class="panel panel-primary" style="min-height:500px">            
                <div class="panel-heading" style="font-size:15px">Category - <?php if (!empty($cat_id)) {
                    echo $cate_name = Purchasecategory::model()->findByPk($cat_id)->name;
                }
                ?> Purchase</div>
                <div class="panel-body">
                    <ul class="todo-list ui-sortable">
                        <?php
                        if (!empty($subCats_Purchase)) {
                            foreach ($subCats_Purchase as $sub_cat) {
                                ?>                
                                <li>
                                        <?php //echo $this->createUrl('supply/viewstock', array('cat_id' => $cat_id, 'sub_cat' => $sub_cat->id)); ?>
                                    <a href='#' onclick="getAllItems(<?php echo $cat_id; ?>,<?php echo $sub_cat->id; ?>)">
                                <?php echo $sub_cat->name ?>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3" >
            <div class="panel panel-primary" style="min-height:500px">            
                <div class="panel-heading" style="font-size:15px">Category - <?php if (!empty($cat_id)) {
                            echo $cate_name;
                        } ?> Processed</div>
                <div class="panel-body">
                    <ul class="todo-list ui-sortable">
                            <?php
                            if (!empty($subCats_Processed)) {
                                foreach ($subCats_Processed as $sub_cat) {
                                    ?>                
                                <li>
                                <?php //echo $this->createUrl('supply/viewstock', array('cat_id' => $cat_id, 'sub_cat' => $sub_cat->id));  ?>
                                    <a href='#' onclick="getAllItems(<?php echo $cat_id; ?>,<?php echo $sub_cat->id; ?>)">
                                <?php echo $sub_cat->name ?>
                                    </a>
                                </li>
        <?php
    }
}
?>
                    </ul>
                </div>
            </div>
        </div>
         <div class="col-lg-3" >
            <div class="panel panel-primary" style="min-height:500px">            
                <div class="panel-heading" style="font-size:15px">Category - <?php if (!empty($cat_id)) {
                            echo $cate_name;
                        } ?> Resale</div>
                <div class="panel-body">
                    <ul class="todo-list ui-sortable">
                            <?php
                            if (!empty($subCats_Resale)) {
                                foreach ($subCats_Resale as $sub_cat) {
                                    ?>                
                                <li>
                                <?php //echo $this->createUrl('supply/viewstock', array('cat_id' => $cat_id, 'sub_cat' => $sub_cat->id));  ?>
                                    <a href='#' onclick="getAllItems(<?php echo $cat_id; ?>,<?php echo $sub_cat->id; ?>)">
                                <?php echo $sub_cat->name ?>
                                    </a>
                                </li>
        <?php
    }
}
?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-primary" style="min-height:500px">            
                <div class="panel-heading" style="font-size:16px">Item List</div>
                <div class="panel-body"  id="product_list">
                </div>
            </div>
        </div>
    </div><!-- row -->
</div>
    </div>
</div>
<script>
    function getAllItems(cat_id, subcat_id) {
        //   alert('hh');
        var url = '<?php echo $this->createUrl('supply/getItems') ?>';
        $.getJSON(url, {'cat_id': cat_id, 'subcat_id': subcat_id}, function(data) {
            console.log(data.data);
            var content = "";
            content += "<table class='table table-bordered'><thead><tr>";
            content += "<th>Item Name</th>";
            content += "<th>Brand</th>";
            content += "<th>Low Qty</th>";
            content += "<th>Available Qty</th>";
            content += "</tr></thead>";
            content += "<tbody>";
            $.each(data.data, function(k, v) {
                content += "<tr>";
                content += " <td>" + v.itemname + "(" + v.item_scale + ") </td>";
                content += " <td>" + v.brand + "</td>";
                content += " <td>" + v.low_qty + "</td>";
                content += " <td>" + v.stock + "</td>";
                content += " </tr> ";
            });
            content += " </tbody>   </table> ";
            $("#product_list").html(content);
        });
    }
</script>