<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_phones".
 *
 * @property int $id
 * @property int $client_id
 * @property string $phone
 * @property int $created
 *
 * @property Client $client
 */
class ClientPhones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_phones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'phone', 'created'], 'required'],
            [['client_id', 'created'], 'integer'],
            [['phone'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'phone' => 'Phone',
            'created' => 'Created',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @param $id
     * @return string
     */
    public static function getPhones($id)
    {
        $phones = self::find()->select('phone')->where(['client_id' => $id])->all();
        $numbers = [];
        foreach ($phones as $number) {
            $numbers[] = $number->phone;
        }
        return implode(', ', $numbers);
    }
}
