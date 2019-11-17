<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $categoryname
 * @property integer $active
 * @property string $icons
 */
class Category extends CActiveRecord {

    public $fileField;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('categoryname,active,icons', 'required'),
            array('active', 'numerical', 'integerOnly' => true),
            array('categoryname', 'length', 'max' => 255),
            array(
                'icons', 'file',
                'types' => 'jpg,png', // ให้ (Field) files กำหนดประเภท file ชนิด jpg,pdf,doc
                'wrongType' => 'รองรับไฟล์ jpg, png เท่านั้น', 'allowEmpty' => true, // ข้อความเตือน
                'maxSize' => 1024 * 1024 * 5, // 5 MB
                'tooLarge' => 'ขนาดไฟล์ไม่เกิน 5MB' // ขนาดไฟล์
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, categoryname, active, icons', 'safe', 'on' => 'search'),
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
            'categoryname' => 'Categoryname',
            'active' => 'Active',
            'icons' => 'icon',
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
        $criteria->compare('categoryname', $this->categoryname, true);
        $criteria->compare('active', $this->active);
        $criteria->compare('icons', $this->icons, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
