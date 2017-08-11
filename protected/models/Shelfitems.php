<?php

/**
 * This is the model class for table "shelf_items".
 *
 * The followings are the available columns in table 'shelf_items':
 * @property integer $id
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $barcode
 * @property string $tax_type
 * @property string $sale_price
 *
 * The followings are the available model relations:
 * @property PurchaseItem $item
 */
class Shelfitems extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Shelfitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shelf_items';
    }
public $item_name;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('p_category_id, p_sub_category_id, item_id', 'numerical', 'integerOnly' => true),
            array('barcode', 'length', 'max' => 100),
            array('tax_type', 'length', 'max' => 9),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, p_category_id,sale_price, p_sub_category_id, item_id, barcode, tax_type,total_qty,item_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'positem' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
//			'item' => array(self::BELONGS_TO, 'Menuitem', 'item_id'),
            'pCategory' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'pSubCategory' => array(self::BELONGS_TO, 'Purchasesubcategory', 'p_sub_category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'p_category_id' => 'Category',
            'p_sub_category_id' => 'Sub Category',
            'item_id' => 'Item Name',
            'barcode' => 'Barcode',
            'tax_type' => 'Tax Type',
            'sale_price' => 'Sale Price',
            'total_qty' => 'Avl. Qty in Shelf ',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
       $criteria->with = array('positem');
        $criteria->compare('id', $this->id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        //$criteria->compare('item_id',$this->item_id);
        $criteria->compare('positem.itemname', $this->item_name, true);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('tax_type', $this->tax_type, true);
        $criteria->compare('sale_price', $this->sale_price, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
             'Pagination' => array (
                  'PageSize' =>25
              ),
            'sort' => array(
                'attributes' => array(
                    'item_name' => array(
                        'asc' => 'positem.itemname',
                        'desc' => 'positem.itemname',
                    ),
                    '*',
                ),
            ),
        ));
    }
    public function searchExcel() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
       $criteria->with = array('positem');
        $criteria->compare('id', $this->id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        //$criteria->compare('item_id',$this->item_id);
        $criteria->compare('positem.itemname', $this->item_name, true);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('tax_type', $this->tax_type, true);
        $criteria->compare('sale_price', $this->sale_price, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
               'pagination' => FALSE
        ));
    }

    public static function Addtoshelf($data) {
        ?>
             <a href='#' onclick="getStockOfItem('<?php echo $data->item_id; ?>')" class="btn btn-primary">Dispatch</a>
        <!--<a href="#" onclick="viewDispatched('<?php //echo $data->item_id; ?>')" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i> View</a>-->
<?php
$csrfTokenName = Yii::app()->request->csrfTokenName;
$csrfToken = Yii::app()->request->csrfToken;
?>
<script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $('#myItemModal').on('hidden.bs.modal', function() {
                                                            window.location.reload();
                                                        });
                                                    });
                                    

                                                    function viewDispatched(item_id, id) {
                                                        var url = '<?php echo Yii::app()->createUrl("supply/getDirectDispatchItem"); ?>';
                                                        $.getJSON(url, {'item_id': item_id, 'id': id}, function(data) {

                                                        });
                                                        $("#myDispatchModal").modal({backdrop: 'static', keyboard: false});
                                                    }

                                                    function getStockOfItem(item_id) {
                                                     //   alert(item_id);
                                                        var url = '<?php echo Yii::app()->createUrl("supply/getItemStockForPOS"); ?>';
                                                        $.getJSON(url, {'item_id': item_id}, function(data) {
                                                            $("#itemname").html("Item - " + data.item_total.item_name);                                                         
                                                            $("#dispatch_qty").html("Total Qty Available : <b>" + data.item_total.stock_qty + "</b>");
                                                            var content = "";
                                                            content += "<table class='table table-bordered'>";
                                                        //    alert(data.item_stock);
                                                            if (data.item_stock == '') {
                                                                content += "<tr class='alert alert-danger'>";
                                                                content += "<th colspan='9'>No Stock Available</th> </tr>";
                                                                content += "</table>";
                                                            } else {
                                                                $.each(data.item_stock, function(k, v) {
                                                                    content += "<tr class='alert alert-success'>";
                                                                    content += "<th>ItemName </th>";
                                                                    content += "<th>Brand </th>";
                                                                    content += "<th>Store</th>";
                                                                    content += "<th>Available Qty</th>";
                                                                    content += "<th>Rate</th>";
                                                                    content += "<th>Taxes(%)</th>";
                                                                    //     if (v.is_mrd == 'Yes') {
                                                                    content += "<th>Make Date</th>";
                                                                    content += "<th>Discard Date</th>";
                                                                    //       }
                                                                    content += "<th colspan='2'>Dispatch Qty</th> </tr>";

                                                                    content += " <tr>";
                                                                    content += "<td>" + v.itemname + "</td>";
                                                                    content += "<td>" + v.brand + "</td>";
                                                                    content += "<td>Store1</td>";

                                                                    content += "<td>" + v.stock_qty + "</td>";
                                                                    content += "<td>" + v.rate + "</td>";
                                                                    content += "<td>" + v.tax + "</td>";
                                                                    //  if (v.is_mrd == 'Yes') {
                                                                    content += "<td>" + v.make_date + "</td>";
                                                                    content += "<td>" + v.discard_date + "</td>";
                                                                    //     }
                                                                    content += "<td><input type='number' class='form-control text-box' id='new_qty_" + v.id + "' placeholder='Enter Qty'>";
//                                                                    content += "<input type='number' class='form-control text-box' id='sale_price_" + v.id + "' placeholder='Enter Sale Price'>";
//                                                                    content += "<input type='number' class='form-control text-box' id='new_tax_" + v.id + "' placeholder='Enter Tax'></td>";
                                                                    content += "<td><button type='button' class='btn btn-info' id='btn_" + v.id + "' onclick=getCheckValue('" + v.stock_qty + "','" + v.id + "','" + item_id + "')>Save</button></td>";
                                                                    content += "</tr>";
                                                                });
                                                                // content += "<tr><td colspan='6' align='right'></tr>";
                                                                content += "</table>";
                                                            }
                                                            //   alert(content);
                                                            $("#show_item_details").html(content);
                                                        });

                                                        $("#myItemModal").modal({backdrop: 'static', keyboard: false});
                                                    }

                                                    function getCheckValue(stock_qty, stock_id, item_id) {
                                                        //alert(stock_id);                                                  
                                                        var new_qty = $('#new_qty_' + stock_id).val();
                                                                                                     //     alert(new_qty);  
                                                        if (new_qty == "") {
                                                            alert('Please fill the Dispatch Qty');
                                                            return;
                                                        }
                                                        if (eval(new_qty) > eval(stock_qty)) {
                                                            alert('Dispatch Qty can\'t be greater than Stock Qty');
                                                            $('#new_qty_' + stock_id).focus().val('');
                                                        } else {
                                                            $("#show_item_details").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/loading_icon.gif">');
                                                            var url = '<?php echo Yii::app()->createUrl("supply/saveDirectDispatchStock"); ?>';
                                                            var token = '<?php echo $csrfToken; ?>';
                                                            $.post(url, {'YII_CSRF_TOKEN': token,
                                                                'stock_id': stock_id,
                                                                'dispatch_qty': new_qty,
                                                                'item_id': item_id,
                                                            }, function(data) {
                                                                var data = jQuery.parseJSON(data);
                                                                if (data.msg == 'Success') {
                                                                    $('#new_qty_' + stock_id).val('');
                                                                    getStockOfItem(item_id);
                                                                } else if (data.msg == 'less_stock') {
                                                                    alert('Dispatch Qty can\'t be greater than Required Qty');
                                                                    getStockOfItem(item_id);
                                                                }
                                                            });
                                                        }
                                                    }//============

                                                    function getOrderDone(indent_id) {
                                                        var c = confirm('Are you sure want to submit to Supply Items ?');
                                                        if (c == true) {
                                                            var url = '<?php echo Yii::app()->createUrl("supply/updateOrderStatus"); ?>';
                                                            $.getJSON(url, {'indent_id': indent_id, 'status': '2'}, function(data) {
                                                                if (data.msg == 'Success') {
                                                                    window.location.href = '<?php echo Yii::app()->createUrl("supply/viewIndents"); ?>';
                                                                }
                                                            });
                                                        }
                                                    }
</script>

    <?php }

    public static function availableStock($data) {
        $item=Itemstock::model()->findBySql("Select sum(stock_qty) as stock_qty from item_stock where item_id=$data->item_id");
        ?>
        <label class="badge"><?php echo isset($item->stock_qty)?$item->stock_qty:'0'; ?></label>
    <?php
    } 
    public static function availableInShelf($data) {
        $item=  InternalStock::model()->findBySql("Select sum(stock_qty) as stock_qty from internal_stock where item_id=$data->item_id");
        ?>
        <label class="badge"><?php echo isset($item->stock_qty)?$item->stock_qty:'0'; ?></label>
    <?php
    }

}
