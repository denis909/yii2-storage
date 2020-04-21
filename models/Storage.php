<?php

namespace denis909\storage;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%storage}}".
 *
 * @property integer $id
 * @property string $component
 * @property string $base_url
 * @property string $path
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property string $upload_ip
 * @property integer $created_at
 */
class Storage extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['component', 'path'], 'required'],
            [['size'], 'integer'],
            [['component', 'name', 'type'], 'string', 'max' => 255],
            [['path', 'base_url'], 'string', 'max' => 1024],
            [['type'], 'string', 'max' => 45],
            [['upload_ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('storage', 'ID'),
            'component' => Yii::t('storage', 'Component'),
            'base_url' => Yii::t('storage', 'Base Url'),
            'path' => Yii::t('storage', 'Path'),
            'type' => Yii::t('storage', 'Type'),
            'size' => Yii::t('storage', 'Size'),
            'name' => Yii::t('storage', 'Name'),
            'upload_ip' => Yii::t('storage', 'Upload Ip'),
            'created_at' => Yii::t('storage', 'Created At')
        ];
    }
}