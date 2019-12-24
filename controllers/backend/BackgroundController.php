<?php

class BackgroundController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $sql = "select * from background";
        $data['background'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render('//backend/background/index', $data);
    }

    public function actionSaveupload() {
        // Define a destination
        $targetFolder = Yii::app()->baseUrl . '/uploads/background'; // Relative to the root

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

            // Validate the file type
            $fileTypes = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            $image_info = getimagesize($_FILES["Filedata"]["tmp_name"]);
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);

                //insert
                $columns = array(
                    "background" => $FileName,
                    "active" => '0'
                );

                Yii::app()->db->createCommand()
                        ->insert("background", $columns);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionSet_active() {
        $id = Yii::app()->request->getPost('id');
        //Clean
        $columns_clean = array(
            "active" => '0',
        );
        Yii::app()->db->createCommand()
                ->update("background", $columns_clean, "1 = 1");

        $columns = array(
            "active" => '1'
        );
        Yii::app()->db->createCommand()
                ->update("background", $columns, "id = '$id' ");
    }

    public function actionDelete() {
        $id = Yii::app()->request->getPost('id');
        $sql = "select * from background where id = '$id' and id != '1'";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        $images = $rs['background'];
        if (isset($images)) {
            $filename = './uploads/background/' . $images;

            if (file_exists($filename)) {
                unlink($filename);
            }
        }

        Yii::app()->db->createCommand()
                ->delete('background', "id = '$id' ");
    }

    public function actionSetoption() {
        $option = Yii::app()->request->getPost('option');
        $columns = array("option" => $option);
        Yii::app()->db->createCommand()
                ->update("backgroundoption", $columns, "id = '1'");
    }

}
