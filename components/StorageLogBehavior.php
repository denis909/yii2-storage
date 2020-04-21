<?php

namespace denis909\storage\components;

use common\models\Uploaded;
use League\Flysystem\File;
use trntv\filekit\Storage;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

/**
 * Class FileStorageLogBehavior
 * @package common\behaviors
 * @author Eugene Terentev <eugene@terentev.net>
 */
class StorageLogBehavior extends Behavior
{

    public $component;

    public function events()
    {
        return [
            Storage::EVENT_AFTER_SAVE => 'afterSave',
            Storage::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

    /**
     * @param $event \trntv\filekit\events\StorageEvent
     */
    public function afterSave($event)
    {
        $file = new File($event->filesystem, $event->path);
        
        $model = new Uploaded;

        if (Yii::$app->has('user'))
        {
            $model->user_id = Yii::$app->user->id;
        }
        
        $model->component = $this->component;
        
        $model->path = $file->getPath();
        
        $model->size = $file->getSize();
        
        $model->type = $file->getMimeType();
        
        if (Yii::$app->request->getIsConsoleRequest() === false)
        {
            $model->upload_ip = Yii::$app->request->getUserIP();
        }
        
        $model->save(false);
    }

    /**
     * @return \trntv\filekit\Storage
     * @throws \yii\base\InvalidConfigException
     */
    public function getStorage()
    {
        if ($this->component === null)
        {
            throw new InvalidConfigException('Storage component name must be set');
        }
        
        return Yii::$app->get($this->component);
    }

    /**
     * @param $event \trntv\filekit\events\StorageEvent
     */
    public function afterDelete($event)
    {
        Uploaded::deleteAll([
            'component' => $this->component,
            'path' => $event->path
        ]);
    }

}