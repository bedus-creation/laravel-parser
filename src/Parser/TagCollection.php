<?php

namespace Aammui\LaravelParser\Parser;

use Illuminate\Support\LazyCollection;

class TagCollection
{
    /**
     * @var
     */
    private $nodeList;

    public function __construct($nodeList)
    {
        $this->nodeList = $nodeList;
    }

    public function first(string $filter)
    {
        return (new PHPSoup())
            ->parse($this->html())
            ->first($filter);
    }

    public function get(string $filter)
    {
        return (new PHPSoup())
            ->parse($this->html())
            ->get($filter);
    }

    public function text(): string
    {
        return LazyCollection::make(function () {
            for ($i = 0; $i < $this->nodeList->length; $i++) {
                yield new Tag($this->nodeList->item($i));
            }
        })->map(function (Tag $item) {
            return $item->text();
        })->implode("");
    }

    public function html(): string
    {
        return LazyCollection::make(function () {
            for ($i = 0; $i < $this->nodeList->length; $i++) {
                yield new Tag($this->nodeList->item($i));
            }
        })->map(function (Tag $item) {
            return $item->html();
        })->implode("");
    }
}
