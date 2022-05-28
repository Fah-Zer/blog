<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subnav */

$this->title = 'Update Subnav: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subnavs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subnav-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
