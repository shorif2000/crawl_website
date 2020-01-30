<?php
declare(strict_types=1);

namespace App\Applications\Services\Parsers;

use App\Applications\Services\Parsers\Interfaces\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;

class HtmlParser implements ParserInterface
{
    private Crawler $htmlDom;

    public function __construct(Crawler $htmlDom)
    {
        $this->htmlDom = $htmlDom;
    }

    public function title(): string
    {
        return $this->htmlDom->filter('div.header h3')->text();
    }

    public function description(): string
    {
        return $this->htmlDom->filter('div.package-name')->text();
    }

    public function packagePrices(): Crawler
    {
        return $this->htmlDom->filter('div.package-price')->children();
    }

    public function price(): int
    {
        $price = $this->packagePrices()->first()->text();
        return (int)(preg_replace('/£/', '', $price) ?? 0) * 100;
    }

    public function discount(): int
    {
        $discount = $this->packagePrices()->last()->text();
        preg_match('/Save £(?P<price>[0-9.]+)/', $discount, $array);
        return (int)($array['price'] ?? 0) * 100;
    }
}
