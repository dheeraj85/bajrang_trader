<?php

/**
 * This is the model class for table "users_logins".
 *
 * The followings are the available columns in table 'users_logins':
 * @property integer $id
 * @property integer $user_id
 * @property string $log_type
 * @property string $in_out
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Userslogins extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users_logins';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // array('in_out', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('log_type', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, log_type, in_out', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'log_type' => 'Type',
            'in_out' => 'Time',
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
    public function search($user_id,$filter_date_start,$filter_date_end) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('log_type', $this->log_type, true);
        $criteria->compare('in_out', $this->in_out, true);
        if($user_id!="" && $filter_date_start!="" && $filter_date_end!=""){
        $criteria->condition = "user_id=$user_id and in_out between '" . $filter_date_start . "' and '" . $filter_date_end." 23:59:00'";
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function search2($user_id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        if (!empty($user_id)) {
            $criteria->compare('user_id', $user_id);
        } else {
            $criteria->compare('user_id', $this->account_id);
        }
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('log_type', $this->log_type, true);
        $criteria->compare('in_out', $this->in_out, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Userslogins the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
