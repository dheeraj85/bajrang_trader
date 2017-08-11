<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $password_hash
 * @property string $password
 * @property string $role
 * @property string $logged_in
 * @property string $logged_out
 * @property integer $is_active
 */
class Users extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('logged_in', 'required'),
            array('is_active', 'numerical', 'integerOnly' => true),
            array('name, email, password_hash, password', 'length', 'max' => 100),
            array('mobile', 'length', 'max' => 10),
            array('role', 'length', 'max' => 14),
            array('logged_out', 'safe'),
            array('mobile','unique'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('mobile, email, password_hash, role', 'required'),
            //array('id, name, mobile, email, password_hash, password, role, logged_in, logged_out, is_active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'password_hash' => 'Password',
            'password' => 'Password',
            'auth_password'=>'Security Password',
            'role' => 'Role',
            'logged_in' => 'Logged In',
            'logged_out' => 'Logged Out',
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
        $criteria->condition = "role!='sa'";
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password_hash', $this->password_hash, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('auth_password', $this->auth_password, true);
        $criteria->compare('role', $this->role, true);
        $criteria->compare('logged_in', $this->logged_in, true);
        $criteria->compare('logged_out', $this->logged_out, true);
        $criteria->compare('is_active', $this->is_active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function authenticate($username, $password) {
        $user = Users::model()->findByAttributes(array("mobile" => $username));

        if ($user != null && $user->password_hash == md5($password)) {
            return $user;
        } else {
            return null;
        }
    }

    public static function fauthenticate($username, $password) {
        $user = Users::model()->findByAttributes(array("mobile" => $username, "is_active" => 1));

        if ($user != null && $user->password_hash == md5($password)) {
            return $user;
        } else {
            return null;
        }
    }
     public static function request($data) {
        if ($data->is_active == 1) {
            ?>
            <a class="btn btn-info" href="<?php echo Yii::app()->createUrl('users/approval', array('id' => $data->id, 'active' => 0)); ?>" title="Active"><i class="fa fa-unlock"></i></a>
            <?php
        } else {
            ?>
            <a class="btn btn-info" href="<?php echo Yii::app()->createUrl('users/approval', array('id' => $data->id, 'active' => 1)); ?>" title="Block"><i class="fa fa-lock"></i></a>
        <?php }
        ?>
        <?php
    }

}
