<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ExpenseForm;
use app\models\IncomeForm;
use yii\data\SqlDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
    public function actionIndex()
    {
        $expenseModel = new ExpenseForm();
        $incomeModel = new IncomeForm();
        // getting remaining money on wallet with createCommand
        $db = Yii::$app->db;
        $incomeSum = $db->createCommand('SELECT SUM(money) as incomeSum FROM dompetku WHERE item_name IS  NULL;')->queryAll();
        $expenseSum = $db->createCommand('SELECT SUM(money) as expenseSum FROM dompetku WHERE item_name IS NOT NULL;')->queryAll();
        $remainingMoney = $incomeSum[0]['incomeSum'] - $expenseSum[0]['expenseSum'];

        if ($expenseModel->load(Yii::$app->request->post()) && $expenseModel->validate()) {
            $expenseModel->money = (float)$expenseModel->money;
            $expenseModel->save();
            return $this->redirect(['/site/spending-log']);
        }
        if ($incomeModel->load(Yii::$app->request->post()) && $incomeModel->validate()) {
            $incomeModel->money = (float)$incomeModel->money;
            $incomeModel->save();
            return $this->redirect(['/site/income-log']);
        }
        return $this->render('index', [
            'expenseModel' => $expenseModel,
            'incomeModel' => $incomeModel,
            'remainingMoney' => $remainingMoney
        ]);
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
    public function actionIncomeLog()
    {

        $incomeDataProvider = new SqlDataProvider([
            'sql' => "SELECT * FROM dompetku WHERE item_name IS NULL",
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        return $this->render('incomeLog', [
            'incomeDataProvider' => $incomeDataProvider
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSpendingLog()
    {

        $expenseDataProvider = new SqlDataProvider([
            'sql' => "SELECT * FROM dompetku WHERE item_name IS NOT NULL",
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        return $this->render('spendingLog', [
            'expenseDataProvider' => $expenseDataProvider
        ]);
    }
}
