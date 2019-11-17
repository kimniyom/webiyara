<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property string $title
 * @property string $detail
 * @property string $images
 * @property string $owner
 * @property integer $category
 * @property string $create_date
 */
class Article {

    function Get_article_all() {
        $sql = "select a.*,m.name,m.lname,c.category as category_name
                from article a inner join masuser m on a.owner = m.id 
                inner join articlecategory c on a.category = c.id
                order by a.id desc";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function Get_article_limit($limit = null) {
        $result = Yii::app()->db->createCommand()
                ->select("a.*,m.name,m.lname")
                ->from("article a")
                ->join("masuser m", "a.owner = m.id")
                ->order("a.id DESC")
                ->limit("$limit")
                ->queryAll();
        return $result;
    }

    function Get_article_by_id($id = null) {
        /*
          $result = Yii::app()->db->createCommand()
          ->select("a.*,m.name,m.lname")
          ->from("article a")
          ->join("masuser m","a.owner = m.id")
          ->where("a.id = '$id' ")
          ->queryRow();
         * 
         */
        $sql = "select a.*,m.name,m.lname,c.category as category_name from article a inner join masuser m on a.owner = m.id inner join articlecategory c on a.category = c.id where a.id = '$id' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function Count() {
        $query = "SELECT COUNT(*) AS TOTAL FROM article";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['TOTAL'];
    }

    function getArticleByCategory($category) {
        $sql = "select a.*,m.name,m.lname,c.category as category_name
                from article a inner join masuser m on a.owner = m.id 
                inner join articlecategory c on a.category = c.id
                where a.category = '$category' order by a.id desc";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function CountArticleByCategory($category) {
        $sql = "select COUNT(*) as total from article where category = '$category' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['total'];
    }

    function Getpopulation($limit) {
        $sql = "SELECT a.*
                FROM article a 
                ORDER BY a.countread DESC 
                LIMIT $limit";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

}
