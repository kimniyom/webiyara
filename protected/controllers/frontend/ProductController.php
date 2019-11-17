<?php

class ProductController extends Controller {

	public $layout = "iyara";

	//public $layout = "template_product";
	//################# ดึงข้อมูลรานละเอียดสินค้ามาแสดง อ้างจาก product_id ##################//
	public function actionIndex() {
		$prodult = new Product();
		$data['product'] = $prodult->GetProductAll();
		$data['count'] = count($data['product']);
		$data['categorys'] = Category::model()->findAll();
		$data['brands'] = Brand::model()->findAll();
		$this->render("//product/index", $data);
	}

	public function actionPagesall() {
		//$productModel = new Product();
		$category = Yii::app()->request->getPost('category');
		$brand = Yii::app()->request->getPost('brand');
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$item_per_page = 12; //ให้แสดงที่ละ
		//throw HTTP error if page number is not valid
		if (!is_numeric($page_number)) {
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);
		//$rs = $productModel->GetProductAllBetween($position, $item_per_page);
		$rs = $this->GetProductAllBetween($position, $item_per_page, $category, $brand);
		$data['product'] = $rs;
		if (count($rs) > 0) {
			$this->renderPartial("//product/product_more", $data);
		} else {
			echo 0;
		}
	}

	function GetProductAllBetween($start, $end, $category, $brand) {
		$categorys = Yii::app()->request->getPost('category');
		$brands = Yii::app()->request->getPost('brand');
		if ($categorys != "" || $brands != "") {
			$where = " 1=1 ";
			if ($categorys != "") {
				$category = $categorys;
				$where .= " and p.category in($category) ";
			}
			if ($brands != "") {
				$brand = $brands;
				$where .= " and p.brand in($brand) ";
			}
		} else {
			$where = " 1=1";
		}
		$sql = "SELECT DISTINCT(p.product_id),p.*,t.type_name,c.categoryname
                    FROM product p INNER JOIN product_type t ON p.type_id = t.type_id
                    INNER JOIN category c ON p.category = c.id
                    WHERE $where
                    ORDER BY p.id DESC LIMIT $start,$end";
		//return $sql;
		return Yii::app()->db->createCommand($sql)->queryAll();
	}

	public function actionDetail() {
		$this->layout = "webapp";
		$config = new Configweb_model();
		$product_id = $config->url_decode($_GET['id']);

		$product = new Product();

		$data['images'] = $product->get_images_product($product_id);
		$data['product'] = $product->_get_detail_product($product_id);

		$data['near'] = $product->get_product_near($product_id);

		$this->render("//product/detail_product", $data);
	}

	public function actionViews($id) {
		$product = new Product();
		$conFig = new Configweb_model();
		$data['product'] = $product->_get_detail_product($id);
		$data['images'] = $product->get_images_product($id);
		$fimg = $product->firstpictures($data['product']['product_id']);
		$data['layout'] = $this->getLayout($id);
		Yii::app()->session['fbtitle'] = $data['product']['product_name'];
		Yii::app()->session['fbcaption'] = $data['product']['description'];
		Yii::app()->session['fbdescription'] = $data['product']['description'];
		Yii::app()->session['fbimages'] = $conFig->GetFullLink(Yii::app()->baseUrl . "/uploads/product/thumbnail/480-" . $fimg);
		Yii::app()->session['fburl'] = $conFig->GetFullLink(Yii::app()->createUrl('frontend/product/views', array("id" => $data['product']['product_id'])));
		$this->Readproduct($id);
		$data['countreview'] = $this->Countreview($id);
		$data['productid'] = $id;
		$this->actionSaveviewproduct($id);
		$this->render("//product/views", $data);
	}

	public function getLayout($id) {
		$sql = "select l.row_id,y.`columns`,y.classname
                    from layoutcontent l INNER JOIN layout y ON l.layout = y.id
                    WHERE l.pageid = '$id'
                    GROUP BY row_id";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}

	/*
		      public function actionViews($id) {
		      $product = new Product();
		      $conFig = new Configweb_model();
		      $data['product'] = $product->_get_detail_product($id);
		      $data['images'] = $product->get_images_product($id);
		      $fimg = $product->firstpictures($data['product']['product_id']);

		      Yii::app()->session['fbtitle'] = $data['product']['product_name'];
		      Yii::app()->session['fbcaption'] = $data['product']['description'];
		      Yii::app()->session['fbdescription'] = $data['product']['description'];
		      Yii::app()->session['fbimages'] = $conFig->GetFullLink(Yii::app()->baseUrl . "/uploads/product/thumbnail/480-" . $fimg);
		      Yii::app()->session['fburl'] = $conFig->GetFullLink(Yii::app()->createUrl('frontend/product/views', array("id" => $data['product'])));
		      $this->Readproduct($id);
		      $data['countreview'] = $this->Countreview($id);
		      $this->actionSaveviewproduct($id);
		      $this->render("//product/views", $data);
		      }
	*/

	public function actionSaveviewproduct($product_id) {
		$columns = array(
			"product_id" => $product_id,
			"dupdate" => date("Y-m-d H:i:s"),
		);
		Yii::app()->db->createCommand()
			->insert("viewproduct", $columns);
	}

	private function Readproduct($productID) {
		$sql = "select countread from product where product_id = '$productID' ";
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		$newsRead = $rs['countread'] + 1;
		$columns = array("countread" => $newsRead);
		Yii::app()->db->createCommand()
			->update("product", $columns, "product_id = '$productID'");
	}

	private function Countreview($productID) {
		$sql = "select count(*) as total from review where product_id = '$productID' ";
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		$review = $newsRead = $rs['total'];
		return $review;
	}

	public function actionNotify($order_id = '') {
		if ($order_id != "") {
			$data['order_id'] = $order_id;
		} else {
			$data['order_id'] = $this->session->userdata('order_id');
		}
		$head = "แจ้งชำระเงิน";
		$page = "web_system/notify"; // โหลดไปแสดงค่าโชว์แบบ popup
		$this->output_system($data, $page, $head);
	}

	public function actionSave_notify() {
		$order_id_now = $this->session->userdata('order_id');
		$order_id = $_POST['order_id'];
		$data = array(
			'order_id' => $order_id,
			'money' => $_POST['money'],
			'date_tranfer' => $_POST['date_tranfer'],
			'time_tranfer' => $_POST['time_tranfer'],
		);
		$this->db->insert('notify', $data);

		// เปลี่ยนสถานะให้เป็น รอการจัดส่ง
		$data_check = array(
			'status' => '1',
		);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data_check);

		if ($order_id = $order_id_now) {
			$max_order_id = $this->p_db->autoId('orders', 'order_id', '7');
			$this->session->set_userdata('order_id', $max_order_id);
		}
	}

	public function actionPayments_g() {
		$head = "ช่องทางชำระเงิน";
		$page = "web_system/payments_g"; // โหลดไปแสดงค่าโชว์แบบ popup
		$this->output_system('', $page, $head);
	}

	public function actionFrom_add_bill($order_id = '') {
		$data['order_id'] = $order_id;
		$head = "ส่งหลักฐานการโอนเงิน";
		$page = "web_system/from_add_bill"; // โหลดไปแสดงค่าโชว์แบบ popup
		$this->output_system($data, $page, $head);
	}

	public function actionFrom_search_product() {
		$data['product_type'] = $this->product->_get_product_type();
		$head = "ข้อมูลสินค้า";
		$page = "web_system/from_search_product"; // โหลดไปแสดงค่าโชว์แบบ popup
		$this->output_webapp($data, $page, $head);
	}

	public function actionSearch_product() {
		$type_id = $_POST['type_id'];
		$product_name = $_POST['search_txt'];

		if ($type_id != "") {
			$w1 = " t.type_id = '$type_id' ";
		} else {
			$w1 = " 1=1 ";
		}

		if ($product_name != "") {
			$w3 = " AND p.product_name LIKE '%$product_name%' ";
		} else {
			$w3 = " AND 1=1 ";
		}

		$data['product'] = $this->product->_get_search_product($w1, $w3);
		$this->load->view('web_system/show_search_product', $data);
	}

	public function actionFrom_print_bill($order_id = '') {
		$data['order_id'] = $order_id;
		$page = "web_system/from_print_bill";
		$head = "พิมพ์ใบแจ้งโอนเงิน";

		$this->output_system($data, $page, $head);
	}

	public function actionPrint_bill($order_id = '') {
		$data['bill'] = $this->product->print_bill($order_id);
		$data['order_id'] = $order_id;
		$member = $this->session->userdata('member');
		$data['name'] = $member->pername . $member->name . "-" . $member->lname;

		$this->load->view('web_system/print_bill', $data);
	}

	public function actionView($type) {
		$type_id = $type;
		//$config = new Configweb_model();
		$prodult = new Product();

		//$type_id = $config->url_decode($_GET['type']);
		$sql = "select t.*,categoryname from product_type t inner join category c on t.category = c.id where type_id = '$type_id'";
		$data['type'] = Yii::app()->db->createCommand($sql)->queryRow();
		$data['type_id'] = $type_id;
		$data['type_name'] = $prodult->get_type_name($type_id);
		$data['product'] = $prodult->get_product_all($type_id);
		$data['count_product_type'] = $prodult->get_count_product_type($type_id);

		$this->render("//product/show_product_all", $data);
	}

	public function actionPages() {
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$type_id = $_POST["type_id"];
		$item_per_page = 8; //ให้แสดงที่ละ
		//throw HTTP error if page number is not valid
		if (!is_numeric($page_number)) {
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);

		//Limit our results within a specified range.
		//$results = mysqli_query($connecDB, "SELECT id,name,message FROM paginate ORDER BY id DESC LIMIT $position, $item_per_page");
		$query = "SELECT *
                  FROM product
                    WHERE type_id = '$type_id'
                  ORDER BY id DESC LIMIT $position, $item_per_page";
		$rs = Yii::app()->db->createCommand($query)->queryAll();

		//WHERE type_id = '$type_id'
		//output results from database
		/*
	          echo '<ul class="page_result">';
	          foreach ($rs as $row) {
	          echo '<li id="item_' . $row["id"] . '"><span class="page_name">' . $row["id"] . ') ' . $row["product_name"] . '</span><span class="page_message">' . $row["product_name"] . '</span></li>';
	          }
	          echo '</ul>';
	         *
*/

		$data['product'] = $rs;
		if ($rs) {
			$this->renderPartial("//product/product_more", $data);
		} else {
			echo 0;
		}
	}

	public function actionReview() {
		$productID = Yii::app()->request->getPost('product_id');
		$data['review'] = Review::model()->findAll('product_id=:product_id', array(':product_id' => $productID));
		$this->renderPartial("//review/index", $data);
	}

	public function actionSavereview() {
		$columns = array(
			"name" => Yii::app()->request->getPost('name'),
			"email" => Yii::app()->request->getPost('email'),
			"product_id" => Yii::app()->request->getPost('product_id'),
			"reviews" => Yii::app()->request->getPost('reviews'),
			"ip" => Yii::app()->request->userHostAddress,
			"d_update" => date("Y-m-d H:i:s"),
		);
		Yii::app()->db->createCommand()
			->insert("review", $columns);
	}

	public function actionCategory($id) {

		$prodult = new Product();

		$data['category'] = Category::model()->find("id=:id", array(":id" => $id));
		$data['product'] = $prodult->getProductByCategory($id);
		$data['count'] = count($data['product']);

		$this->render("//product/show_product_category", $data);
	}

	public function actionPagescategory() {
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$category = $_POST["category"];
		$item_per_page = 8; //ให้แสดงที่ละ
		//throw HTTP error if page number is not valid
		if (!is_numeric($page_number)) {
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);

		//Limit our results within a specified range.
		//$results = mysqli_query($connecDB, "SELECT id,name,message FROM paginate ORDER BY id DESC LIMIT $position, $item_per_page");
		$query = "SELECT *
                  FROM product
                    WHERE category = '$category'
                  ORDER BY id DESC LIMIT $position, $item_per_page";
		$rs = Yii::app()->db->createCommand($query)->queryAll();

		$data['product'] = $rs;
		if ($rs) {
			$this->renderPartial("//product/product_more", $data);
		} else {
			echo 0;
		}
	}

	public function actionBrand($id) {

		$prodult = new Product();

		$data['brands'] = Brand::model()->find("id=:id", array(":id" => $id));
		$data['product'] = $prodult->getProductByBrand($id);
		$data['count'] = count($data['product']);

		$this->render("//product/show_product_brand", $data);
	}

	public function actionPagesbrands() {
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$brand = $_POST["brands"];

		$item_per_page = 8; //ให้แสดงที่ละ
		//throw HTTP error if page number is not valid
		if (!is_numeric($page_number)) {
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);

		//Limit our results within a specified range.
		//$results = mysqli_query($connecDB, "SELECT id,name,message FROM paginate ORDER BY id DESC LIMIT $position, $item_per_page");
		$query = "SELECT *
                  FROM product
                    WHERE brand = '$brand'
                  ORDER BY id DESC LIMIT $position, $item_per_page";
		$rs = Yii::app()->db->createCommand($query)->queryAll();

		$data['product'] = $rs;
		if ($rs) {
			$this->renderPartial("//product/product_more", $data);
		} else {
			echo 0;
		}
	}

	public function actionSearch($product) {
		$search = $product;
		$sql = "select * from product where product_name like '%$search%'";
		$data['search'] = $search;
		$data['product'] = Yii::app()->db->createCommand($sql)->queryAll();
		$data['count'] = count($data['product']);
		$this->render('//product/search', $data);
	}

	public function actionPagessearch() {
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		$search = $_POST["search"];

		$item_per_page = 8; //ให้แสดงที่ละ
		//throw HTTP error if page number is not valid
		if (!is_numeric($page_number)) {
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);

		//Limit our results within a specified range.
		//$results = mysqli_query($connecDB, "SELECT id,name,message FROM paginate ORDER BY id DESC LIMIT $position, $item_per_page");
		$query = "select * from product where product_name like '%$search%' order by id desc limit $position, $item_per_page";

		$rs = Yii::app()->db->createCommand($query)->queryAll();

		$data['product'] = $rs;
		if ($rs) {
			$this->renderPartial("//product/product_more", $data);
		} else {
			echo 0;
		}
	}

	public function actionGetproductall() {
		$categorys = Yii::app()->request->getPost('category');
		$brands = Yii::app()->request->getPost('brand');
		if ($categorys != "" || $brands != "") {
			$where = " 1=0 ";
			if ($categorys != "") {
				$category = $categorys;
				$where .= " or category in($category) ";
			} else {
				$category = " or 1=0 ";
			}
			if ($brands != "") {
				$brand = $brands;
				$where .= " or brand in($brand) ";
			} else {
				$brand .= " or 1=0";
			}
		} else {
			$where = " 1 = 0";
		}
		$sql = "select count(DISTINCT(product_id)) as total from product  where $where  ";
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		echo $rs['total'];
		//echo $sql;
	}

	public function actionDefaultpage() {
		$category = Yii::app()->request->getPost('category');
		$brand = Yii::app()->request->getPost('brand');
		$rs = $this->GetProductAllBetween(0, 100, $category, $brand);
		$data['count'] = count($rs);
		$this->renderPartial("//product/default", $data);
	}

}
