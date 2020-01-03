<?php

class AboutController extends Controller {

	public $layout = "template_backend";

	public function actionIndex() {
		$rs = Yii::app()->db->createCommand()
			->select('*')
			->from('about')
			->queryRow();

		$data['about'] = $rs;
		$sqlBg = "select * from bgcontent where type = 's'";
		$rs = Yii::app()->db->createCommand($sqlBg)->queryRow();
		$data['lt'] = $rs['lefttop'];
		$data['rt'] = $rs['righttop'];
		$data['lb'] = $rs['leftbottom'];
		$data['rb'] = $rs['rightbottom'];
		$data['bg'] = $rs;
		$this->render("//backend/about/view", $data);
	}

	public function actionCreate() {
		$rs = Yii::app()->db->createCommand()
			->select('*')
			->from('about')
			->queryRow();

		$data['about'] = $rs;
		$this->render("//backend/about/create", $data);
	}

	public function actionSave() {
		$columns = array("about" => $_POST['about']);
		Yii::app()->db->createCommand()
			->update("about", $columns, '1=1');
	}

}
