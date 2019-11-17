<?php

class Report {
    function ReadProduct(){
        $sql = "select * from product order by countread desc";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }
}

