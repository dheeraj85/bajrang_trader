<?php

/**
 * This is the model class for table "internal_indent_items".
 *
 * The followings are the available columns in table 'internal_indent_items':
 * @property integer $id
 * @property string $sync_id
 * @property string $barcode
 * @property string $particulars
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_brand
 * @property string $item_purpose
 * @property string $qty_scale
 * @property integer $qty_required
 * @property integer $qty_dispatch
 * @property integer $qty_in_stock
 * @property string $req_date
 * @property integer $issued_to
 * @property string $rate
 * @property string $tax
 * @property string $dealership_price
 * @property string $mrp
 * @property string $discount
 * @property string $markup
 * @property string $markdown
 * @property integer $is_mrd
 * @property integer $mrd_no
 * @property string $make_date
 * @property string $ready_date
 * @property string $discard_date
 * @property string $schedule_date
 * @property integer $is_added_to_order
 * @property integer $item_accepted_by_pos
 * @property integer $is_sync_to
 * @property string $sync_date
 * @property integer $created_by
 * @property string $created_user_role
 * @property integer $is_indenting_done
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property PurchaseCategory $pCategory
 * @property PurchaseSubCategory $pSubCategory
 * @property PurchaseItem $item
 */
class Indentitems extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'internal_indent_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('issued_to', 'required'),
            array('p_category_id, p_sub_category_id, item_id, issued_to, is_mrd, mrd_no, is_added_to_order, item_accepted_by_pos, is_sync_to, created_by, is_indenting_done', 'numerical', 'integerOnly' => true),
            array('sync_id', 'length', 'max' => 20),
            array('barcode, item_name', 'length', 'max' => 100),
            array('particulars', 'length', 'max' => 200),
            array('item_brand', 'length', 'max' => 50),
            array('item_purpose', 'length', 'max' => 6),
            array('qty_scale', 'length', 'max' => 25),
            array('rate, tax, dealership_price, mrp, discount, markup, markdown,qty_required, qty_dispatch, qty_in_stock,qty_for_sale', 'length', 'max' => 12),
            array('created_user_role', 'length', 'max' => 30),
            array('req_date, make_date, ready_date, discard_date, schedule_date, sync_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sync_id, barcode, particulars, p_category_id, p_sub_category_id, item_id, item_name, item_brand, item_purpose, qty_scale, qty_required, qty_dispatch, qty_in_stock, req_date, issued_to, rate, tax, dealership_price, mrp, discount, markup, markdown, is_mrd, mrd_no, make_date, ready_date, discard_date, schedule_date, is_added_to_order, item_accepted_by_pos, is_sync_to, sync_date, created_by, created_user_role, is_indenting_done', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'pCategory' => array(self::BELONGS_TO, 'PurchaseCategory', 'p_category_id'),
            'pSubCategory' => array(self::BELONGS_TO, 'PurchaseSubCategory', 'p_sub_category_id'),
            'item' => array(self::BELONGS_TO, 'PurchaseItem', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'sync_id' => 'Sync',
            'barcode' => 'Barcode',
            'particulars' => 'Particulars',
            'p_category_id' => 'P Category',
            'p_sub_category_id' => 'P Sub Category',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_brand' => 'Item Brand',
            'item_purpose' => 'Item Purpose',
            'qty_scale' => 'Qty Scale',
            'qty_required' => 'Qty Required',
            'qty_dispatch' => 'Qty Dispatch',
            'qty_in_stock' => 'Qty In Stock',
            'req_date' => 'Req Date',
            'issued_to' => 'Issued To',
            'rate' => 'Rate',
            'tax' => 'Tax',
            'dealership_price' => 'Dealership Price',
            'mrp' => 'Mrp',
            'discount' => 'Discount',
            'markup' => 'Markup',
            'markdown' => 'Markdown',
            'is_mrd' => 'Is Mrd',
            'mrd_no' => 'Mrd No',
            'make_date' => 'Make Date',
            'ready_date' => 'Ready Date',
            'discard_date' => 'Discard Date',
            'schedule_date' => 'Schedule Date',
            'is_added_to_order' => 'Is Added To Order',
            'item_accepted_by_pos' => 'Item Accepted By Pos',
            'is_sync_to' => 'Is Sync To',
            'sync_date' => 'Sync Date',
            'created_by' => 'Created By',
            'created_user_role' => 'Created User Role',
            'is_indenting_done' => 'Is Indenting Done',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('sync_id', $this->sync_id, true);
        $criteria->compare('barcode', $this->barcode, true);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_brand', $this->item_brand, true);
        $criteria->compare('item_purpose', $this->item_purpose, true);
        $criteria->compare('qty_scale', $this->qty_scale, true);
        $criteria->compare('qty_required', $this->qty_required);
        $criteria->compare('qty_dispatch', $this->qty_dispatch);
        $criteria->compare('qty_in_stock', $this->qty_in_stock);
        $criteria->compare('req_date', $this->req_date, true);
        $criteria->compare('issued_to', $this->issued_to);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('tax', $this->tax, true);
        $criteria->compare('dealership_price', $this->dealership_price, true);
        $criteria->compare('mrp', $this->mrp, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('markup', $this->markup, true);
        $criteria->compare('markdown', $this->markdown, true);
        $criteria->compare('is_mrd', $this->is_mrd);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('is_added_to_order', $this->is_added_to_order);
        $criteria->compare('item_accepted_by_pos', $this->item_accepted_by_pos);
        $criteria->compare('is_sync_to', $this->is_sync_to);
        $criteria->compare('sync_date', $this->sync_date, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_user_role', $this->created_user_role, true);
        $criteria->compare('is_indenting_done', $this->is_indenting_done);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Indentitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
