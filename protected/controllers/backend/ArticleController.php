<?php

class ArticleController extends Controller {

    public $layout = "template_backend";

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'index', 'create', 'update', 'checkproduct', 'delet', 'view', 'delete',
                    'save', 'upload', 'save_update', 'getgallery', 'gallery', 'deletegallery'
                ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex($category = "") {
        $art = new Backend_article();
        $data['categorylist'] = Articlecategory::model()->findAll("active=:active",array(":active" => 1));
        $data['category'] = $category;

        if($category == ""){
            $data['article'] = $art->Get_article_all();
        } else {
            $data['article'] = $art->GetArticleByCategory($category);
        }
        

        $this->render("//backend/article/index", $data);
    }

    public function actionCreate() {
        $sql = "SELECT MAX(id) AS id FROM article ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        $data['category'] = Articlecategory::model()->findAll("active=:active", array(":active" => '1'));
        $data['id'] = ($rs['id'] + 1);
        $this->render("//backend/article/create", $data);
    }

    public function actionSave() {
        $columns = array(
            "id" => $_POST['id'],
            "title" => $_POST['title'],
            "detail" => $_POST['msg'],
            "category" => $_POST['category'],
            "owner" => Yii::app()->user->id,
            "create_date" => date("Y-m-d H:i:s")
        );
        Yii::app()->db->createCommand()
                ->insert("article", $columns);
    }

    public function actionUploads($id = null) {

//Check File 
        $art = new Backend_article();
        $rs = $art->Get_article_by_id($id);
        if (!empty($rs['images'])) {
            $filename = './uploads/article/' . $rs['images'];
            if (file_exists($filename)) {
                unlink($filename);
            }
        }

        $targetFolder = Yii::app()->baseUrl . '/uploads/article'; // Relative to the root

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

// Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);

//สั่งอัพเดท
                $columns = array(
                    "images" => $FileName
                );

                Yii::app()->db->createCommand()
                        ->update("article", $columns, "id = '$id' ");
                echo '1';
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

    public function actionUpload($id = null) {
//Check File 
        $art = new Backend_article();
        $rs = $art->Get_article_by_id($id);
        if (!empty($rs['images'])) {
            $filename = './uploads/article/' . $rs['images'];
            if (file_exists($filename)) {
                unlink($filename);
            }

            if (file_exists('./uploads/article/200-' . $rs['images'])) {
                unlink('./uploads/article/200-' . $rs['images']);
            }

            if (file_exists('./uploads/article/600-' . $rs['images'])) {
                unlink('./uploads/article/600-' . $rs['images']);
            }

            if (file_exists('./uploads/article/870-' . $rs['images'])) {
                unlink('./uploads/article/870-' . $rs['images']);
            }
        }

        $targetFolder = Yii::app()->baseUrl . '/uploads/article'; // Relative to the root
        if (!empty($_FILES)) {

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "img_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;


            $fileTypes = array('jpg', 'jpeg', 'JPG', 'JPEG', 'png', 'PNG'); // File extensions
            $JpegType = array('jpg', 'jpeg', 'JPG', 'JPEG');
            $PngType = array('png', 'PNG');
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {

//สั่งอัพเดท
                $columns = array(
                    "images" => $Name
                );

                Yii::app()->db->createCommand()
                        ->update("article", $columns, "id = '$id' ");

                $width = 1280; //*** Fix Width & Heigh (Autu caculate) ***//
//$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
                $size = getimagesize($_FILES['Filedata']['tmp_name']);
                $height = round($width * $size[1] / $size[0]);

                $images_orig = imagecreatefromjpeg($tempFile);

                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);

                $images_fin = imagecreatetruecolor($width, $height);
                imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);

                imagejpeg($images_fin, "uploads/article/" . $Name);

                imagedestroy($images_orig);
                imagedestroy($images_fin);

                $this->Thumbnail($Name, 600, 486);
                $this->Thumbnail($Name, 200, 200);
                $this->Thumbnail($Name, 870, 500);
                $this->Thumbnail($Name, 80, 100);

                /*
                  $this->Thumbnailpng($Name, 600, 486);
                  $this->Thumbnailpng($Name, 200, 200);
                  $this->Thumbnailpng($Name, 870, 500);
                 * */

                echo $id;
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function Thumbnailpng($Name, $width, $height) {
        $image = new ImageResize("uploads/article/" . $Name);
        //$image->quality_jpg = 100;
        //$image->crop($width, $height, $allow_enlarge, $position)
        $image->crop($width, $height, false, ImageResize::CROPCENTER);
        $image->save("uploads/article/" . $width . '-' . $Name, IMAGETYPE_PNG);
    }

    public function Thumbnail($Name, $width, $height) {
        $image = new ImageResize("uploads/article/" . $Name);
        $image->quality_jpg = 100;
        $image->crop($width, $height, true, ImageResize::CROPCENTER);
        $image->save("uploads/article/" . $width . '-' . $Name);
    }

    public function actionUpdate($id = null) {
        $art = new Backend_article();
        $data['rs'] = $art->Get_article_by_id($id);
        $data['category'] = Articlecategory::model()->findAll("active=:active", array(":active" => '1'));
        $data['id'] = $id;
        $this->render("//backend/article/update", $data);
    }

    public function actionSave_update() {
        $id = $_POST['id'];
        $columns = array(
            "title" => $_POST['title'],
            "detail" => $_POST['msg'],
            "category" => $_POST['category'],
            "owner" => Yii::app()->user->id
        );
        Yii::app()->db->createCommand()
                ->update("article", $columns, "id = '$id'");
    }

    public function actionView($id = null) {
//$id = $_GET['id'];
        $article = new Backend_article();
        $data['result'] = $article->Get_article_by_id($id);
        $this->render("//backend/article/view", $data);
    }

    public function actionDelete() {
//Check File 
        $id = $_POST['id'];
        $art = new Backend_article();
        $rs = $art->Get_article_by_id($id);
        $this->Deletegalleryall($id);
        if (!empty($rs['images'])) {
            $filename = './uploads/article/' . $rs['images'];

            if (file_exists($filename)) {
                unlink($filename);
            }

            if (file_exists('./uploads/article/600-' . $rs['images'])) {
                unlink('./uploads/article/600-' . $rs['images']);
            }

            if (file_exists('./uploads/article/870-' . $rs['images'])) {
                unlink('./uploads/article/870-' . $rs['images']);
            }

            if (file_exists('./uploads/article/200-' . $rs['images'])) {
                unlink('./uploads/article/200-' . $rs['images']);
            }
            if (file_exists('./uploads/article/80-' . $rs['images'])) {
                unlink('./uploads/article/80-' . $rs['images']);
            }
        }

        Yii::app()->db->createCommand()
                ->delete("article", "id = '$id' ");
    }

    public function actionGallery($id) {
        $targetFolder = Yii::app()->baseUrl . '/uploads/article/gallery'; // Relative to the root
        if (!empty($_FILES)) {

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "img_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;


            $fileTypes = array('jpg', 'jpeg', 'JPG', 'JPEG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {

//สั่งอัพเดท
                $columns = array(
                    "images" => $Name,
                    "article" => $id
                );

                Yii::app()->db->createCommand()
                        ->insert("articlegallery", $columns);

                $width = 1280; //*** Fix Width & Heigh (Autu caculate) ***//
//$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
                $size = getimagesize($_FILES['Filedata']['tmp_name']);
                $height = round($width * $size[1] / $size[0]);

                $images_orig = imagecreatefromjpeg($tempFile);

                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);

                $images_fin = imagecreatetruecolor($width, $height);
                imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);

                imagejpeg($images_fin, "uploads/article/gallery/" . $Name);

                imagedestroy($images_orig);
                imagedestroy($images_fin);

                $this->ThumbnailGallery($Name, 600, 486);
                $this->ThumbnailGallery($Name, 200, 200);
                $this->ThumbnailGallery($Name, 480, 480);
                $this->ThumbnailGallery($Name, 80, 100);
            }
        }
    }

    public function ThumbnailGallery($Name, $width, $height) {
        $image = new ImageResize("uploads/article/gallery/" . $Name);
        $image->quality_jpg = 100;
        $image->crop($width, $height, true, ImageResize::CROPCENTER);
        $image->save("uploads/article/gallery/" . $width . '-' . $Name);
    }

    public function actionGetgallery() {
        $article = Yii::app()->request->getPost('article');
        $sql = "select * from articlegallery where article = '$article' ";
        $data['gallery'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('gallery', $data);
    }

    public function actionDeletegallery() {
        $id = Yii::app()->request->getPost('id');
        $sql = "select * from articlegallery where id = '$id' ";
        $gallery = Yii::app()->db->createCommand($sql)->queryRow();
        $path = "uploads/article/gallery/";
        if (file_exists($path . $gallery['images'])) {
            unlink($path . $gallery['images']);
        }

        if (file_exists($path . "80-" . $gallery['images'])) {
            unlink($path . "80-" . $gallery['images']);
        }

        if (file_exists($path . "200-" . $gallery['images'])) {
            unlink($path . "200-" . $gallery['images']);
        }

        if (file_exists($path . "480-" . $gallery['images'])) {
            unlink($path . "480-" . $gallery['images']);
        }

        if (file_exists($path . "600-" . $gallery['images'])) {
            unlink($path . "600-" . $gallery['images']);
        }

        Yii::app()->db->createCommand()
                ->delete("articlegallery", "id='$id'");
    }

    private function Deletegalleryall($article) {
        $sql = "select * from articlegallery where article = '$article' ";
        $gallerys = Yii::app()->db->createCommand($sql)->queryAll();
        $path = "uploads/article/gallery/";
        foreach ($gallerys as $gallery):
            if (file_exists($path . $gallery['images'])) {
                unlink($path . $gallery['images']);
            }

            if (file_exists($path . "80-" . $gallery['images'])) {
                unlink($path . "80-" . $gallery['images']);
            }

            if (file_exists($path . "200-" . $gallery['images'])) {
                unlink($path . "200-" . $gallery['images']);
            }

            if (file_exists($path . "480-" . $gallery['images'])) {
                unlink($path . "480-" . $gallery['images']);
            }

            if (file_exists($path . "600-" . $gallery['images'])) {
                unlink($path . "600-" . $gallery['images']);
            }

        endforeach;

        Yii::app()->db->createCommand()
                ->delete("articlegallery", "article='$article'");
    }

}
