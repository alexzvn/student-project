<?php

namespace Core\Http;

use Core\Support\Path;

class FileUpload
{
    protected array $file;

    protected bool $isMoved = false;

    public function __construct(array $fileRequest) {
        $this->file = $fileRequest;
    }

    public function size()
    {
        return $this->file['size'] ?? 0;
    }

    public function name()
    {
        return $this->file['name'] ?? 0;
    }

    /**
     * Get extension name of file upload
     *
     * @return string
     */
    public function ext()
    {
        $name = explode('.', $this->name());

        return array_pop($name);
    }

    /**
     * The error code associated with this file upload.
     * @see https://www.php.net/manual/en/features.file-upload.errors.php
     *
     * @return int
     */
    public function error()
    {
        return $this->file['error'] ?? null;
    }

    /**
     * The temporary filename of the file in which the uploaded file was stored on the server. 
     *
     * @return string
     */
    public function tmpName()
    {
        return $this->file['tmp_name'];
    }

    public function moveToNewFile(string $name, string $path)
    {
        return move_uploaded_file($this->tmpName(), Path::join($path, $name));
    }

    public function moveTo(string $path)
    {
        return move_uploaded_file($this->tmpName(), $path);
    }
}
