<?php

class UserController extends Controller {

    public $layout = "template_backend";

    public function actionUserall() {
        $use = new User();
        $data['user'] = $use->findAll();

        $this->render("//backend/user/userall", $data);
    }

    public function actionDetail() {
        $use = new User();
        $order = new Orders();
        $config = new Configweb_model();

        $pid = $_GET['pid'];
        $data['user'] = $use->Get_detail($pid);
        $data['order'] = $order->get_order_user($pid);

        //Chart Order Month
        $chart = new Highcharts();
        $Month = $config->MonthShot();
        $categories = implode("','", $Month);
        $order_month = $order->get_order_month($pid);
        foreach ($order_month as $datas):
            $column[] = $datas['PRICE_TOTAL'];
        endforeach;
        $column_value = implode(",", $column);

        $chart->set_id("chart-month");
        $chart->set_type("column");
        $chart->set_title("ข้อมูลการซื้อสินค้าในแต่ละเดือนที่ผ่านมา");
        $year = date("Y");
        $year_now = ($year + 543);
        $chart->set_subtitle("ปี พ.ศ. " . $year_now);
        $chart->set_categories($categories);
        $chart->set_yAxis("จำนวน(บาท)");
        $chart->set_series_name("จำนวน ");
        $chart->set_value($column_value);
        $graph = $chart->Bar_chart();
        $data['chartmonth'] = $graph;

        //Chart Order Month Visit
        $chart_visit = new Highcharts();
        $order_month_vidit = $order->get_order_month_visit($pid);
        foreach ($order_month_vidit as $datavisit):
            $column_visit[] = $datavisit['TOTAL'];
        endforeach;
        $column_visit_value = implode(",", $column_visit);

        $chart_visit->set_id("chart-month-visit");
        $chart_visit->set_type("bar");
        $chart_visit->set_title("ข้อมูลการซื้อสินค้าในแต่ละเดือนที่ผ่านมา(ครั้ง)");
        $chart_visit->set_subtitle("ปี พ.ศ. " . $year_now);
        $chart_visit->set_categories($categories);
        $chart_visit->set_yAxis("จำนวน(ครั้ง)");
        $chart_visit->set_series_name("จำนวน ");
        $chart_visit->set_value($column_visit_value);
        $data['chartvisit'] = $chart_visit->chart_spline();

        //Chart Order type
        $type_model = new Type_product();
        $type = $type_model->Get_all();
        foreach ($type as $Ptype):
            $Ptype_arr[] = $Ptype['type_name'];
        endforeach;
        $categories_type = implode("','", $Ptype_arr);
        $data['categories_type'] = $categories_type;
        $chart_type = new Highcharts();
        $order_type = $order->get_order_type($pid);
        foreach ($order_type as $rs_type):
            $column_type[] = $rs_type['TOTAL'];
        endforeach;
        $column_type_value = implode(",", $column_type);

        $chart_type->set_id("chart-type");
        //$chart_type->set_type("bar");
        $chart_type->set_color("#ffff00");
        $chart_type->set_title("ข้อมูลการซื้อสินค้าแต่ละประเภท");
        $chart_type->set_subtitle("ปี พ.ศ. " . $year_now);
        $chart_type->set_categories($categories_type);
        $chart_type->set_yAxis("จำนวน(บาท)");
        $chart_type->set_series_name("ประเภท ");
        $chart_type->set_value($column_type_value);
        $data['charttype'] = $chart_type->chart_spline();

        $this->render("//backend/user/detail", $data);
    }

}
