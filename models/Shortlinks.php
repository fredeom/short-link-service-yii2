<?php

namespace app\models;

/**
 * This is the model class for table "shortlinks".
 *
 * @property int $id
 * @property string $shorturlsuffix
 * @property string $longurl
 */
class Shortlinks extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shortlinks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shorturlsuffix', 'longurl'], 'required'],
            [['shorturlsuffix'], 'string', 'max' => 50],
            [['longurl'], 'string', 'max' => 255],
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
            'longurl' => 'Longurl',
        ];
    }

}
