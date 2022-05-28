<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\commentary */

$this->title = 'Create Commentary';
$this->params['breadcrumbs'][] = ['label' => 'Commentaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commentary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
