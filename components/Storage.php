<?php

namespace denis909\storage\components;

use Exception;
use trntv\filekit\File;
use yii\helpers\FileHelper;

class Storage extends \trntv\filekit\Storage
{

    public function saveContent($filename, $content, $preserveFileName = false, $overwrite = false, $config = [], $pathPrefix = '')
    {
        //$stream = fopen('data://text/plain,' . $content, 'r');
        //$uploadedFile = new UploadedFile(['tempResource' => $stream]);
        //$file = File::create($uploadedFile);

        $tempFilename = tempnam(sys_get_temp_dir(), 'PHP');

        $handle = fopen($tempFilename, "w");

        fwrite($handle, $content);
        
        fclose($handle);   

        $file = File::create($filename); // create with original filename

        $file->getPathInfo(); // create pathinfo cache

        $file->setPath($tempFilename); // set real filename

        //$file->extension = pathinfo($filename, PATHINFO_EXTENSION);

        try
        {
            $return = $this->save($file, $preserveFileName, $overwrite, $config, $pathPrefix);
        }
        catch(Exception $e)
        {
            unlink($tempFilename);

            throw $e;
        }

        unlink($tempFilename);
    
        return $return;
    }

}