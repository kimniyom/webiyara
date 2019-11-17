<?php

class OptionController extends Controller {

    public $layout = "template_backend";

    public function actionSave() {
        $product_id = Yii::app()->request->getPost('product_id');
        $masoption = Yii::app()->request->getPost('masoption');

        $columns = array("product_id" => $product_id, "masoption" => $masoption);
        Yii::app()->db->createCommand()
                ->insert("masoption", $columns);
    }

    public function actionGetmasoption() {
        $product_id = Yii::app()->request->getPost('product_id');
        $data['masoption'] = Masoption::model()->findAll('product_id=:product_id', array(':product_id' => $product_id));
        $this->renderPartial("//backend/option/index", $data);
    }

    public function actionSaveoption() {
        $option = Yii::app()->request->getPost('option');
        $price = Yii::app()->request->getPost('price');
        $group = Yii::app()->request->getPost('group');
        $columns = array(
            "group_id" => $group,
            "price" => $price,
            "option" => $option,
            "status" => '1'
        );

        Yii::app()->db->createCommand()
                ->insert("optionproduct", $columns);
    }

}
