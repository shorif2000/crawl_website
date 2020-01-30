<?php

namespace App\Applications\Services\Containers\Interfaces;

use App\Applications\Services\ResourceManagers\Interfaces\ReaderInterface;
use App\Applications\Services\ResourceManagers\Interfaces\WriterInterface;

interface MetaInterface
{

    public function addMeta(ReaderInterface $reader): void;

    public function saveMeta(WriterInterface $writer): void;

    public function sortByPrice(): void;

    public function getMeta(): array;
}
