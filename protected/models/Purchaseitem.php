<?php

/**
 * This is the model class for table "purchase_item".
 *
 * The followings are the available columns in table 'purchase_item':
 * @property integer $id
 * @property string $item_type
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property string $itemname
 * @property string $brand
 * @property string $item_scale
 * @property string $specification
 * @property integer $created_by
 * @property integer $is_active
 * @property integer $is_schedule
 * @property integer $low_qty
 * @property string $barcode
 * @property string $type
 *
 * The followings are the available model relations:
 * @property InternalIndentItems[] $internalIndentItems
 * @property InternalIndentItemsIssue[] $internalIndentItemsIssues
 * @property ItemStock[] $itemStocks
 * @property PurchaseIndent[] $purchaseIndents
 * @property PurchaseInvoiceItems[] $purchaseInvoiceItems
 * @property Users $createdBy
 * @property PurchaseCategory $pCategory
 * @property PurchaseSubCategory $pSubCategory
 * @property PurchaseOrderItems[] $purchaseOrderItems
 * @property VendorItemSupply[] $vendorItemSupplies
 */
class Purchaseitem extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('p_category_id, p_sub_category_id, created_by, is_active, is_schedule, low_qty', 'numerical', 'integerOnly' => true),
            array('item_type', 'length', 'max' => 9),
            array('itemname, brand, barcode', 'length', 'max' => 100),
            array('specification', 'length', 'max' => 200),
            array('item_scale', 'length', 'max' => 20),
            array('type', 'length', 'max' => 13),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('item_type,p_category_id, p_sub_category_id, itemname', 'required'),
            //array('id, item_type, p_category_id, p_sub_category_id, itemname, brand, item_scale, specification, created_by, is_active, is_schedule, low_qty, barcode, type', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'internalIndentItems' => array(self::HAS_MANY, 'InternalIndentItems', 'item_id'),
            //'internalIndentItemsIssues' => array(self::HAS_MANY, 'InternalIndentItemsIssue', 'item_id'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'category' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'subcategory' => array(self::BELONGS_TO, 'Purchasesubcategory', 'p_sub_category_id'),
            'itemStocks' => array(self::HAS_MANY, 'Itemstock', 'item_id'),
            //'itemStocks' => array(self::HAS_MANY, 'ItemStock', 'item_id'),
            //'purchaseIndents' => array(self::HAS_MANY, 'PurchaseIndent', 'item_id'),
            //'purchaseInvoiceItems' => array(self::HAS_MANY, 'PurchaseInvoiceItems', 'item_id'),
            'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
                //'pCategory' => array(self::BELONGS_TO, 'PurchaseCategory', 'p_category_id'),
                //'pSubCategory' => array(self::BELONGS_TO, 'PurchaseSubCategory', 'p_sub_category_id'),
                //'purchaseOrderItems' => array(self::HAS_MANY, 'PurchaseOrderItems', 'item_id'),
                //'vendorItemSupplies' => array(self::HAS_MANY, 'VendorItemSupply', 'purchase_item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'item_type' => 'Item Type',
            'p_category_id' => 'Category',
            'p_sub_category_id' => 'Sub Category',
            'itemname' => 'Item Name',
            'brand' => 'Item Code',
            'gst_code' => 'HSN/SAC Code',
            'gst_code_type' => 'GST Type',
            'gst_percent' => 'GST HSN/SAC Tax %',
            'cess_tax' => 'CESS Tax %',
            'item_scale' => 'Item Scale',
            'specification' => 'Specification',
            'created_by' => 'Created By',
            'is_active' => 'Is Active',
            'is_schedule' => 'Is Schedule',
            'low_qty' => 'Low Qty',
            'barcode' => 'Barcode',
            'type' => 'Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        //$criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('item_type', $this->item_type, true);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('gst_code', $this->gst_code, true);
        $criteria->compare('gst_code_type', $this->gst_code_type, true);
        $criteria->compare('gst_percent', $this->gst_percent, true);
        
        $criteria->compare('itemname', $this->itemname, true);
        $criteria->compare('brand', $this->brand, true);
        $criteria->compare('item_scale', $this->item_scale, true);
        $criteria->compare('specification', $this->specification, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_schedule', $this->is_schedule);
        $criteria->compare('low_qty', $this->low_qty);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 20,)
        ));
    }

    public function search_for_stock_settlements() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        //$criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('item_type', $this->item_type, true);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('itemname', $this->itemname, true);
                $criteria->compare('gst_code', $this->gst_code, true);
        $criteria->compare('gst_code_type', $this->gst_code_type, true);
        $criteria->compare('gst_percent', $this->gst_percent, true);
        $criteria->compare('brand', $this->brand, true);
        $criteria->compare('item_scale', $this->item_scale, true);
        $criteria->compare('specification', $this->specification, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_schedule', $this->is_schedule);
        $criteria->compare('low_qty', $this->low_qty);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 20,)
        ));
    }

    public function searchprint() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        //$criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('item_type', $this->item_type, true);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('itemname', $this->itemname, true);
                      $criteria->compare('gst_code', $this->gst_code, true);
        $criteria->compare('gst_code_type', $this->gst_code_type, true);
        $criteria->compare('gst_percent', $this->gst_percent, true);
        $criteria->compare('brand', $this->brand, true);
        $criteria->compare('item_scale', $this->item_scale, true);
        $criteria->compare('specification', $this->specification, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_schedule', $this->is_schedule);
        $criteria->compare('low_qty', $this->low_qty);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => FALSE
        ));
    }

    public function searchexcel() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        //$criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('item_type', $this->item_type, true);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('itemname', $this->itemname, true);
                      $criteria->compare('gst_code', $this->gst_code, true);
        $criteria->compare('gst_code_type', $this->gst_code_type, true);
        $criteria->compare('gst_percent', $this->gst_percent, true);
        $criteria->compare('brand', $this->brand, true);
        $criteria->compare('item_scale', $this->item_scale, true);
        $criteria->compare('specification', $this->specification, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_schedule', $this->is_schedule);
        $criteria->compare('low_qty', $this->low_qty);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => FALSE
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchaseitem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getqty($data) {
        $sql = "select sum(stock_qty) as stock_qty from item_stock where item_id=$data->id";
        $qty = Yii::app()->db->createCommand($sql)->queryRow();
        if (isset($qty['stock_qty'])) {
            return $qty['stock_qty'];
        }
    }

    public function getstockqty($data) {
        $uid = Yii::app()->user->id;
        $sql = "select sum(qty_for_sale) as stock_qty from internal_indent_items where item_id=$data->id and created_by=$uid";
        $qty = Yii::app()->db->createCommand($sql)->queryRow();
        if (isset($qty['stock_qty'])) {
            return $qty['stock_qty'];
        }
    }

//    public function getstockqty($data) {
//        $uid = Yii::app()->user->id;
//        $sql = "select sum(qty_for_sale) as stock_qty from internal_indent_items where item_id=$data->id and created_by=$uid";
//        $qty = Yii::app()->db->createCommand($sql)->queryRow();
//        if (isset($qty['stock_qty'])) {
//            return $qty['stock_qty'];
//        }
//    }

    public static function stockSettlement($data) {
        ?>
        <a class="btn btn-success btn-sm" href="<?php echo Yii::app()->createUrl('purchaseitem/stockopening', array('id' => $data->id, 'type' => 'csk')); ?>">CSK Stock</a>

        <?php
        $shelf_item = Shelfitems::model()->findByAttributes(array('item_id' => $data->id));
        if (!empty($shelf_item)) {
            ?>
            <a class="btn btn-success btn-sm" href="<?php echo Yii::app()->createUrl('purchaseitem/stockopening', array('id' => $data->id, 'type' => 'shelf')); ?>">Store Stock</a>
            <?php } else {
            ?>
            <a class="btn btn-danger btn-sm" href="#">Not in Store</a>
        <?php
        }
    }

    public static function Addtoshelf($data) {
        $shelf_item = Shelfitems::model()->findByAttributes(array('item_id' => $data->id));
        ?>       
        <button type="button" class="btn btn-sm btn-info" onclick="Assignmenu(<?php echo $data->id; ?>);">Allot Vendor</button>
        <div id="ItemsaveModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Select Vendor</h4>
                    </div>
                    <div class="modal-body">
                        <form id="menu_item_form">
                            <input type="hidden" id="item_id" name="item_id" value="<?php echo $data->id; ?>">
                            <div style="overflow-y:scroll;height:350px;">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Vendor</th>
                                    </tr>
                                    <?php
                                    foreach (Vendor::model()->findAllBySql("select * from vendor") as $vs) {
                                        ?>
                                        <tr>
                                            <td width="20%"><input type="checkbox" class="allcheckedcategory" id="vs_<?php echo $vs->id ?>" name="vid[]" value="<?php echo $vs->id ?>"></td>
                                            <td width="80%"><?php echo $vs->name ?> (<?php echo $vs->firm_name; ?>)</td>    
                                        </tr>
        <?php } ?>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="save" onclick="saveitem()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
                    function saveitem() {
                    var dataset = $('#menu_item_form').serialize();
                            $.ajax({
                            url: '<?php echo Yii::app()->createUrl('purchaseitem/savemenu'); ?>',
                                    data: dataset,
                                    success: function(response) {
                                    $('#menu_item_form')[0].reset();
                                            $("#ItemsaveModal").modal('hide');
                                            location.reload();
                                    }
                            });
                    }
            function Assignmenu(id) {
            $("#item_id").val(id);
                    $("#ItemsaveModal").modal({backdrop: 'static', keyboard: false});
            }
        </script>
        <?php
        if ($data->is_active == 1) {
            ?>
            <a class="btn btn-sm btn-green" href="#" id='sts_<?php echo $data->id ?>' onclick="updateItemStatus(<?php echo $data->id ?>, '0')" title="Inactive Item">Inactive</a>
            <?php
        } else {
            ?>
                <a class="btn btn-sm btn-danger" href="#" id='sts_<?php echo $data->id ?>' onclick="updateItemStatus(<?php echo $data->id ?>, '1')" title="Active Item">Active</a>
            <?php }
        ?>

    <?php
    }

    public static function CSKStock($data) {
        $item = Itemstock::model()->findBySql("Select sum(stock_qty) as stock_qty from item_stock where item_id=$data->id");
        ?>
        <label class="badge"><?php echo isset($item->stock_qty) ? $item->stock_qty : '0'; ?></label>
        <?php
    }

    public static function ShelfStock($data) {
        $dt = Yii::app()->db->createCommand()
                ->select('total_qty as stock_qty')
                ->from('shelf_items')
                ->where('item_id = ' . $data->id)
                ->queryRow();
        $total_qty = $dt['stock_qty'];
        ?>
        <label class="badge"><?php echo isset($total_qty) ? $total_qty : '0'; ?></label>
        <?php
    }

}
?>