<?php

/**
 * This is the model class for table "item_stock".
 *
 * The followings are the available columns in table 'item_stock':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $particulars
 * @property integer $stock_qty
 * @property string $stock_taking_scale
 * @property string $rate
 * @property string $amount
 * @property integer $is_mrd
 * @property integer $mrd_no
 * @property string $make_date
 * @property string $ready_date
 * @property string $discard_date
 * @property string $schedule_date
 * @property string $remarks
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property PurchaseInvoice $invoice
 * @property PurchaseCategory $pCategory
 * @property PurchaseSubCategory $pSubCategory
 * @property PurchaseItem $item
 */
class Itemstock extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'item_stock';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id, p_category_id, p_sub_category_id, item_id, mrd_no, is_active', 'numerical', 'integerOnly' => true),
            array('particulars', 'length', 'max' => 200),
            array('stock_taking_scale', 'length', 'max' => 10),
            array('rate, amount,v_qty,stock_qty', 'length', 'max' => 12),
            array('remarks', 'length', 'max' => 100),
            array('make_date, ready_date, discard_date, schedule_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, entry_type, invoice_id, p_category_id, p_sub_category_id, item_id, particulars, stock_qty, stock_taking_scale, rate, amount, is_mrd, mrd_no, make_date, ready_date, discard_date, schedule_date, remarks, is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pcat' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'pscat' => array(self::BELONGS_TO, 'Purchasesubcategory', 'p_sub_category_id'),
            'invoice' => array(self::BELONGS_TO, 'Purchaseinvoice', 'invoice_id'),
            'item' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'entry_type' => 'Entry Type',
            'invoice_id' => 'Invoice',
            'p_category_id' => 'P Category',
            'p_sub_category_id' => 'P Sub Category',
            'item_id' => 'Item',
            'particulars' => 'Particulars',
            'stock_qty' => 'Stock Qty',
            'stock_taking_scale' => 'Scale',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'is_mrd' => 'Is Mrd',
            'mrd_no' => 'Mrd No',
            'make_date' => 'Make Date',
            'ready_date' => 'Processed Date',
            'discard_date' => 'Discard Date',
            'schedule_date' => 'Schedule Date',
            'remarks' => 'Remarks',
            'is_active' => 'Is Active',
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
        $criteria->compare('entry_type', 'Invoice');
        //$criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('entry_type', $this->entry_type);
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('stock_qty', $this->stock_qty);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('is_mrd', $this->is_mrd);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function searchprint() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('entry_type', 'Invoice');
        //$criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('entry_type', $this->entry_type);
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('stock_qty', $this->stock_qty);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('is_mrd', $this->is_mrd);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date);

       return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function searchGPU() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('entry_type', 'Direct');
        $criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('entry_type', $this->entry_type);
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('stock_qty', $this->stock_qty);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('is_mrd', $this->is_mrd);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function searchGPUPrint() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('entry_type', 'Direct');
        $criteria->compare('created_by', Yii::app()->user->id);
        $criteria->compare('id', $this->id);
        $criteria->compare('entry_type', $this->entry_type);
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('stock_qty', $this->stock_qty);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('is_mrd', $this->is_mrd);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date);

         return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => FALSE
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Itemstock the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getstockqty($data) {
        echo "<div class='bg-green' style='padding:5px;'>" . $data->stock_qty . "</div>";
    }

    public static function getitemdiscard($data) {
        echo "<div class='bg-red' style='padding:5px;'>" . $data->discard_date . "</div>";
    }
 
    public static function getcategory($data) {
        if(isset($data->p_category_id)){ echo $data->pcat->name; }
    }
    
    public static function getscategory($data) {
        if(isset($data->p_category_id)){ echo $data->pscat->name;}
    }
 
    public static function viewitemdetails($data) {?>
        <a title='View' href='<?php echo Yii::app()->createUrl('finisheditem/view',array("id"=>$data->id)); ?>'><i class='fa fa-eye'></i></a>
    <?php } 
}
