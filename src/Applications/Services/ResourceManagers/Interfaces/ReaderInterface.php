<?php

namespace App\Applications\Services\ResourceManagers\Interfaces;

interface ReaderInterface extends ResourceManagerInterface
{
    public function read(): array;
}
