<?php

namespace app\controllers;

use app\models\Persona;
use app\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\web\UploadedFile;
use yii\data\Pagination;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class PersonaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access'=>[
                    'class'=>AccessControl::className(),
                    'only'=>['index', 'view', 'create', 'update', 'delete'],
                    'rules'=>[
                        [
                            'allow'=>true,
                            'roles'=>['@']
                        ]
                    ]
                ],
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
     * Lists all Persona models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persona model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Persona();

        $this->subirFoto($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->subirFoto($model);

        #if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        #    return $this->redirect(['view', 'id' => $model->id]);
        #}

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);

        if(file_exists($model->foto)){
            unlink($model->foto);
        }
        
        $model->delete();

        #$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLista(){
        $model=Persona::find();

        $paginacion=new Pagination([
            'defaultPageSize'=>4,
            'totalCount'=> $model->count()
        ]);

        $personas= $model->orderBy('apellido_pa')->offset($paginacion->offset)->limit($paginacion->limit)->all();

        return $this->render('lista', ['personas'=>$personas, 'paginacion'=>$paginacion]);
    }

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Persona::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function subirFoto(Persona $model){

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                $model->archivo = UploadedFile::getInstance($model, 'archivo');    

                if ($model->validate()) {
                    
                    if($model->archivo){

                        if(!empty($model->foto) && file_exists($model->foto)){
                        unlink($model->foto);
                        }

                        $rutaArchivo = 'uploads/' . time() . "_" . $model->archivo->baseName . "." . $model->archivo->extension;

                        if($model->archivo->saveAs($rutaArchivo)){
                            $model->foto = $rutaArchivo;
                        }

                    }

                }
                if($model->save(false)){
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        #if($model->load(Yii::$app->request->post()) && $model->save()){
        #    return $this->redirect(['view', 'id' => $model->id]);
        #}
    }
}
