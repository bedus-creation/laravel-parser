<?php

namespace Aammui\LaravelParser\Tests;

use Aammui\LaravelParser\Parser\PHPSoup;
use Aammui\LaravelParser\Parser\Tag;
use Aammui\LaravelParser\Tests\Stubs\HTMLResponseTrait;

class TitleParsingTest extends TestCase
{
    use HTMLResponseTrait;

    /** @test */
    public function it_parses_using_first()
    {
        $html = $this->getResponse();

        $soup = (new PHPSoup())->parse($html);

        $this->assertStringContainsString("The Dormouse's story\n", $soup->first("p>b")->text());
        $this->assertEquals("The Dormouse's story", $soup->first("p>b")->text(true));
    }

    /** @test */
    public function it_parses_with_get()
    {
        $html = $this->getResponse();

        $soup = (new PHPSoup())->parse($html);

        collect($soup->get("p"))->map(function (Tag $item) {
            return $item->text();
        })->dd();
    }

    /** @test */
    public function it_parses_with_get_and_title()
    {
        $html = <<<HTML
<body>
<h1>I am Heading</h1>
<ul>
<li>List 1</li>
<li>List 2</li>
<li>List 3</li>
</ul>
</body>
HTML;

        $soup = (new PHPSoup())->parse($html);

        $first = $soup->first("body");

        dd($first->first("ul")->first("li")->text());
    }

    /** @test */
    public function it_filters_with_attributes()
    {
        $html = <<<HTML
<body>
<h1>I am Heading</h1>
<ul>
<li class="class-1" href="https://google.com">List 1</li>
<li class="class" href="https://google.com">List 2</li>
<li class="class">List 3</li>
</ul>
</body>
HTML;
        $soup = (new PHPSoup())->parse($html);

        $first = $soup->first("li.class-1")
            ->attributes("href");
//        $first = $soup->first("li")->classes();
        dd($first);
    }
}
