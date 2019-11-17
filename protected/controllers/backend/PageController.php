<?php

class PageController extends Controller {

    public $layout = "template_backend";

    public function actionIndex($product = "0") {
        $data['layout'] = $this->getLayout($product);
        $data['pageid'] = $product;
        $this->render('index', $data);
    }

    public function getLayout($product) {
        $sql = "select l.pageid, l.row_id,y.`columns`,y.classname
                    from layoutcontent l INNER JOIN layout y ON l.layout = y.id
                    WHERE l.pageid = '$product'
                    GROUP BY row_id";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function actionCreate($type, $seq) {
        $data['type'] = $type;
        $data['seq'] = $seq;
        $data['articlelist'] = Yii::app()->db->createCommand("select * from article order by id desc")->queryAll();
        $this->render("create", $data);
    }

    public function actionSave() {
        $article = Yii::app()->request->getPost('article');
        $type = Yii::app()->request->getPost('type');
        $seq = Yii::app()->request->getPost('seq');
        $columns = array(
            "code" => $article,
            "type" => $type,
            "seq" => $seq
        );

        $sql = "select * from page where type = '$type' and seq = '$seq'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if ($result['id'] != "") {
            $id = $result['id'];
            Yii::app()->db->createCommand()
                    ->update("page", $columns, "id='$id'");
        } else {
            Yii::app()->db->createCommand()
                    ->insert("page", $columns);
        }
    }

    public function actionAddrow() {
        $row = Yii::app()->request->getPost('row');
        $pageid = Yii::app()->request->getPost('pageid');
        $layout = Yii::app()->request->getPost('layout');
        if ($layout > 1) {
            for ($i = 1; $i <= $layout; $i++):
                $columns = array(
                    "row_id" => $row,
                    "pageid" => $pageid,
                    "columns_id" => $i,
                    "layout" => $layout
                );

                Yii::app()->db->createCommand()
                        ->insert("layoutcontent", $columns);
            endfor;
        } else {
            $columns = array(
                "row_id" => $row,
                "pageid" => $pageid,
                "columns_id" => 1,
                "layout" => $layout
            );

            Yii::app()->db->createCommand()
                    ->insert("layoutcontent", $columns);
        }
    }

    public function actionAddcontent() {
        $id = Yii::app()->request->getPost('id');
        $content = Yii::app()->request->getPost('content');

        $columns = array(
            "content" => $content
        );

        Yii::app()->db->createCommand()
                ->update("layoutcontent", $columns, "id = '$id'");
    }

    public function actionAddlink() {
        $id = Yii::app()->request->getPost('id');
        $link = Yii::app()->request->getPost('link');
        $linktext = Yii::app()->request->getPost('linktext');
        $columns = array(
            "link" => $link,
            "linktext" => $linktext
        );

        Yii::app()->db->createCommand()
                ->update("layoutcontent", $columns, "id = '$id'");
    }

    public function actionGetrow() {
        $id = Yii::app()->request->getPost('id');
        $sql = "select * from layoutcontent where id = '$id' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        echo json_encode($rs);
    }

    public function actionUploadify() {
        /*
          Uploadify
          Copyright (c) 2012 Reactive Apps, Ronnie Garcia
          Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
         */
        //Define a destination

        $targetFolder = Yii::app()->baseUrl . '/uploads/page'; // Relative to the root
        $id = Yii::app()->request->getPost('id');
        $sql = "select * from layoutcontent where id = '$id'";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        if ($rs['images']) {
            if (file_exists($targetFolder . "/" . $rs['images'])) {
                unlink("./uploads/page/" . $rs['images']);
            }
        }
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "img_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

            //$targetFile = $targetFolder . '/' . $_FILES['Filedata']['name'];
            //$targetFile = $targetFolder . '/' . $Name;
            //Validate the file type
            $fileTypes = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            //$GalleryShot = $_FILES['Filedata']['name'];

            /*
              $tempFile = $_FILES['Filedata']['tmp_name'];
              $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
              $targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];

              // Validate the file type
              $fileTypes = array('rar', 'pdf', 'zip'); // File extensions
              $fileParts = pathinfo($_FILES['Filedata']['name']);
             */

            if (in_array($fileParts['extension'], $fileTypes)) {
                $columns = array(
                    'images' => $Name
                );
                Yii::app()->db->createCommand()
                        ->update("layoutcontent", $columns, "id = '$id'");

                move_uploaded_file($tempFile, $targetFile); //เก่า
                echo 1;
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    function Randstrgen() {
        $len = 30;
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function actionDeleterow() {
        $rowid = Yii::app()->request->getPost('rowid');
        $pageid = Yii::app()->request->getPost('pageid');
        $sql = "select * from layoutcontent where pageid = '$pageid' and row_id = '$rowid'";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $targetFolder = Yii::app()->baseUrl . '/uploads/page';
        foreach ($result as $rs):
            if ($rs['images']) {
                if (file_exists("./uploads/page/" . $rs['images'])) {
                    unlink("./uploads/page/" . $rs['images']);
                }
            }
        endforeach;

        Yii::app()->db->createCommand()
                ->delete("layoutcontent", "pageid = '$pageid' and row_id = '$rowid' ");
    }

}
