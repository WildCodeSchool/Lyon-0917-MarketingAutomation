<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 * See : https://symfony.com/doc/current/controller/upload_file.html
 * @package AppBundle\Service
 */
class FileUploader
{
    /**
     * @var
     */
    private $targetDir;

    /**
     * FileUploader constructor.
     * @param $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /**
     * @param UploadedFile $file
     * @param $slug
     * @return string
     */
    public function upload(UploadedFile $file, $slug)
    {
        $fileName = $slug .'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

}