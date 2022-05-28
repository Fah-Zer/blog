<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Subnav */

$this->title = 'Create Subnav';
$this->params['breadcrumbs'][] = ['label' => 'Subnavs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subnav-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
