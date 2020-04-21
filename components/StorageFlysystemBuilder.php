<?php

namespace denis909\storage\components;

use Yii;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use trntv\filekit\filesystem\FilesystemBuilderInterface;

/**
 * Class LocalFlysystemProvider
 * @author Eugene Terentev <eugene@terentev.net>
 */
class StorageFlysystemBuilder implements FilesystemBuilderInterface
{

    public $path;

    public function build()
    {
        $adapter = new Local(Yii::getAlias($this->path));

        return new Filesystem($adapter);
    }

}