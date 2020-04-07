<?php

namespace app\controllers;

use app\models\Category;
use app\models\Comment;
use app\models\User;
use Yii;
use app\models\Lesson;
use yii\behaviors\TimestampBehavior;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            TimestampBehavior::class,
        ];
    }

    /**
     * Lists all Lesson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Lesson::find();
        $query->byUser(Yii::$app->user->getId());
        $lessons = $query->all();

        return $this->render('index', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Displays a single Lesson model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $lesson = $this->findModel($id);

        return $this->render('view', [
            'model' => $lesson,
            'comment'=> new Comment(),
            'commentsUsers' => $lesson->getCommentsUsersArray(),
        ]);
    }

    /**
     * Creates a new Lesson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $lesson = new Lesson();

        $lesson->setScenario(Lesson::SCENARIO_INSERT);
        if ($lesson->load(Yii::$app->request->post())) {
            $lesson->users = User::findOne(Yii::$app->user->getId());
            $lesson->categories = Category::findOne($lesson->category_id);

            if ($lesson->save()) {
                return $this->redirect(['view', 'id' => $lesson->id]);
            }
        }

        return $this->render('create', [
            'model' => $lesson,
            'categoriesNames' => Category::getCategoriesNames()
        ]);
    }

    /**
     * Updates an existing Lesson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $lesson = $this->findModel($id);

        $lesson->setScenario(Lesson::SCENARIO_UPDATE);
        if ($lesson->load(Yii::$app->request->post())) {
            $lesson->users = User::findOne(Yii::$app->user->getId());
            $lesson->categories = Category::findOne($lesson->category_id);

            if ($lesson->save()) {
                return $this->redirect(['view', 'id' => $lesson->id]);
            }
        }

        return $this->render('update', [
            'model' => $lesson,
            'categoriesNames' => Category::getCategoriesNames()
        ]);
    }

    /**
     * Deletes an existing Lesson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lesson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lesson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lesson::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
