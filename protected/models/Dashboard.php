<?php 
class Dashboard {
	function GetIncome($year = ""){
		if($year != ""){
			$sql = "SELECT IFNULL(SUM((d.order_detail_price * order_detail_quantity)),0) as producttotal
					FROM orders o INNER JOIN order_details d ON o.id = d.order_id
					WHERE o.order_confirm = '1' AND LEFT(o.order_date,4) = '$year' ";
		} else {
			$sql = "SELECT IFNULL(SUM((d.order_detail_price * order_detail_quantity)),0) as producttotal
					FROM orders o INNER JOIN order_details d ON o.id = d.order_id
					WHERE o.order_confirm = '1'";
		}

		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		return $rs['producttotal'];
	}

	//สินค้าซื้อมากในปี
    function CountProductBaseYear($year = ""){
    	if($year != ""){
    		$where = "AND LEFT(o.order_confirm_date,4) = '$year'";
    	} else {
			$where = "";
    	}
    	$sql = "SELECT d.product_id,p.product_name,SUM(d.order_detail_quantity) AS total
				FROM orders o INNER JOIN order_details d ON o.id = d.order_id
				INNER JOIN product p ON d.product_id = p.product_id
				WHERE o.order_confirm = '1' $where
				GROUP BY d.product_id 
				ORDER BY total DESC
				LIMIT 1";
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		return $rs;
    }

    //จำนวนสินค้าที่ขายแต่ละเดือน
    function CountProductMonthInYear($year = ""){
    	if($year != ""){
    		$years = $year;
    	} else {
    		$years = date("Y");
    	}
    	$sql = "SELECT m.month_th,IFNULL(Q.total,0) AS total
				FROM `month` m
				LEFT JOIN (
				SELECT SUBSTR(o.order_confirm_date,6,2) AS month,SUM(d.order_detail_quantity) AS total
				FROM orders o INNER JOIN order_details d ON o.id = d.order_id
				WHERE o.order_confirm = '1' AND LEFT(o.order_confirm_date,4) = '$years'
				GROUP BY SUBSTR(o.order_confirm_date,6,2)
				) AS Q ON m.id = Q.month
				ORDER BY m.id ASC ";
		return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function SumIncomeMonthInYear($year = ""){
    	if($year != ""){
    		$years = $year;
    	} else {
    		$years = date("Y");
    	}
    	$sql = "SELECT m.month_th,IFNULL(Q.total,0) as total
				FROM `month` m 
				LEFT JOIN 
				(
					SELECT SUBSTR(o.order_confirm_date,6,2) as month,SUM((d.order_detail_price * d.order_detail_quantity)) AS total
					FROM orders o INNER JOIN order_details d ON o.id = d.order_id
					WHERE o.order_confirm = '1' AND LEFT(o.order_confirm_date,4) = '$years' 
					GROUP BY SUBSTR(o.order_confirm_date,6,2)
				) Q ON m.id = Q.month ";
		return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function SumIncomCategoryInYear($year = ""){
    	if($year != ""){
    		$where = "AND LEFT(o.order_confirm_date,4) = '$year'";
    	} else {
			$where = "";
    	}
    	$sql = "SELECT c.categoryname,IFNULL(Q.total,0) as total
				FROM category c
				LEFT JOIN (
					SELECT p.product_id,p.category,SUM((d.order_detail_price * d.order_detail_quantity)) AS total
					FROM orders o INNER JOIN order_details d ON o.id = d.order_id
					INNER JOIN product p ON d.product_id = p.product_id
					WHERE o.order_confirm = '1' $where 
					GROUP BY p.category
				) Q ON c.id = Q.category ";
		return Yii::app()->db->createCommand($sql)->queryAll();
    }
}
?>