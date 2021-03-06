<?php


namespace App\Manager;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
class ImageManager
{
    protected $webDir;

    protected $imagesDir;

    /**
     * ImageManager constructor.
     * @param $imagesDir
     * @param $webDir
     */
    public function __construct($webDir, $imagesDir)
    {
        $this->imagesDir = $imagesDir;
        $this->webDir = $webDir;
    }

    public function saveImageOnDisk(File $image, $filename)
    {
        $filesystem = new Filesystem();

        if (!is_dir($this->getImagesPath())) {
            $filesystem->mkdir($this->getImagesPath());
        }

        $filesystem->copy($image->getRealPath(), $this->getImagePath($filename));
    }

    public function getImagesPath()
    {
        return preg_replace('#/{2,}#', '/', $this->webDir.DIRECTORY_SEPARATOR.$this->imagesDir);
    }

    public function getImagePath($imageName)
    {
        return $this->getImagesPath().DIRECTORY_SEPARATOR.$imageName;
    }

    public function getImageUrl($imageName)
    {
        return preg_replace('#/{2,}#', '/', $this->imagesDir.DIRECTORY_SEPARATOR.$imageName);
    }
}