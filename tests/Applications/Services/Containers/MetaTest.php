<?php

namespace App\Tests\Applications\Services\Parsers;

use App\Applications\Services\Containers\Meta;
use App\Applications\Services\ResourceManagers\Interfaces\ReaderInterface;
use App\Entity\VidexEntity;
use PHPUnit\Framework\TestCase;

class MetaTest extends TestCase
{
    private $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->data = new Meta();
    }

    /**
     * @dataProvider provider
     */
    public function testAddMeta($expected, $provided, $order)
    {
        $reader = $this->createMock(ReaderInterface::class);
        $reader->expects($this->any())
            ->method('read')
            ->willReturn($provided);

        $this->data->addMeta($reader);
        $array = $this->data->getMeta();

        $this->assertCount(2, $array);
    }

    /**
     * @dataProvider provider
     */
    public function testMeta($expected, $provided, $order)
    {
        $reader = $this->createMock(ReaderInterface::class);
        $reader->expects($this->any())
            ->method('read')
            ->willReturn($provided);

        $this->data->addMeta($reader);
        $array = $this->data->getMeta();

        $first = current($array);
        $this->assertInstanceOf(VidexEntity::class, $first);
    }

    /**
     * @dataProvider provider
     */
    public function testSortByPriceDesc($expected, $provided, $order)
    {
        $reader = $this->createMock(ReaderInterface::class);
        $reader->expects($this->any())
            ->method('read')
            ->willReturn($provided);

        $this->data->addMeta($reader);
        $this->data->sortByPrice($order);
        $array = $this->data->getMeta();

        $first = current($array);
        $this->assertInstanceOf(VidexEntity::class, $first);
        $this->assertEquals($expected, $first->getPrice());
    }


    public function provider() : array
    {
        $videx1 = new VidexEntity();
        $videx1->setOptionTitle('First Title');
        $videx1->setDescription('First Desc');
        $videx1->setPrice('1000');
        $videx1->setDiscount('10');

        $videx2 = new VidexEntity();
        $videx2->setOptionTitle('Second Title');
        $videx2->setDescription('Second Desc');
        $videx2->setPrice('500');
        $videx2->setDiscount('10');

        return [
            [
                1000,
                [$videx2, $videx1],
                'DESC'
            ],
            [
                500,
                [$videx2, $videx1],
                'ASC'
            ]
        ];
    }
}
