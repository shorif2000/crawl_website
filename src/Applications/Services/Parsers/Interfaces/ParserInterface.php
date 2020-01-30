<?php

namespace App\Applications\Services\Parsers\Interfaces;

use Symfony\Component\DomCrawler\Crawler;

interface ParserInterface
{
    public function title(): string;

    public function description(): string;

    public function packagePrices(): Crawler;

    public function price(): int;

    public function discount(): int;
}
