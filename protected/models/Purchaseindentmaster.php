<?php

/**
 * This is the model class for table "purchase_indent_master".
 *
 * The followings are the available columns in table 'purchase_indent_master':
 * @property integer $id
 * @property string $indend_date
 * @property integer $is_done
 * @property integer $created_by
 */
class Purchaseindentmaster extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_indent_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_done, created_by', 'numerical', 'integerOnly' => true),
            array('indend_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, indend_date, is_done, created_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'createdby' => array(self::BELONGS_TO, 'Users', 'created_by'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Indent No',
            'indend_date' => 'Indent Date',
            'is_done' => 'Status',
            'created_by' => 'Created By',
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
        $criteria->compare('indend_date', $this->indend_date, true);
        $criteria->compare('is_done', $this->is_done);
        $criteria->compare('created_by', $this->created_by);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchaseindentmaster the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

     public static function getindent($data){
     ?>
        <center><label class="badge bg-green"><?php echo $data->id?></label></center>
    <?php     
     }
     
     public static function reqaction($data){
       if ($data->is_done==0) {
            ?>
            <label class="badge bg-gray">Indenting</label>
            <?php
        } else if ($data->is_done==1) {
            ?>
            <label class="badge bg-red">Review</label>
            <?php
       } else {
            ?>
            <label class="badge bg-green">Finished</label>
            <?php
        }
    }
    
     public static function action($data){
       if ($data->is_done==0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('itemstock/indent', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Indenting</button></a>
            <?php
        } else if ($data->is_done==1) {
            ?>
            <a href="#" onclick="authreview(<?php echo $data->id;?>,'<?php echo Yii::app()->createUrl('purchaseindentmaster/review', array('id' => $data->id)); ?>')"><button type='button' class='btn btn-warning btn-sm'>Review</button></a>
            <?php
       } else {
            ?>
            <button type='button' class='btn btn-primary btn-sm disabled'>Finished</button>
            <a href="<?php echo Yii::app()->createUrl('purchaseindentmaster/printindent', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>View Indent</button></a>
            <?php
        }
    }
}
