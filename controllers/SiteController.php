<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    if (\Yii::$app->user->isGuest)
                    {
                        \Yii::$app->getSession()->setFlash('warning', 'You must be authenticated to access this page');
                        return $this->redirect(Url::to('/site/login'));
                    }
                    else
                        throw new HttpException('403', 'You are not allowed to access this page');
                },
                'only' => [ 'secure', 'authenticated' ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [ 'secure' ],
                        'matchCallback' => function($rule, $action) {
                            return !\Yii::$app->user->isGuest && \Yii::$app->user->identity->role->id === 2;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => [ 'authenticated' ],
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSecure()
    {
        return $this->render('secure');
    }

    public function actionAuthenticated()
    {
        return $this->render('authenticated');
    }

    public function actionLogin()
    {
        $model = new \app\models\UserForm(['scenario' => 'login']);

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->login())
            {
                if (\Yii::$app->user->identity->role->id === 2)
                    return $this->redirect('secure');

                return $this->redirect('authenticated');

            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new \app\models\UserForm(['scenario' => 'register']);

        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->register())
            {
                \Yii::$app->getSession()->setFlash('warning', 'Your account has been registered, you may now login');
                return $this->redirect('login');
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
