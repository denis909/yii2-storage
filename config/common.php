<?php

return [
    'components' => [
        'storage' => [
            'class' => denis909\storage\Storage::class,
            'baseUrl' => '/uploaded',
            'filesystem' => [
                'class' => denis909\storage\components\StorageFlysystemBuilder::class,
                'path' => '@frontend/web/uploaded'
            ],
            'as log' => [
                'class' => denis909\storage\components\StorageLogBehavior::class,
                'component' => 'storage'
            ]
        ]
    ]
];