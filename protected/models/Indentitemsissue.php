<?php

/**
 * This is the model class for table "internal_indent_items_issue".
 *
 * The followings are the available columns in table 'internal_indent_items_issue':
 * @property integer $id
 * @property integer $internal_id
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_brand
 * @property integer $issue_qty
 * @property string $issue_date
 * @property string $issue_purpose
 * @property integer $created_by
 * @property string $created_user_role
 * @property integer $is_issue_done
 *
 * The followings are the available model relations:
 * @property InternalIndentItems $internal
 * @property Users $createdBy
 * @property PurchaseCategory $pCategory
 * @property PurchaseSubCategory $pSubCategory
 * @property PurchaseItem $item
 */
class Indentitemsissue extends CActiveRecord {

    public $from_date;
    public $to_date;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'internal_indent_items_issue';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('internal_id, p_category_id, p_sub_category_id, item_id, created_by, is_issue_done', 'numerical', 'integerOnly' => true),
            array('item_name', 'length', 'max' => 100),
            array('item_brand', 'length', 'max' => 50),
            array('issue_purpose', 'length', 'max' => 255),
            array('created_user_role', 'length', 'max' => 30),
            array('issue_qty', 'length', 'max' => 12),
            array('issue_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('p_category_id, p_sub_category_id,from_date, to_date', 'safe', 'on' => 'search'),
            array('id, internal_id, p_category_id, p_sub_category_id, item_id, item_name, item_brand, issue_qty, issue_date, issue_purpose, created_by, created_user_role, is_issue_done', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'internal' => array(self::BELONGS_TO, 'InternalIndentItems', 'internal_id'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
            'pcat' => array(self::BELONGS_TO, 'Purchasecategory', 'p_category_id'),
            'pscat' => array(self::BELONGS_TO, 'Purchasesubcategory', 'p_sub_category_id'),
            'item' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'internal_id' => 'Internal',
            'p_category_id' => 'Category',
            'p_sub_category_id' => 'Sub Category',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_brand' => 'Item Brand',
            'issue_qty' => 'Issue Qty',
            'issue_date' => 'Issue Date',
            'issue_purpose' => 'Issue Purpose',
            'created_by' => 'Created By',
            'created_user_role' => 'Created User Role',
            'is_issue_done' => 'Is Issue Done',
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
        $criteria->compare('created_by', Yii::app()->user->id);
        if(!empty($this->from_date) && empty($this->to_date) && empty($this->p_category_id))
        {
            $criteria->condition = "issue_date >= '$this->from_date'"; 
        }elseif(!empty($this->to_date) && empty($this->from_date) && empty($this->p_category_id))
        {
            $criteria->condition = "issue_date <= '$this->to_date'";
        }elseif(!empty($this->to_date) && !empty($this->from_date) && empty($this->p_category_id))
        {
            $criteria->condition = "issue_date  >= '$this->from_date' and issue_date <= '$this->to_date'";
        }
        elseif(!empty($this->to_date) && !empty($this->from_date) && !empty($this->p_category_id))
        {
            $criteria->condition = "issue_date  >= '$this->from_date' and issue_date <= '$this->to_date' and p_category_id=$this->p_category_id";
        }
        $criteria->compare('id', $this->id);
        $criteria->compare('internal_id', $this->internal_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_brand', $this->item_brand, true);
        $criteria->compare('issue_qty', $this->issue_qty);
        $criteria->compare('issue_date', $this->issue_date, true);
        $criteria->compare('issue_purpose', $this->issue_purpose, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_user_role', $this->created_user_role, true);
        $criteria->compare('is_issue_done', $this->is_issue_done);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Indentitemsissue the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

     public static function getcategory($data) {
        if(isset($data->p_category_id)){ echo $data->pcat->name; }
    }
    public static function getscategory($data) {
        if(isset($data->p_category_id)){ echo $data->pscat->name;}
    }
    
    public static function getitemdiscard($data) {
        echo "<div class='bg-red' style='padding:5px;'>" . $data->discard_date . "</div>";
    }
}