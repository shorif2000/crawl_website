<?php
declare(strict_types=1);

namespace App\Applications\Services\Converters;

use App\Applications\Services\Converters\Interfaces\ConverterInterface;
use App\Applications\Services\Parsers\HtmlParser;
use App\Entity\VidexEntity;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class HtmlConverter implements ConverterInterface
{

    public function fetch(string $source): string
    {
        $client = new CurlHttpClient();
        return $client->request('GET', $source)->getContent();
    }

    public function unserialize(string $content): array
    {
        $array = [];

        $crawler = new Crawler($content);
        foreach ($crawler->filter('div > .package') as $domElement) {
            $videx = new VidexEntity();
            $htmlParser = new HtmlParser(new Crawler($domElement));
            $videx->setOptionTitle($htmlParser->title());
            $videx->setDescription($htmlParser->description());
            $videx->setPrice($htmlParser->price());
            $videx->setDiscount($htmlParser->discount());

            $array[] = $videx;
        }

        return $array;
    }

    public function serialize(array $data): string
    {
        $jsonEncoder = new JsonEncode();
        return $jsonEncoder->encode($data, 'json');
    }
}
