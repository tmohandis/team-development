<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['profile', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    /**
     * Displays a single User model.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile()
    {
        $model = $this->findModel(Yii::$app->user->identity->getId());

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
