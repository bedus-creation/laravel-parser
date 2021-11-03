<?php

namespace Aammui\LaravelParser\Tests;

use Aammui\LaravelParser\Facade\PHPSoup;
use Aammui\LaravelParser\Tests\Stubs\HTMLResponseTrait;

/**
 * Class PHPSoupTest
 *
 * @package Aammui\LaravelParser\Tests
 */
class PHPSoupTest extends TestCase
{
    use HTMLResponseTrait;

    /** @test */
    public function it_can_parses_to_text()
    {
        $html = $this->getResponse();

        $soup = PHPSoup::parse($html);

        $this->assertEquals("The Dormouse's story", $soup->get("p>b")->text());
    }

    /** @test */
    public function it_can_parse_to_html()
    {
        $soup = PHPSoup::parse($this->getResponse());

        $html = $soup->get("p")->index(2)->outerHtml();

        $this->assertStringContainsString("<p class=\"story\"", $html);
    }

    /** @test */
    public function it_filters_with_attributes()
    {
        $soup = PHPSoup::parse($this->getAttributesResponse());

        $url = $soup->get("li.class")
            ->first()
            ->attributes("data-url");

        $this->assertEquals("https://google.com", $url);
    }

    /** @test */
    public function it_filters_with_nested_filter()
    {
        $soup = PHPSoup::parse($this->getAttributesResponse());

        $url = $soup->get("ul>li")
            ->first()
            ->attributes("data-url");

        $this->assertEquals("https://google.com", $url);
    }
}
