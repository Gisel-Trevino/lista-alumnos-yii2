<?php

use yii\helpers\Html;
#use yii\widgets\LinkPager;
use yii\bootstrap5\LinkPager;

?>

<h1> Alumnos </h1>

<div class="row g-3">
    <?php foreach ($personas as $persona): ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <a href="#" class="card h-100 text-decoration-none text-dark">
            <div class="card-body">
                <?= Html::img("{$persona->foto}", ['class' => 'card-img-top img-fluid']) ?><br>
                <?= Html::encode("{$persona->nombre}") ?>
                <?= Html::encode("{$persona->apellido_pa}") ?>
                <?= Html::encode("{$persona->apellido_ma}") ?>
                <?= Html::encode("{$persona->telefono}") ?> <br>
                <?= Html::encode("{$persona->email}") ?> <br>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<div class="mt-4">
    <?= LinkPager::widget(['pagination' => $paginacion]) ?>
</div>