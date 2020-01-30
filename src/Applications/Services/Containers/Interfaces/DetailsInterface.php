<?php

namespace App\Applications\Services\Containers\Interfaces;

use App\Applications\Services\ResourceManagers\Interfaces\ReaderInterface;
use App\Applications\Services\ResourceManagers\Interfaces\WriterInterface;

interface DetailsInterface
{

    public function addDetails(ReaderInterface $reader): void;

    public function saveDetails(WriterInterface $writer): void;

    public function sortByPrice(): void;

    public function getDetails(): array;
}
