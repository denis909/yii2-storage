<?php

use denis909\storage\Storage;
use denis909\storage\StorageFlysystemBuilder;
use denis909\storage\StorageLogBehavior;

return [
    'components' => [
        'storage' => [
            'class' => Storage::class,
            'baseUrl' => '/uploaded',
            'filesystem' => [
                'class' => StorageFlysystemBuilder::class,
                'path' => '@frontend/web/uploaded'
            ],
            'as log' => [
                'class' => StorageLogBehavior::class,
                'component' => 'storage'
            ]
        ]
    ]
];