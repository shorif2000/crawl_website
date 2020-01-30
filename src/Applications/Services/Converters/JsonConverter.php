<?php
declare(strict_types=1);

namespace App\Applications\Services\Converters;

use App\Applications\Services\Converters\Interfaces\ConverterInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class JsonConverter implements ConverterInterface
{
    public function unserialize(string $string): array
    {
        $jsonDecoder = new JsonDecode();
        return $jsonDecoder->decode($string);
    }

    public function serialize(array $data): string
    {
        $array = [];

        foreach ($data as $key => $value) {
            $array[] = [
                'title' => $value->getOptionTitle(),
                'description' => $value->getDescription(),
                'price' => $value->getPrice(),
                'discount' => $value->getDiscount()
            ];
        }

        $jsonEncoder = new JsonEncode();
        return $jsonEncoder->encode($array, 'json');
    }

    public function fetch(string $source): string
    {
        // @TODO: Implement fetch() method.
    }
}
