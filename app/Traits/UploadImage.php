<?php


namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadImage
{
    protected $originImage;
    protected $hashingName;

    public function uploadImage($image)
    {
        $this->originImage = $image;
        $this->hashingName = $this->createImageName();
        return $this->processUploadImage($image);
    }

    protected function createImageName()
    {
        return md5($this->originImage->getClientOriginalName() . time()) . '.' . $this->originImage->getClientOriginalExtension();
    }

    protected function processUploadImage($image)
    {
        foreach ($this->upload as $path => $quality) {
            $tmpImage = Image::make($image);
            if ($quality) {
                [$imageWidth, $imageHeight] = explode('x', $quality);
                $tmpImage->resize($imageWidth, $imageHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            $this->saveImage($tmpImage, $path);
        }
        return $this->hashingName;
    }

    protected function saveImage($image, $path)
    {
        Storage::disk('public')
            ->put(
                'uploads/'. $this->rootPathUpload .'/'. $path .'/'. $this->hashingName,
                $image->encode($this->originImage->getClientOriginalExtension())
            );
    }
}
