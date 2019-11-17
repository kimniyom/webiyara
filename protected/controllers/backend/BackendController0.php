<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BackendController extends Controller {

    public $layout = "template_backend";

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    protected function beforeAction($action) {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array('site/login'));
        } else {
            $this->actionIndex();
        }

        //return parent::beforeAction($action);
    }

    public function actionIndex() {
        $month = Month::model()->findAll();
        $Category = array();
        $Val = array();
        foreach ($month as $rs):
            $Arr = $this->actionGetviewmonth($rs['monthnumber']);
            if ($Arr['product_name']) {
                $cat = $rs['month_th'] . "(" . $Arr['product_name'] . ")";
                $Value = $Arr['total'];
            } else {
                $cat = $rs['month_th'];
                $Value = 0;
            }
            $Category[] = $cat;
            $Val[] = $Value;
        endforeach;

        $data['category'] = "'" . implode("','", $Category) . "'";
        $data['val'] = implode(",", $Val);

        //exit();
        $viewcategory = $this->Getviewcategory();
        $data['viewcategory'] = $viewcategory['value'];
        $data['viewcategoryCount'] = $viewcategory['sum'];

        $viewbran = $this->GetviewBrand();
        $data['brandcat'] = $viewbran['brancat'];
        $data['brandval'] = $viewbran['branval'];

        $data['viewMaxbrand'] = $this->Getmaxviewbrand();
        
        $data['viewMaxcategory'] = $this->Getmaxviewcategory();
        
        $data['viewMaxproduct'] = $this->Getmaxviewproduct();

        $data['countOederAll'] = $this->countOrder();

        $data['countOederSuccess'] = $this->countOrderSuccess();

        $this->render("//backend/index", $data);
    }

    private function Getmaxviewbrand() {
        $sql = "SELECT c.brandname,IFNULL(Q.total,0) AS total
                FROM brand c
                LEFT JOIN(
                SELECT p.brand,IFNULL(COUNT(*),0) AS total
                FROM viewproduct v INNER JOIN product p ON v.product_id = p.product_id
                GROUP BY p.brand
                ) Q ON c.id = Q.brand
                ORDER BY total DESC
                LIMIT 1";

        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $Arr = array("brandname" => $result['brandname'], "total" => $result['total']);
        return $Arr;
    }
    
    private function Getmaxviewcategory() {
        $sql = "SELECT c.categoryname,IFNULL(Q.total,0) AS total
                FROM category c
                LEFT JOIN(
                SELECT p.category,IFNULL(COUNT(*),0) AS total
                FROM viewproduct v INNER JOIN product p ON v.product_id = p.product_id
                GROUP BY p.category
                ) Q ON c.id = Q.category
                ORDER BY total DESC
                LIMIT 1";

        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $Arr = array("categoryname" => $result['categoryname'], "total" => $result['total']);
        return $Arr;
    }
    
    private function Getmaxviewproduct() {
        $sql = "SELECT p.product_name,IFNULL(COUNT(*),0) AS total
                FROM viewproduct v INNER JOIN product p ON v.product_id = p.product_id
                GROUP BY p.product_id
                ORDER BY total DESC 
                LIMIT 1";

        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $Arr = array("productname" => $result['product_name'], "total" => $result['total']);
        return $Arr;
    }
    
    

    private function Getviewcategory() {
        $sql = "SELECT c.categoryname,IFNULL(Q.total,0) AS total
                FROM category c
                LEFT JOIN(
                SELECT p.category,IFNULL(COUNT(*),0) AS total
                FROM viewproduct v INNER JOIN product p ON v.product_id = p.product_id
                GROUP BY p.category
                ) Q ON c.id = Q.category ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $Arr = array();
        $sum = 0;
        foreach ($result as $rs):
            $Arr[] = "['" . $rs['categoryname'] . "'," . $rs['total'] . "]";
            $sum = $sum + $rs['total'];
        endforeach;
        $value = implode(",", $Arr);
        $Array = array("value" => $value, "sum" => $sum);
        return $Array;
    }

    private function actionGetviewmonth($month) {
        $sql = "SELECT p.product_name,COUNT(*) as total
                FROM viewproduct v inner join product p ON v.product_id = p.product_id
                WHERE MONTH(v.dupdate) = '$month'
                GROUP BY v.product_id
                ORDER BY total DESC 
                LIMIT 1";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        $Arr = array("product_name" => $rs['product_name'], "total" => $rs['total']);
        return $Arr;
    }

    private function GetviewBrand() {
        $sql = "SELECT c.brandname,IFNULL(Q.total,0) AS total
                FROM brand c
                LEFT JOIN(
                SELECT p.brand,IFNULL(COUNT(*),0) AS total
                FROM viewproduct v INNER JOIN product p ON v.product_id = p.product_id
                GROUP BY p.brand
                ) Q ON c.id = Q.brand
                ORDER BY total DESC ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $CatArr = array();
        $ValArr = array();
        foreach ($result as $rs):
            $CatArr[] = $rs['brandname'];
            $ValArr[] = $rs['total'];
        endforeach;
        $Cat = "'" . implode("','", $CatArr) . "'";
        $Val = implode(",", $ValArr);
        $Res = array("brancat" => $Cat, "branval" => $Val);
        return $Res;
    }

    public function actionSet_navbar() {
        $navmenu = $_POST['id'];
        Yii::app()->session['navmenu'] = $navmenu;
    }


    function countOrder(){
        $sql = "select count(*) as total from orders ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['total'];
    }

    function countOrderSuccess(){
        $sql = "select count(*) as total from orders where order_confirm = '1' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['total'];
    }

}
