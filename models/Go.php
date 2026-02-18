<?php

namespace app\models;

/**
 * This is the model class for table "go".
 *
 * @property int $id
 * @property string $shorturlsuffix
 * @property string $ip
 */
class Go extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'go';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shorturlsuffix', 'ip'], 'required'],
            [['shorturlsuffix'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shorturlsuffix' => 'Shorturlsuffix',
            'ip' => 'Ip',
        ];
    }

}
