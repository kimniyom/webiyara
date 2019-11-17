<?php

class ReportController extends Controller {
    public $layout = "template_backend";

    public function actionDashboard($year = ""){
    	$data['year'] = $year;
    	$DashboardModel = new Dashboard();
		$data['income'] = $DashboardModel->GetIncome($data['year']);
		$data['productbaseyear'] = $DashboardModel->CountProductBaseYear($data['year']);
		$data['chartcountproductinyear'] = $this->CountProductMonthInyear($year);
    	return $this->render("dashboard",$data);
    }


    public function CountProductMonthInyear($year){
    	$DashboardModel = new Dashboard();
    	$result = $DashboardModel->CountProductMonthInYear($year);
    	$Category = array();
    	$Value = array();
    	foreach($result as $rs):
    		$Category[] = "'".$rs['month_th']."'";
    		$Value[] = $rs['total'];
    	endforeach;

    	$cat = implode(",", $Category);
    	$val = implode(",",$Value);

    	$data = array("cat" => $cat,"val" => $val);

    	return $data;
    }

    public function actionIncome($year = ""){
    	$data['year'] = $year;
    	$DashboardModel = new Dashboard();
		$data['income'] = $DashboardModel->GetIncome($data['year']);
		$data['chartcountproductinyear'] = $this->ChartIncomeInYear($year);
		$data['chartincomecategoryinyear'] = $this->ChartIncomeCategoryInYear($year);
    	return $this->render("income",$data);
    }

    public function ChartIncomeInYear($year){
    	$data['year'] = $year;
    	$DashboardModel = new Dashboard();
    	$result = $DashboardModel->SumIncomeMonthInYear($year);
    	$Category = array();
    	$Value = array();
    	foreach($result as $rs):
    		$Category[] = "'".$rs['month_th']."'";
    		$Value[] = $rs['total'];
    		$Month[] = $rs['month_th'];
    	endforeach;

    	$cat = implode(",", $Category);
    	$val = implode(",",$Value);

    	$data = array("cat" => $cat,"val" => $val,"month" => $Month,"total" => $Value);

    	return $data;
    	
    }

    public function ChartIncomeCategoryInYear($year){
    	$data['year'] = $year;
    	$DashboardModel = new Dashboard();
    	$result = $DashboardModel->SumIncomCategoryInYear($year);
    	$Category = array();
    	$Value = array();
    	foreach($result as $rs):
    		$Category[] = "'".$rs['categoryname']."'";
    		$Value[] = $rs['total'];
    	endforeach;

    	$cat = implode(",", $Category);
    	$val = implode(",",$Value);

    	$data = array("cat" => $cat,"val" => $val);

    	return $data;
    	
    }
    
}

