<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Chat;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Linhachat;
use common\models\Profile;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Chat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id_user = Yii::$app->user->id;
        $profile = Profile::find()->where(['id_user' => $id_user])->one();

        $mensagens = Chat::find()->where('or', ['user1_id' => $profile->id], ['user2_id' => $profile->id])->all();

        return $this->render('index', [
            'mensagens' => $mensagens,
        ]);
    }

    /**
     * Displays a single Chat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $user1_id = Yii::$app->request->get('user1_id');
        $user2_id = Yii::$app->request->get('user2_id');


        $chat = Chat::find()
        ->where(['or', 
            ['user1_id' => $user1_id, 'user2_id' => $user2_id],
            ['user1_id' => $user2_id, 'user2_id' => $user1_id]
        ])
        ->one();


        if(!$chat){
            $chat = new Chat();
            $chat->user1_id = $user1_id;
            $chat->user2_id = $user2_id;
            $chat->save();
        }

        $chatMensagens = Linhachat::find()->where(['chat_id' => $chat->id])->all();

        return $this->renderPartial('view', [
            'chatMensagens' => $chatMensagens,
        ]);
    }

    /**
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Chat();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Chat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Chat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
