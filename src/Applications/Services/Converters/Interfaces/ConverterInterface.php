<?php

namespace App\Applications\Services\Converters\Interfaces;

interface ConverterInterface
{

    public function unserialize(string $string): array;

    public function serialize(array $details): string;

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function fetch(string $source): string;
}
