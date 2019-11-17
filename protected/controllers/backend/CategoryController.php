<?php

class CategoryController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'checkproduct', 'delet'),
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

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Category;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            /* อัพโหลดไฟล์ */
            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'icons');
            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            //$model->icons = $fileName;

            if (is_object($uploadedFile) && get_class($uploadedFile) === 'CUploadedFile') {
                $uploadedFile->saveAs(Yii::app()->basePath . '/../uploads/category/' . $fileName);

                $image = new ImageResize("uploads/category/" . $fileName);
                $image->quality_jpg = 100;
                $image->crop(400, 400, true, ImageResize::CROPCENTER);
                $image->save("uploads/category/thumbnail/" . $fileName);
                $model->icons = $fileName; // บันทึกชื่อไฟล์ลงตารางฐานข้อมูล
            }

            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];

            /* อัพโหลดไฟล์ */
            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'icons');
            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            //$model->icons = $fileName;

            if (is_object($uploadedFile) && get_class($uploadedFile) === 'CUploadedFile') {
                if (file_exists(Yii::app()->basePath . '/../uploads/category/' . $model->icons)) {
                    unlink(Yii::app()->basePath . '/../uploads/category/' . $model->icons);
                }

                if (file_exists(Yii::app()->basePath . '/../uploads/category/thumbnail/' . $model->icons)) {
                    unlink(Yii::app()->basePath . '/../uploads/category/thumbnail/' . $model->icons);
                }

                $uploadedFile->saveAs(Yii::app()->basePath . '/../uploads/category/' . $fileName);

                $image = new ImageResize("uploads/category/" . $fileName);
                $image->quality_jpg = 100;
                $image->crop(400, 400, true, ImageResize::CROPCENTER);
                $image->save("uploads/category/thumbnail/" . $fileName);

                $model->icons = $fileName; // บันทึกชื่อไฟล์ลงตารางฐานข้อมูล
            }

            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    /*
      public function actionDelete($id) {
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
      }
     * 
     */

    /**
     * Lists all models.
     */
    public function actionDelete() {
        $categoryID = Yii::app()->request->getPost('categoryID');
        $cateResult = Category::model()->find("id=:id", array(":id" => $categoryID));
        $img = $cateResult['icons'];
        if (file_exists(Yii::app()->basePath . '/../uploads/category/' . $img)) {
            unlink(Yii::app()->basePath . '/../uploads/category/' . $img);
        }

        if (file_exists(Yii::app()->basePath . '/../uploads/category/thumbnail/' . $img)) {
            unlink(Yii::app()->basePath . '/../uploads/category/thumbnail/' . $img);
        }

        Yii::app()->db->createCommand()
                ->delete("category", "id='$categoryID'");

        Yii::app()->db->createCommand()
                ->delete("product_type", "category='$categoryID'");
    }

    public function actionIndex() {
        $this->redirect(array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $data['category'] = Category::model()->findAll();
        $this->render('admin', $data);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCheckproduct() {
        $categoryID = Yii::app()->request->getPost('categoryID');
        $rs = Yii::app()->db->createCommand("select * from product where category = '$categoryID'")->queryAll();
        $count = count($rs);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
