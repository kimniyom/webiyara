<?php

class Backend_article{
    function Get_article_all(){
        $result = Yii::app()->db->createCommand()
                ->select("a.*,m.name,m.lname,c.category as categoryname")
                ->from("article a")
                ->join("masuser m","a.owner = m.id")
                ->join("articlecategory c","a.category = c.id")
                ->order("a.id DESC")
                ->queryAll();
        return $result;  
    }
    
    function Get_article_limit($limit){
        $result = Yii::app()->db->createCommand()
                ->select("a.*,m.name,m.lname,c.category as categoryname")
                ->from("article a")
                ->join("masuser m","a.owner = m.id")
                ->join("articlecategory c","a.category = c.id")
                ->order("a.id DESC")
                ->limit("$limit")
                ->queryAll();
        return $result;  
    }
    
    function Get_article_by_id($id){
        $result = Yii::app()->db->createCommand()
                ->select("a.*,m.name,m.lname,c.category as categoryname")
                ->from("article a")
                ->join("masuser m","a.owner = m.id")
                ->join("articlecategory c","a.category = c.id")
                ->where("a.id = '$id' ")
                ->queryRow();
        return $result;    
    }

    function GetArticleByCategory($categoryID){
        $sql = "select a.*,m.name,m.lname,c.category as categoryname
            from article a 
            inner join masuser m on a.owner = m.id 
            inner join articlecategory c on a.category = c.id
            where a.category = '$categoryID' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function CountArticleByCategory($categoryID){
        $sql = "select COUNT(*) AS total from article where category = '$categoryID'";
        $data = Yii::app()->db->createCommand($sql)->queryRow();
        return $data['total'];
    }
}

