<?php
declare(strict_types=1);

namespace App\Applications\Services\ResourceManagers;

use App\Applications\Services\Files\Interfaces\FileInterface;
use App\Applications\Services\Converters\Interfaces\ConverterInterface;
use App\Applications\Services\ResourceManagers\Interfaces\WriterInterface;

class Writer implements WriterInterface
{
    private $file;

    private $converter;

    public function __construct(FileInterface $file, ConverterInterface $converter)
    {
        $this->file = $file;
        $this->converter = $converter;
    }

    public function write(array $details): void
    {
        $string = $this->converter->serialize($details);
        $this->file->store($string);
    }
}
