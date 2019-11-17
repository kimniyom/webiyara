<?php

class BannerController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $banner = new Backend_banner();
        $data['banner'] = $banner->get_banner();
        $result = Yii::app()->db->createCommand("select max(banner_id) as id from banner")->queryRow();
        $data['id'] = $result['id'] + 1;
        $this->render('//backend/banner/index', $data);
    }

    public function actionLoadbanner() {
        $banner = new Backend_banner();
        $data['banner'] = $banner->get_banner();
        $this->renderPartial('//backend/banner/banner', $data);
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

    public function actionSaveupload() {
        // Define a destination
        $targetFolder = Yii::app()->baseUrl . '/uploads/banner'; // Relative to the root

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);

                //สั่งอัพเดท
                $columns = array(
                    "banner_images" => $FileName
                );

                Yii::app()->db->createCommand()
                        ->insert("banner", $columns);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionSave() {
        $link = Yii::app()->request->getPost('link');
        $detail = Yii::app()->request->getPost('detail');
        $color = Yii::app()->request->getPost('color');
        $title = Yii::app()->request->getPost('title');
        $id = Yii::app()->request->getPost('id');
        $columns = array(
            "title" => $title,
            "link" => $link,
            "detail" => $detail,
            "color" => $color
        );

        Yii::app()->db->createCommand()
                ->insert("banner", $columns);

        echo "1";
    }

    public function actionUploadify() {
        $id = $_GET['id'];

        $targetFolder = Yii::app()->baseUrl . '/uploads/banner'; // Relative to the root
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/banner-' . $Name;

            $fileTypes = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png'); // File extensions

            $fileParts = pathinfo($_FILES['Filedata']['name']);

            
            //if (in_array($fileParts['extension'], $fileTypes)) {
            if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
                $width = 1900; //*** Fix Width & Heigh (Autu caculate) ***//
                //$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
                $size = getimagesize($_FILES['Filedata']['tmp_name']);
                $height = round($width * $size[1] / $size[0]);
                $images_orig = imagecreatefromjpeg($tempFile);
                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);

                if ($photoX == "1900" && $photoY == "900") {
                    move_uploaded_file($tempFile, $targetFile);
                    $this->Thumbnail($Name, 300);
                } else {
                    $images_fin = imagecreatetruecolor($width, $height);
                    imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                    imagejpeg($images_fin, "uploads/banner/" . $Name);
                    imagedestroy($images_orig);
                    imagedestroy($images_fin);
                    $image = new ImageResize("uploads/banner/" . $Name);
                    $image->quality_jpg = 100;
                    $image->crop("1900", "900", true, ImageResize::CROPCENTER);
                    $image->save("uploads/banner/" . 'banner-' . $Name);
                    $this->Thumbnail($Name, 300);
                    if (file_exists("uploads/banner/" . $Name)) {
                        unlink("uploads/banner/" . $Name);
                    }
                }
                //สั่งอัพเดท
                $columns = array(
                    "banner_images" => "banner-" . $Name
                );
               
                Yii::app()->db->createCommand()->update("banner", $columns, "banner_id = '$id' ");

                echo '1';
            }
        } else {
            echo 'Invalid file type.';
        }
    }

    public function Thumbnail($Name, $width) {
        $image = new ImageResize("uploads/banner/banner-" . $Name);
        $image->quality_jpg = 100;
        $image->resizeToWidth($width);
        //$image->crop($width, $width, true, ImageResize::CROPCENTER);
        $image->save("uploads/banner/thumbnail/" . 'banner-' . $Name);
    }

    public function actionSet_active() {
        $banner_id = $_POST['banner_id'];
        $status = $_POST['status'];

        $columns = array("status" => $status);

        Yii::app()->db->createCommand()
                ->update("banner", $columns, "banner_id = '$banner_id' ");
    }

    public function actionDelete() {
        $banner_id = $_POST['banner_id'];
        $model = new Backend_banner();
        $rs = $model->get_banner_by_id($banner_id);
        $images = $rs['banner_images'];
        if (isset($images)) {
            $filename = './uploads/banner/' . $images;

            if (file_exists($filename)) {
                unlink($filename);
            }

            if (file_exists('./uploads/banner/thumbnail/' . $images)) {
                unlink('./uploads/banner/thumbnail/' . $images);
            }
        }

        Yii::app()->db->createCommand()
                ->delete('banner', "banner_id = '$banner_id' ");
    }

}
