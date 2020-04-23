<?php

namespace denis909\storage\commands;

use Yii;
use Exception;
use denis909\storage\models\Storage;

class StorageController extends \yii\console\Controller
{

    public $debug;

    public function options($actionID)
    {
        return ['debug'];
    }    

    public function actionClear($hours = 1)
    {
        $due_time = time() - (60 * 60 * $hours);

        $query = Storage::find()->where('created_at<=:due_time', [':due_time' => $due_time]);

        $models = $query->all();

        if ($this->debug)
        {
            echo count($models) . ' elements found' . PHP_EOL;
        }

        foreach($models as $model)
        {
            if (!Yii::$app->storage->delete($model->path))
            {
                throw new Exception('Storage is not deleted.');
            }
            else
            {
                if ($this->debug)
                {
                    echo $model->path . ' deleted ' . PHP_EOL;
                }
            }
        }

        if ($this->debug)
        {
            echo 'done' . PHP_EOL;
        }
    }

}