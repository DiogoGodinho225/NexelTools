<?php

namespace frontend\models;
use common\models\Profile;

use Yii;

/**
 * This is the model class for table "chats".
 *
 * @property int $id
 * @property int $use1_id
 * @property int $user2_id
 * @property string $created_at
 *
 * @property Linhachat[] $linhachats
 * @property Profile $use1
 * @property Profile $user2
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user1_id', 'user2_id'], 'required'],
            [['user1_id', 'user2_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['user1_id' => 'id']],
            [['user2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['user2_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user1_id' => 'Use1 ID',
            'user2_id' => 'User2 ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Linhachats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhachats()
    {
        return $this->hasMany(Linhachat::class, ['chat_id' => 'id']);
    }

    /**
     * Gets query for [[Use1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUse1()
    {
        return $this->hasOne(Profile::class, ['id' => 'user1_id']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser2()
    {
        return $this->hasOne(Profile::class, ['id' => 'user2_id']);
    }
}
