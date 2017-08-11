<?php

/**
 * This is the model class for table "expense_info".
 *
 * The followings are the available columns in table 'expense_info':
 * @property integer $id
 * @property integer $expense_head_id
 * @property string $name
 * @property string $reg_no
 * @property string $particular
 * @property string $voucher_no
 * @property string $amount
 * @property string $voucher_date
 * @property integer $created_by
 * @property integer $expense_nature_id
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property ExpenseHeads $expenseHead
 * @property ExpenseNature $expenseNature
 * @property Users $updatedBy
 * @property Users $createdBy
 */
class Expenseinfo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'expense_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('expense_head_id, created_by, expense_nature_id, updated_by', 'numerical', 'integerOnly' => true),
            array('name, reg_no', 'length', 'max' => 100),
            array('particular', 'length', 'max' => 200),
            array('voucher_no', 'length', 'max' => 50),
            array('amount', 'length', 'max' => 12),
            array('voucher_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            //array('reg_no, particular,voucher_date', 'required'),
                //array('id, expense_head_id, name, reg_no, particular, voucher_no, amount, voucher_date, created_by, expense_nature_id, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'expensehead' => array(self::BELONGS_TO, 'Expenseheads', 'expense_head_id'),
            'expensenature' => array(self::BELONGS_TO, 'Expensenature', 'expense_nature_id'),
            'updatedby' => array(self::BELONGS_TO, 'Users', 'updated_by'),
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'expense_head_id' => 'Expense Head',
            'name' => 'Name',
            'reg_no' => 'Reg No',
            'particular' => 'Particular',
            'voucher_no' => 'Voucher No',
            'amount' => 'Amount',
            'voucher_date' => 'Voucher Date',
            'created_by' => 'Created By',
            'expense_nature_id' => 'Expense Nature',
            'updated_by' => 'Updated By',
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
        $criteria->compare('id', $this->id);
        $criteria->compare('expense_head_id', $this->expense_head_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('reg_no', $this->reg_no, true);
        $criteria->compare('particular', $this->particular, true);
        $criteria->compare('voucher_no', $this->voucher_no, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('voucher_date', $this->voucher_date, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('expense_nature_id', $this->expense_nature_id);
        $criteria->compare('updated_by', $this->updated_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Expenseinfo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function accountaction($data) {
        if(!empty(Yii::app()->session['authorize'])){
        if(empty($data->expense_nature_id)){    
        ?>   
        <a href="<?php echo Yii::app()->createUrl('expenseinfo/review', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Update Nature</button></a>
        <?php }else{?>
        <a href="#"><button type='button' class='btn btn-green btn-sm disabled'>Nature Updated</button></a>
        <?php }}else{?>
       
        <?php
        } 
    }

}
