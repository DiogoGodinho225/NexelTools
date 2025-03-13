<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Chat $model */

//$this->title = $model->id;

\yii\web\YiiAsset::register($this);
?>
<div class="chat-container">
    <div class="chat-box">
        <div class="messages">
            <?php if (!empty($chatMensagens)): ?>
                <?php foreach ($chatMensagens as $mensagem): ?>
                    <div class="message <?= $mensagem->user_id == Yii::$app->user->id ? 'my-message' : 'other-message' ?>">
                        <p><?= Html::encode($mensagem->conteudo) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Ainda não há mensagens.</p>
            <?php endif; ?>
        </div>

        
        <div class="message-form">
            <input type="text" class="form-control" id="message" oninput="alterarEstado(this)" placeholder="Escreva a sua mensagem...">
            <button class="btn-send-message" disabled id="send-message">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>
