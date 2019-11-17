<?php

/**
 * This is the model class for table "privilege".
 *
 * The followings are the available columns in table 'privilege':
 * @property integer $id
 * @property integer $shop
 * @property integer $setting
 * @property integer $product
 * @property integer $article
 * @property integer $contact
 * @property integer $log
 * @property integer $user
 */
class Privilege extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'privilege';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop, setting, product, article, contact, log, user', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shop, setting, product, article, contact, log, user', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shop' => 'Shop',
			'setting' => 'Setting',
			'product' => 'Product',
			'article' => 'Article',
			'contact' => 'Contact',
			'log' => 'Log',
			'user' => 'User',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('shop',$this->shop);
		$criteria->compare('setting',$this->setting);
		$criteria->compare('product',$this->product);
		$criteria->compare('article',$this->article);
		$criteria->compare('contact',$this->contact);
		$criteria->compare('log',$this->log);
		$criteria->compare('user',$this->user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Privilege the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
