<?php

namespace app\controllers;

use app\models\Lesson;
use app\models\User;
use Yii;
use app\models\Comment;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
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
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $lessonId
     * @return mixed
     */
    public function actionCreate($lessonId)
    {
        $comment = new Comment();

        if ($comment->load(Yii::$app->request->post())) {
            $comment->users = User::findOne(Yii::$app->user->getId());
            $comment->lessons = Lesson::findOne($lessonId);

            if ($comment->save()) {
                return $this->redirect("/lesson/view?id=$lessonId");
            }
        }

        return $this->goHome();
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
