<?php

/**
 * This is the model class for table "opening_stock_history".
 *
 * The followings are the available columns in table 'opening_stock_history':
 * @property integer $id
 * @property string $stock_type
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $stock_qty
 * @property string $price
 * @property string $stock_taking_scale
 * @property string $created_date
 * @property integer $created_by
 *
 * The followings are the available model relations:
 * @property PurchaseCategory $pCategory
 * @property PurchaseSubCategory $pSubCategory
 */
class Stockhistory extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Stockhistory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'opening_stock_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('p_category_id, p_sub_category_id, item_id, created_by', 'numerical', 'integerOnly' => true),
            array('stock_type', 'length', 'max' => 8),
            array('stock_qty, stock_taking_scale', 'length', 'max' => 10),
            array('price', 'length', 'max' => 12),
            array('created_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, stock_type, p_category_id, p_sub_category_id, item_id, stock_qty, price, stock_taking_scale, created_date, created_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pCategory' => array(self::BELONGS_TO, 'PurchaseCategory', 'p_category_id'),
            'pSubCategory' => array(self::BELONGS_TO, 'PurchaseSubCategory', 'p_sub_category_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'stock_type' => 'Stock Type',
            'p_category_id' => 'P Category',
            'p_sub_category_id' => 'P Sub Category',
            'item_id' => 'Item',
            'stock_qty' => 'Stock Qty',
            'price' => 'Price',
            'stock_taking_scale' => 'Stock Taking Scale',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('stock_type', $this->stock_type, true);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('stock_qty', $this->stock_qty, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('created_date', $this->created_date, true);
        $criteria->compare('created_by', $this->created_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getsalesitem($data = array()) {
        if (!empty($data['choice_item'])) {
            if ($data['choice_item'] == "selfitem") {
                $sql = "SELECT * from opening_stock_history";

                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(created_date) >= '" . $data['filter_date_start'] . "'";
                }

                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(created_date) <= '" . $data['filter_date_end'] . "'";
                }
                if (!empty($data['item_id'])) {
                    $sql .= " AND item_id=" . $data['item_id'];
                }

                $sql .= " and stock_type='internal'";
                $query = Yii::app()->db->createCommand($sql)->queryAll();
            } else {

                $sql = "SELECT * from opening_stock_history";

                if (!empty($data['filter_date_start'])) {
                    $sql .= " WHERE DATE(created_date) >= '" . $data['filter_date_start'] . "'";
                }

                if (!empty($data['filter_date_end'])) {
                    $sql .= " AND DATE(created_date) <= '" . $data['filter_date_end'] . "'";
                }
                if (!empty($data['item_id'])) {
                    $sql .= " AND item_id=" . $data['item_id'];
                }

                $sql .= " and stock_type='main'";
                $query = Yii::app()->db->createCommand($sql)->queryAll();
            }
        }
        return $query;
    }

}
