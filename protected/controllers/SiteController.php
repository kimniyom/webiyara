<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public $layout = "iyara";

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        //$data['social'] = $this->GetSocial();
        $data['layout'] = $this->getLayout();
        $this->render('index', $data);
    }

    public function getLayout() {
        $sql = "select l.row_id,y.`columns`,y.classname
                    from layoutcontent l INNER JOIN layout y ON l.layout = y.id
                    WHERE l.pageid = '0'
                    GROUP BY row_id";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function actionMain() {
        $this->renderPartial('homepage');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new Contactuser();

        if (isset($_POST['ContactUser'])) {
            $model->attributes = $_POST['Contactuser'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                if ($model->save()) {
                    Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                    $this->refresh();
                } else {
                    $this->render('contact', array('model' => $model));
                }
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionContacts() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (!defined('CRYPT_BLOWFISH') || !CRYPT_BLOWFISH) {
            throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");
        }

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                //$this->redirect(Yii::app()->user->returnUrl);
                $columns = array(
                    "log" => "user" . Yii::app()->user->id . " | login",
                    "user" => Yii::app()->user->name,
                    "dupdate" => date("Y-m-d H:i:s"),
                    "ip" => Yii::app()->request->userHostAddress,
                    "status" => "TRUE",
                );
                Yii::app()->db->createCommand()
                        ->insert("loguserlogin", $columns);
                $this->redirect(array('backend/backend/index'));
            } else {
                $columns = array(
                    "log" => "!LoginFail | login",
                    "user" => "",
                    "dupdate" => date("Y-m-d H:i:s"),
                    "ip" => Yii::app()->request->userHostAddress,
                    "status" => "FALSE",
                );
                Yii::app()->db->createCommand()
                        ->insert("loguserlogin", $columns);

                //$this->renderPartial('login', array('model' => $model));
            }
        }
        // display the login form
        $this->renderPartial('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('site/index'));
    }

    public function actionAbout() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('about')
                ->queryRow();

        $data['about'] = $rs;
        $this->render("//main/about", $data);
    }

    public function actionHowtoorder() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('howtoorder')
                ->queryRow();

        $data['howtoorder'] = $rs;
        $this->render("//main/howtoorder", $data);
    }

    public function actionGetmenu() {
        $this->renderPartial('//menu/menu');
    }

    function GetSocial() {
        $sql = "SELECT m.*,s.account,s.social_id
                FROM massocial m LEFT JOIN contact_social s ON m.id = s.social_id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function actionPayment() {
        $payment = new Payment();
        //$data['bank'] = $payment->Get_bank();
        $data['payment'] = $payment->Get_patment();
        $data['popup'] = Yii::app()->db->createCommand("select * from popupalert limit 1")->queryRow();
        $this->render("payment", $data);
    }

    public function actionStory() {
        $sql = "select * from about where id = '1'";
        $data['data'] = Yii::app()->db->createCommand($sql)->queryRow();
        $this->render("story", $data);
    }

    public function actionFindstore() {
        $sql = "SELECT * FROM findstore f INNER JOIN country c ON f.`country` = c.`id`";
        $data['data'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render("findstore", $data);
    }

    public function actionVideo() {
        $this->renderPartial("video");
    }

    public function actionVideomobile() {
        $this->renderPartial("videomobile");
    }

}
