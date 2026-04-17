<?php

use app\models\Persona;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\PersonaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Persona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'pager' => [
            'class' => LinkPager::class,
            'pagination' => $dataProvider->pagination,
        ],
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'curp',
            'nombre',
            'apellido_pa',
            'apellido_ma',
            'telefono',
            'email:email',
            #'foto',
            [
                'attribute' => 'foto',
                'format' => 'html', 'value' => function($data){
                return Html::img($data->foto, ['width' => '80px']);
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Persona $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
