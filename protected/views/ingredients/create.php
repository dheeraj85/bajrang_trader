<?php
/* @var $this IngredientsController */
/* @var $model Ingredients */
?>

<?php
$this->breadcrumbs = array(
    'Cake Management System' => array('cakeweight/index'),
    'Recipe Items' => array('recipeitems/create'),
    'Ingredients',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Ingredients', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Ingredients', 'url' => array('admin')),
);
?>

<style>
    .view, .delete{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <div class="pull-left">
                        <h3 class="panel-title">Add Ingredients</h3>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-default" href="<?php echo $this->createUrl('recipeitems/create') ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-success">
                        <?php
                        $flavour = Recipeitems::model()->findByPk($rid);
                        $grams = 1000 * $flavour->weight_limit_kg;
                        ?>
                        <div class="row">
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'>Type :</label>
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b><?php echo $flavour->recipe_category; ?></b></label>
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b>Name :</b></label>
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b><?php echo Recipeitems::Category_name($flavour); ?></b></label>
                        </div>
                        <div class="row">
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b>Weight Limit in gm : </b></label>
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b id="wght_in_gm"><?php echo $grams; ?></b><b> gm</b></label>
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b>Description :</b></label>
                            <label class='col-lg-3 col-md-3 col-sm-6 col-xs-6'><b><?php echo $flavour->description; ?></b></label>

                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" id="rid" value="<?php echo $rid; ?>">
                        <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                            <label>Select Item</label>
                            <select class="form-control select2" id="item">
                                <option value="">--Select Item--</option>
                                <?php foreach (Purchaseitem::model()->findAll() as $item) { ?>
                                    <option value="<?php echo $item->id; ?>"><?php echo $item->itemname; ?></option>      
                                <?php } ?>    
                            </select>
                        </div>
                        <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12' style="margin-top: 25px;">
                            <button type="button" data-loading-text="Please wait..." id="add" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Add Item</button>
                        </div>
                    </div><hr/>

                </div>
            </div>     
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Ingredients</h3>
                </div>
                <div class="panel-body">
                    <div id="item_list"></div>
                </div>
            </div>     
        </div>  
    </div>  
</div>  <script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var rid = $('#rid').val();
        var item = $('#item').val();
        GetItemList(rid, item);
        $('#add').click(function () {
            var $btn = $('#add').button('loading');
            var rid = $('#rid').val();
            var item = $('#item').val();
            GetItemList(rid, item);
            $btn.button('reset');
        });
    });

    function GetItemList(rid, item) {
        $.ajax({
            url: "<?php echo $this->createUrl('ingredients/getItemList'); ?>",
            data: {"rid": rid, "item": item},
            success: function (data) {
                $('#item').val("");
                $("#item_list").html(data);
            }
        });
    }
</script>
