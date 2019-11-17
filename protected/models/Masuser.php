<?php

/**
 * This is the model class for table "masuser".
 *
 * The followings are the available columns in table 'masuser':
 * @property integer $id
 * @property string $oid
 * @property string $pid
 * @property string $name
 * @property string $lname
 * @property string $alias
 * @property string $password
 * @property string $email
 * @property string $tel
 * @property string $sex
 * @property string $birth
 * @property string $status
 * @property string $d_update
 * @property string $create_date
 * @property string $images
 * @property string $username
 *
 * The followings are the available model relations:
 * @property News[] $news
 * @property Orders[] $orders
 */
class Masuser extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'masuser';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,password,name,lname,tel,sex','required'),
            array('oid', 'length', 'max' => 3),
            array('email','email'),
            array('pid, tel', 'length', 'max' => 10),
            array('name, lname, password, username', 'length', 'max' => 100),
            array('alias, images', 'length', 'max' => 255),
            array('sex, status', 'length', 'max' => 1),
            array('birth, d_update, create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, oid, pid, name, lname, alias, password, email, tel, sex, birth, status, d_update, create_date, images, username', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        /*
        return array(
            'news' => array(self::HAS_MANY, 'News', 'pid'),
            'orders' => array(self::HAS_MANY, 'Orders', 'pid'),
        );
         * 
         */
        return array(
		);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'รหัส',
            'oid' => 'รหัสคำนำหน้า',
            'pid' => 'รหัสสมาชิก',
            'name' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'alias' => 'Alias',
            'password' => 'รหัสผ่าน',
            'email' => 'อีเมล์',
            'tel' => 'เบอร์โทร',
            'sex' => 'Sex',
            'birth' => 'วันเกิด',
            'status' => 'สถานะ',
            'd_update' => 'วันที่',
            'create_date' => 'Create Date',
            'images' => 'รูปภาพประจำตัว',
            'username' => 'Username',
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
        $criteria->compare('oid', $this->oid, true);
        $criteria->compare('pid', $this->pid, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('lname', $this->lname, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('sex', $this->sex, true);
        $criteria->compare('birth', $this->birth, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('d_update', $this->d_update, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('images', $this->images, true);
        $criteria->compare('username', $this->username, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Masuser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
