<?php

use Denis909\CascadeFilesystem\CascadeConfig;

Yii::setAlias('@denis909/storage', dirname(__DIR__));

CascadeConfig::addPath(__DIR__);