<?php

/**
 * This is the model class for table "purchase_indent".
 *
 * The followings are the available columns in table 'purchase_indent':
 * @property integer $id
 * @property integer $indent_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_brand
 * @property integer $qty_req
 * @property string $qty_scale
 * @property string $req_date
 *
 * The followings are the available model relations:
 * @property PurchaseItem $item
 */
class Purchaseindent extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_indent';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('indent_id, item_id', 'numerical', 'integerOnly' => true),
            array('item_name', 'length', 'max' => 100),
            array('item_brand', 'length', 'max' => 50),
            array('qty_scale', 'length', 'max' => 25),
            array('qty_req', 'length', 'max' => 12),
            array('req_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, indent_id, item_id, item_name, item_brand, qty_req, qty_scale, req_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'item' => array(self::BELONGS_TO, 'PurchaseItem', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'indent_id' => 'Indent',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_brand' => 'Item Brand',
            'qty_req' => 'Qty Req',
            'qty_scale' => 'Qty Scale',
            'req_date' => 'Req Date',
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
        $criteria->compare('indent_id', $this->indent_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_brand', $this->item_brand, true);
        $criteria->compare('qty_req', $this->qty_req);
        $criteria->compare('qty_scale', $this->qty_scale, true);
        $criteria->compare('req_date', $this->req_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchaseindent the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
