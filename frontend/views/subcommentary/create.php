<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\subcommentary */

$this->title = 'Create Subcommentary';
$this->params['breadcrumbs'][] = ['label' => 'Subcommentaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcommentary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
