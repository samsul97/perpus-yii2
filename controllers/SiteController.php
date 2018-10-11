<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Registrasi;
use app\models\Anggota;
use app\models\Forget;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actionEmail()
    {
        return Yii::$app->mail->compose()
        ->setFrom('samsulaculhadi@gmail.com')
        ->setTo('mahmudanurinayatun@gmail.com')
        ->setSubject('Hai')
        ->setTextBody('<b>hallo guys</b>')
        ->send();
    }
    // public function actionDownload()
    // {
    //     return \Yii::$app->response->sendFile('path/to/file.txt');
    // }
    public function verifyCode()
    {
        return[
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'registrasi'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['registrasi'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    // redirect itu buat array, bukan string atau bisa dikatakan untuk mengalihkan sebuah halaman ke url atau route lain.
    // dan untuk render kemungkinan bukan untuk arayy, tapi kebalikanya yaitu string. untuk nampilin sebuah view atau template lain.
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/dashboard']);
        }
        else
        {
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionDashboard()
    {
        if (User::isAdmin())
        {
            return $this->render('dashboard');
        }
        elseif (User::isAnggota()) {
            return $this->render('dashboard');
        }
        elseif (User::isPetugas()) {
            return $this->render('dashboard');
        }
        else
        {
            return $this->redirect(['site/login']);
        }
        // return $this->render('dashboard');
    }
    public function actionRegistrasi()
    {
        $this->layout = 'main-login';
        $model = new Registrasi();
        if ($model->load(Yii::$app->request->post()))
        {
            $anggota = new Anggota();
            $anggota->nama = $model->nama;
            $anggota->alamat = $model->alamat;
            $anggota->telepon = $model->telepon;
            $anggota->email = $model->email;
            $anggota->status_aktif = 1;
            $anggota->save();

            // if($anggota->save()) {
            //     Yii::$app->session->setFlash('success','Data berhasil disimpan.');

            $user = new User();
            $user->id_anggota = $anggota->id;
            $user->id_user_role = $anggota->id;
            $user->username = $model->username;
            $user->password = $model->password;
            $user->id_petugas = 0;
            $user->id_user_role = 2;
            $user->status = 1;
            // token berfungsi untuk membedakan atau menjadikan identitas sebuah user. untuk mengamankan sebuah transaksi.
            $user->token = Yii::$app->getSecurity()->generateRandomString ( $length = 50 );
            $user->save();

            // if($user->save()) {
            //     Yii::$app->session->setFlash('success','Data berhasil disimpan.');

            return $this->redirect(['site/login']);
        }

        // $model->password = '';
        return $this->render('registrasi', [
            'model' => $model,
        ]);
    }
    
    public function actionForgot()
    {
        $this->layout = 'main-login';
        $model = new Forget();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->sendEmail()) {
                Yii::$app->session->setFlash('Gagal', 'Email tidak ditemukan');
                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('Berhasil', 'Cek Email Anda');
                return $this->redirect('site/login');
            }
        }
        return $this->render('forgot', [
            'model' => $model,
        ]);
    }
}

    // public function actionReset()
    // {
    //     $this->layout = 'main-login';
    //     $model=$this->loadModel(Yii::app()->user->id);

    //     if(isset($_POST['oldpassword'],$_POST['newpassword']))
    //     {   

    //         if($model->validatePassword($_POST['oldpassword']))
    //         {
    //             $dua=$_POST['newpassword'];
    //             $model->saltPassword=$model->generateSalt();
    //             $model->password=md5($model->saltPassword.$dua);
    //             $model->save(false);
    //                 $this->redirect(array('index','id'=>$model->id));
    //         }
    //     }

    //     $this->render('reset',array(
    //         'model'=>$model,
    //     ));
    // }

    // public function getToken($token)
    // {
    //     $model=Users::model()->findByAttributes(array('token'=>$token));
    //     if($model===null)
    //         throw new CHttpException(404,'The requested page does not exist.');
    //     return $model;
    // }


    // public function actionVerToken($token)
    // {
    //     $model=$this->getToken($token);
    //     if(isset($_POST['Ganti']))
    //     {
    //         if($model->token==$_POST['Ganti']['tokenhid']){
    //             $model->password=md5($_POST['Ganti']['password']);
    //             $model->token="null";
    //             $model->save();
    //             Yii::app()->user->setFlash('ganti','<b>Password has been successfully changed! please login</b>');
    //             $this->redirect('?r=site/login');
    //             $this->refresh();
    //         }
    //     }
    //     $this->render('verifikasi',array(
    //         'model'=>$model,
    //     ));
    // }

        // if (isset($_POST['Lupa']) && isset($_POST['Lupa']['email'])) {
        //     $getEmail=$_POST['Lupa']['email'];
        //     $getModel= Users::model()->findByAttributes(array('email'=>$getEmail));
        //     if(isset($_POST['Lupa']))
        //     {
        //         $getToken=rand(0, 99999);
        //         $getTime=date("H:i:s");
        //         $getModel->token=md5($getToken.$getTime);
        //         $namaPengirim="Owner Perpus JJ";
        //         $emailadmin="samsulaculhadi@gmail.com";
        //         $subjek="Reset Password";
        //         $setpesan="kamu berhasil reset password<br/>
        //         <a href='http://yourdomain.com/index.php?r=site/vertoken/view&token=".$getModel->token."'>Click Here to Reset Password</a>";
        //         if($getModel->validate())
        //         {
        //             $name='=?UTF-8?B?'.base64_encode($namaPengirim).'?=';
        //             $subject='=?UTF-8?B?'.base64_encode($subjek).'?=';
        //             $headers="From: $name <{$emailadmin}>\r\n".
        //             "Reply-To: {$emailadmin}\r\n".
        //             "MIME-Version: 1.0\r\n".
        //             "Content-type: text/html; charset=UTF-8";
        //             $getModel->save();
        //             Yii::app()->user->setFlash('forgot','link to reset your password has been sent to your email');
        //             mail($getEmail,$subject,$setpesan,$headers);
        //             $this->refresh();
        //         }
        //     }
        // }
        // $this->render('forgot');
