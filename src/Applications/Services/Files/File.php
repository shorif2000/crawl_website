<?php
declare(strict_types=1);

namespace App\Applications\Services\Files;

use App\Applications\Services\Converters\Interfaces\ConverterInterface;
use App\Applications\Services\Files\Interfaces\FileInterface;
use Symfony\Component\Filesystem\Filesystem;

class File implements FileInterface
{
    private $source = '';

    private $filesystem;

    public function __construct(string $source, Filesystem $filesystem = null)
    {
        $this->source = $source;
        $this->filesystem = $filesystem;
    }

    public function store(string $string): void
    {
        $this->filesystem->dumpFile($this->source, $string);
    }

    public function fetch(ConverterInterface $converter): string
    {
        return $converter->fetch($this->source);
    }
}
