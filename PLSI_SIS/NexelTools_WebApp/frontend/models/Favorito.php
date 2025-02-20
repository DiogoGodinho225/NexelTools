<?php

namespace frontend\models;

use Yii;
use common\models\Produto;
use common\models\Profile;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_produto
 *
 * @property Produto $produto
 * @property Profile $user
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_produto'], 'required'],
            [['id_user', 'id_produto'], 'integer'],
            [['id_produto'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::class, 'targetAttribute' => ['id_produto' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_produto' => 'Id Produto',
        ];
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::class, ['id' => 'id_produto']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Profile::class, ['id' => 'id_user']);
    }
}
