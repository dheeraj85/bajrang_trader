<?php

/**
 * This is the model class for table "recipe_items".
 *
 * The followings are the available columns in table 'recipe_items':
 * @property integer $id
 * @property string $recipe_category
 * @property integer $category_name_id
 * @property string $description
 * @property integer $weight_limit_kg
 *
 * The followings are the available model relations:
 * @property Ingredients[] $ingredients
 */
class Recipeitems extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Recipeitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'recipe_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_name_id, weight_limit_kg', 'numerical', 'integerOnly' => true),
            array('recipe_category', 'length', 'max' => 7),
            array('description', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, recipe_category, category_name_id, description, weight_limit_kg', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ingredients' => array(self::HAS_MANY, 'Ingredients', 'recipe_item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'recipe_category' => 'Recipe Category',
            'category_name_id' => 'Category Name',
            'description' => 'Description',
            'weight_limit_kg' => 'Weight Limit in Kg',
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
        $criteria->compare('recipe_category', $this->recipe_category, true);
        $criteria->compare('category_name_id', $this->category_name_id);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('weight_limit_kg', $this->weight_limit_kg);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function Ingredients($data) {
        ?>
        <a class="btn btn-success" href="<?php echo Yii::app()->createUrl('ingredients/create', array('rid' => $data->id)); ?>">Ingredients</a>
        <?php
    }

    public static function Category_name($data) {
       if($data->recipe_category=='Flavour'){
        $cat = Cakeflavour::model()->findByPk($data->category_name_id);
        $name = $cat->flavour_name;
       }
       return $name;
    }

}
