<?php

namespace app\controllers;

use app\models\Lesson;
use app\models\User;
use Yii;
use app\models\Comment;
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
        return [];
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

        $user = User::findOne(Yii::$app->user->getId());
        $comment->users = $user;

        $lesson = Lesson::findOne($lessonId);
        $comment->lessons = $lesson;

        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            return $this->redirect("/lesson/view?id=$lessonId");
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
