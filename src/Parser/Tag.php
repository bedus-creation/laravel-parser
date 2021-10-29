<?php

namespace Aammui\LaravelParser\Parser;

use DOMNode;

class Tag
{
    /**
     * @var DOMNode
     */
    private DOMNode $node;

    public function __construct(DOMNode $node)
    {
        $this->node = $node;
    }

    public function first(string $filter)
    {
        return (new PHPSoup())
            ->parse($this->html())
            ->first($filter);
    }

    public function classes()
    {
        return $this->node
            ->attributes
            ->getNamedItem("class")
            ->textContent;
    }

    public function attributes(string $name)
    {
        return $this->node
            ->attributes
            ->getNamedItem($name)
            ->textContent;
    }

    public function get(string $filter)
    {
        return (new PHPSoup())
            ->parse($this->html())
            ->get($filter);
    }

    /**
     * @param bool $trim
     *
     * @return string
     */
    public function text(bool $trim = true): string
    {
        $text = $this->node->textContent;

        if ( !$trim ) {
            return $text;
        }

        return trim($this->node->textContent);
    }

    public function html()
    {
        return $this->node->ownerDocument->saveHTML($this->node);
    }

    public function __toString()
    {
        return $this->html();
    }
}
