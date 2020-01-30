<?php

namespace App\Tests\Applications\Services\Parsers;

use App\Applications\Services\Converters\JsonConverter;
use App\Entity\VidexEntity;
use PHPUnit\Framework\TestCase;

class JsonConverterTest extends TestCase
{

    private $jsonConverter;

    public function setUp(): void
    {
        parent::setUp(); 
        $this->jsonConverter = new JsonConverter();
    }

    public function testSerialize()
    {
        $expected = '[{"title":"Option Title","description":"Product Desc","price":1000,"discount":10}]';

        $videx = new VidexEntity();
        $videx->setOptionTitle('Option Title');
        $videx->setDescription('Product Desc');
        $videx->setPrice('1000');
        $videx->setDiscount('10');

        $json = $this->jsonConverter->serialize([$videx]);

        $this->assertIsString($json);
        $this->assertJson($json);
        $this->assertEquals($expected, $json);
    }
}
