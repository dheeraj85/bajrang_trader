<?php

/**
 * This is the model class for table "expense_master".
 *
 * The followings are the available columns in table 'expense_master':
 * @property integer $id
 * @property string $goods_service
 * @property string $gs_name
 * @property string $item_classification
 * @property string $hsn_sac_code
 * @property string $tax_percent
 * @property string $cess_percent
 * @property string $description
 * @property integer $created_by
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property ExpenseInvoiceItems[] $expenseInvoiceItems
 * @property Users $createdBy
 */
class Expensemaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'expense_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by,tax_percent, cess_percent', 'numerical', 'integerOnly' => true),
            array('goods_service', 'length', 'max' => 8),
            array('gs_name, hsn_sac_code', 'length', 'max' => 255),
            array('item_classification', 'length', 'max' => 14),
            //array('', 'length', 'max' => 12),
            array('description, created_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('goods_service, gs_name, item_classification, description', 'required'),
            //array('id, goods_service, gs_name, item_classification, hsn_sac_code, tax_percent, cess_percent, description, created_by, created_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'expenseinvoiceitems' => array(self::HAS_MANY, 'Expenseinvoiceitems', 'item_id'),
            'expenseheads' => array(self::BELONGS_TO, 'Expenseheads', 'expense_heads_id'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'expense_heads_id' => 'Expense Head',
            'goods_service' => 'GST Type',
            'gs_name' => 'Name',
            'item_classification' => 'Item Classification',
            'hsn_sac_code' => 'HSN/SAC Code',
            'tax_percent' => 'Tax Percent',
            'cess_percent' => 'Cess Percent',
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
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
        $criteria->compare('expense_heads_id', $this->expense_heads_id);
        $criteria->compare('goods_service', $this->goods_service, true);
        $criteria->compare('gs_name', $this->gs_name, true);
        $criteria->compare('item_classification', $this->item_classification, true);
        $criteria->compare('hsn_sac_code', $this->hsn_sac_code, true);
        $criteria->compare('tax_percent', $this->tax_percent, true);
        $criteria->compare('cess_percent', $this->cess_percent, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Expensemaster the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
