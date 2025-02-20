<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Update User: ' . $model->id;

?>
<div class="user-update" style="padding:30px;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
