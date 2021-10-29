<?php

namespace Aammui\LaravelParser\Parser;

use DOMDocument;
use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

class PHPSoup
{
    /**
     * @var DOMDocument
     */
    protected DOMDocument $dom;

    public function __construct()
    {
        $this->dom = new DOMDocument();
    }

    public function query(string $filter)
    {
        $xpath = new DOMXpath($this->dom);

        $result = $xpath->query($filter)->item(0);
    }

    public function parse(string $html)
    {
        $this->dom->loadHTML($html);

        return $this;
    }

    public function first(string $filter)
    {
        $converter = new CssSelectorConverter();

        $xPathFilter = $converter->toXPath($filter);

        $xpath = new DOMXpath($this->dom);

        $result = $xpath->query($xPathFilter)->item(0);

        return new Tag($result);
    }

    public function get(string $filter)
    {
        $converter = new CssSelectorConverter();

        $xPathFilter = $converter->toXPath($filter);

        $xpath = new DOMXpath($this->dom);

        $results = $xpath->query($xPathFilter);

        return new TagCollection($results);
    }
}
