<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeTask */

$this->title = 'Create Type Task';
$this->params['breadcrumbs'][] = ['label' => 'Type Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
