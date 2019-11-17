<?php

class MenubackendController extends Controller{
    public $layout = "template_backend";


    public function actionSetactive(){
        $group = Yii::app()->request->getPost('group');
        $menu = Yii::app()->request->getPost('menu');
        Yii::app()->session['groupmenu'] = $group;
        Yii::app()->session['submenu'] = $menu;
      }
}
