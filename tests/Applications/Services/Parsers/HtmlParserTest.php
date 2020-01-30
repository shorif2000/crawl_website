<?php

namespace App\Tests\Applications\Services\Parsers;

use App\Applications\Services\Parsers\HtmlParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class HtmlParserTest extends TestCase
{

    private $htmlParser;

    private $html = <<< 'HTML'
<!DOCTYPE html>
<html>
    <body>
        <div class="col-xs-4">
                    <div class="package featured center" style="margin-left:0px;">
                        <div class="header dark-bg">
                            <h3>Option 2000 Mins</h3>
                        </div>
                        <div class="package-features">
                            <ul>
                                <li>
                                    <div class="package-name">Up to 2000 minutes talk time per year<br> including 420 SMS<br>(5p / minute and 4p / SMS thereafter)</div>
                                </li>
                                <li>
                                    <div class="package-price"><span class="price-big">£108.00</span><br>(inc. VAT)<br>Per Year
                                       <p style="color: red">Save £12 on the monthly price</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="package-data">12 Months - Voice &amp; SMS Service Only</div>
                                </li>
                            </ul>
                            <div class="bottom-row">
                                <a class="btn btn-primary main-action-button" href="activate" role="button">Choose</a>
                            </div>
                        </div>
                    </div>
                </div>
    </body>
</html>
HTML;

    public function setUp(): void
    {
        parent::setUp(); 
        $this->htmlParser = new HtmlParser(new Crawler($this->html));
    }

    public function testTitle()
    {
        $title = $this->htmlParser->title();
        $this->assertEquals('Option 2000 Mins', $title);
    }

    public function testPrice()
    {
        $price = $this->htmlParser->price();
        $this->assertEquals(10800, $price);
    }

    public function testDescription()
    {
        $description = $this->htmlParser->description();
        $this->assertEquals('Up to 2000 minutes talk time per year including 420 SMS(5p / minute and 4p / SMS thereafter)', $description);
    }

    public function testDiscount()
    {
        $discount = $this->htmlParser->discount();
        $this->assertEquals(1200, $discount);
    }
}
