<?php

namespace App\Applications\Services\ResourceManagers\Interfaces;

interface WriterInterface extends ResourceManagerInterface
{
    public function write(array $details): void;
}
