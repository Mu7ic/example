<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $hash_id
 * @property int $age
 * @property string $name
 * @property string $city
 * @property string $membership_date
 * @property int $created
 *
 * @property ClientPhones[] $clientPhones
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hash_id', 'age', 'name', 'city', 'membership_date', 'created'], 'required'],
            [['age', 'created'], 'integer'],
            [['hash_id', 'name', 'city', 'membership_date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash_id' => 'Hash ID',
            'age' => 'Age',
            'name' => 'Name',
            'city' => 'City',
            'membership_date' => 'Membership Date',
            'created' => 'Created',
        ];
    }

    /**
     * Gets query for [[ClientPhones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientPhones()
    {
        return $this->hasMany(ClientPhones::className(), ['client_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getPhones()
    {
        $numbers = [];
        foreach ($this->clientPhones as $number) {
            $numbers[] = $number->phone;
        }
        return implode(', ', $numbers);
    }
}
