<?php

namespace denis909\storage\components;

use yii\helpers\ArrayHelper;
use denis909\storage\models\Storage as StorageModel;

class StorageUploadBehavior extends \trntv\filekit\behaviors\UploadBehavior
{

    public $filesStorage = 'storage';

    protected function deleteSingleLog()
    {
        $attribute = ArrayHelper::getValue($this->fields(), 'path');

        if ($attribute)
        {
            StorageModel::deleteAll([
                'component' => $this->filesStorage,
                'path' => $this->owner->{$attribute}
            ]);
        }
    }

    protected function deleteMultipleLog()
    {
        foreach($this->fields() as $field)
        {
            $attribute = ArrayHelper::getValue($field, 'path');

            StorageModel::deleteAll([
                'component' => $this->filesStorage,
                'path' => $this->owner->{$attribute}
            ]);
        }
    }

    public function afterInsertSingle()
    {
        parent::afterInsertSingle();

        $this->deleteSingleLog();
    }

    public function afterInsertMultiple()
    {
        parent::afterInsertMultiple();

        $this->deleteMultipleLog();
    }

    public function afterUpdateSingle()
    {
        parent::afterUpdateSingle();

        $this->deleteSingleLog();
    }

    public function afterUpdateMultiple()
    {
        parent::afterUpdateMultiple();

        $this->deleteMultipleLog();
    }
    
}