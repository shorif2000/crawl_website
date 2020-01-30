<?php
declare(strict_types=1);

namespace App\Applications\Services\Containers;

use App\Applications\Services\Containers\Interfaces\MetaInterface;
use App\Applications\Services\ResourceManagers\Interfaces\ReaderInterface;
use App\Applications\Services\ResourceManagers\Interfaces\WriterInterface;
use App\Entity\Interfaces\HtmlEntityInterface;

class Meta implements MetaInterface
{

    private $data = [];

    public function addMeta(ReaderInterface $reader): void
    {
        $this->data += $reader->read();
        if(empty($this->data)){
            throw new \Exception('No content found');
        }
    }

    public function saveMeta(WriterInterface $writer): void
    {
        $writer->write($this->data);
    }

    public function sortByPrice(string $order = 'DESC'): void
    {
        usort($this->data, function (HtmlEntityInterface $item1, HtmlEntityInterface $item2) use ($order) {
            if ($order === 'DESC') {
                return $item2->getPrice() <=> $item1->getPrice();
            }

            return $item1->getPrice() <=> $item2->getPrice();
        });
    }

    public function getMeta(): array
    {
        return $this->data;
    }
}
