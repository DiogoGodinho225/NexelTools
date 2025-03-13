<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "linhachat".
 *
 * @property int $id
 * @property int $chat_id
 * @property int $emissor_id
 * @property string $mensagem
 * @property string $send_at
 * @property int $lida
 * @property resource $iv
 *
 * @property Chat $chat
 * @property Profile $emissor
 */
class Linhachat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linhachat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'emissor_id', 'mensagem', 'lida', 'iv'], 'required'],
            [['chat_id', 'emissor_id', 'lida'], 'integer'],
            [['mensagem'], 'string'],
            [['send_at'], 'safe'],
            [['iv'], 'string', 'max' => 16],
            [['chat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chat::class, 'targetAttribute' => ['chat_id' => 'id']],
            [['emissor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['emissor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chat_id' => 'Chat ID',
            'emissor_id' => 'Emissor ID',
            'mensagem' => 'Mensagem',
            'send_at' => 'Send At',
            'lida' => 'Lida',
            'iv' => 'Iv',
        ];
    }

    /**
     * Gets query for [[Chat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(Chat::class, ['id' => 'chat_id']);
    }

    /**
     * Gets query for [[Emissor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmissor()
    {
        return $this->hasOne(Profile::class, ['id' => 'emissor_id']);
    }

    public static $chave;

    public static function initChave()
    {
        $chave = Yii::$app->security->generateRandomKey(16);
    }

    public static function encryptMessage($message)
    {
        $iv = random_bytes(16);
        if(empty($chave)){
            self::initChave();
        }
        $encrypted_message = openssl_encrypt($message, 'aes-256-cbc', self::$chave, 0, $iv);

        return['message' => $encrypted_message, 'iv' => $iv];
    }

    public static function decryptMessage($encrypted_message, $iv)
    {
        return openssl_decrypt($encrypted_message, 'aes-256-cbc', self::$chave, 0, $iv);
    }
}
