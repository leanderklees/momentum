<?php
namespace Leanderklees\Momentum\Tests;

use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;

class TestUploadedFile extends UploadedFile
{
    public function __construct($path, $name = null, $mimeType = null, $error = null, $test = false)
    {
        $file = new File($path);

        parent::__construct(
            $file->getPathname(),
            $name ?: $file->getFilename(),
            $mimeType ?: $file->getMimeType(),
            $error ?: UPLOAD_ERR_OK,
            $test
        );
    }

    public static function fake($name = 'file.txt', $size = 0, $mimeType = null)
    {
        $tempFile = tempnam(sys_get_temp_dir(), $name);

        if ($size > 0) {
            $data = str_repeat('A', $size);
            file_put_contents($tempFile, $data);
        }

        $file = new SymfonyUploadedFile($tempFile, $name, $mimeType);

        return new static(
            $tempFile,
            $name,
            $mimeType ?: $file->getClientMimeType(),
            UPLOAD_ERR_OK,
            true
        );
    }
}
