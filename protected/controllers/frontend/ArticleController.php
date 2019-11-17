<?php

class ArticleController extends Controller {

    public $layout = "iyara";

    //public $layout = "template_product";
    public function actionIndex($category = null) {
        $Art = new Article();
        if ($category) {
            $data['category'] = $category;
            $data['count'] = $Art->CountArticleByCategory($category);
            $data['article'] = $Art->getArticleByCategory($category);
        } else {
            $data['category'] = "";
            $data['count'] = $Art->Count();
            $data['article'] = $Art->Get_article_all();
        }

        $sql = "select * from article order by id desc limit 3";
        $data['lastblog'] = Yii::app()->db->createCommand($sql)->queryAll();

        $data['categoryList'] = Articlecategory::model()->findAll('active=:active',array(':active' => 1));

        $this->render("//article/article_all", $data);
    }

    public function actionPages() {
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        $category = $_POST['category'];
        $item_per_page = 12; //ให้แสดงที่ละ
        //throw HTTP error if page number is not valid
        if (!is_numeric($page_number)) {
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }

        //get current starting point of records
        $position = ($page_number * $item_per_page);

        //Limit our results within a specified range.
        //$results = mysqli_query($connecDB, "SELECT id,name,message FROM paginate ORDER BY id DESC LIMIT $position, $item_per_page");
        if ($category) {
            $query = "select a.*,m.name,m.lname,c.category as category_name
                from article a inner join masuser m on a.owner = m.id 
                inner join articlecategory c on a.category = c.id
                where a.category = '$category'
                order by a.id desc LIMIT $position, $item_per_page";
        } else {
            $query = "select a.*,m.name,m.lname,c.category as category_name
                from article a inner join masuser m on a.owner = m.id 
                inner join articlecategory c on a.category = c.id
                order by a.id desc LIMIT $position, $item_per_page";
        }
        $rs = Yii::app()->db->createCommand($query)->queryAll();
        //output results from database
        /*
          echo '<ul class="page_result">';
          foreach ($rs as $row) {
          echo '<li id="item_' . $row["id"] . '"><span class="page_name">' . $row["id"] . ') ' . $row["product_name"] . '</span><span class="page_message">' . $row["product_name"] . '</span></li>';
          }
          echo '</ul>';
         *
         */
        $data['article'] = $rs;
        $this->renderPartial("//article/article_more", $data);
    }

    public function actionView() {
        $Art = new Article();
        $config = new Configweb_model();
        $id = $config->url_decode($_GET['id']);
        $data['result'] = $Art->Get_article_by_id($id);
        $this->render("//article/view", $data);
    }

    public function actionViews($id) {
        $Art = new Article();
        $conFig = new Configweb_model();
        $data['result'] = $Art->Get_article_by_id($id);

        $fimg = $data['result']['images'];
        Yii::app()->session['fbtitle'] = $data['result']['title'];
        Yii::app()->session['fbimages'] = $conFig->GetFullLink(Yii::app()->baseUrl . "/uploads/article/600-" . $fimg);
        Yii::app()->session['fburl'] = $conFig->GetFullLink(Yii::app()->createUrl('frontend/article/views', array("id" => $data['result']['id'])));


        Yii::app()->session['fbcaption'] = $data['result']['title'];
        Yii::app()->session['fbdescription'] = $data['result']['title'];

        $this->CountRead($id, $data['result']['countread']);

        $data['category_id'] = $data['result']['category'];
        $data['category'] = Articlecategory::model()->findAll('active=:active',array(':active' => 1));

        $sql = "select * from article order by id desc limit 3";
        $data['lastblog'] = Yii::app()->db->createCommand($sql)->queryAll();

        $sqlnext = "select * from article where id > '$id' limit 1";
        $data['next'] = Yii::app()->db->createCommand($sqlnext)->queryRow();

        $sqlpre = "select * from article where id < '$id' limit 1";
        $data['pre'] = Yii::app()->db->createCommand($sqlpre)->queryRow();

        //near 
        $sqlnear = "SELECT * 
                FROM (
                SELECT *
                FROM article 
                WHERE category = '" . $data['category_id'] . "' AND id != '$id'
        ) Q WHERE RAND() LIMIT 3; ";

        $data['near'] = Yii::app()->db->createCommand($sqlnear)->queryAll();

        $sqlGallery = "select * from articlegallery where article = '$id' ";
        $data['gallery'] = Yii::app()->db->createCommand($sqlGallery)->queryAll();
        $this->render("//article/view", $data);
    }

    private function CountRead($id, $countread) {
        /*
          $sql = "select countread from article where id = '$id'";
          $rs = Yii::app()->db->createCommand($sql)->queryRow();
         * 
         */
        $newsCount = ($countread + 1);
        $columns = array("countread" => $newsCount);
        Yii::app()->db->createCommand()
                ->update("article", $columns, "id='$id'");
    }

}
