<?php

class OrdersController extends Controller {

    public $layout = "template_backend";

    public function actionIndex(){
        $this->render('history');
    }

    public function actionGet_list_basket() {
        $order_id = $_POST['order_id'];
        $order = new Orders();
        $data['basket'] = $order->_get_list_order($order_id);

        $this->renderPartial('//backend/order/basket', $data);
    }

    //รายการรอการตรวจสอบ
    public function actionVerify() {
        $order = new Backend_orders();
        //$transport = new Transport();
        $data['order'] = $order->get_order_verify();
        $this->render('//backend/order/verify', $data);
    }

    //ดึงข้อมูลสินค้าในแต่ละการสั่งซื้อมาแสดง
    public function actionGet_detail_order() {
        $order_id = $_POST['order_id'];
        $order = new Backend_orders();
        $data['basket'] = $order->_get_list_order($order_id);
        $data['order'] = $order->get_detail_order($order_id);

        $this->renderPartial('//backend/order/detail', $data);
    }

    public function actionPendingshipment() {
        $order = new Backend_orders();
        $product_model = new Product();
        $data['product_model'] = $product_model;
        $data['order_model'] = $order;
        $data['order'] = $order->get_pending_shipment();
        $this->render('//backend/order/pending_shipment', $data);
    }

    public function actionPrint_address() {
        $order_id = $_GET['order_id'];
        $order = new Backend_orders();
        if ($order_id != 0 && $order_id != '') {
            $data['rs'] = $order->print_address($order_id);
            $page = "printaddress";
        } else {
            $data['result'] = $order->print_address_all();
            $page = "printaddress_all";
        }


        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('th', 'A4');

        $mPDF1->SetDisplayMode('fullpage');
        # render (full page)
        $mPDF1->WriteHTML($this->renderPartial('//backend/order/' . $page, $data, true));

        # Load a stylesheet
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML('', 1);

        # Outputs ready PDF
        $mPDF1->Output();


        //$this->renderPartial('//backend/order/printaddress', $data);
    }

    public function actionPrint() {
        echo "kimniyom";
    }

    //Confirem Order //ตรวจสอบยอดเงินสำเร็จ
    public function actionConfirm_order() {
        $order_id = $_POST['order_id'];
        $columns = array(
            "active" => "3"
        );

        Yii::app()->db->createCommand()
                ->update("orders", $columns, "order_id = '$order_id' ");
    }

    //บรรจุของพร้อมนำไปส่งให้ลูกค้า
    public function actionPacks_product() {
        $order_id = $_POST['order_id'];
        $columns = array(
            "active" => "4"
        );

        Yii::app()->db->createCommand()
                ->update("orders", $columns, "order_id = '$order_id' ");
    }

    //แจ้งหมายเลขพัสดุ
    public function actionNotification() {
        $order = new Backend_orders();
        $data['order'] = $order->list_order_inform();

        $this->render('//backend/order/notification', $data);
    }

    public function actionView_order() {
        $order_id = $_POST['order_id'];
        $order = new Backend_orders();
        $data['basket'] = $order->_get_list_order($order_id);
        $data['order'] = $order->get_detail_order($order_id);

        $this->renderPartial('//backend/order/view_order', $data);
    }

    //แจ้งรหัสพัสดุ
    public function actionOrder_success() {
        $order_id = $_POST['order_id'];
        $columns = array(
            "postcode" => $_POST['post'],
            "active" => "5",
            "date_send" => date("Y-m-d")
        );

        Yii::app()->db->createCommand()
                ->update("orders", $columns, "order_id = '$order_id' ");
    }

    //ตรวจสอบข้อมูลก่อนลบถ้ามีสินค้านี้ในการสั่งซื้อจะไม่สามารถลบได้
    public function actionProduct_in_order() {
        $order = new Backend_orders();
        $product_id = $_POST['product_id'];
        $status = $order->check_product_in_order($product_id);
        if ($status != 0) {
            echo "1"; //NoDelete
        } else {
            $columns = array("delete_flag" => '1');
            Yii::app()->db->createCommand()
                    ->update("product", $columns, "product_id = '$product_id' ");
        }
    }

    public function actionOrders() {
        $sql = "select * from orders where order_confirm = '0' order by id asc";
        $data['order'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render("orders", $data);
    }

    public function actionConfirmorder() {

        $orderId = Yii::app()->request->getPost('order_id');
        $columns = array(
            "order_confirm" => "1",
            "order_confirm_date" => date("Y-m-d H:i:s"),
            "admin_id" => Yii::app()->user->id
        );

        Yii::app()->db->createCommand()
                ->update("orders", $columns, "id='$orderId'");
        
        $columnsLog = array(
            "admin_id" => Yii::app()->user->id,
            "log" => "user ID " . Yii::app()->user->id . " Confirm Order " . $orderId,
            "order_id" => $orderId,
            "date" => date("Y-m-d H:i:s")
        );
        
        Yii::app()->db->createCommand()
                ->insert("logorders", $columnsLog);
    }

    public function actionDeleteorder() {
        $orderId = Yii::app()->request->getPost('order_id');
        $columns = array("order_confirm" => "3");

        Yii::app()->db->createCommand()
                ->update("orders", $columns, "id='$orderId'");

        $columnsLog = array(
            "admin_id" => Yii::app()->user->id,
            "log" => "user ID " . Yii::app()->user->id . " Delete Order " . $orderId,
            "order_id" => $orderId,
            "date" => date("Y-m-d H:i:s")
        );
        
        Yii::app()->db->createCommand()
                ->insert("logorders", $columnsLog);
    }

    public function actionGethistory(){
        $status = Yii::app()->request->getPost('status');
        $datestart = Yii::app()->request->getPost('datestart');
        $dateend = Yii::app()->request->getPost('dateend');


        $YearS = (substr($datestart,-4) - 543);
        $MonthS = (substr($datestart,3,2));
        $DayS = (substr($datestart,0,2));
        $datestarts = $YearS."-".$MonthS."-".$DayS;
       
        $YearE = (substr($dateend,-4) - 543);
        $MonthE = (substr($dateend,3,2));
        $DayE = (substr($dateend,0,2));
        $dateends = $YearE."-".$MonthE."-".$DayE;
        
        if($status != ""){
            $where = " AND o.order_confirm = '$status'";
        } else {
            $where = "";
        }

        $sql = "SELECT o.id,o.order_fullname,
                SUM(d.order_detail_quantity) AS number,
                SUM((d.order_detail_price * d.order_detail_quantity)) AS total,
                o.order_email,
                o.order_address,
                o.order_phone,
                o.order_confirm,
                o.order_date
                FROM orders o INNER JOIN order_details d ON o.id = d.order_id
                WHERE LEFT(o.order_date,10) BETWEEN '$datestarts' AND '$dateends' $where
                GROUP BY o.id 
                ORDER BY o.order_date ASC";

        $data['orderlist'] = Yii::app()->db->createCommand($sql)->queryAll();

        $data['status'] = $status;
        $data['datestart'] = $datestarts;
        $data['dateend'] = $dateends;

        $this->renderPartial("listorder",$data);
    }

    public function actionView($id = ""){
        $order = new Orders();
        $data['order'] = $order->GetDetailOrder($id);
        $data['orderList'] = $order->GetListOrder($id);
        $this->render("view",$data);
    }

     public function actionExcelorder($id = ""){
        $order = new Orders();
        $data['order'] = $order->GetDetailOrder($id);
        $data['orderList'] = $order->GetListOrder($id);
        $this->renderPartial("excelorder",$data);
    }

    public function actionExcelorderall($status,$datestart,$dateend){
    
        
        if($status != ""){
            $where = " AND o.order_confirm = '$status'";
        } else {
            $where = "";
        }

        $sql = "SELECT o.id,o.order_fullname,
                SUM(d.order_detail_quantity) AS number,
                SUM((d.order_detail_price * d.order_detail_quantity)) AS total,
                o.order_email,
                o.order_address,
                o.order_phone,
                o.order_confirm,
                o.order_date
                FROM orders o INNER JOIN order_details d ON o.id = d.order_id
                WHERE LEFT(o.order_date,10) BETWEEN '$datestart' AND '$dateend' $where
                GROUP BY o.id 
                ORDER BY o.order_date ASC";

        $data['orderlist'] = Yii::app()->db->createCommand($sql)->queryAll();

        $data['datestart'] = $datestart;
        $data['dateend'] = $dateend;

        $this->renderPartial("excelorderall",$data);
    }

}
