<?php

namespace denis909\storage;

use yii\helpers\ArrayHelper;
use denis909\storage\models\Storage as StorageModel;

class StorageUploadBehavior extends \trntv\filekit\behaviors\UploadBehavior
{

    public $filesStorage = 'storage';

    protected function deleteSingleLog()
    {
        $attribute = ArrayHelper::getValue($this->fields(), 'path');

        StorageModel::deleteAll([
            'component' => $this->filesStorage,
            'path' => $this->owner->{$attribute}
        ]);        
    }

    protected function deleteMultipleLog()
    {
        $attribute = ArrayHelper::getValue($this->fields(), 'path');

        foreach($this->owner->{$this->uploadRelation} as $related)
        {
            StorageModel::deleteAll([
                'component' => $this->filesStorage,
                'path' => $related->{$attribute}
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